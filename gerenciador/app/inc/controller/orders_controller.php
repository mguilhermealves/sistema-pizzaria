<?php

use Dompdf\Dompdf;

class orders_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "")
	{
		$boiler = new orders_model();
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

		$filter = array(" active = 'yes' ", " companie_id in ( select companies.idx from companies where companies.active = 'yes' and companies.idx = '" . $_SESSION[constant("cAppKey")]["companie_id"] ."' ) ");

		if (isset($info["get"]["paginate"]) && !empty($info["get"]["paginate"])) {
			$done["paginate"] = $info["get"]["paginate"];
		}
		if (isset($info["get"]["sr"]) && !empty($info["get"]["sr"])) {
			$done["sr"] = $info["get"]["sr"];
		}
		if (isset($info["get"]["ordenation"]) && !empty($info["get"]["ordenation"])) {
			$done["ordenation"] = $info["get"]["ordenation"];
		}

		if (isset($info["get"]["filter_start_date"]) && !empty($info["get"]["filter_start_date"])) {
			$done["filter_start_date"] = $info["get"]["filter_start_date"];
			$filter["filter_start_date"] = " created_at >= '" . $info["get"]["filter_start_date"] . "' ";
		} else {
			$filter["filter_start_date"] = " created_at >= '" . date("Y-m-d 00:00:00") . "' ";
		}

		if (isset($info["get"]["filter_end_date"]) && !empty($info["get"]["filter_end_date"])) {
			$done["filter_end_date"] = $info["get"]["filter_end_date"];
			$filter["filter_end_date"] = " created_at <= '" . $info["get"]["filter_end_date"] . "' ";
		} else {
			$filter["filter_end_date"] = " created_at <= '" . date("Y-m-d 23:59:59") . "' ";
		}

		if (isset($info["get"]["filter_uf"]) && !empty($info["get"]["filter_uf"])) {
			$done["filter_uf"] = $info["get"]["filter_uf"];
			$filter["filter_uf"] = " uf like '%" . $info["get"]["filter_uf"] . "%' ";
		}

		if (isset($info["get"]["filter_status"]) && !empty($info["get"]["filter_status"])) {
			$done["filter_status"] = $info["get"]["filter_status"];
			$filter["filter_status"] = " is_aproved = '" . $info["get"]["filter_status"] . "' ";
		}

		if (isset($info["get"]["filter_type"]) && !empty($info["get"]["filter_type"])) {
			$done["filter_type"] = $info["get"]["filter_type"];
			$filter["filter_type"] = " object_propertie  = '" . $info["get"]["filter_type"] . "' ";
		}

		if (isset($info["get"]["filter_cpf"]) && !empty($info["get"]["filter_cpf"])) {
			$info["get"]["filter_cpf"] = preg_replace("/[^0-9]/", "", $info["get"]["filter_cpf"]);
			$done["filter_cpf"] = $info["get"]["filter_cpf"];
			$filter["filter_cpf"] = " document like '%" . $info["get"]["filter_cpf"] . "%' ";
		}

		if (isset($info["get"]["filter_contract"]) && !empty($info["get"]["filter_contract"])) {
			$done["filter_contract"] = $info["get"]["filter_contract"];
			$filter["filter_contract"] = " n_contract like '%" . $info["get"]["filter_contract"] . "%' ";
		}

		if (isset($info["get"]["filter_name"]) && !empty($info["get"]["filter_name"])) {
			$done["filter_name"] = $info["get"]["filter_name"];
			$filter["filter_name"] = " concat_ws(' ' , first_name , last_name ) like '%" . $info["get"]["filter_name"] . "%' ";
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

		$orders = new orders_model();

		if ($info["format"] != ".json") {
			$orders->set_paginate(array($info["sr"], $paginate));
		} else {
			$orders->set_paginate(array(0, 900000));
		}

		$orders->set_filter($filter);
		$orders->set_order(array($ordenation));

		list($total, $data) = $orders->return_data();
		$orders->attach(array("clients", "orderstatus"));
		$data = $orders->data;

		switch ($info["format"]) {
			case ".json":
				header('Content-type: application/json');
				echo json_encode(
					array(
						"total" => array("total" => $total), "row" => $data
					)
				);
				break;
			case ".xls":

				if (file_exists(constant("cFurniture1") . 'excel/orders/Relatorio.xls')) {
					unlink(constant("cFurniture1") . 'excel/orders/Relatorio.xls');
				}

				$name = "Relatorio_Alugueis_e_Vendas_" .  date("d-m-Y-H:s");
				require_once(constant("cRootServer_APP") . '/inc/lib/PHPExcel-1.8/Classes/PHPExcel.php');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setCreator("SYSMOB")
					->setLastModifiedBy("SYSMOB")
					->setTitle("Relatorio de Aluguel e Vendas")
					->setSubject("Relatorio de Aluguel e Vendas")
					->setDescription("Relatorio de Aluguel e Vendas")
					->setKeywords("Aluguel e Vendas")
					->setCategory("Aluguel e Vendas");

				$objPHPExcel = PHPExcel_IOFactory::load(constant("cFurniture1") . 'excel/orders/modelo-orders.xlsx');

				$objPHPExcel->setActiveSheetIndex(0)->setTitle('Aluguel e Vendas');

				$x_in = 13;
				foreach ($data as $k => $v) {
					$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($x_in, 1);
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . $x_in . ':E' . $x_in);

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . ($x_in - 1), $v["first_name"] . " " . $v["last_name"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . ($x_in - 1), preg_replace("/(...)(...)(...)(..)$/", "$1.$2.$3-$4", preg_replace("/\.|-/", "", $v["document"])));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . ($x_in - 1), $v["mail"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . ($x_in - 1), $v["number_residents"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . ($x_in - 1), $GLOBALS["status_location"][$v["is_aproved"]]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . ($x_in - 1), $v["day_due"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K' . ($x_in - 1), $GLOBALS["payment_method"][$v["payment_method"]]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L' . ($x_in - 1), $v["n_contract"]);

					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('M' . $x_in . ':N' . $x_in);

					if (!empty($v["complement"])) {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M' . ($x_in - 1), $v["address"] . ", N° " . $v["number_address"] . ", " . $v["complement"] . ", " . preg_replace("/(.....)(...)$/", "$1-$2", preg_replace("/\.|-/", "", $v["code_postal"])) . ", " . $v["district"] . ", " . $v["city"] . " - " .  $v["uf"]);
					} else {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M' . ($x_in - 1), $v["address"] . ", N° " . $v["number_address"] . ", " . preg_replace("/(.....)(...)$/", "$1-$2", preg_replace("/\.|-/", "", $v["code_postal"])) . ", " . $v["district"] . ", " . $v["city"] . " - " .  $v["uf"]);
					}

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O' . ($x_in - 1), $v["properties_attach"][0]["clients_attach"][0]["first_name"] . " " . $v["properties_attach"][0]["clients_attach"][0]["last_name"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P' . ($x_in - 1), preg_replace("/(...)(...)(...)(..)$/", "$1.$2.$3-$4", preg_replace("/\.|-/", "", $v["properties_attach"][0]["clients_attach"][0]["document"])));

					$x_in++;
				}

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->setIncludeCharts(TRUE);
				$objWriter->save(constant("cFurniture1") . 'excel/orders/Relatorio.xlsx');
				$objWriter->setOffice2003Compatibility(true);
				$objPHPExcel->disconnectWorksheets();
				$objPHPExcel->garbageCollect();
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment; filename="' . $name . '.xlsx"');

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
				readfile(constant("cFurniture1") . 'excel/orders/Relatorio.xlsx');
				unset($objPHPExcel);
				exit();
				break;
			default:
				$page = 'Pedidos';

				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["orders_url"], $done) : $GLOBALS["orders_url"]),
					"pattern" => array(
						"new" => $GLOBALS["neworder_url"],
						"action" => $GLOBALS["order_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["orders_url"], $info["get"]) : $GLOBALS["orders_url"]
					)
				);

				$ordenation_id = 'idx-asc';
				$ordenation_id_ordenation = 'bi bi-border';
				$ordenation_name = 'nome-asc';
				$ordenation_name_ordenation = 'bi bi-border';
				$ordenation_cpf = 'cpf-asc';
				$ordenation_cpf_ordenation = 'bi bi-border';
				$ordenation_type = 'object_propertie-asc';
				$ordenation_type_ordenation = 'bi bi-border';
				$ordenation_is_aproved = 'is_aproved-asc';
				$ordenation_is_aproved_ordenation = 'bi bi-border';
				$ordenation_ncontract = 'n_contract-asc';
				$ordenation_ncontract_ordenation = 'bi bi-border';
				switch ($ordenation) {
					case 'idx asc':
						$ordenation_id = 'idx-desc';
						$ordenation_id_ordenation = 'bi bi-arrow-up';
						break;
					case 'idx desc':
						$ordenation_id = 'idx-asc';
						$ordenation_id_ordenation = 'bi bi-arrow-down';
						break;
					case 'nome asc':
						$ordenation_name = 'nome-desc';
						$ordenation_name_ordenation = 'bi bi-arrow-up';
						break;
					case 'nome desc':
						$ordenation_name = 'nome-asc';
						$ordenation_name_ordenation = 'bi bi-arrow-down';
						break;
					case 'cpf asc':
						$ordenation_cpf = 'cpf-desc';
						$ordenation_cpf_ordenation = 'bi bi-arrow-up';
						break;
					case 'cpf desc':
						$ordenation_cpf = 'cpf-asc';
						$ordenation_cpf_ordenation = 'bi bi-arrow-down';
						break;
					case 'object_propertie asc':
						$ordenation_type = 'object_propertie-desc';
						$ordenation_type_ordenation = 'bi bi-arrow-up';
						break;
					case 'object_propertie desc':
						$ordenation_type = 'object_propertie-asc';
						$ordenation_type_ordenation = 'bi bi-arrow-down';
						break;
					case 'n_contract asc':
						$ordenation_ncontract = 'n_contract-desc';
						$ordenation_ncontract_ordenation = 'bi bi-arrow-up';
						break;
					case 'n_contract desc':
						$ordenation_ncontract = 'n_contract-asc';
						$ordenation_ncontract_ordenation = 'bi bi-arrow-down';
						break;
					case 'is_aproved asc':
						$ordenation_is_aproved = 'is_aproved-desc';
						$ordenation_is_aproved_ordenation = 'bi bi-arrow-up';
						break;
					case 'is_aproved desc':
						$ordenation_is_aproved = 'is_aproved-asc';
						$ordenation_is_aproved_ordenation = 'bi bi-arrow-down';
						break;
				}

				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/orders/orders.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				print('    data_location_json = {' . "\n");
				print('        url: "' . $GLOBALS["orders_url"] . '.json"' . "\n");
				print('        , data: ' . json_encode($done) . "\n");
				print('        , action: "' . set_url($GLOBALS["order_url"], array("done" => rawurlencode($form["done"]))) . '"' . "\n");
				print('        , template: ""' . "\n");
				print('        , page: 1' . "\n");
				print('    }' . "\n");
				include(constant("cRootServer") . "furniture/js/orders/orders.js");
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
			$order = new orders_model();
			$order->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$order->load_data();
			$order->attach(array("clients", "orderstatus"));
			$order->join("companies", "companies", array("idx" => "companie_id"));
			$data = current($order->data);

			$timelines = unserialize($data["timeline"]);

			$form = array(
				"title" => "Editar Pedido",
				"url" => sprintf($GLOBALS["order_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Pedido",
				"url" => $GLOBALS["neworder_url"]
			);
		}

		$info["get"]["done"] = isset($info["get"]["done"]) ? rawurldecode($info["get"]["done"]) : $GLOBALS["orders_url"];

		$pages = 'Pedidos';
		$page = 'Pedido';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/orders/order.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		include(constant("cRootServer") . "furniture/js/orders/order.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$order = new orders_model();

		$info["post"]["value"] = str_replace('.', '', $info["post"]["value"]);
		$info["post"]["tax"] = str_replace('.', '', $info["post"]["tax"]);

		print_pre($info, true);

		if (isset($info["post"]["has_balance_request"]) && $info["post"]["has_balance_request"] == "on") {
			$info["post"]["has_balance_request"] = "yes";
		} else {
			$info["post"]["has_balance_request"] = "no";
		}

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$order->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		if ($info["post"]["orderstatus_id"] == 1) {
			$info["post"]["emitted_at"] = date("Y-m-d H:i:s");
			$info["post"]["emitted_by"] = $_SESSION[constant("cAppKey")]["credential"]["idx"];

			$historic = array([
				'title' => 'Pré Pedido Criado',
				'description' => 'Pré pedido criado.',
				'date' =>  date("Y-m-d"),
				'time' =>  date("H:i:s"),
				'icon' => 'fa fa-envelope bg-blue',
				'color' => 'bg-green',
				'username' => $_SESSION[constant("cAppKey")]["credential"]["first_name"]
			]);

			$info["post"]['timeline'] = serialize($historic);
		}

		$order->populate($info["post"]);
		$order->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $order->con->insert_id;
		}

		$order->save_attach($info, array("clients", "orderstatus"));

		$_SESSION["messages_app"]["success"] = array("Pedido efetuado com sucesso.");

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["orders_url"]);
		}
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$order = new orders_model();

			$order->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$order->remove();
		}

		basic_redir($GLOBALS["orders_url"]);
	}
}
