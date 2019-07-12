<?php

$url = $this->get_param('url');

$artigo = BlogArtigo::get([ 'url' => $url ]);
if($artigo == null)
	$this->redirect('/');

// adicionar 1 view ao artigo
if($artigo->views == '' || $artigo->views == null)
	$artigo->views = 0;

$artigo->views = $artigo->views +1;
$artigo->save(['properties' => 'views']);

$autor = BlogAutor::get( $artigo->cod_autor );
if($autor == null)
	$this->redirect('/');

$categoria = BlogCategoria::get( $artigo->cod_blog_categoria );
if($categoria == null)
	$this->redirect('/');

$this->page_header_description = '';				

$this->_meta_og_image = $artigo->imagem_facebook;

$this->page_header_title = $artigo->titulo;
$this->page_header_description = $artigo->introducao;

$this->set_title(str_replace('"', '', $artigo->titulo));
$this->set_description(str_replace('"', '', $artigo->introducao));

$this->location_bullets = [ ['link' => '/', 'label' => 'Blog'], ['link' => '/categoria/'.$categoria->url, 'label' => $categoria->titulo], ['label' => $artigo->titulo] ];

$where_add = ' AND artigo.cod_blog_categoria = '. $categoria->id .' ';

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
		AND artigo.id <> ".$artigo->id."
	ORDER BY 
		artigo.data_postagem DESC
	LIMIT 4";

$this->obj = $artigo;
$this->autor = $autor;
$this->categoria = $categoria;

$this->bloc_cod('side-bar-article'); 

?>

