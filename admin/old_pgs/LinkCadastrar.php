<?php
// valida permissão
if( !in_array( "link", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "link";

$p = new Link();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	
	$p->link = $_POST["link"];
	$p->descricao = $_POST["descricao"];

	if( $p->cadastrar() ){
		LogAdmin::_salvar( "Link Cadastrado", "Link" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Cadastrado com sucesso.','sucess');");
	} else {
		LogAdmin::_salvar( "Erro ao cadastrar Link", "Link" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Ocorreu um erro ao cadastrar.','error');");
	}
}

$p = new Link();

$page = new StdAdminPage();

$page->title = "Cadastrar Link";
$page->page = "Link";
$page->back_link = true;
$page->title_back = "Links";

$page->form = true;

$page->form_fields = array(
	array( "value" => $p->descricao, "name" => "descricao", "label" => "Descri&ccedil;&atilde;o *", "required" => true, "autofocus" => true ),
	array( "value" => $p->link, "name" => "link", "label" => "Link *", "required" => true)
);


$page->render();


?>