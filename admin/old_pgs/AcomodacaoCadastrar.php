<?php
// valida permissão
if( !in_array( "galeria", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "galeria";

$p = new Acomodacao();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	
	$p->titulo = $_POST["titulo"];
	// $p->texto = $_POST["texto"];
	$p->intro = $_POST["intro"];
	
	// $p->head_titulo = $_POST["head_titulo"];	
	// $p->head_descricao = $_POST["head_descricao"];	
	// $p->head_palavras_chave = $_POST["head_palavras_chave"];

	SEO::id_url( $p->titulo, $p );
	
	if ( $_FILES["imagem"]["error"] == 0 ){
		$img_name = $p->id_url."-".gerar_hash(4);
		$p->imagem = Upload::salvaArq( "acomodacoes/" . $img_name, $_FILES["imagem"] );
	}
	
	/*
	if ( $_FILES["imagem_capa"]["error"] == 0 ){
		$img_name = $p->id_url. "-capa-". gerar_hash(4);
		$p->imagem_capa = Upload::salvaArq( "acomodacoes/" . $img_name, $_FILES["imagem_capa"] );
	}*/
	/*
	if ( $_FILES["imagem_topo"]["error"] == 0 ){
		$img_name = $p->id_url. "-topo-". gerar_hash(4);
		$p->imagem_topo = Upload::salvaArq( "acomodacoes/" . $img_name, $_FILES["imagem_topo"] );
	} */

	if( $p->cadastrar() ){
		LogAdmin::_salvar( "Acomodacao Cadastrado", "Acomodacao" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Cadastrado com sucesso.','sucess');");
	} else {
		LogAdmin::_salvar( "Erro ao cadastrar Acomodacao", "Acomodacao" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Ocorreu um erro ao cadastrar.','error');");
	}
}

$p = new Acomodacao();

$page = new StdAdminPage();

$page->title = "Cadastrar Acomoda&ccedil;&atilde;o";
$page->page = "Acomodacao";
$page->back_link = true;
$page->title_back = "Acomoda&ccedil;&otilde;es";

$page->form = true;

$page->form_fields = array(

	/* título */
	array( "value" => $p->titulo, "name" => "titulo", "label" => "Titulo", "required" => true),
	
	/* descrição */
	// array( "value" => $p->texto, "name" => "texto", "type" => "editor", "label" => "Descri&ccedil;&atilde;o *", "required" => true ),
	array( "name" => "intro", "type" => "textarea", "label" => "Introdu&ccedil;&atilde;o *", "required" => true, 
		"value" => $p->intro 
	),
	
	/* imagens */
	array( "label" => "Imagem Atual", "type" => "image-view", "value" => ( "/" . $p->imagem ) ),
	array( "name" => "imagem", "label" => "Imagem ".ACOMODACAO_IMAGEM_WIDTH."x".ACOMODACAO_IMAGEM_HEIGHT, "type" => "file", "required" => true ),
	
	// array( "label" => "Imagem Capa Atual", "type" => "image-view", "value" => ( "/" . $p->imagem_capa ) ),
	// array( "name" => "imagem_capa", "label" => "Imagem Capa ( ".ACOMODACAO_CAPA_WIDTH."x".ACOMODACAO_CAPA_HEIGHT. " )", "type" => "file", "required" => true ),

	// array( "label" => "Imagem Topo Atual", "type" => "image-view", "value" => ( "/" . $p->imagem_topo ) ),
	// array( "name" => "imagem_topo", "label" => "Imagem Topo ( Opcional )", "type" => "file" ),
	
	/*	
	'--',
	'Configurações internas da página ( opcional )',
	*/
	/* headers */
	/*
	array( "value" => $p->head_titulo, "name" => "head_titulo", "label" => "T&iacute;tulo"),
	array( "value" => $p->head_descricao, "name" => "head_descricao", "label" => "Descri&ccedil;&atilde;o" ),
	array( "value" => $p->head_palavras_chave, "name" => "head_palavras_chave", "label" => "Palavras-Chave"),
	*/

);

$page->render();


?>