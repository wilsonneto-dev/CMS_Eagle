<?php

// valida permissão
if( !in_array( "modelo", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "modelo";

$p = new Modelo();

if( isset($_GET["id"]) ){
	$p->id = $_GET["id"];
	if($p->get()){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
			$clone = clone $p;

			$p->descricao = $_POST["descricao"];
		
			SEO::id_url( $p->descricao, $p );

			if ( $_FILES["arquivo"]["error"] == 0 ){
				$img_name = $p->id_url; // gerar_hash();
				$p->url = Upload::salvaArq( "arquivos/" . $img_name, $_FILES["arquivo"] );
			}
		
			if($p->atualizar()){
				LogAdmin::_salvar( "Modelo Topo Editado", "Modelo" , $admin->id, json_encode( $clone ), json_encode( $p ) );
				addOnloadScript("message('Atualizado com sucesso.','sucess');");
			} else {
				LogAdmin::_salvar( "Erro ao editar banner topo", "Modelo" , $admin->id, json_encode( $clone ), json_encode( $p ) );
				addOnloadScript("message('Erro ao atualizar.','error');");
			}
		}
	}
}

$page = new StdAdminPage();

$page->title = "Editar Modelo";
$page->page = "Modelo";
$page->back_link = true;
$page->title_back = "Modelos";

$page->form = true;

$page->form_fields = array(
	array( "value" => $p->descricao, "name" => "descricao", "label" => "Descri&ccedil;&atilde;o *", "required" => true, "autofocus" => true ),
	array( "name" => "arquivo", "label" => "Arquivo", "type" => "file" )
);

$page->render();

?>