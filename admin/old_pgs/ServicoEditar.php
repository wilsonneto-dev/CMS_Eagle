<?php

// valida permissão
if( !in_array( "servico", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "servico";

$p = new Servico();

if( isset($_GET["id"]) ){
	$p->id = $_GET["id"];
	if($p->get()){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
			$clone = clone $p;

			$p->titulo = $_POST["titulo"];
			$p->texto = $_POST["texto"];
			$p->intro = $_POST["intro"];
			$p->ordem = $_POST["ordem"];

			$p->head_titulo = $_POST["head_titulo"];	
			$p->head_descricao = $_POST["head_descricao"];	
			$p->head_palavras_chave = $_POST["head_palavras_chave"];

			SEO::id_url( $p->titulo, $p );

			
			if ( $_FILES["imagem"]["error"] == 0 ){
				$img_name = $p->id_url ."-". gerar_hash(6);
				$p->imagem = Upload::salvaArq( "servicos/" . $img_name, $_FILES["imagem"] );
			}
			
			if ( $_FILES["imagem_capa"]["error"] == 0 ){
				$img_name = $p->id_url ."-capa-". gerar_hash(6);
				$p->imagem_capa = Upload::salvaArq( "servicos/" . $img_name, $_FILES["imagem_capa"] );
			}
			if ( $_FILES["imagem_topo"]["error"] == 0 ){
				$img_name = $p->id_url ."-topo-". gerar_hash(6);
				$p->imagem_topo = Upload::salvaArq( "servicos/" . $img_name, $_FILES["imagem_topo"] );
			}
			if ( $_FILES["thumb"]["error"] == 0 ){
				$img_name = $p->id_url ."-thumb-". gerar_hash(6);
				$p->thumb = Upload::salvaArq( "servicos/" . $img_name, $_FILES["thumb"] );
			}

			if($p->atualizar()){
				LogAdmin::_salvar( "Servico Topo Editado", "Servico" , $admin->id, json_encode( $clone ), json_encode( $p ) );
				addOnloadScript("message('Atualizado com sucesso.','sucess');");
			} else {
				LogAdmin::_salvar( "Erro ao editar banner topo", "Servico" , $admin->id, json_encode( $clone ), json_encode( $p ) );
				addOnloadScript("message('Erro ao atualizar.','error');");
			}
		}
	}
}

$page = new StdAdminPage();

$page->title = "Editar Servi&ccedil;o";
$page->page = "Servico";
$page->back_link = true;
$page->title_back = "Servi&ccedil;os";

$page->form = true;


$page->form_fields = array(

	array( "value" => $p->ordem, "name" => "ordem", "label" => "Ordem"),

	/* título */
	array( "value" => $p->titulo, "name" => "titulo", "label" => "Titulo", "required" => true),
	
	/* descrição */
	array( "value" => $p->texto, "name" => "texto", "type" => "editor", "label" => "Descri&ccedil;&atilde;o *", "required" => true ),
	array( "name" => "intro", "type" => "textarea", "label" => "Introdu&ccedil;&atilde;o *", "required" => true, 
		"value" => $p->intro 
	),
	
	/* imagens */
	array( "label" => "Imagem Atual", "type" => "image-view", "value" => ( "/" . $p->imagem ) ),
	array( "name" => "imagem", "label" => "Imagem ".SERVICO_IMAGEM_WIDTH."x".SERVICO_IMAGEM_HEIGHT, "type" => "file" ),
	
	array( "label" => "Imagem Capa Atual", "type" => "image-view", "value" => ( "/" . $p->imagem_capa ) ),
	array( "name" => "imagem_capa", "label" => "Imagem Capa ( ".ACOMODACAO_CAPA_WIDTH."x".ACOMODACAO_CAPA_HEIGHT. " )", "type" => "file" ),

	array( "label" => "Imagem Topo Atual", "type" => "image-view", "value" => ( "/" . $p->imagem_topo ) ),
	array( "name" => "imagem_topo", "label" => "Imagem Topo ( Opcional )", "type" => "file" ),

	array( "label" => "Thumb Atual", "type" => "image-view", "value" => ( "/" . $p->thumb ) ),
	array( "name" => "thumb", "label" => "Thumb ( Opcional )", "type" => "file" ),

	'--',
	'Configurações internas da página ( opcional )',

	/* headers */
	array( "value" => $p->head_titulo, "name" => "head_titulo", "label" => "T&iacute;tulo"),
	array( "value" => $p->head_descricao, "name" => "head_descricao", "label" => "Descri&ccedil;&atilde;o" ),
	array( "value" => $p->head_palavras_chave, "name" => "head_palavras_chave", "label" => "Palavras-Chave")

);


$page->render();

?>