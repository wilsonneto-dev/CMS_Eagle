<?php
// valida permissão
if( !in_array( "depoimento", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "depoimento";

$p = new Depoimento();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	
	$p->nome = $_POST["nome"];
	$p->titulo = $_POST["titulo"];
	$p->texto = $_POST["texto"];

	if ( $_FILES["foto"]["error"] == 0 ){
		$img_name = "depoimento-".gerar_hash(4);
		$p->foto = Upload::salvaArq( "depoimentos/" . $img_name, $_FILES["foto"] );
	}
	
	if( $p->cadastrar() ){
		LogAdmin::_salvar( "Depoimento Cadastrado", "Depoimento" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Cadastrado com sucesso.','sucess');");
	} else {
		LogAdmin::_salvar( "Erro ao cadastrar Depoimento", "Depoimento" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Ocorreu um erro ao cadastrar.','error');");
	}
}

$p = new Depoimento();

$page = new StdAdminPage();

$page->title = "Cadastrar Depoimento";
$page->page = "Depoimento";
$page->back_link = true;
$page->title_back = "Depoimentos";

$page->form = true;

$page->form_fields = array(

	/* título */
	array( "value" => $p->nome, "name" => "nome", "label" => "Nome", "required" => true),
	array( "value" => $p->titulo, "name" => "titulo", "label" => "Titulo", "required" => true),
	
	array( "name" => "texto", "type" => "textarea", "label" => "Texto *", "required" => true, 
		"value" => $p->texto 
	),
	
	/* imagens */
	array( "label" => "Foto Atual", "type" => "image-view", "value" => ( "/" . $p->foto ) ),
	array( "name" => "foto", "label" => "Foto ".DEPOIMENTO_IMAGEM_WIDTH."x".DEPOIMENTO_IMAGEM_HEIGHT, "type" => "file", "required" => true )

);

$page->render();


?>