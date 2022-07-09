<?php
class quiz_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "name" ){
		$quizes_model = new quizes_model();
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
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }
		if( !isset( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) || empty( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) ){
			basic_redir( $GLOBALS["regulamento_url"] );
			exit();
		}

        $quiz = new quizes_model();
        $quiz->set_filter( array( " active = 'yes' " , "idx in (select quizes_profiles.quizes_id from quizes_profiles where active = 'yes' and profiles_id = '" .  $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"]  . "' )" ));
        $quiz->load_data();
        $quiz->attach( array( "respostas" ) , false , " and created_by = '" . $_SESSION[ constant("cAppKey") ]["credential"]["idx"] . "' " , array( "created_at" , "acertos" , "pontos" )  );
        $data = $quiz->data;

		include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include(constant("cRootServer") . "ui/includes/navbar.php");
        include( constant("cRootServer") . "ui/page/quizes.php");
        include(constant("cRootServer") . "ui/includes/footer.php");
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");
        if(isset($info["get"]["send"])){
            print(' <script>');
            print('$(function(){');
            print('$("#sendModal").modal("show")');
            print( '});' );
            print('</script>');
        }

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

        $quiz = new quizes_model();
        $quiz->set_filter( array( " slug = '" . $info["slug"] . "' " ) );
        $quiz->load_data();
        $quiz->attach( array( "respostas" ) , false , " and created_by = '" . $_SESSION[ constant("cAppKey") ]["credential"]["idx"] . "' "  );
        $data = $quiz->data; 

        include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include(constant("cRootServer") . "ui/includes/navbar.php");
        include( constant("cRootServer") . "ui/page/quiz.php");
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

        $quiz = new quizes_model();
        $quiz->set_filter( array( " slug = '" . $info["slug"] . "' " ) );
        $quiz->set_field( array( " idx " , " questions " , " points " ) );
        $quiz->load_data();
        $data = unserialize( $quiz->data[0]["questions"]  ) ;
        $corretas = array_column( $data["data"] , "correct" );

        $respostas = new respostas_model();
        $info["post"]["acertos"] = count( array_intersect( $corretas , $info["post"]["resposta"] ) ) ;
        $info["post"]["resposta"] = serialize( $info["post"]["resposta"] );
        $info["post"]["pontos"] = ( 100 * $info["post"]["acertos"] / count( $corretas ) ) * $quiz->data[0]["points"] / 100 ;
        $respostas->populate( $info["post"] );
        $respostas->save();
        $info["idx"] = $respostas->con->insert_id ;
        $info["post"]["users_id"] = $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ;
        $info["post"]["quizes_id"] = $quiz->data[0]["idx"] ;
        $respostas->save_attach( $info , array( "users" , "quizes" ) , true );
        basic_redir( sprintf($GLOBALS["quizes_url"]."?send=".$info["slug"]) );

    }
}
?>