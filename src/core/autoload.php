<?php

#funcao q carrega as classes automaticamente
spl_autoload_register(function( $classe ) {

	if(file_exists( "./app/models/".$classe.".classe.php"))
		require_once( "./app/models/".$classe.".classe.php");

	/* obsolete */
	if(file_exists( "./core/abstracts/".$classe.".classe.php"))
		require_once( "./core/abstracts/".$classe.".classe.php");

	/* core */
	if(file_exists( "./core/models/".$classe.".classe.php"))
		require_once( "./core/models/".$classe.".classe.php");
	
	if(file_exists( "./core/core/".$classe.".classe.php"))
		require_once( "./core/core/".$classe.".classe.php");
	
	if(file_exists( "./core/config/".$classe.".classe.php"))
		require_once( "./core/config/".$classe.".classe.php");
	
	if(file_exists( "./core/util/".$classe.".classe.php"))
		require_once( "./core/util/".$classe.".classe.php");	

});
