<?php
class ranking_controller{

    public static function position( $info ){

        $user_filter = array();
        if( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] == 4 ){
            switch( $_SESSION[ constant("cAppKey") ]["credential"]["position"] ){
                case "Gerente de Contas":
                case "GER CONTAS ESPECIAIS VET":
                    $user_filter[] = " and u.idx in (  select users_id from users_profiles where active = 'yes' and profiles_id = '".$_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"]."' )  and u.position in ('Gerente de Contas', 'GER CONTAS ESPECIAIS VET')" ;
                break;
                case "Coordenador(a) Comercial":
                case "COORD CONTAS ESPECIAIS VET":
                    $user_filter[] = " and u.idx in (  select users_id from users_profiles where active = 'yes' and profiles_id = '".$_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"]."' ) and u.position in ('Coordenador(a) Comercial', 'COORD CONTAS ESPECIAIS VET')" ;
                break;
                case "PROMOTOR VET":
                    $user_filter[] = " and u.idx in (  select users_id from users_profiles where active = 'yes' and profiles_id = '".$_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"]."' ) and u.position = '" . $_SESSION[ constant("cAppKey") ]["credential"]["position"] . "'" ;
                break;
            }
        } else {
            switch( $_SESSION[ constant("cAppKey") ]["credential"]["position"] ){
                case "Vendedor(a)":
                    if( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] == 5 ){
                        $user_filter[] = " and u.position = 'Vendedor(a)' " ;
                        if( isset( $info["period"] ) ){
                            $user_filter[] = " and u.idx in ( select users_distributors.users_id from users_distributors where users_distributors.active = 'yes' and users_distributors.distributors_id = '" . $_SESSION[ constant("cAppKey") ]["credential"]["distributors_attach"][0]["idx"] . "' ) " ;
                        }
                        else{
                            $user_filter[] = " and u.regional = '" . $_SESSION[ constant("cAppKey") ]["credential"]["regional"] . "' " ;
                        }
                    }
                    else{
                        $user_filter[] = " and u.position = 'Vendedor(a)' and u.idx in ( select users_distributors.users_id from users_distributors where users_distributors.active = 'yes' and users_distributors.distributors_id = '" . $_SESSION[ constant("cAppKey") ]["credential"]["distributors_attach"][0]["idx"] . "' )  " ;
                    }
                break;
                case "Supervisor(a)":
                    if( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] == 5 ){
                        $user_filter[] = " and u.position = 'Supervisor(a)' " ;
                        if( isset( $info["period"] ) ){
                            $user_filter[] = " and u.regional = '" . $_SESSION[ constant("cAppKey") ]["credential"]["regional"] . "' " ;
                        }
                    }
                    else{
                        $user_filter[] = " and u.position = 'Supervisor(a)' and u.regional = '" . $_SESSION[ constant("cAppKey") ]["credential"]["regional"] . "' " ;
                    }
                break;
                case "Promotor(a)":
                    $user_filter[] = " and u.position = '" . $_SESSION[ constant("cAppKey") ]["credential"]["position"] . "' " ;
                break;
            }
        }

        // print_pre($user_filter, true);

        $sql = "     SELECT  " ;
        $sql .= "         SUM(a.points) as  total " ;
        $sql .= "         , p.slug " ;
        $sql .= "         , u.* " ;
        $sql .= "     FROM " ;
        $sql .= "         ( " ;
        $sql .= "             ( " ;
        $sql .= "                 SELECT  " ;
        $sql .= "                     SUM(r.pontos) AS points, " ;
        $sql .= "                     r.created_by AS users_id, " ;
        $sql .= "                     DATE_FORMAT(r.created_at, '%Y%m') AS periodo " ;
        $sql .= "                 FROM " ;
        $sql .= "                     respostas r " ;
        $sql .= "                 where " ;
        $sql .= "                     r.active = 'yes' " ;
        if( isset( $info["period"] ) ){
            $sql .= "                   and DATE_FORMAT(r.created_at, '%Y%m') in (" . $info["period"] . ") " ;
        }
        $sql .= "                 GROUP BY r.created_by , DATE_FORMAT(r.created_at, '%Y%m') " ;
        $sql .= "             )  " ;
        $sql .= "             UNION ALL  " ;
        $sql .= "             ( " ;
        $sql .= "                 SELECT  " ;
        $sql .= "                     SUM(g.points) AS points, " ;
        $sql .= "                     gu.users_id, " ;
        $sql .= "                     DATE_FORMAT(g.mes, '%Y%m') AS periodo " ;
        $sql .= "                 FROM " ;
        $sql .= "                     goals g, users_goals gu " ;
        $sql .= "                 WHERE " ;
        $sql .= "                     g.type_front != 'melhor-foto-de-execucao-do-mes-' " ;
        $sql .= "                     and  g.idx = gu.goals_id " ;
        $sql .= "                     and g.active = 'yes' " ;
        $sql .= "                     and gu.active = 'yes' " ;
        if( isset( $info["period"] ) ){
            $sql .= "                     and DATE_FORMAT(g.mes, '%Y%m') in (" . $info["period"] . ") " ;
        }
        $sql .= "                 GROUP BY gu.users_id , DATE_FORMAT(g.created_at, '%Y%m') " ;
        $sql .= "             ) " ;
        $sql .= "         ) AS a " ;
        $sql .= "         inner join users u on (u.idx = a.users_id " . implode(" " , $user_filter ) . " ) " ;
        $sql .= "         inner join users_profiles up on ( up.users_id = u.idx and up.active = 'yes' ) " ;
        $sql .= "         inner join profiles p on ( up.profiles_id = p.idx and p.active = 'yes' and p.name = '" . $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["name"] . "') " ;
        if( isset( $info["period"] ) ){
                // $sql .= "         where u.regional = '" . $_SESSION[ constant("cAppKey") ]["credential"]["regional"] . "'" ;
        }
        else {
                $sql .= "         where up.profiles_id = '" . $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] . "'";
        }

        $sql .= "     GROUP BY a.users_id " ;
        $sql .= "     ORDER BY SUM(a.points) DESC , u.first_name asc " ;

        $users_model = new users_model();

        $pontos = $users_model->con->results( $users_model->con->my_query( $sql ) ) ;

        $resumo = array_flip( array_values( array_unique( array_column( $pontos , "total" ) ) ) );
        return  array( $resumo , $pontos , $sql );
    }

	public function mensal( $info ){
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }
		if( !isset( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) || empty( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) ){
			basic_redir( $GLOBALS["regulamento_url"] );
			exit();
		}

        $select = array();
        foreach(  $GLOBALS["periodos"] as $k => $v ){
            $key = array();
            for( $x = strtotime( $v["start"] ) ; $x <= strtotime( $v["end"] ) ; $x = strtotime("+1 month", $x ) ){
                $key[] = date("Ym" , $x );
            }
            $select[ $k ] = $k . " Trimestre";
            $GLOBALS["rkn" . $k ] = ranking_controller::position( array( "type" => "month" , "period" => "'" . implode("','" , $key ) . "'" ) ) ;
        }

        // print_pre($rkn_1, true);

		include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include( constant("cRootServer") . "ui/includes/menuTopoOnline.php");
        include( constant("cRootServer") . "ui/page/ranking_tri.php");
        include( constant("cRootServer") . "ui/includes/footerOnline.php"); 
        include( constant("cRootServer") . "ui/common/foot.php");
        ?>
        <script>
        $("select[id='period-input']").bind("change",function(){
            $("div.dataTable div[class^='tbl']").hide()
            $("div.dataTable div[class*='tbl" + $("option:selected",this).val() + "']").show()
        }) ;
        $("select[id='period-input']").change();
        </script>
        <?php
		include( constant("cRootServer") . "ui/common/footer.php");
	}
    
	public function final( $info ){
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }
		if( !isset( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) || empty( $_SESSION[ constant("cAppKey") ]["credential"]["accept_at"] ) ){
			basic_redir( $GLOBALS["regulamento_url"] );
			exit();
		}
        $rkn = ranking_controller::position( array( "type" => "anual" ) ) ;
		include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include( constant("cRootServer") . "ui/includes/menuTopoOnline.php");
        include( constant("cRootServer") . "ui/page/ranking_final.php");
        include( constant("cRootServer") . "ui/includes/footerOnline.php"); 
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");
	}
}
?>