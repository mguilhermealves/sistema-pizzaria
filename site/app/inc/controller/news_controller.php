<?php
class news_controller{
	public function display( $info ){
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }
		if( !isset( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) || empty( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) ){
			basic_redir( $GLOBALS["regulamento_url"] );
			exit();
		}


        $news = new news_model();
        $news->set_fields(array(" slug ", " name ", " headline ", " image ", " category "));
        $news->set_filter(array( "idx in (select news_profiles.news_id from news_profiles where active = 'yes' and profiles_id = '" .  $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"]  . "' ) " , " active = 'yes' " ));
        $news->set_order(array(" idx desc "));
        $news->load_data();
        $data = $news->data;

        $recent_news = new news_model();
        $recent_news->set_fields(array(" slug ", " name ", " headline ", " image ", " category ", "created_at"));
        $recent_news->set_filter(array("idx in (select news_profiles.news_id from news_profiles where active = 'yes' and profiles_id = '" .  $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"]  . "' ) " , " active = 'yes' " ));
        $recent_news->set_order(array(" created_at desc "));
        $recent_news->set_paginate(array(" 3 "));
        $recent_news->load_data();
        $data_recent_news = $recent_news->data;

		include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include(constant("cRootServer") . "ui/includes/navbar.php");
        include( constant("cRootServer") . "ui/page/noticias.php");
        include(constant("cRootServer") . "ui/includes/footer.php");
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");
	}
    
	public function detail( $info ){
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }
		if( !isset( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) || empty( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) ){
			basic_redir( $GLOBALS["regulamento_url"] );
			exit();
		}
        $news = new news_model();
        $news->set_fields( array( " slug " , " name " , " context " , " image " , " category " ) );
        $news->set_filter( array( " slug = '" . $info["slug"] . "' " ) );
        $news->load_data();
        $data = current( $news->data ); 

		include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include(constant("cRootServer") . "ui/includes/navbar.php");
        include( constant("cRootServer") . "ui/page/noticia.php");
        include(constant("cRootServer") . "ui/includes/footer.php");
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");
        
        print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . ($GLOBALS["noticias_url"]) . '" ');
		print('})' . "\n");
        print("</script>");
		include( constant("cRootServer") . "ui/common/footer.php");
	}
}
?>