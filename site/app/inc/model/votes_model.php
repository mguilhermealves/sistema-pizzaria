<?php
class votes_model extends DOLModel {
	protected $field = array( " idx " , " created_at ", " created_by ", " modified_at ", " modified_by ", " removed_at ", " active ", " ip ", "cookiename") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "votes" , $bd );
	}
}
?>