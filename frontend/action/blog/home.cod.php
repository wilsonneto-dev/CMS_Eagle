<?php

$type = $this->get_param('type');
$param = $this->get_param('param');
$pg = $this->get_param('pag_number');
if($pg == "" || $pg == null)
	$pg = 1;
$query = str_replace('--','',str_replace('\'', '', $this->get_param('q')));

$pagination_link = '/blog/pg#pg';

$where_add = '';

$this->page_header_title = 'Blog';
$this->page_header_description = '';				
$this->location_bullets = [ ['url' => '/', 'label' => 'Blog'], ['label' => 'Últimas Postagens']];

if($type == 'busca')
{
	$this->page_header_title = 'Busca por: "' . $query . '"';
	$this->set_title(str_replace('"', '', $this->page_header_title), true);

	$this->page_header_description = '';			
	$this->location_bullets = [ ['url' => '/', 'label' => 'Blog'], ['label' => 'Busca'], ['label' => $query]];

	$where_add .= ' 
			AND (
				artigo.titulo like \'%'.$query.'%\' 
				OR artigo.introducao like \'%'.$query.'%\'
				OR autor.nome like \'%'.$query.'%\'
			)';

	$pagination_link = '/blog/busca/pg#pg?q='.$query;

}
else if($type == 'categoria')
{
	$categoria = BlogCategoria::get([ 'url' => $param ]);
	if($categoria == null)
		$this->redirect('/');
	$this->page_header_title = $categoria->titulo;
	$this->set_title(str_replace('"', '', $this->page_header_title), true);
	$this->page_header_description = $categoria->texto;
	$this->location_bullets = [ ['url' => '/', 'label' => 'Blog'], ['label' => 'Categorias'], ['label' => $categoria->titulo] ];

	$where_add .= ' AND artigo.cod_blog_categoria = \'' . $categoria->id . '\' ';

	$pagination_link = '/blog/categoria/'.$param.'/pg#pg';

}

$paginacao_config = null;
if($this->infos->paginacao_config != '')
{
	$paginacao_config = json_decode($this->infos->paginacao_config, true);
}

$sql_from_where = "
	FROM 
		blog_artigo artigo
		INNER JOIN blog_autor AS autor ON autor.id = artigo.cod_blog_autor  
	WHERE 
		artigo.ativo = 1
		".$where_add." ";

$qtd_obj = BaseDao::query("SELECT count(*) as qtd ".$sql_from_where);

$this->paginacao = Paginacao::get_instance($pagination_link, $paginacao_config);
$this->paginacao->num_elems_pg = $this->infos->lista_qtd;
$this->paginacao->total_elems = $qtd_obj->qtd;
$this->paginacao->pg_atual = $pg;
$this->paginacao->calcular();

$this->home_posts = new Repeater();
$this->home_posts->campos = "url;introducao;titulo;imagem;data;autor_url;autor";
$this->home_posts->sql = "
	SELECT 
		artigo.url, 
		artigo.introducao, 
		artigo.titulo, 
		artigo.thumb as imagem, 
		DATE_FORMAT(artigo.data_postagem, '%d/%m/%y') as data,
		DATE_FORMAT(artigo.data_postagem, '%d-%m-%y') as data_code,
		autor.nome as autor,
		autor.url as autor_url ".
		$sql_from_where.
		" ORDER BY 
		artigo.data_postagem DESC
	LIMIT ".$this->paginacao->ini." , ".$this->infos->lista_qtd."
";

$this->bloc_cod('side-bar'); 


?>

