<?php

$this->page_header_title = 'Materiais';
$this->page_header_description = '';	

$this->location_bullets = [ [ 'url' => '/', 'label' => 'Blog' ], [ 'label' => 'Materiais'] ];

$materiais_source = BlogMaterial::get_all(['order' => 'titulo' ], true);
$this->loops['materiais_source'] = new Loop( $materiais_source );

?>

