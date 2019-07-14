<?php

error_reporting( E_ALL ); // somente em producao descomentar

#funcao q carrega as classes automaticamente
spl_autoload_register(function( $classe ) {
	if(file_exists("../php/models/".$classe.".classe.php"))
		require_once("../php/models/".$classe.".classe.php");
	else if(file_exists("php/models/".$classe.".classe.php"))
		require_once("php/models/".$classe.".classe.php");

	if(file_exists("../php/abstracts/".$classe.".classe.php"))
		require_once("../php/abstracts/".$classe.".classe.php");
	else if(file_exists("php/abstracts/".$classe.".classe.php"))
		require_once("php/abstracts/".$classe.".classe.php");
	else if(file_exists("../../php/abstracts/".$classe.".classe.php"))
		require_once("../../php/abstracts/".$classe.".classe.php");
	else if(file_exists("../../../php/abstracts/".$classe.".classe.php"))
		require_once("../../../php/abstracts/".$classe.".classe.php");
	
	else if(file_exists("../php/core/".$classe.".classe.php"))
		require_once("../php/core/".$classe.".classe.php");
	else if(file_exists("php/core/".$classe.".classe.php"))
		require_once("php/core/".$classe.".classe.php");

	else if(file_exists("../../php/models/".$classe.".classe.php"))
		require_once("../../php/models/".$classe.".classe.php");
	else if(file_exists("../../../php/models/".$classe.".classe.php"))
		require_once("../../../php/models/".$classe.".classe.php");

	else if(file_exists("php/config/".$classe.".classe.php"))
		require_once("php/config/".$classe.".classe.php");
	else if(file_exists("../php/config/".$classe.".classe.php"))
		require_once("../php/config/".$classe.".classe.php");	
	else if(file_exists("../../php/config/".$classe.".classe.php"))
		require_once("../../php/config/".$classe.".classe.php");	
	else if(file_exists("../php/util/".$classe.".classe.php"))
		require_once("../php/util/".$classe.".classe.php");	
	else if(file_exists("../../php/util/".$classe.".classe.php"))
		require_once("../../php/util/".$classe.".classe.php");	
	else if(file_exists("php/util/".$classe.".classe.php"))
		require_once("php/util/".$classe.".classe.php");	
});

/*
#constantes
define( 'CODPROJETO' , '1' );
define( 'DEBUG' , '1' );

#sessoes
define( 'S_REDIRECIONAR' , 'sessao_redirocinar_pagina' );
define( 'S_POST' , 'sessao_post' );
define( 'S_FLAG' , 'sessao_flags' );
define( 'S_MENSAGEM_ERRO' , 'sessao_mensagem_erro' );
define( 'S_MENSAGEM_OK' , 'sessao_mensagem_ok' );
*/
