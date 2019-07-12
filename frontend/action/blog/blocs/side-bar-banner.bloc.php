<?php

$banner_side_bar = Banner::get_all(['cod_banner_tipo' => '4' ]);
$this->loops['banner_side_bar'] = new Loop( $banner_side_bar );
