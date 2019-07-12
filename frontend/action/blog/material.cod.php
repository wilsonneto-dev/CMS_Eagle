<?php

$url = $this->get_param('url');

$material = BlogMaterial::get([ 'url' => $url ]);
if($material == null)
	$this->redirect('/');

$this->link_download = '/download/material/'.$url;
$this->link_submit = '/material/'.$url.'/download';

$this->page_header_title = $material->titulo;
$this->page_header_description = '';

$this->set_title(str_replace('"', '', $material->titulo));

$this->location_bullets = [ ['link' => '/', 'label' => 'Blog'], ['link' => '/materiais', 'label' => 'Materiais'], ['label' => $material->titulo] ];

$this->obj = $material;
// $this->show_master = false;

?>

