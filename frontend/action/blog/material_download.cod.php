<?php

$url = $this->get_param('url');

$material = BlogMaterial::get([ 'url' => $url ]);

// if($material == null) $this->redirect('/');

$this->link_download = '/download/material/'.$url;
$this->link_submit = '/material/'.$url.'/download';

$this->page_header_title = $material->titulo;
$this->set_title(str_replace('"', '', $material->titulo));

$this->page_header_description = '';

$this->location_bullets = [ ['link' => '/', 'label' => 'Blog'], ['link' => '/materiais', 'label' => 'Materiais'], ['label' => $material->titulo] ];

$this->obj = $material;

if($this->is_post())
{

	$lead = Lead::get([ 'email' => $this->get_param('email'), 'cod_lista' => $this->obj->cod_lista ]);
	if($lead == null)
		$lead = new Lead();	
	
	$lead->load( $_POST );
	$lead->ref = $this->get_param('ref','');
	$lead->cod_lista = $this->obj->cod_lista;

	$lead->save();
}

?>

