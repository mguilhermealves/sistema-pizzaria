<?php
class site_controller
{
	public function logout()
	{
		unset($_SESSION[constant("cAppKey")]);
		basic_redir($GLOBALS["home_url"]);
	}

	public static function check_login()
	{
		return isset($_SESSION[constant("cAppKey")]["credential"]["idx"]) && (int)$_SESSION[constant("cAppKey")]["credential"]["idx"] > 0;
	}

	public function display($info)
	{
		include(constant("cRootServer") . "ui/common/header.php");
		include(constant("cRootServer") . "ui/common/head.php");
		if (site_controller::check_login()) {
			if (!isset($_SESSION[constant("cAppKey")]["credential"]["accept_at"]) || empty($_SESSION[constant("cAppKey")]["credential"]["accept_at"])) {
				basic_redir($GLOBALS["regulamento_url"]);
				exit();
			}

			$users = new users_model();
			$users->set_field(array("idx", "cpf", "accept_at"));
			$users->set_filter(array("idx = '" .  $_SESSION[constant("cAppKey")]["credential"]["idx"]  . "' "));
			$users->load_data();

			$banners = new banners_model();	
			$banners->set_field(array("idx", "img" ));
			$banners->set_filter(array( "idx in (select banners_profiles.banners_id from banners_profiles where active = 'yes' and profiles_id = '" .  $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"]  . "' ) " , " active = 'yes' " ));	
			$banners->load_data();

			$news = new news_model();
			$news->set_fields(array(" slug ", " name ", " headline ", " image ", " category "));
			$news->set_filter(array( "idx in (select news_profiles.news_id from news_profiles where active = 'yes' and profiles_id = '" .  $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"]  . "' ) " , " active = 'yes' " ));
			$news->set_order(array(" idx desc "));
			$news->set_paginate(array("1"));
			$news->load_data();

			$dataNews = $news->data;

			if ($dataNews) {
				$newsRecent = current($dataNews);
			} else {
				$newsRecent = [];
			}

			$users->attach(array("goals"), false);
			$users->join("respostas", "respostas", array("created_by" => "idx"), null, array("pontos"));


			$goal = isset($users->data[0]["goals_attach"][0]) ? array_sum(array_column($users->data[0]["goals_attach"], "points")) : 0;
			$goal += isset($users->data[0]["respostas_attach"][0]) ? array_sum(array_column($users->data[0]["respostas_attach"], "pontos")) : 0;

			$rkn = ranking_controller::position( array("type" => "month") ) ;

			$rkn_Mensal = ranking_controller::position( array("type" => "mensal" , "period" => date("Ym")) ) ;

			include(constant("cRootServer") . "ui/includes/navbar.php");
			include(constant("cRootServer") . "ui/page/dash.php");
			include(constant("cRootServer") . "ui/includes/footer.php");
		} else {
			include(constant("cRootServer") . "ui/page/login.php");
		}

		include(constant("cRootServer") . "ui/common/foot.php");

		if ($info["server_uri"] == "") {
			print('<script>' . "\n");
			if (!site_controller::check_login()) {
				print('$(".forgot-password").bind("click", function(){' . "\n");
				print('	$("#loginFORM").hide();' . "\n");
				print('	$("#loginPASSOWRD").show();' . "\n");
				print('})' . "\n");
				print('$(".back-password").bind("click", function(){' . "\n");
				print('	$("#loginFORM").show();' . "\n");
				print('	$("#loginPASSOWRD").hide();' . "\n");
				print('})' . "\n");
			} else {
				print('var elem = document.querySelector(".main-carousel");' . "\n");
				print('var flkty = new Flickity( elem, {' . "\n");
				print('  cellAlign: "left",' . "\n");
				print('  contain: true' . "\n");
				print('});' . "\n");
				print('var elem1 = document.querySelector(".notice-carousel");' . "\n");
				print('var flkty1 = new Flickity( elem1, {' . "\n");
				print('  cellAlign: "center",' . "\n");
				print('  contain: true' . "\n");
				print('});' . "\n");
			}
			print('</script>' . "\n");
		}
		include(constant("cRootServer") . "ui/common/footer.php");
	}

	public function password($info)
	{
		include(constant("cRootServer") . "ui/common/header.php");
		include(constant("cRootServer") . "ui/common/head.php");
		include(constant("cRootServer") . "ui/page/password.php");
		include(constant("cRootServer") . "ui/common/foot.php");
	}

	public function display_data($info)
	{
		if (!isset($_SESSION[constant("cAppKey")]["credential"]["accept_at"]) || empty($_SESSION[constant("cAppKey")]["credential"]["accept_at"])) {
			basic_redir($GLOBALS["regulamento_url"]);
			exit();
		}
		$data = array();
		foreach (array("mail", "login", "first_name", "last_name", "cpf", "company", "crmv", "crmv_uf", "occupation_area", "phone", "genre", "birthdate", "address", "address_number", "address_complement", "address_neighborhood", "address_state", "address_city", "address_zip_code", "avatar", "image") as $k) {
			$data[$k] = isset($_SESSION[constant("cAppKey")]["credential"][$k]) && !empty($_SESSION[constant("cAppKey")]["credential"][$k]) ? $_SESSION[constant("cAppKey")]["credential"][$k] : "";
		}
		include(constant("cRootServer") . "ui/common/header.php");
		include(constant("cRootServer") . "ui/common/head.php");
		include(constant("cRootServer") . "ui/includes/navbar.php");
		include(constant("cRootServer") . "ui/page/mydata.php");
		include(constant("cRootServer") . "ui/includes/footer.php");
		include(constant("cRootServer") . "ui/common/foot.php");
		print("<script>");
		include(constant("cRootServer") . "furniture/js/mydata.js");
		print("</script>");
		include(constant("cRootServer") . "ui/common/footer.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
			exit();
		} else {
			if (isset($info["post"]["pwd"]) && !empty($info["post"]["pwd"])) {
				$info["post"]["password"] = md5($info["post"]["pwd"]);
			}
			$user = new users_model();
		
			$user->set_filter(array(" idx = '" . $user->con->real_escape_string($_SESSION[constant("cAppKey")]["credential"]["idx"]) . "' "));
			$user->set_paginate(array(" 1 "));
			if( isset( $_FILES[ "image" ] ) && is_file( $_FILES[ "image" ]["tmp_name"] ) ){
				$info["post"]["slug"]  = generate_key(16) ;  
				$name = preg_replace('/(.+)(....)$/',"$2",$_FILES[ "image" ]["name"]);
				$file = "furniture/upload/lovers/mydata/" . $info["post"]["slug"] . $name ;
				if( ! file_exists( dirname( constant("cRootServer") . $file ) ) ){
					mkdir( dirname( constant("cRootServer") . $file ) , true );
				}
				if( file_exists( constant("cRootServer") . $file ) ){
					unlink( constant("cRootServer") . $file );
				}
				move_uploaded_file( $_FILES[ "image" ]["tmp_name"] , constant("cRootServer") . $file );
				$info["post"]["image"] = $file ;
			} 
			
			$user->populate($info["post"]);
			$user->save();
			
			$user = new users_model();
			$user->set_filter(array(" idx = '" . $user->con->real_escape_string($_SESSION[constant("cAppKey")]["credential"]["idx"]) . "' "));
			
			$user->load_data();
			$user->set_paginate(array(" 1 "));
			$user->load_data();
			$user->attach(array("profiles"), false, null, array("idx", "name", "editabled"));
			$_SESSION[constant("cAppKey")] = array(
				"credential" => current($user->data)
			);
			$_SESSION["messages_app"]["warning"] = array("Dados Atualizados com Sucesso");
		}		
		basic_redir($GLOBALS["mydata_url"]);
		exit();
	}

	public function login($info)
	{
		if (isset($info["post"]["login"]) && isset($info["post"]["password"])) {
			$users = new users_model();
			$users->set_filter(array(" ( '" . $users->con->real_escape_string($info["post"]["login"]) . "' in (mail,login) or '" . $users->con->real_escape_string(preg_replace("/[^0-9]+?/", "", $info["post"]["login"])) . "' = cpf ) ", " password in ( '" . $users->con->real_escape_string(md5($info["post"]["password"])) . "' , '" . $users->con->real_escape_string(md5(preg_replace("/[^0-9]+?/", "", $info["post"]["login"]))) . "' ) "));
			$users->set_paginate(array(" 1 "));
			$users->load_data();
			if (isset($users->data[0]["idx"])) {
				$users->attach(array("profiles"), false, null, array("idx", "name", "editabled"));
				$users->attach(array("distributors"), false, null, array("idx", "name"));
				$_SESSION[constant("cAppKey")] = array(
					"credential" => current($users->data)
				);
				$users->populate(array("last_login" => date("Y-m-d H:i:s")));
				$users->save();
			} else {
				$_SESSION["messages_app"]["warning"] = array("Login e/ou Senha informados não conferem");
			}
		} else {
			$_SESSION["messages_app"]["warning"] = array("Login e/ou Senha são obrigatórios para realizar o login");
		}
		basic_redir($GLOBALS["home_url"]);
		exit();
	}

	public function rules($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
			exit();
		}
		include(constant("cRootServer") . "ui/common/header.php");
		include(constant("cRootServer") . "ui/common/head.php");
		include(constant("cRootServer") . "ui/includes/navbar.php");
		include(constant("cRootServer") . "ui/page/regulamento.php");
		include(constant("cRootServer") . "ui/includes/footer.php");
		include(constant("cRootServer") . "ui/common/foot.php");
		include(constant("cRootServer") . "ui/common/footer.php");
	}

	public function regulamento($info)
	{
		$date = date("Y-m-d H:i:s") ;
		$users = new users_model();
		$users->set_filter(array("idx = '" .  $_SESSION[constant("cAppKey")]["credential"]["idx"]  . "' "));
		$users->populate(array("accept_at" => date("Y-m-d H:i:s")));
		$users->save();

		$_SESSION[constant("cAppKey")]["credential"]["accept_at"] = $date ;


		basic_redir($GLOBALS["home_url"]);
	}

	public function premio($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
			exit();
		}
		if (!isset($_SESSION[constant("cAppKey")]["credential"]["accept_at"]) || empty($_SESSION[constant("cAppKey")]["credential"]["accept_at"])) {
			basic_redir($GLOBALS["regulamento_url"]);
			exit();
		}
		
		$key = preg_replace("/[^0-9]+?/", "", $_SESSION[constant("cAppKey")]["credential"]["cpf"]);
		$externalapi_controller = new externalapi_controller();
		$externalapi_controller->set_body(array("username" => $key, "password" => $key, "url" => "https://ferasavert.hotshoponline.com.br"));
		$externalapi_controller->set_method("POST");
		$externalapi_controller->set_header(array("Content-Type" => "application/x-www-form-urlencoded"));
		list($response, $err) = $externalapi_controller->load(constant("cURL_API") . "oauth/token/external/generate");
		$link_btn = false;
		if (!$err) {
			$link = json_decode($response);
			if (isset($link->oAuth->authLink)) {
				$link_btn = $link->oAuth->authLink;
			}
		}
		

		$users = new users_model();
		$users->set_field(array("idx", "cpf"));
		$users->set_filter(array("idx = '" .  $_SESSION[constant("cAppKey")]["credential"]["idx"]  . "' "));
		$users->load_data();

		$body = array(
			'username' => $users->data[0]["cpf"],
			'password' => $users->data[0]["cpf"],
			'url' => constant("cCampanhaUrl")
		);

		$response = externalapi_controller::login($body); 
		if ( isset( $response["error"] ) && !$response["error"]) {
			$user_externo = $response;
		}

        include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include(constant("cRootServer") . "ui/includes/navbar.php");
		include(constant("cRootServer") . "ui/page/premiacoes.php");
        include(constant("cRootServer") . "ui/includes/footer.php");
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");
	}

	public function selfie($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
			exit();
		}
		if (!isset($_SESSION[constant("cAppKey")]["credential"]["accept_at"]) || empty($_SESSION[constant("cAppKey")]["credential"]["accept_at"])) {
			basic_redir($GLOBALS["regulamento_url"]);
			exit();
		}

		include(constant("cRootServer") . "ui/common/header.php");
		include(constant("cRootServer") . "ui/common/head.php");
		include(constant("cRootServer") . "ui/includes/navbar.php");
		include(constant("cRootServer") . "ui/page/selfie-pet.php");
		include(constant("cRootServer") . "ui/includes/footer.php");
		include(constant("cRootServer") . "ui/common/foot.php");
		include(constant("cRootServer") . "ui/common/footer.php");
	}

	public function extrato($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
			exit();
		}
		if (!isset($_SESSION[constant("cAppKey")]["credential"]["accept_at"]) || empty($_SESSION[constant("cAppKey")]["credential"]["accept_at"])) {
			basic_redir($GLOBALS["regulamento_url"]);
			exit();
		}

		$users = new users_model();
		$users->set_field(array("idx", "position"));
		$users->set_filter(array("idx = '" .  $_SESSION[constant("cAppKey")]["credential"]["idx"]  . "' "));
		$users->load_data();
		$users->attach(array("profiles"));
		$users->attach(array("goals"), false, null, array(" created_at ", " name ", " points ", " tipo ", "type_front", "mes","goalsimports_id"));	
		$users->join("respostas", "respostas", array("created_by" => "idx"), null, array(" idx ", " created_at ", " name ", "pontos"));
		$users->attach_son("respostas", array("quizes"), true);

		$array = array() ;
		if (isset($users->data[0]["respostas_attach"][0])) {		
			foreach ($users->data[0]["respostas_attach"] as $k => $d) {
				$current_data = preg_replace("/\D+?/","", $d["created_at"] );
				foreach (array_keys( $GLOBALS["month_name"] ) as $x) {
					$fist_date = date("YmdHis" , mktime(0 , 0 ,0 , $x , 1 , 2022 ) ) ;
					$end_date = date("YmdHis" , mktime(0 , 0 ,-1 , $x+1 , 1 , 2022 ) ) ;
					if ($current_data >= $fist_date && $current_data <= $end_date ) {
						if (!isset($array[ $x ][ "data" ]["pontuacoes-bonus"] ) ) {
							$array[ $x ][ "data" ]["pontuacoes-bonus" ] = array(
								"mes" => $GLOBALS["month_name"][ $x  ],
								"name" => "Quiz - " . $d["quizes_attach"][0]["name"], 
								"pontos" => $d["pontos"],
								"type_front" => "pontuacoes-bonus",
								"tipo" => "Quiz"
							);
						}
						$array[ $x ][ "data" ][ "pontuacoes-bonus" ][ "infos" ][] = array(
							"name" =>  "Quiz - " . ( isset($d["quizes_attach"][0]["name"]) ? $d["quizes_attach"][0]["name"] : "0" ),
							"points" => $d["pontos"]
						);
					}
				}
			}
		}
		if (isset($users->data[0]["goals_attach"][0])) {
			
			if( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] == 4 ){
				$dic = array(
				"Gerente de Contas" => array(
					"1" => "Cumprimento do Sell out em valor do trimestre da regional"
					, "2" => "Positivação geral da regional – média mês do trimestre"
					, "3" => "Cumprimento da PV do trimestre – venda do Mix planejado"
					, "4" => "Cumprimento do Sell In do trimestre em valor"
				)
				, "GER CONTAS ESPECIAIS VET" => array(
					"1" => "Cumprimento do Sell out em valor do trimestre"
					,"2" => "Crescimento do Sell In (em relação ao mesmo período do ano anterior)"
					,"3" => "Cumprimento da PV do trimestre – venda do Mix planejado"
					,"4" => "Cumprimento do Sell In do trimestre em valor"
				)
				, "Coordenador(a) Comercial" => array(
					"1" => "Cumprimento do Sell out em valor do trimestre da regional"
					,"2" => "Positivação geral da regional – média mês do trimestre"
					,"3" => "Crescimento do sell out em relação ao mesmo período do ano anterior"
					,"4" => "Cumprimento do Sell In do trimestre em valor"
				)
				, "COORD CONTAS ESPECIAIS VET" => array(
					"1" => "Cumprimento do Sell out em valor do trimestre"
					,"2" => "Aumento do ticket médio (%) valor Sell Out/nº de lojas de redes (em relação ao trimestre anterior)"
					,"3" => "Crescimento do Sell Out em relação ao mesmo período do ano anterior"
					,"4" => "Cumprimento do Sell In do trimestre em valor"
				)
				, "PROMOTOR VET" => array(
					"1" => "Cumprimento do Sell out em valor do trimestre"
					,"2" => "Aumento do ticket médio (%) valor Sell Out/nº de lojas de redes (em relação ao trimestre anterior)"
					,"3" => "Crescimento do Sell Out em relação ao mesmo período do ano anterior"
					,"4" => "Cumprimento do Sell In do trimestre em valor"
				)
				) ;
			}
			if( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] == 5 ){
				$dic = array(
				"Supervisor(a)" => array(
					"1" => "Cumprimento do Sell out da distribuidora em valor do trimestre"
					, "2" => "Positivação da distribuidora – média mês do trimestre"
					, "3" => "Cumprimento das linhas em valor (por linha participante)"
				)
				, "Promotor(a)" => array(
					"1" => "Cumprimento do Sell out da distribuidora em valor do trimestre;"
					,"2" => "Positivação da distribuidora – média mês do trimestre"
					,"3" => "Cumprimento das linhas em valor (por linha participante"
				)
				, "Vendedor(a)" => array(
					"1" => "Cumprimento do Sell out em valor do trimestre;"
					,"2" => "Positivação – média mês do trimestre;"
					,"3" => "Cumprimento das linhas em valor (por linha participante)"
				)
				) ;
			}
			if( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] == 7 ){
				$dic = array(
				"Coordenador" => array(
					"1" => "Cumprimento do Sell out em valor da área espelho do trimestre do setor distribuidor (percentual de atingimento x 10) "
					, "2" => "MDV - Média de visitas diárias do setor (trimestre) – objetivo 100% = 10 (percentual de atingimento x 10)"
					, "3" => "Qualidade do painel - percentual de veterinários classificados como 3 estrelas e diamante dentro do painel geral (percentual x 10);"
				)
				, "Consultor" => array(
					"1" => "Realização de um dia de prescrição dentro do ciclo, com ações direcionadas para maior oportunidade dentro dos produtos do ciclo dentro deste cliente. Meta: dois eventos/ ciclo = a meta (percentual X 10)"
					,"2" => "MDV - Média de visitas diárias do setor – objetivo 100% = 10 (percentual de atingimento x 10)"
					,"3" => "Qualidade do painel - percentual de veterinários classificados como 3 estrelas e diamante dentro do painel geral (percentual x 10);"
				)
				, "Propagandista" => array(
					"1" => "Cumprimento do Sell out em valor da área espelho do trimestre do setor (distribuidores - percentual de atingimento x 10);"
					,"2" => "MDV - Média de visitas diárias do setor – objetivo 100% = 10 (percentual de atingimento x 10)"
					,"3" => "Qualidade do painel - percentual de veterinários classificados como 3 estrelas e diamante dentro do painel geral (percentual x 10)"
				)
				) ;
			}
			$dic = isset( $dic[ $_SESSION[ constant("cAppKey") ]["credential"]["position"] ] ) ? $dic[ $_SESSION[ constant("cAppKey") ]["credential"]["position"] ] : false  ; 
			foreach ($users->data[0]["goals_attach"] as $k => $d) {
				$current_data = preg_replace("/\D+?/","", $d["mes"] );
				foreach (array_keys( $GLOBALS["month_name"] ) as $x) {
					$fist_date = date("YmdHis" , mktime(0 , 0 ,0 , $x , 1 , 2022 ) ) ;
					$end_date = date("YmdHis" , mktime(0 , 0 ,-1 , $x+1 , 1 , 2022 ) ) ;
					if ($current_data >= $fist_date && $current_data <= $end_date ) {
						if( !isset( $array[ $x ]["data"][ $d["type_front"] ] )  ){
							$array[ $x ]["data"][ $d["type_front"] ] = array(
								"mes" => $x,
								"tipo" => isset( $dic[ $d["type_front"] ] ) ? $dic[ $d["type_front"] ] : $d["tipo"], 
								"name" => isset( $dic[ $d["type_front"] ] ) ? $dic[ $d["type_front"] ] : $d["name"],
								"points" => $d["points"]
							);
						}
						$array[ $x ][ "data" ][ $d[ "type_front" ] ][ "infos" ][] = array(
							"name" => isset( $dic[ $d["type_front"] ] ) ? $dic[ $d["type_front"] ] : $d["name"],
							"points" => $d["points"]
						);
					}
				}
			}
		}
		include(constant("cRootServer") . "ui/common/header.php");
		include(constant("cRootServer") . "ui/common/head.php");
		include(constant("cRootServer") . "ui/includes/navbar.php");
		include(constant("cRootServer") . "ui/page/extrato.php");
		include(constant("cRootServer") . "ui/includes/footer.php");
		include(constant("cRootServer") . "ui/common/foot.php");
		print('<script src="'. constant("cFurniture").'js/period_input.js"></script>');
		include(constant("cRootServer") . "ui/common/footer.php");
	}

	public function metas($info)
	{		
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
			exit();
		}
		if (!isset($_SESSION[constant("cAppKey")]["credential"]["accept_at"]) || empty($_SESSION[constant("cAppKey")]["credential"]["accept_at"])) {
			basic_redir($GLOBALS["regulamento_url"]);
			exit();
		}

		/* $boiler = new goals_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		list( $recordset , $data ) = $boiler->return_data(); */

		$users = new users_model();
		$users->set_field(array("idx", "position"));
		$users->set_filter( array("idx = '" .  $_SESSION[constant("cAppKey")]["credential"]["idx"]  . "' "));
		$users->load_data();
		$users->attach(array("goals"), false, null, array(" created_at ", " name ", " points ", " tipo ", "type_front", "mes"));
		$users->attach(array("targets"), false, null, array(" created_at ", " name ", " points ", " tipo ", "type_front", "mes"));
		$users->join("respostas", "respostas", array("created_by" => "idx"), null, array(" idx ", " created_at ", " name ", "pontos"));
		$users->attach_son("respostas", array("quizes"), true);

		$array = $GLOBALS["periodos"] ;	

		$dic_type_front = goalstypes_controller::data4select("slug",array(" active = 'yes' " ) , "dic_type_front" ) ;

		$data = $users->data;

		if (isset($users->data[0]["goals_attach"][0])) {
			foreach ($users->data[0]["goals_attach"] as $k => $d) {
				$current_data = $d["mes"];
				foreach (array_keys($array) as $x) {
					if ($current_data >= $array[$x]["start"] && $current_data <= $array[$x]["end"]) {
						$kkk = isset( $dic_type_front[ $d["type_front"] ] ) ? $dic_type_front[ $d["type_front"] ] : "bonus" ;
						if( !isset( $array[ $x ]["data"][ $kkk ] )  ){
							$array[ $x ]["data"][ $kkk ] = array(
								"month" => $x,
								"type_front" => $kkk, 
								"name" => $d["tipo"],
							);
						}
						$array[ $x ][ "data" ][ $kkk ][ "infos" ][] = array(
							"name" => $d["name"],
							"points" => $d["points"],
							"ref" => substr( $GLOBALS["month_name"][ preg_replace("/^.....(..).+/","$1",$current_data ) ] ,0 , 3)
						);
					}
				}
			}
		}

		if (isset($users->data[0]["respostas_attach"][0])) {
			foreach ($users->data[0]["respostas_attach"] as $k => $d) {
				$current_data = $d["created_at"];
				foreach (array_keys($array) as $x) {
					if ($current_data >= $array[$x]["start"] && $current_data <= $array[$x]["end"]) {
						if (!isset($array[ $x ][ "data" ]["pontuacoes-bonus"] ) ) {
							$array[ $x ][ "data" ]["pontuacoes-bonus" ] = array(
								"month" => $x,
								"name" => "Quiz - " . $d["quizes_attach"][0]["name"], 
								"pontos" => $d["pontos"],
								"type_front" => "bonus",
							);
						}
						$array[ $x ][ "data" ][ "pontuacoes-bonus" ][ "infos" ][] = array(
							"name" => "Quiz - " .  $d["quizes_attach"][0]["name"],
							"points" => $d["pontos"]
						);
					}
				}
			}
		}
		switch ($info["format"]) {
			case ".json":
				$total = array("total" => 3 );
				header('Content-type: application/json');
				echo json_encode( 
					array( 
						"total" => array_merge( array( "total" => array_sum( $total ) ) , $total )
						, "row" => $data 
					) 
				);
		break;			
		default:
			$page = 'metas';
			include(constant("cRootServer") . "ui/common/header.php");
			include(constant("cRootServer") . "ui/common/head.php");
			include(constant("cRootServer") . "ui/includes/navbar.php");
			include(constant("cRootServer") . "ui/page/metas.php");
			include(constant("cRootServer") . "ui/includes/footer.php");
			include(constant("cRootServer") . "ui/common/foot.php");
			/* 
				print('<script>' . "\n");
				print('    data_metas_json = {' . "\n");
				print('        url: "' . $GLOBALS["metas_url"] . '.json"' . "\n");
				print('    }' . "\n");					
				print('</script>' . "\n");
				print('<script src="'. constant("cFurniture").'js/metas.js"></script>');
				//include(constant("cRootServer") . "furniture/js/add/metas.js"); 
			*/
			print('<script>'."\n");
			print('$("#period-input").bind("change", function(){'."\n");
			print('	$("#tbl1").hide();'."\n");
			print('	$("#tbl2").hide();'."\n");
			print('	$("#tbl3").hide();'."\n");
			print('	$("#tbl4").hide();'."\n");
			print('	$("#tbl" + $("option:selected",this).val() ).show();'."\n");
			print('})'."\n");
			print('</script>'."\n");
			include(constant("cRootServer") . "ui/common/footer.php");
		}
	}


	public function save_rules($info)
	{
		$data = date("Y-m-d H:i:s");
		$users = new users_model();
		$users->set_filter(array("idx = '" .  $_SESSION[constant("cAppKey")]["credential"]["idx"]  . "' "));
		$users->populate(array("accept_at" => date("Y-m-d H:i:s")));
		$users->save();
		$_SESSION[constant("cAppKey")]["credential"]["accept_at"] = $data;

		basic_redir($GLOBALS["home_url"]);
	}

	public function reset_password( $info ){
        $boiler = new users_model();
        $boiler->set_filter( array( " enabled = 'yes' " , " (  cpf = '" . $boiler->con->real_escape_string( $info["post"]["cpf"] ) . "' or mail = '" . $boiler->con->real_escape_string( $info["post"]["cpf"] ) . "' ) " ) ) ;
        $boiler->load_data();
		if( isset( $boiler->data[0] ) ){
			$boiler->attach( array("tokens") , false , null , array( "name" ) );
			if( !isset( $boiler->data[0]["tokens_attach"][0] ) ){
				$key = md5( date("YmdHis") . $boiler->data[0]["idx"] ) ; 
				$tokens = new tokens_model();
				$tokens->populate( array( "name" => $key ) ) ;
				$tokens->save();
				$infotoken = array(
					"idx" => $tokens->con->insert_id 
					, "post" => array(
						"users_id" => $boiler->data[0]["idx"] 
					)
				) ;
				$tokens->save_attach( $infotoken , array("users") , true );
			}
			else{
				$key = $boiler->data[0]["tokens_attach"][0]["name"] ;
			}

			ob_start();
				include( constant("cRootServer") . "furniture/email/bemvindo.html");
				$out = ob_get_contents();
			ob_end_clean();

			$mails_idx = mail_controller::save(
				array(
					"post" => array(
						"name" => "Esqueceu a Senha"
						, "scheduled_at" => date("Y-m-d H:i:s")
						, "htmlmsg" => strtr( $out , array( "[HOST]" => constant("cFrontend"), "[link]" => sprintf( $GLOBALS["tkpwd_url"] , $key ) , "[login]" =>  $boiler->data[0]["login"] , "[name]" => $boiler->data[0]["first_name"] . " " . $boiler->data[0]["last_name"]  ) ) 
						, "textmsg" => "Clique no link abaixo para redefinir sua senha:\n" . sprintf($GLOBALS["tkpwd_url"] , $key ) 
						, "type" => "mail"
						, "scheduled_at" => date("Y-m-d H:i:s")
						, "mailboxes" => serialize(
							array(
								"from" => array( "mail" => constant("mail_from_mail"), "name" => constant("mail_from_name") )
								, "replyTo" => array( "mail" => constant("mail_from_mail") , "name" => constant("mail_from_name") )
								, "Address" => array( array( "mail" => $boiler->data[0]["mail"] , "name" => $boiler->data[0]["first_name"] . " " . $boiler->data[0]["last_name"] ) ) 
								, "BCC" => array( array( "mail" => "rcarpi@hsolmkt.com.br", "name" => "Raphael Carpi" ) )
							)
						)
					)
				)
			)  ;
			$mail = array(
				"idx" => $boiler->data[0]["idx"]
				, "post" => array(
					"messages_id" => $mails_idx["idx"] 
				)
			) ;
			$boiler->save_attach( $mail , array("messages") );
			$_SESSION["messages_app"]["info"] = array("Foi enviado um e-mail com o link para definir nova senha");
		}
		else{
			$_SESSION["messages_app"]["danger"] = array("Não foi encontrado nenhum usuário ativo");
		}
		basic_redir( $GLOBALS["home_url"] );
		exit();
	}

	public function display_selfiepet($info){
		
		$selfies = new selfies_model();	
		$selfies->set_filter(array("slug = '" .  $info["slug"]  . "' "));
		$selfies->load_data();
		$data = $selfies->data[0];
		$votado = "false";
		if(isset($_COOKIE["avertloverspetselfiepet"])){
			$votado = "true";
		}		
		include(constant("cRootServer") . "ui/common/header.php");
		include(constant("cRootServer") . "ui/common/head.php");		
		include(constant("cRootServer") . "ui/page/public_selfiepet.php");	
		include(constant("cRootServer") . "ui/includes/footer.php");
		include(constant("cRootServer") . "ui/common/foot.php");	
		print('<script src="'. constant("cFurniture").'js/selfiepet.js"></script>');
		include(constant("cRootServer") . "ui/common/footer.php");
	}

	public function vote_selfie($info){

		$cookiename = 'avertloverspet';

		$selfies = new selfies_model();	
		$selfies->set_filter(array("slug = '" .  $info["post"]["selfiepet"]  . "' "));
		$selfies->load_data();
		
		$info["post"]["selfies_id"] = $selfies->data[0]["idx"];
		setcookie($cookiename.'selfiepet', true, time() + (10 * 365 * 24 * 60 * 60));
		
		$info["post"]["cookiename"] = $cookiename;
		$boiler = new votes_model();
		$boiler->populate( $info["post"] ) ;
		$boiler->save();		
		$info["idx"] = $boiler->con->insert_id;

		$boiler->save_attach($info, array("selfies") );

		echo json_encode([
			'erro' => false,
			'message' => "VOTADO"
		]);

	}
	
	public function display_musica($info){
		
		$musics = new musics_model();	
		$musics->set_filter(array("slug = '" .  $info["slug"]  . "' "));
		$musics->load_data();
		$data = $musics->data[0];
				
		include(constant("cRootServer") . "ui/common/header.php");
		include(constant("cRootServer") . "ui/common/head.php");		
		include(constant("cRootServer") . "ui/page/musics.php");	
		include(constant("cRootServer") . "ui/includes/footer.php");
		include(constant("cRootServer") . "ui/common/foot.php");		
		include(constant("cRootServer") . "ui/common/footer.php");
	}
}
