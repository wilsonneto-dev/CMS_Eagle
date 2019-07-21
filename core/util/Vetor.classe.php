<?php
/*
	classe com funções úteis para trabalhar com vetores de maneira prática
	03/12/2016 - Wilson Neto	
*/


class Vetor {

	/*  
		função estática que preenche um objeto com os valores de um array

		- para facilitar a preencher os objetos nas telas de cadastro:
		- ex: Vetor::_preenche( $_POST, $p, [ "link", ... propriedades a preencher ... ] );
	*/
	public static function _preenche( $_vetor, $_obj, $_propriedades = null ){
		if($_propriedades == null) 
			$_propriedades = array_keys( $_vetor );
		foreach ($_propriedades as $propriedade) {
			$_obj->$propriedade = $_vetor[$propriedade];
		}
	}
}

?>