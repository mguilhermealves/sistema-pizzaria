<?php
class contact_controller{
	public function display( $info ){
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }
		if( !isset( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) || empty( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) ){
			basic_redir( $GLOBALS["regulamento_url"] );
			exit();
		}
        include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include(constant("cRootServer") . "ui/includes/navbar.php");
        include( constant("cRootServer") . "ui/page/contato.php");
        include(constant("cRootServer") . "ui/includes/footer.php");
		include( constant("cRootServer") . "ui/common/foot.php");
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
        $boiler = new contacts_model();
        $boiler->populate( $info["post"] ) ;
        $boiler->save();
        $_SESSION["messages_app"]["info"] = array("Contato salvo com sucesso");
		basic_redir( $GLOBALS["contacts_url"] );
    }
}
?>