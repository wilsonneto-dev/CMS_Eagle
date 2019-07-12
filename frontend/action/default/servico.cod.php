<?php

$this->objeto = Servico::_getByUrl( _get("id_url") );

if( $this->objeto->id == "" ){
	header("Location: /404");
	die();
}

$this->set_title( $this->objeto->titulo, true );
$this->set_description( $this->objeto->intro );


?>
