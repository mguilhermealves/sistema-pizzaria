<?php

class status_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "")
	{
		$boiler = new orderstatus_model();
		$boiler->set_field(array($key, $field));
		$boiler->set_order(array(" idx asc "));
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
		//
	}

	public function display($info)
	{
		//
	}

	public function form($info)
	{
		//
	}

	public function save($info)
	{
		//
	}

	public function remove($info)
	{
		//
	}
}
