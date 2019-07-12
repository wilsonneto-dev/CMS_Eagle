<?php

// valida permissão
if( !in_array( "link", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "link";

$p = new Link();

if( isset($_GET["id"]) ){
	$p->id = $_GET["id"];
	if($p->get()){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
			$clone = clone $p;

			$p->descricao = $_POST["descricao"];
			$p->link = $_POST["link"];
			
			if($p->atualizar()){
				LogAdmin::_salvar( "Link Topo Editado", "Link" , $admin->id, json_encode( $clone ), json_encode( $p ) );
				addOnloadScript("message('Atualizado com sucesso.','sucess');");
			} else {
				LogAdmin::_salvar( "Erro ao editar banner topo", "Link" , $admin->id, json_encode( $clone ), json_encode( $p ) );
				addOnloadScript("message('Erro ao atualizar.','error');");
			}
		}
	}
}

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