<?php

$side_bar_article_posts_hottest = BlogArtigo::get_all(
	[
		'where' => [ 'cod_blog_categoria' => $this->obj->cod_blog_categoria ],
		'not-where' => [ 'id' => $this->obj->id ],
		'order' => 'views', 
		'limit' => 7 
	], true
);

$this->loops['side_bar_article_posts_hottest'] = new Loop( $side_bar_article_posts_hottest );
