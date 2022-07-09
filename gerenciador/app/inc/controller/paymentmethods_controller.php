<?php
class paymentmethods_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "")
	{
		$boiler = new payment_methods_model();
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
			$filter["filter_q"] = " concat_ws(' ', first_name, last_name ) like '%" . $info["get"]["q_name"] . "%' ";
		}

		if (isset($info["get"]["q_mail"]) && !empty($info["get"]["q_mail"])) {
			$filter["filter_q"] = " mail like '%" . $info["get"]["q_mail"] . "%' ";
		}

		if (isset($info["get"]["q_cpf"]) && !empty($info["get"]["q_cpf"])) {
			$filter["filter_q"] = " cpf like '%" . $info["get"]["q_cpf"] . "%' ";
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

		if (isset($info["get"]["filter_CPF"]) && !empty($info["get"]["filter_CPF"])) {
			$done["filter_CPF"] = $info["get"]["filter_CPF"];
			$filter["filter_CPF"] = " document like '%" . $info["get"]["filter_CPF"] . "%' ";
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

		if (isset($info["get"]["query"]) && strlen(addslashes($info["get"]["query"]))) {
			$query = preg_replace("/\[+?|\]+?/", "", toUtf8($info["get"]["query"]));
			$query = preg_replace("/\s+?|\t+?|\n+?/", " ", $query);
			$query = preg_replace("/^ | $/", "", $query);
			$query = preg_replace("/([A-z0-9\ \-\_])+?/", "$1", $query);

			if (empty($query)) {
				$query = " ";
			}

			switch ($info["get"]["autcomplete_field"]) {
				case "cpf":
					$query = preg_replace("/\D+?/im", "", $query);
					$info["get"]["q_cpf"] = $query;
					break;
				case "name":
					$info["get"]["q_name"] = $query;
					break;
				case "mail":
					$info["get"]["q_mail"] = $query;
					break;
			}
		}

		list($done, $filter) = $this->filter($info);
		$payment_methods = new payment_methods_model();

		$payment_methods->set_filter($filter);
		$payment_methods->set_order(array($ordenation));
		list($total, $data) = $payment_methods->return_data();
		$data = $payment_methods->data;

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
						"value" => sprintf("%s", $value["first_name"])
					);
				}

				header('Content-type: application/json');
				echo json_encode($out);
				break;
			default:
				$page = 'Formas de Pagamentos';

				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["payment_methods_url"], $done) : $GLOBALS["payment_methods_url"]),
					"pattern" => array(
						"new" => $GLOBALS["newpayment_method_url"],
						"action" => $GLOBALS["payment_method_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["payment_methods_url"], $info["get"]) : $GLOBALS["payment_methods_url"]
					)
				);

				$ordenation_idx = 'idx-asc';
				$ordenation_idx_ordenation = 'fa fa-sort';
				$ordenation_name = 'first_name-asc';
				$ordenation_name_ordenation = 'fa fa-sort';
				$ordenation_cpf = 'document-asc';
				$ordenation_cpf_ordenation = 'fa fa-sort';
				switch ($ordenation) {
					case 'idx asc':
						$ordenation_idx = 'idx-desc';
						$ordenation_idx_ordenation = 'fa fa-sort-asc';
						break;
					case 'idx desc':
						$ordenation_idx = 'idx-asc';
						$ordenation_idx_ordenation = 'fa fa-sort-desc';
						break;
					case 'first_name asc':
						$ordenation_name = 'first_name-desc';
						$ordenation_name_ordenation = 'fa fa-sort-asc';
						break;
					case 'first_name desc':
						$ordenation_name = 'first_name-asc';
						$ordenation_name_ordenation = 'fa fa-sort-desc';
						break;
					case 'document asc':
						$ordenation_cpf = 'document-desc';
						$ordenation_cpf_ordenation = 'fa fa-sort-asc';
						break;
					case 'document desc':
						$ordenation_cpf = 'document-asc';
						$ordenation_cpf_ordenation = 'fa fa-sort-desc';
						break;
				}

				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/payment_methods/payment_methods.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				include(constant("cRootServer") . "furniture/js/payment_methods/payment_methods.js");
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

		if (isset($info["idx"])) {
			$payment_method = new payment_methods_model();
			$payment_method->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$payment_method->load_data();
			$payment_method->attach(array("products"), null, null, array("idx"));
			$data = current($payment_method->data);

			$form = array(
				"title" => "Editar Conta Bancária",
				"url" => sprintf($GLOBALS["payment_method_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Conta Bancária",
				"url" => $GLOBALS["newpayment_method_url"]
			);
		}

		$page = 'Conta Bancária';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/payment_methods/payment_method.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		include(constant("cRootServer") . "furniture/js/payment_methods/payment_method.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$payment_method = new payment_methods_model();

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$payment_method->set_filter(array(" idx = '" . $info["idx"] . "' "));
		} else {
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		$payment_method->populate($info["post"]);
		$payment_method->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $payment_method->con->insert_id;
		}

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["payment_methods_url"]);
		}
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$payment_method = new payment_methods_model();

			$payment_method->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$payment_method->remove();
		}

		basic_redir($GLOBALS["payment_methods_url"]);
	}
}
