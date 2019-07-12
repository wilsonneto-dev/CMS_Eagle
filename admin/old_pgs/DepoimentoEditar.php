<?php

// valida permissão
if( !in_array( "depoimento", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "depoimento";

$p = new Depoimento();

if( isset($_GET["id"]) ){
	$p->id = $_GET["id"];
	if($p->get()){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
			$clone = clone $p;

			$p->nome = $_POST["nome"];
			$p->titulo = $_POST["titulo"];
			$p->texto = $_POST["texto"];
			
			if ( $_FILES["foto"]["error"] == 0 ){
				$img_name = "depoimento-".$p->id."-".gerar_hash(4);
				$p->foto = Upload::salvaArq( "depoimentos/" . $img_name, $_FILES["foto"] );
			}
			
			if($p->atualizar()){
				LogAdmin::_salvar( "Depoimento Topo Editado", "Depoimento" , $admin->id, json_encode( $clone ), json_encode( $p ) );
				addOnloadScript("message('Atualizado com sucesso.','sucess');");
			} else {
				LogAdmin::_salvar( "Erro ao editar banner topo", "Depoimento" , $admin->id, json_encode( $clone ), json_encode( $p ) );
				addOnloadScript("message('Erro ao atualizar.','error');");
			}
		}
	}
}

$page = new StdAdminPage();

$page->title = "Editar Depoimento";
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
	array( "name" => "foto", "label" => "Foto ".DEPOIMENTO_IMAGEM_WIDTH."x".DEPOIMENTO_IMAGEM_HEIGHT, "type" => "file" )
);



$page->render();

?>