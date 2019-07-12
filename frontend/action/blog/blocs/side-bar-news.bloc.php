<?php

$side_bar_posts_news = BlogArtigo::get_all(['order' => 'data_postagem', 'limit' => 5 ], true);
$this->loops['side_bar_posts_news'] = new Loop( $side_bar_posts_news );
