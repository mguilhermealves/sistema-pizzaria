<?php
date_default_timezone_set('America/Sao_Paulo');
define( "cPaginate" , 150 );
ini_set('post_max_size', '4096M');
ini_set('upload_max_filesize', '4096M');
ini_set('default_charset', 'UTF-8');

define ("cHStr", '172.29.0.2');
define ("cUserStr", 'user_santher');
define ("cPassStr", '123456');
define ("cBancoStr", 'mysql_santher');

define( "cURL_API" , "https://api.hotshoponline.info/" );

define("prefix_tables" , "");

define( "cAppKey" , "santher" );
define( "cTitle" , "Campanha Santher" );

define( "cAppRoot" , "/" );
define( "cRootServer" ,  sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , constant("cAppRoot") ) ) ;
define( "cRootServer_APP" ,  sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , constant("cAppRoot") . "../app"  ) ) ;
define( "cFrontend" , sprintf( "http://%s%s" , $_SERVER["HTTP_HOST"] , constant("cAppRoot") ) );

define( "cFurniture" , sprintf( "%s%s" , constant("cFrontend") , "furniture/" ) );

//DADOS API EXTERNA
define( "cExternalAuth" , "");
define( "cApiUrl" , "" );
define( "cCampanhaUrl" , "" );
define( "cCampanhaID" , "" );

?>
