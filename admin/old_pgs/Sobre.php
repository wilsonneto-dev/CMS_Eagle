<?php

// valida permissão
if( !in_array( "sobre", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "sobre";

$p = Sobre::_get();
$header = Pagina::_get( "sobre" );


if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$clone = clone $p;
	$p->texto = $_POST["texto"];
				
	if ( $_FILES["imagem"]["error"] == 0 ){
		$img_name = "sobre-". gerar_hash(6);
		$p->imagem = Upload::salvaArq( "sobre/" . $img_name, $_FILES["imagem"] );
	}

	$clone_header = clone $header;
	$header->head_titulo = $_POST["head_titulo"];	
	$header->head_descricao = $_POST["head_descricao"];	
	$header->head_palavras_chave = $_POST["head_palavras_chave"];
	if ( $_FILES["imagem_topo"]["error"] == 0 ){
		$img_name = "topo-".$header->url."-". gerar_hash(6);
		$header->imagem_topo = Upload::salvaArq( "paginas/" . $img_name, $_FILES["imagem_topo"] );
	}


	$atualizou_header = false;
	if( $header->id == "" ){ // se ainda não tem cadastrado, cadastra
		$header->url = "sobre";
		$atualizou_header = $header->cadastrar();
	}else{ // se já há na base de dados, atualiza
		$atualizou_header = $header->atualizar();
	}

	if( $p->atualizar() ){
		LogAdmin::_salvar( "Sobre Editado", "Sobre" , $admin->id, json_encode( $clone ) . "  " .json_encode( $clone_header ) , json_encode( $p ) . " - ". json_encode($header) );
		addOnloadScript("message('Atualizado com sucesso.','sucess');");
	} else {
		LogAdmin::_salvar( "Erro ao editar sobre", "Sobre" , $admin->id, json_encode( $clone ) . "  " .json_encode( $clone_header ) , json_encode( $p ) . " - ". json_encode($header) );
		addOnloadScript("message('Erro ao atualizar.','error');");
	}

}

$page = new StdAdminPage();

$page->title = "P&aacute;gina Sobre";
$page->page = "Sobre";

$page->form = true;

$page->form_fields = array(

	
	/* descrição */
	array( "value" => $p->texto, "name" => "texto", "type" => "editor", "label" => "Texto *", "required" => true ),
	
	/* imagens */
	array( "label" => "Imagem Atual", "type" => "image-view", "value" => ( "/" . $p->imagem ) ),
	array( "name" => "imagem", "label" => "Imagem", "type" => "file" ),

	'--',
	
	/* headers */
	array( "value" => $header->head_titulo, "name" => "head_titulo", "label" => "T&iacute;tulo"),
	array( "value" => $header->head_descricao, "name" => "head_descricao", "label" => "Descri&ccedil;&atilde;o" ),
	array( "value" => $header->head_palavras_chave, "name" => "head_palavras_chave", "label" => "Palavras-Chave"),
	
	/* imagens */
	array( "label" => "Imagem Topo Atual", "type" => "image-view", "value" => ( "/" . $header->imagem_topo ) ),
	array( "name" => "imagem_topo", "label" => "Imagem Topo ( Opcional )", "type" => "file" ),


);


$page->render();

?>