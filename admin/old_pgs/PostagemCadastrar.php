<?php
// valida permissão
if( !in_array( "postagem", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "postagem";

$p = new Postagem();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	
	$p->titulo = $_POST["titulo"];
	$p->texto = $_POST["texto"];
	$p->video = $_POST["video"];
	$p->intro = $_POST["intro"];
	$p->data = data( $_POST["data"] );
	
	$p->head_titulo = $_POST["head_titulo"];	
	$p->head_descricao = $_POST["head_descricao"];	
	$p->head_palavras_chave = $_POST["head_palavras_chave"];

	SEO::id_url( $p->titulo, $p );
	
	if ( $_FILES["imagem"]["error"] == 0 ){
	
		$img_name = $p->id_url."-".gerar_hash( 4 );
		$p->imagem = Upload::salvaArq( "postagens/" . $img_name, $_FILES["imagem"] );
	
	}
	if ( $_FILES["thumb"]["error"] == 0 ){
	
		$img_name = $p->id_url."-thumb-".gerar_hash( 4 );
		$p->thumb = Upload::salvaArq( "postagens/" . $img_name, $_FILES["thumb"] );
	}
	
	if( $p->cadastrar() ){
		LogAdmin::_salvar( "Postagem Cadastrado", "Postagem" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Cadastrado com sucesso.','sucess');");
	} else {
		LogAdmin::_salvar( "Erro ao cadastrar Postagem", "Postagem" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Ocorreu um erro ao cadastrar.','error');");
	}
}

$p = new Postagem();

$page = new StdAdminPage();

$page->title = "Cadastrar Postagem";
$page->page = "Postagem";
$page->back_link = true;
$page->title_back = "Postagens";

$page->form = true;

$page->form_fields = array(

	array( "value" => "", "type" => "data", "name" => "data", "label" => "Data", "required" => true ),
	
	/* título */
	array( "value" => $p->titulo, "name" => "titulo", "label" => "Titulo", "required" => true),
	
	/* descrição */
	array( "value" => $p->texto, "name" => "texto", "type" => "editor", "label" => "Descri&ccedil;&atilde;o *", "required" => true ),
	array( "name" => "intro", "type" => "textarea", "label" => "Introdu&ccedil;&atilde;o *", "required" => true, 
		"value" => $p->intro 
	),
	
	/* imagens */
	array( "label" => "Imagem Atual", "type" => "image-view", "value" => ( "/" . $p->imagem ) ),
	array( "name" => "imagem", "label" => "Imagem ", "type" => "file", "required" => true ),
	
	/* imagens */
	array( "label" => "Thumb Atual", "type" => "image-view", "value" => ( "/" . $p->thumb ) ),
	array( "name" => "thumb", "label" => "Thumb ", "type" => "file", "required" => true ),
	
	// array( "label" => "Imagem Capa Atual", "type" => "image-view", "value" => ( "/" . $p->imagem_capa ) ),
	// array( "name" => "imagem_capa", "label" => "Imagem Capa ( ".ACOMODACAO_CAPA_WIDTH."x".ACOMODACAO_CAPA_HEIGHT. " )", "type" => "file", "required" => true ),

	// array( "label" => "Imagem Topo Atual", "type" => "image-view", "value" => ( "/" . $p->imagem_topo ) ),
	// array( "name" => "imagem_topo", "label" => "Imagem Topo ( Opcional )", "type" => "file" ),
	
	/* título */
	array( "value" => $p->video, "name" => "video", "label" => "Video"),
		
	'--',
	'Configurações internas da página ( opcional )',
	
	/* headers */
	
	array( "value" => $p->head_titulo, "name" => "head_titulo", "label" => "T&iacute;tulo"),
	array( "value" => $p->head_descricao, "name" => "head_descricao", "label" => "Descri&ccedil;&atilde;o" ),
	array( "value" => $p->head_palavras_chave, "name" => "head_palavras_chave", "label" => "Palavras-Chave")
	

);

$page->render();


?>