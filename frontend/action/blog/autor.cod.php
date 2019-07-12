<?php

$url = $this->get_param('url');

$autor = BlogAutor::get([ 'url' => $url ]);
if($autor == null)
	$this->redirect('/');

$this->page_header_description = '';				

$this->page_header_title = $autor->nome;
$this->page_header_description = $autor->introducao;

$this->set_title(str_replace('"', '', $autor->nome));
$this->set_description(str_replace('"', '', $autor->introducao));

$this->location_bullets = [ ['url' => '/', 'label' => 'Blog'], ['label' => 'Autores'], ['label' => $autor->nome] ];

$where_add = ' AND autor.id = '.$autor->id .' ';

$this->autor_posts = new Repeater();
$this->autor_posts->campos = "url;introducao;titulo;imagem;data;autor_url;autor";
$this->autor_posts->sql = "
	SELECT 
		artigo.url, 
		artigo.introducao, 
		artigo.titulo, 
		artigo.thumb as imagem, 
		DATE_FORMAT(artigo.data_postagem, '%d/%m/%y') as data,
		DATE_FORMAT(artigo.data_postagem, '%d-%m-%y') as data_code,
		autor.nome as autor,
		autor.url as autor_url
	FROM 
		blog_artigo artigo
		INNER JOIN blog_autor AS autor ON autor.id = artigo.cod_blog_autor  
	WHERE 
		artigo.ativo = 1
		".$where_add." 
	ORDER BY 
		artigo.data_postagem DESC
	LIMIT 8";

$this->obj = $autor;

?>

