<?php
class games_controller{
	public function display( $info ){
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }
		include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include( constant("cRootServer") . "ui/includes/menuTopoOnline.php");
        include( constant("cRootServer") . "ui/page/game_explain.php");
        include( constant("cRootServer") . "ui/includes/footerOnline.php"); 
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");
	}
	public function finish( $info ){
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }

        if( !isset( $_SESSION[ constant("cAppKey") ]["start_game"] ) ){
            basic_redir( $GLOBALS["games_url"] );
            exit();
        }

        $boiler = new games_model();
        $boiler->set_filter( array( 
            "name='" . $_SESSION[ constant("cAppKey") ]["start_game"] . "'" 
            , "created_by" => $_SESSION[ constant("cAppKey") ]["credential"]["idx"] 
            , " finished = 'yes' " 
            , " TIMEDIFF( modified_at , created_at) != '00:00:00' " 
        ) );

        $boiler->set_field( array(
            "TIMEDIFF( modified_at , created_at) as tempo"
            ,  "moviment"
        ) );

        $boiler->load_data();
        if( !isset( $boiler->data[0] ) ){
            basic_redir( $GLOBALS["games_url"] );
            exit();
        }
        unset( $_SESSION[ constant("cAppKey") ]["start_game"] );
        $data = current( $boiler->data );

		include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include( constant("cRootServer") . "ui/includes/menuTopoOnline.php");
        include( constant("cRootServer") . "ui/page/game_finish.php");
        include( constant("cRootServer") . "ui/includes/footerOnline.php"); 
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");
	}
	public function ranking( $info ){
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }

        if( !isset( $info["get"]["period"] ) ){
            basic_redir( set_url( $GLOBALS["game_ranking_url"] , array("period" => date("Ym") ) ) );
            exit();
        }

        $boiler = new games_model();
        $boiler->set_filter( array( 
            " finished = 'yes' " 
            , " TIMEDIFF( modified_at , created_at) != '00:00:00' " 
            , " DATE_FORMAT( end_at , '%Y%m' ) = '" . $info["get"]["period"] . "' " 
        ) ) ;
        $boiler->set_field( array(
            " count( idx ) as qtd  "
            , " 0 as idx  "
            ,  "min( ( TIMEDIFF( modified_at , created_at) ) ) as tempo "
            ,  "created_by "
        ) );
        $boiler->set_group( array( "created_by") );
        $boiler->set_order( array( " min( TIME_TO_SEC( TIMEDIFF( modified_at , created_at) ) ) " , " count( idx ) ") );
        $boiler->load_data();
        $boiler->join( "users" , "users" , array( "idx" => "created_by" ) , null , array( "idx" , "first_name" , "last_name" ) );

        $list_month = array();
        if( date("m") < 11 ){
            $list_month[ 202111 ] = $GLOBALS["month_name"][ 11 ] . "/2021";
            $list_month[ 202112 ] = $GLOBALS["month_name"][ 12 ] . "/2021"; 
        }
        else{
            for( $x = 11 ; $x <= date("m"); $x++){
                $list_month[ 2021 . $x ] = $GLOBALS["month_name"][ $x ] . "/2021";
            }
        }
		include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include( constant("cRootServer") . "ui/includes/menuTopoOnline.php");
        include( constant("cRootServer") . "ui/page/game_ranking.php");
        include( constant("cRootServer") . "ui/includes/footerOnline.php"); 
		include( constant("cRootServer") . "ui/common/foot.php");

print("<script>\n");
print("$(document).ready(function(){\n");
print("  $('#period-input').bind('change', function(){\n");
print("    document.location = '" . $GLOBALS["game_ranking_url"] . "?period=' + $('option:selected',this).val();\n");
print("  });\n");
print("});\n");
print("</script>\n");
		include( constant("cRootServer") . "ui/common/footer.php");
	}
    
	public function start( $info ){
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }
        $_SESSION[ constant("cAppKey") ]["start_game"] = generate_key(18);
        $boiler = new games_model();
        $boiler->populate( array("name" => $_SESSION[ constant("cAppKey") ]["start_game"] ) ) ;
        $boiler->save();
		include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include( constant("cRootServer") . "ui/includes/menuTopoOnline.php");
        include( constant("cRootServer") . "ui/page/game_start.php");
        include( constant("cRootServer") . "ui/includes/footerOnline.php"); 
		include( constant("cRootServer") . "ui/common/foot.php");
        ?>
        <script src="<?php printf("%s%s",constant("cFurniture"),"js/game.js")?>"></script> <?php
		include( constant("cRootServer") . "ui/common/footer.php");
	}

	public function save( $info ){
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }
        $boiler = new games_model();
        $boiler->set_filter( array( "name='" . $_SESSION[ constant("cAppKey") ]["start_game"] . "'" , "created_by" => $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ) );
        $boiler->populate( array( "moviment" => $info["post"]["moviment"] , "finished" => "yes" , "end_at" => date("Y-m-d H:i:s") ) ) ;
        $boiler->save();



		basic_redir( $GLOBALS["games_finish_url"] );
    }
}
?>
