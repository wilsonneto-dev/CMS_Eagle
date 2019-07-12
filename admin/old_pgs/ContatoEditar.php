<?php

// valida permissão
if( !in_array( "contato", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "contato";

$p = new Contato();

if( isset($_GET["id"]) ){

	$p->id = $_GET["id"];
	$p->get();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		addOnloadScript("message('Não é possível editar um contato.','error');");
	}

}

$page = new StdAdminPage();

$page->title = "Detalhes do Contato";
$page->page = "Contato";
$page->back_link = true;
$page->title_back = "Contatos";

$page->form = true;

$page->form_fields = array(

	/* título */
	array( "value" => $p->nome, "name" => "nome", "label" => "Nome", "required" => true),
	array( "value" => $p->email, "name" => "email", "label" => "E-mail", "required" => true),
	array( "value" => $p->telefone, "name" => "titulo", "label" => "Telefone", "required" => true),
	array( "value" => $p->assunto, "name" => "assunto", "label" => "Assunto", "required" => true),
	array( "value" => $p->tipo, "name" => "tipo", "label" => "Tipo", "required" => true),
	array( "value" => $p->pagina, "name" => "pagina", "label" => "P&aacute;gina", "required" => true),
	array( "value" => $p->ip, "name" => "ip", "label" => "IP", "required" => true),
	
	array( "name" => "texto", "type" => "textarea", "label" => "Texto *", "required" => true, 
		"value" => $p->mensagem 
	)

);



$page->render();

?>