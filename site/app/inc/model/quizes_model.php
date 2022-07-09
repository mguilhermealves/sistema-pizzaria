<?php
class quizes_model extends DOLModel {
	protected $field = array(" idx " , " name " , " slug " , " level " , " questions " , " points " , " catalogo ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "quizes" , $bd );
	}
}
?>