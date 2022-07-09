<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once( $_SERVER["DOCUMENT_ROOT"] . "/../app/inc/main.php");
if( isset( $_GET["logout"] ) && $_GET["logout"] == "yes" ){
	unset( $_SESSION[ constant("cAppKey") ] );
	basic_redir( $GLOBALS["home_url"] ) ;
}
$params = array(
	"sr" => isset( $_GET["sr"] ) ? $_GET["sr"] > 1 ? $_GET["sr"] : 0 : 0 ,
	"format" => ".html" ,
	"post" => isset( $_POST ) ? $_POST : NULL ,
	"get" => isset( $_GET ) ? $_GET : NULL ,
);
$btn_save = isset( $_POST["btn_save"] ) ? true : null ;
$btn_remove = isset( $_POST["btn_remove"] ) ? true : null ;

$strCanal = "";
$dispatcher = new dispatcher( true ) ;
$dispatcher->add_route ( "GET" , "/(index(\.json|\.xml|\.html)).*?" , "function:basic_redir" , null, $home_url ) ;
$dispatcher->add_route ( "GET" , "/?" , "site_controller:display" , null, $params ) ;
$dispatcher->add_route ( "POST" , "/login" , "site_controller:login" , $btn_save, $params ) ;
$dispatcher->add_route ( "GET" , "/sair" , "site_controller:logout" , null, $params ) ;
$dispatcher->add_route ( "GET" , "/senha" , "site_controller:password" , null, $params ) ;
$dispatcher->add_route ( "POST" , "/senha" , "site_controller:reset_password" , $btn_save, $params ) ;
//$dispatcher->add_route ( "GET" , "/selfie-pet/(?P<slug>.+)" , "site_controller:display_selfiepet" , null, $params ) ;
//$dispatcher->add_route ( "POST" , "/voteselfiepet" , "site_controller:vote_selfie" ,  $btn_save, $params ) ;

$dispatcher->add_route ( "GET" , "/musicas/(?P<slug>.+)" , "site_controller:display_musica" , null, $params ) ;

foreach( tokens_controller::data4select("idx", array( " active = 'yes' " ) , "name" ) as $k => $v ){
	$dispatcher->add_route ( "GET" , "/tkpwd/(?P<key>".$v.")" , "tokens_controller:display" , null, $params ) ;
	$dispatcher->add_route ( "POST" , "/tkpwd/(?P<key>".$v.")" , "tokens_controller:renew" , $btn_save, $params ) ;
}

if( site_controller::check_login() ){
	$dispatcher->add_route ( "GET" , "/meus-dados" , "site_controller:display_data" , null, $params ) ;
	$dispatcher->add_route ( "POST" , "/meus-dados" , "site_controller:save" , $btn_save, $params ) ;
	$dispatcher->add_route ( "GET" , "/contato" , "contact_controller:display" , null, $params ) ;
	$dispatcher->add_route ( "POST" , "/contato" , "contact_controller:save" ,  $btn_save, $params ) ;
	$dispatcher->add_route ( "GET" , "/regulamento" , "site_controller:rules" , null, $params ) ;
	$dispatcher->add_route ( "POST" , "/regulamento" , "site_controller:save_rules" ,  $btn_save, $params ) ;
	$dispatcher->add_route ( "GET" , "/extrato" , "site_controller:extrato" , null, $params ) ;
	$dispatcher->add_route ( "GET" , "/premiacoes" , "site_controller:premio" , null, $params ) ;
	
	//$dispatcher->add_route ( "GET" , "/selfie-pet" , "selfies_controller:display" , null, $params ) ;
	//$dispatcher->add_route ( "POST" , "/selfie-pet" , "selfies_controller:save" , null, $params ) ;

	$dispatcher->add_route ( "GET" , "/musicas" , "musics_controller:display" , null, $params ) ;
	$dispatcher->add_route ( "POST" , "/musicas" , "musics_controller:save" , null, $params ) ;

	$dispatcher->add_route ( "GET" , "/noticias" , "news_controller:display" , null, $params ) ;
	$dispatcher->add_route ( "GET" , "/noticia/(?P<slug>.+)" , "news_controller:detail" , null, $params ) ;
	$dispatcher->add_route ( "GET" , "/metas(?P<format>.html|.json)?" , "site_controller:metas" , null, $params ) ;
	$dispatcher->add_route ( "GET" , "/quizes" , "quiz_controller:display" , null, $params ) ;
	$dispatcher->add_route ( "GET" , "/quiz/(?P<slug>.+)" , "quiz_controller:detail" , null, $params ) ;
	$dispatcher->add_route ( "POST" , "/quiz/(?P<slug>.+)" , "quiz_controller:save" , $btn_save, $params ) ;

	$dispatcher->add_route ( "GET" , "/ranking/mensal" , "ranking_controller:mensal" , null, $params ) ;
	$dispatcher->add_route ( "GET" , "/ranking/final" , "ranking_controller:final" , null, $params ) ;

	$dispatcher->add_route ( "GET" , "/jogo-da-memoria" , "games_controller:display" , null, $params ) ;
	$dispatcher->add_route ( "POST" , "/jogo-da-memoria" , "games_controller:save" , $btn_save, $params ) ;
	//$dispatcher->add_route ( "GET" , "/jogo-da-memoria/ranking" , "games_controller:ranking" , null, $params ) ;
	// $dispatcher->add_route ( "GET" , "/jogo-da-memoria/iniciar" , "games_controller:start" , null, $params ) ;
	$dispatcher->add_route ( "GET" , "/jogo-da-memoria/finalizado" , "games_controller:finish" , null, $params ) ;

}

if ( ! $dispatcher->exec() ) {
	basic_redir( $home_url );
}
?>