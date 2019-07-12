<?php

$side_bar_posts_hottest = BlogArtigo::get_all(['order' => 'views', 'limit' => 5 ], true);
$this->loops['side_bar_posts_hottest'] = new Loop( $side_bar_posts_hottest );
