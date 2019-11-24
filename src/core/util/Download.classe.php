<?php
class Download {

	/*  
		função estática que preenche um objeto com os valores de um array

		- para facilitar a preencher os objetos nas telas de cadastro:
		- ex: Vetor::_preenche( $_POST, $p, [ "link", ... propriedades a preencher ... ] );
	*/
	public static function exec( $file, $name )
	{

		$ext = pathinfo($file)['extension'];

		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename="'.$name.'.'.$ext.'"');
		header('Content-Type: application/octet-stream');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . filesize($file));
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Expires: 0');
		readfile($file);
		exit();
	}
}