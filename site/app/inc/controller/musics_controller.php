<?php
class musics_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "slug" ){
		$musics = new musics_model();
		$musics->set_field( array( $key , $field  ) ) ;
    $musics->set_filter( $filters ) ;
    $musics->load_data();
    $out = array();
		foreach( $musics->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
	public function display( $info ){
    //print_pre($info, true);
    if( !site_controller::check_login() ){
        basic_redir( $GLOBALS["home_url"] );
        exit();
    }
		if( !isset( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) || empty( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) ){
			basic_redir( $GLOBALS["regulamento_url"] );
			exit();
		}

    $musics = new musics_model();	
		$musics->set_filter(array("created_by = '" .  $_SESSION[ constant("cAppKey") ]["credential"]["idx"]  . "' "));
		$musics->load_data();

    $data = current( isset( $musics->data[0] ) ? $musics->data : array() );

		include( constant("cRootServer") . "ui/common/header.php");
    include( constant("cRootServer") . "ui/common/head.php");
    include( constant("cRootServer") . "ui/includes/menuTopoOnline.php");
    include( constant("cRootServer") . "ui/page/musics.php");
    include( constant("cRootServer") . "ui/includes/footerOnline.php"); 
		include( constant("cRootServer") . "ui/common/foot.php");   
		include( constant("cRootServer") . "ui/common/footer.php");

    if(isset($info["get"]["edit"])){
      print(' <script>');
      print('$(function(){');
      print('$("#editModal").modal("show")');
      print( '});' );
      print('</script>');
    }

	}
	public function save( $info ){
    if( !site_controller::check_login() ){
        basic_redir( $GLOBALS["home_url"] );
        exit();
    }
    if( !isset( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) || empty( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) ){
      basic_redir( $GLOBALS["regulamento_url"] );
      exit();
    }

    $boiler = new musics_model();

    if (isset($info["post"]["idx"]) && (int)$info["post"]["idx"] > 0) {
      $boiler->set_filter(array(" idx = '" . $info["post"]["idx"] . "' "));
    }
    else{
      $info["post"]["slug"]  = generate_key(6);  
    } 
    
    $boiler->populate( $info["post"] ) ;
    $boiler->save();
    $_SESSION["messages_app"]["info"] = array("Selfie salvo com sucesso");
		basic_redir( sprintf($GLOBALS["music_url"]."?edit") );
  }
}
?>