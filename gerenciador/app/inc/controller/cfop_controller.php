<?php
class cfop_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "name")
	{
		$boiler = new cfop_model();
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
		if (isset($info["get"]["filter_id"]) && !empty($info["get"]["filter_id"])) {
			$done["filter_id"] = $info["get"]["filter_id"];
			$filter["filter_id"] = " idx like '%" . $info["get"]["filter_id"] . "%' ";
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
// print_pre('teste1', true);

		$paginate = isset($info["get"]["paginate"]) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20;
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'idx asc';

		$cfops = new cfop_model();

		switch ($info["format"]) {
			case ".autocomplete":
				$cfops->set_paginate(array(0, 12));

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
				$cfops->set_paginate(array((int)$info["sr"] > $paginate ? (int)$info["sr"] : 0, $paginate));
				break;
		}
		list($done, $filter) = $this->filter($info);
		$cfops->set_filter($filter);

		$cfops->set_filter($filter);
		$cfops->set_order(array($ordenation));
		list($total, $data) = $cfops->return_data();
		$data = $cfops->data;

		switch ($info["format"]) {
			case ".autocomplete":

				$out = array(
					"query" => "", "suggestions" => array()
				);

				foreach ($data as $key => $value) {
					$out["suggestions"][] = array(
						"data" => $value,
						"value" => sprintf("%s %s (%s) ", $value["name"])
					);
				}

			
			// 	header('Content-type: application/json');
			// 	echo json_encode($out);
			// 	break;
			// case ".xls":
			// 	if (file_exists(constant("cFurniture1") . 'excel/contracts/Relatorio.xls')) {
			// 		unlink(constant("cFurniture1") . 'excel/contracts/Relatorio.xls');
			// 	}

			// 	$name = "Relatorio_Clientes_" .  date("d-m-Y-H:s");
			// 	require_once(constant("cRootServer_APP") . '/inc/lib/PHPExcel-1.8/Classes/PHPExcel.php');
			// 	$objPHPExcel = new PHPExcel();
			// 	$objPHPExcel->getProperties()->setCreator("HSOL")
			// 		->setLastModifiedBy("SYSMOB")
			// 		->setTitle("Relatorio de Clientes")
			// 		->setSubject("Relatorio de Clientes")
			// 		->setDescription("Relatorio de Clientes")
			// 		->setKeywords("Clientes")
			// 		->setCategory("Clientes");

			// 	$objPHPExcel = PHPExcel_IOFactory::load(constant("cFurniture1") . 'excel/contracts/modelo-contracts.xlsx');

			// 	$objPHPExcel->setActiveSheetIndex(0)->setTitle('Clientes');

			// 	$x_in = 13;
			// 	foreach ($data as $k => $v) {
			// 		$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($x_in, 1);
			// 		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . $x_in . ':E' . $x_in);

			// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . ($x_in - 1), $v["name"] . " " . $v["last_name"]);
			// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . ($x_in - 1), preg_replace("/(...)(...)(...)(..)$/", "$1.$2.$3-$4", preg_replace("/\.|-/", "", $v["cpf"])));
			// 		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . ($x_in - 1), $v["mail"]);
			// 		if (!empty($v["complement"])) {
			// 			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . ($x_in - 1), $v["address"] . ", N° " . $v["number_address"] . ", " . $v["complement"] . ", " . $v["postalcode"] . ", " . $v["district"] . ", " . $v["city"] . " - " .  $v["uf"]);
			// 		} else {
			// 			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . ($x_in - 1), $v["address"] . ", N° " . $v["number_address"] . ", " . $v["postalcode"] . ", " . $v["district"] . ", " . $v["city"] . " - " .  $v["uf"]);
			// 		}
			// 		$x_in++;
			// 	}

			// 	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			// 	$objWriter->setIncludeCharts(TRUE);
			// 	$objWriter->save(constant("cFurniture1") . 'excel/contracts/Relatorio.xlsx');
			// 	$objWriter->setOffice2003Compatibility(true);
			// 	$objPHPExcel->disconnectWorksheets();
			// 	$objPHPExcel->garbageCollect();
			// 	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// 	header('Content-Disposition: attachment; filename="' . $name . '.xlsx"');

				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
				header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header('Pragma: public'); // HTTP/1.0
				ob_clean();
				flush();
				readfile(constant("cFurniture1") . 'excel/contracts/Relatorio.xlsx');
				unset($objPHPExcel);
				exit();
				break;
			case ".json":
				$total = array("total" => 3);
				header('Content-type: application/json');
				echo json_encode(
					array(
						"total" => array_merge(array("total" => array_sum($total)), $total), "row" => $data
					)
				);
				break;
			default:
				$page = 'CFOPS';

				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["cfops_url"], $done) : $GLOBALS["cfops_url"]), "pattern" => array(
						"new" => $GLOBALS["newcfop_url"],
						"action" => $GLOBALS["cfop_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["cfops_url"], $info["get"]) : $GLOBALS["cfops_url"]
					)
				);

				$ordenation_id = 'idx-asc';
				$ordenation_id_ordenation = 'fa fa-sort';
				$ordenation_name = 'name-asc';
				$ordenation_name_ordenation = 'fa fa-sort';
				$ordenation_description = 'description-asc';
				$ordenation_description_ordenation = 'fa fa-sort';
				switch ($ordenation) {
					case 'idx asc':
						$ordenation_idx = 'idx-desc';
						$ordenation_idx_ordenation = 'fa fa-sort-asc';
						break;
					case 'idx desc':
						$ordenation_idx = 'idx-asc';
						$ordenation_idx_ordenation = 'fa fa-sort-desc';
						break;
					case 'name asc':
						$ordenation_name = 'name-desc';
						$ordenation_name_ordenation = 'fa fa-sort-asc';
						break;
					case 'name desc':
						$ordenation_name = 'name-asc';
						$ordenation_name_ordenation = 'fa fa-sort-desc';
						break;
					case 'description asc':
						$ordenation_description = 'description-desc';
						$ordenation_description_ordenation = 'fa fa-sort-asc';
						break;
					case 'description desc':
						$ordenation_description = 'description-asc';
						$ordenation_description_ordenation = 'fa fa-sort-desc';
						break;
				}

				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/cfops/cfops.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				include(constant("cRootServer") . "furniture/js/cfop/cfops.js");
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

		// print_pre($info, true);

		if (isset($info["idx"])) {
			$cfops = new cfop_model();
			$cfops->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$cfops->load_data();
			$data = current($cfops->data);

			// print_pre($data, true);

			$form = array(
				"title" => "Editar CFOP",
				"url" => sprintf($GLOBALS["cfop_url"], $info["idx"])
			);
			// print_pre($info, true);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar CFOP",
				"url" => $GLOBALS["newcfop_url"]
			);
		}

		$info["get"]["done"] = isset($info["get"]["done"]) ? rawurldecode($info["get"]["done"]) : $GLOBALS["cfops_url"];

		$page = 'CFOP';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/cfops/cfop.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["cfop_url"]) . '" ');
		print('})' . "\n");
		include(constant("cRootServer") . "furniture/js/cfop/cfops.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$cfops = new cfop_model();

		// print_pre($info, true);

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$cfops->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		$cfops->populate($info["post"]);
		$cfops->save();


		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $cfops->con->insert_id;
		}


		$boiler = new cfop_model();
		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$boiler->set_filter(array(" idx = '" . $info["idx"] . "' "));
		}
		
		$boiler->populate($info["post"]);
		$boiler->save();
		
		$_SESSION["messages_app"]["success"] = array("Cfop Cadastrado com sucesso.");
		
		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["cfops_url"]);
		}
		
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$cfops = new cfop_model();

			$cfops->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$cfops->remove();
		}

		basic_redir($GLOBALS["cfops_url"]);
	}
}
