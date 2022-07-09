<?php
class selfies_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "slug" ){
		$quizes_model = new selfies_model();
		$quizes_model->set_field( array( $key , $field  ) ) ;
    $quizes_model->set_filter( $filters ) ;
    $quizes_model->load_data();
    $out = array();
		foreach( $quizes_model->data as $value ){
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

    $selfies = new selfies_model();	
		$selfies->set_filter(array("created_by = '" .  $_SESSION[ constant("cAppKey") ]["credential"]["idx"]  . "' "));
		$selfies->load_data();

    $data = current( isset( $selfies->data[0] ) ? $selfies->data : array() );

		include( constant("cRootServer") . "ui/common/header.php");
    include( constant("cRootServer") . "ui/common/head.php");
    include( constant("cRootServer") . "ui/includes/menuTopoOnline.php");
    include( constant("cRootServer") . "ui/page/selfie-pet.php");
    include( constant("cRootServer") . "ui/includes/footerOnline.php"); 
		include( constant("cRootServer") . "ui/common/foot.php");
    print('<script src="'. constant("cFurniture").'js/selfiepet.js"></script>');
		include( constant("cRootServer") . "ui/common/footer.php");
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

    $boiler = new selfies_model();

    if (isset($info["post"]["idx"]) && (int)$info["post"]["idx"] > 0) {
      $boiler->set_filter(array(" idx = '" . $info["post"]["idx"] . "' "));
    }
    else{
      $info["post"]["slug"]  = generate_key(6);  
    }

    if( isset( $_FILES[ "image" ] ) && is_file( $_FILES[ "image" ]["tmp_name"] ) ){
      $name = preg_replace('/(.+)(....)$/',"$2",$_FILES[ "image" ]["name"]);
      $file = "furniture/upload/lovers/selfies/" . generate_key(6) . date("YmdHis") . $name ;
      if( ! file_exists( dirname( constant("cRootServer") . $file ) ) ){
        mkdir( dirname( constant("cRootServer") . $file ) , true );
      }
      if( file_exists( constant("cRootServer") . $file ) ){
        unlink( constant("cRootServer") . $file );
      }
      move_uploaded_file( $_FILES[ "image" ]["tmp_name"] , constant("cRootServer") . $file );
      $info["post"]["image"] = $file ;
    } 
    //print_pre($info, true);
    $boiler->populate( $info["post"] ) ;
    $boiler->save();
    $_SESSION["messages_app"]["info"] = array("Selfie salvo com sucesso");
		basic_redir( $GLOBALS["selfie_url"] );
    }
}
?>