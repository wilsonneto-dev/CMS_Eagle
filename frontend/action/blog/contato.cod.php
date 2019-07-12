<?php

$this->page_header_title = 'Entre em contato';
$this->page_header_description = '';

$autores = BlogAutor::get_all( [ 'contato_mostrar' => '1' ] );
$this->loops['contato_autores'] = new Loop( $autores );

$this->location_bullets = [ ['link' => '/contato', 'label' => 'Contato'] ];

?>

