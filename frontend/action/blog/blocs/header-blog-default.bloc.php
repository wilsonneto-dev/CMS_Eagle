<?php

$categorias_source = BlogCategoria::get_all(['properties' => 'titulo,url', 'order' => 'titulo'], true);
$this->loops['master_categorias'] = new Loop( $categorias_source );

$banners = Banner::get_all(['cod_banner_tipo' => 2, 'visivel' => 1]);
$this->loops['master_banners'] = new Loop( $banners );