<?php
// valida permissão
if( !in_array( "cliente", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "cliente";

$p = new Cliente();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	
	$p->titulo = $_POST["titulo"];
	$p->sub_titulo = $_POST["sub_titulo"];
	$p->texto = $_POST["texto"];
	$p->link = $_POST["link"];
	
	$p->head_titulo = $_POST["head_titulo"];	
	$p->head_descricao = $_POST["head_descricao"];	
	$p->head_palavras_chave = $_POST["head_palavras_chave"];

	SEO::id_url( $p->titulo, $p );
	
	if ( $_FILES["imagem"]["error"] == 0 ){
		$img_name = $p->id_url."-".gerar_hash( 4 );
		$p->imagem = Upload::salvaArq( "clientes/" . $img_name, $_FILES["imagem"] );
	}
	
	if ( $_FILES["imagem_menor"]["error"] == 0 ){
		$img_name = $p->id_url."-menor-".gerar_hash( 4 );
		$p->imagem_menor = Upload::salvaArq( "clientes/" . $img_name, $_FILES["imagem_menor"] );
	}
	

	if( $p->cadastrar() ){
		LogAdmin::_salvar( "Cliente Cadastrado", "Cliente" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Cadastrado com sucesso.','sucess');");
	} else {
		LogAdmin::_salvar( "Erro ao cadastrar Cliente", "Cliente" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Ocorreu um erro ao cadastrar.','error');");
	}
}

$p = new Cliente();

$page = new StdAdminPage();

$page->title = "Cadastrar Cliente";
$page->page = "Cliente";
$page->back_link = true;
$page->title_back = "Clientes";

$page->form = true;

$page->form_fields = array(

	/* título */
	array( "value" => $p->titulo, "name" => "titulo", "label" => "Titulo", "required" => true),
	array( "value" => $p->sub_titulo, "name" => "sub_titulo", "label" => "Sub-Titulo", "required" => true),
	array( "value" => $p->link, "name" => "link", "label" => "Link" ),
	
	/* descrição */
	array( "value" => $p->texto, "name" => "texto", "type" => "editor", "label" => "Descri&ccedil;&atilde;o *", "required" => true ),
	
	/* imagens */
	array( "label" => "Imagem Atual", "type" => "image-view", "value" => ( "/" . $p->imagem ) ),
	array( "name" => "imagem", "label" => "Imagem", "type" => "file", "required" => true ),
	
	/* imagens */
	array( "label" => "Imagem Menor Atual", "type" => "image-view", "value" => ( "/" . $p->imagem_menor ) ),
	array( "name" => "imagem_menor", "label" => "Imagem Menor", "type" => "file", "required" => true ),
	
	'--',
	'Configurações internas da página ( opcional )',
	
	/* headers */
	
	array( "value" => $p->head_titulo, "name" => "head_titulo", "label" => "T&iacute;tulo"),
	array( "value" => $p->head_descricao, "name" => "head_descricao", "label" => "Descri&ccedil;&atilde;o" ),
	array( "value" => $p->head_palavras_chave, "name" => "head_palavras_chave", "label" => "Palavras-Chave"),
	

);

$page->render();


?>