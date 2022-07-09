<?php
class companies_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "")
	{
		$boiler = new companies_model();
		$boiler->set_field(array($key, $field));
		$boiler->set_order(array(" idx desc "));
		$boiler->set_filter($filters);
		$boiler->load_data();
		$out = array();
		foreach ($boiler->data as $value) {
			$out[$value[$key]] = $value[$field];
		}
		return $out;
	}

	private function filter($info)
	{
		$done = array();
		$filter = array(" active = 'yes' ");

		if (isset($info["get"]["q_name"]) && !empty($info["get"]["q_name"])) {
			$filter["q_name"] = " name like '%" . $info["get"]["q_name"] . "%' ";
		}

		if (isset($info["get"]["paginate"]) && !empty($info["get"]["paginate"])) {
			$done["paginate"] = $info["get"]["paginate"];
		}
		if (isset($info["get"]["sr"]) && !empty($info["get"]["sr"])) {
			$done["sr"] = $info["get"]["sr"];
		}
		if (isset($info["get"]["ordenation"]) && !empty($info["get"]["ordenation"])) {
			$done["ordenation"] = $info["get"]["ordenation"];
		}

		if (isset($info["get"]["filter_name"]) && !empty($info["get"]["filter_name"])) {
			$done["filter_name"] = $info["get"]["filter_name"];
			$filter["filter_name"] = " name like '%" . $info["get"]["filter_name"] . "%' ";
		}

		if (isset($info["get"]["filter_cnpj"]) && !empty($info["get"]["filter_cnpj"])) {
			$done["filter_cnpj"] = $info["get"]["filter_cnpj"];
			$filter["filter_cnpj"] = " cnpj like '%" . $info["get"]["filter_cnpj"] . "%' ";
		}

		return array($done, $filter);
	}

	public function display($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}
		$paginate = isset($info["get"]["paginate"]) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20;
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'idx desc';

		list($done, $filter) = $this->filter($info);

		$companies = new companies_model();

		switch ($info["format"]) {
			case ".autocomplete":
				$companies->set_paginate(array(0, 12));

				if (isset($info["get"]["query"]) && strlen(addslashes($info["get"]["query"]))) {
					$query = preg_replace("/\[+?|\]+?/", "", toUtf8($info["get"]["query"]));
					$query = preg_replace("/\s+?|\t+?|\n+?/", " ", $query);
					$query = preg_replace("/^ | $/", "", $query);
					$query = preg_replace("/([A-z0-9\ \-\_])+?/", "$1", $query);

					if (empty($query)) {
						$query = " ";
					} else {
						$info["get"]["q_name"] = $query;
					}
				}
				break;
			default:
				$companies->set_paginate(array((int)$info["sr"] > $paginate ? (int)$info["sr"] : 0, $paginate));
				break;
		}

		list($done, $filter) = $this->filter($info);
		$companies->set_filter($filter);

		$companies->set_filter($filter);
		$companies->set_order(array($ordenation));
		list($total, $data) = $companies->return_data();
		$data = $companies->data;

		$data = $companies->data;
		switch ($info["format"]) {
			case ".json":
				header('Content-type: application/json');
				echo json_encode(
					array(
						"total" => array("total" => $total), "row" => $data
					)
				);
				break;
			case ".autocomplete":
				$out = array(
					"query" => "", "suggestions" => array()
				);
				foreach ($data as $key => $value) {
					$out["suggestions"][] = array(
						"data" => $value,
						"value" => sprintf("%s", $value["name"])
					);
				}

				header('Content-type: application/json');
				echo json_encode($out);
				break;
			default:
				$page = 'Empresas';

				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["companies_url"], $done) : $GLOBALS["companies_url"]), "pattern" => array(
						"new" => $GLOBALS["newcompany_url"],
						"action" => $GLOBALS["company_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["companies_url"], $info["get"]) : $GLOBALS["companies_url"]
					)
				);

				$ordenation_name = 'name-asc';
				$ordenation_name_ordenation = 'fa fa-sort';
				$ordenation_cnpj = 'cnpj-asc';
				$ordenation_cnpj_ordenation = 'fa fa-sort';
				switch ($ordenation) {
					case 'name asc':
						$ordenation_name = 'name-desc';
						$ordenation_name_ordenation = 'fa fa-sort-asc';
						break;
					case 'name desc':
						$ordenation_name = 'name-asc';
						$ordenation_name_ordenation = 'fa fa-sort-desc';
						break;
					case 'cnpj asc':
						$ordenation_cnpj = 'cnpj-desc';
						$ordenation_cnpj_ordenation = 'fa fa-sort-asc';
						break;
					case 'cnpj desc':
						$ordenation_cnpj = 'cnpj-asc';
						$ordenation_cnpj_ordenation = 'fa fa-sort-desc';
						break;
				}

				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/companies/companies.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				include(constant("cRootServer") . "furniture/js/companies/companies.js");
				print('</script>' . "\n");
				include(constant("cRootServer") . "ui/common/foot.inc.php");
				break;
		}
	}

	public function form($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$bank_account = new bankaccounts_model();
		$bank_account->set_filter(array(" active = 'yes' "));
		$bank_account->load_data();
		$data2 = $bank_account->data;

		if (isset($info["idx"])) {
			$company = new companies_model();
			$company->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$company->load_data();
			$company->attach(array("partners"));
			$company->attach(array("bankaccounts"), null, null, array("idx"));
			$data = current($company->data);

			$bankaccounts_id = array_column($data["bankaccounts_attach"], 'idx');

			$form = array(
				"title" => "Editar Empresa",
				"url" => sprintf($GLOBALS["company_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Empresa",
				"url" => $GLOBALS["newcompany_url"]
			);
		}

		$page = 'Empresa';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/companies/company.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		include(constant("cRootServer") . "furniture/js/companies/company.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$company = new companies_model();

		$info["post"]["cnpj"] = preg_replace("/[^0-9]/", "", $info["post"]["cnpj"]);
		$info["post"]["phone"] = preg_replace("/[^0-9]/", "", $info["post"]["phone"]);
		$info["post"]["postalcode"] = preg_replace("/[^0-9]/", "", $info["post"]["postalcode"]);

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$company->set_filter(array(" idx = '" . $info["idx"] . "' "));
		} else {
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		$company->populate($info["post"]);
		$company->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $company->con->insert_id;
		}

		$company->save_attach($info, array("bankaccounts"));

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["companies_url"]);
		}
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$company = new companies_model();

			$company->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$company->remove();
		}

		basic_redir($GLOBALS["companies_url"]);
	}

	public function save_partners($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$company = new companies_model();
		$company->set_filter(array(" idx = '" . $info["idx"] . "' "));

		$company->save_attach($info, array("partners"));

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["companies_url"]);
		}
	}
}
