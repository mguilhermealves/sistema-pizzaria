<?php
date_default_timezone_set('America/Sao_Paulo');
define( "cPaginate" , 150 );
ini_set('post_max_size', '4096M');
ini_set('upload_max_filesize', '4096M');
ini_set('default_charset', 'UTF-8');

define ("cHStr", '172.29.0.2');
define ("cUserStr", 'user_pizzaria');
define ("cPassStr", '123456');
define ("cBancoStr", 'mysql_pizzaria');

define("prefix_tables" , "");

define( "cAppKey" , "pizzaria.gerenciador" );
define( "cTitle" , "Sistema Pizzaria" );
define( "cVersion" , "Desenvolvimento" );

define( "cAppRoot" , "/" );
define( "cRootServer" ,  sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , "/" ) ) ;
define( "cRootServer_APP" ,  sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , constant("cAppRoot") . "../app"  ) ) ;
define( "cFrontend" , sprintf( "http://%s%s" , $_SERVER["HTTP_HOST"] , constant("cAppRoot") ) );
define( "cFrontend_USER" , constant("cFrontend") );
define( "cFrontComponents" ,  sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , "ui/components/" ) ) ;
define( "cFurniture1" ,  sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , "furniture/" ) ) ;
define( "cFurniture" , sprintf( "%s%s" , constant("cFrontend") , "furniture/" ) );

define( "mail_from_port" , "" );
define( "mail_from_host" , "" );
define( "mail_from_user" , "" );
define( "mail_from_name" , "" );
define( "mail_from_pwd" , "" );
?>