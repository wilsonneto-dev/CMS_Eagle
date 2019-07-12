<?php

$this->sobre = Sobre::_get();

$this->set_title( "Sobre nós", true );
$this->set_description( 
	$this->infos->home_intro
);

?>

