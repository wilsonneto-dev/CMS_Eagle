<?php
// valida permissão
if( !in_array( "chamada", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "chamada";

$p = new Chamada();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	
	$p->titulo = $_POST["titulo"];
	$p->texto = $_POST["texto"];
	$p->link = $_POST["link"];
	$p->texto_botao = $_POST["texto_botao"];
	
	if ( $_FILES["imagem"]["error"] == 0 ){
		$img_name = "chamada-".gerar_hash(4);
		$p->imagem = Upload::salvaArq( "chamadas/" . $img_name, $_FILES["imagem"] );
	}
	
	if( $p->cadastrar() ){
		LogAdmin::_salvar( "Chamada Cadastrado", "Chamada" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Cadastrado com sucesso.','sucess');");
	} else {
		LogAdmin::_salvar( "Erro ao cadastrar Chamada", "Chamada" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Ocorreu um erro ao cadastrar.','error');");
	}
}

$p = new Chamada();

$page = new StdAdminPage();

$page->title = "Cadastrar Chamada";
$page->page = "Chamada";
$page->back_link = true;
$page->title_back = "Chamadas";

$page->form = true;

$page->form_fields = array(

	/* título */
	array( "value" => $p->titulo, "name" => "titulo", "label" => "Titulo", "required" => true),
	
	array( "name" => "texto", "type" => "textarea", "label" => "Texto *", "required" => true, 
		"value" => $p->texto 
	),

	array( "value" => $p->link, "name" => "link", "label" => "Link Bot&atilde;o", "required" => true),
	array( "value" => $p->texto_botao, "name" => "texto_botao", "label" => "Texto Bot&atilde;o", "required" => true),
	
	/* imagens */
	array( "label" => "Imagem Atual", "type" => "image-view", "value" => ( "/" . $p->imagem ) ),
	array( "name" => "imagem", "label" => "Imagem ".CHAMADA_IMAGEM_WIDTH."x".CHAMADA_IMAGEM_HEIGHT, "type" => "file", "required" => true )

);

$page->render();


?>