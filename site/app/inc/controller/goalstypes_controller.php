<?php
class goalstypes_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "name" ){
		$goals = new goalstypes_model();
		$goals->set_field( array( $key , $field  ) ) ;
		$goals->set_filter( $filters ) ;
        $goals->load_data();
        $out = array();
		foreach( $goals->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
    }
}
?>