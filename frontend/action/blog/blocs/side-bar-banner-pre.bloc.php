<?php

$banner_side_bar_pre = Banner::get_all(['cod_banner_tipo' => '3' ]);
$this->loops['banner_side_bar_pre'] = new Loop( $banner_side_bar_pre );
