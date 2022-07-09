<?php
class respostas_model extends DOLModel {
	protected $field = array(" idx " , " resposta " , " acertos " , " pontos ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "respostas" , $bd );
	}
}
?>