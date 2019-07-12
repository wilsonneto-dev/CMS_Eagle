<?php

// valida permissão
if( !in_array( "smtp", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "smtp";

$p = EmailConfig::_get();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

	$clone = clone $p;
	$p->email = $_POST["email"];
	$p->senha = $_POST["senha"];
	$p->smtp = $_POST["smtp"];

	if( $p->atualizar() ){
		LogAdmin::_salvar( "Sobre Editado", "Sobre" , $admin->id, json_encode( $clone ) , json_encode( $p ));
		addOnloadScript("message('Atualizado com sucesso.','sucess');");
	} else {
		LogAdmin::_salvar( "Erro ao editar smtp", "Sobre" , $admin->id, json_encode( $clone ) , json_encode( $p ));
		addOnloadScript("message('Erro ao atualizar.','error');");
	}

}

$page = new StdAdminPage();

$page->title = "Configurar SMTP";
$page->page = "Smtp";

$page->form = true;

$page->form_fields = array(
	
	/* headers */
	array( "value" => $p->email, "name" => "email", "label" => "E-mail", "required" => true),
	array( "value" => $p->senha, "name" => "senha", "label" => "Senha", "required" => true),
	array( "value" => $p->smtp, "name" => "smtp", "label" => "SMTP", "required" => true),
	
);


$page->render();

?>