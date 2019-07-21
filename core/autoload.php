<?php

define("CORE_PATH", "./core");
define("APP_PATH", "./app");

#funcao q carrega as classes automaticamente
spl_autoload_register(function( $classe ) {

	/* obsolete */
	if(file_exists( CORE_PATH . "/abstracts/".$classe.".classe.php"))
		require_once( CORE_PATH . "/abstracts/".$classe.".classe.php");

	/* core */
	if(file_exists( CORE_PATH . "/models/".$classe.".classe.php"))
		require_once( CORE_PATH . "/models/".$classe.".classe.php");
	
	if(file_exists( CORE_PATH . "/core/".$classe.".classe.php"))
		require_once( CORE_PATH . "/core/".$classe.".classe.php");
	
	if(file_exists( CORE_PATH . "/config/".$classe.".classe.php"))
		require_once( CORE_PATH . "/config/".$classe.".classe.php");
	
	if(file_exists( CORE_PATH . "/util/".$classe.".classe.php"))
		require_once( CORE_PATH . "/util/".$classe.".classe.php");	

});
