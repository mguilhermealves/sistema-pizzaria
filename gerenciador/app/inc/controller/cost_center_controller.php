<?php
class cost_center_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "")
	{
		$boiler = new cost_center_model();
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
			$filter["q_name"] = " cost_center LIKE '%" . $info["get"]["q_name"] . "%' ";
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

		if (isset($info["get"]["filter_cost_center"]) && !empty($info["get"]["filter_cost_center"])) {
			$done["filter_cost_center"] = $info["get"]["filter_cost_center"];
			$filter["filter_cost_center"] = " idx like '%" . $info["get"]["filter_cost_center"] . "%' ";
		}

		if (isset($info["get"]["filter_name"]) && !empty($info["get"]["filter_name"])) {
			$done["filter_name"] = $info["get"]["filter_name"];
			$filter["filter_name"] = " name like '%" . $info["get"]["filter_name"] . "%' ";
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

		$cost_centers = new cost_center_model();

		switch ($info["format"]) {
			case ".autocomplete":
				$cost_centers->set_paginate(array(0, 12));

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
				$cost_centers->set_paginate(array((int)$info["sr"] > $paginate ? (int)$info["sr"] : 0, $paginate));
				break;
		}
		list($done, $filter) = $this->filter($info);
		$cost_centers->set_filter($filter);

		$cost_centers->set_filter($filter);
		$cost_centers->set_order(array($ordenation));
		list($total, $data) = $cost_centers->return_data();

		$data = $cost_centers->data;
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
						"value" => sprintf("%s - %s ", $value["cost_center"], $value["name"])
					);
				}

				header('Content-type: application/json');
				echo json_encode($out);
				break;
			default:
				$page = 'Centro de Custo';
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["cost_centers_url"], $done) : $GLOBALS["cost_centers_url"]), "pattern" => array(
						"new" => $GLOBALS["newcost_center_url"],
						"action" => $GLOBALS["cost_center_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["cost_centers_url"], $info["get"]) : $GLOBALS["cost_centers_url"]
					)
				);
				
				$ordenation_id = 'idx-asc';
				$ordenation_id_ordenation = 'fa fa-sort';
				$ordenation_name = 'name-asc';
				$ordenation_name_ordenation = 'fa fa-sort';
				switch ($ordenation) {
					case 'idx asc':
						$ordenation_id = 'idx-desc';
						$ordenation_id_ordenation = 'fa fa-sort';
						break;
					case 'idx desc':
						$ordenation_id = 'idx-asc';
						$ordenation_id_ordenation = 'fa fa-sort';
						break;
					case 'name asc':
						$ordenation_name = 'name-desc';
						$ordenation_name_ordenation = 'fa fa-sort';
						break;
					case 'name desc':
						$ordenation_name = 'name-asc';
						$ordenation_name_ordenation = 'fa fa-sort';
						break;
				}

				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/cost_center/cost_centers.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				include(constant("cRootServer") . "furniture/js/cost_centers/cost_center.js");
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
			$cost_center = new cost_center_model();
			$cost_center->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$cost_center->load_data();
			// $cost_center->attach(array("cost_center_categories"));
			$data = current($cost_center->data);
			$form = array(
				"title" => "Editar Centro de Custo",
				"url" => sprintf($GLOBALS["cost_center_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Centro de Custo",
				"url" => $GLOBALS["newcost_center_url"]
			);
		}
		// print_pre($form, true);
		$info["get"]["done"] = isset($info["get"]["done"]) ? rawurldecode($info["get"]["done"]) : $GLOBALS["cost_centers_url"];

		$sidebar_color = "rgba(95, 158, 160, 1)";
		$page = 'Centro-de-custo';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/cost_center/cost_center.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print('<script>' . "\n");
		include(constant("cRootServer") . "furniture/js/cost_centers/cost_center.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$cost_center = new cost_center_model();

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$cost_center->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		  } 
		  $cost_center->populate($info["post"]);
		  $cost_center->save();
  
		  if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			  $info["idx"] = $cost_center->con->insert_id;
		  }
  
		  $_SESSION["messages_app"]["success"] = array("Centro de custo Cadastrado com sucesso.");
  
		  if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			  basic_redir($info["post"]["done"]);
		  } else {
			  basic_redir($GLOBALS["cost_centers_url"]);
		  }
  
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$cost_center = new cost_center_model();

			$cost_center->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$cost_center->remove();
		}

		basic_redir($GLOBALS["cost_centers_url"]);
	}
}
