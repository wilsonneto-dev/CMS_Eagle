<?php

// valida permissão
if( !in_array( "projeto", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "projeto";

$p = new Projeto();

if( isset($_GET["id"]) ){
	$p->id = $_GET["id"];
	if($p->get()){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
			$clone = clone $p;

			$p->titulo = $_POST["titulo"];
			$p->link = $_POST["link"];
			$p->texto = $_POST["texto"];
			$p->servicos = $_POST["servicos"];
			$p->intro = $_POST["intro"];
			$p->cod_categoria = $_POST["cod_categoria"];
			
			$p->head_titulo = $_POST["head_titulo"];	
			$p->head_descricao = $_POST["head_descricao"];	
			$p->head_palavras_chave = $_POST["head_palavras_chave"];

			SEO::id_url( $p->titulo, $p );
			
			if ( $_FILES["imagem"]["error"] == 0 ){
				$img_name = $p->id_url ."-". gerar_hash(6);
				$p->imagem = Upload::salvaArq( "projetos/" . $img_name, $_FILES["imagem"] );
			}
			/*
			if ( $_FILES["imagem_capa"]["error"] == 0 ){
				$img_name = $p->id_url ."-capa-". gerar_hash(6);
				$p->imagem_capa = Upload::salvaArq( "projetos/" . $img_name, $_FILES["imagem_capa"] );
			}
			*/
			/*
			if ( $_FILES["imagem_topo"]["error"] == 0 ){
				$img_name = $p->id_url ."-topo-". gerar_hash(6);
				$p->imagem_topo = Upload::salvaArq( "projetos/" . $img_name, $_FILES["imagem_topo"] );
			}*/

			if($p->atualizar()){
				LogAdmin::_salvar( "Projeto Topo Editado", "Projeto" , $admin->id, json_encode( $clone ), json_encode( $p ) );
				addOnloadScript("message('Atualizado com sucesso.','sucess');");
			} else {
				LogAdmin::_salvar( "Erro ao editar banner topo", "Projeto" , $admin->id, json_encode( $clone ), json_encode( $p ) );
				addOnloadScript("message('Erro ao atualizar.','error');");
			}
		}
	}
}

$page = new StdAdminPage();

$page->title = "Editar Projeto";
$page->page = "Projeto";
$page->back_link = true;
$page->title_back = "Projetos";

$page->form = true;

// select * from genero where ativo = 1;
$sel_categoria = new SqlSelect("SELECT id as valor, titulo as texto FROM categoria WHERE codprojeto = ".CODPROJETO." AND ativo = 1 ORDER BY titulo"); 
$sel_categoria->nome = "cod_categoria";
if( $p != "" ) 
	$sel_categoria->valorSelecionado = $p->cod_categoria; 
$sel_categoria->exec();

$page->form_fields = array(


	/* combos */
	array( "label" => "Categoria", "type" => "html-field", "html" => $sel_categoria->html ),

	/* título */
	array( "value" => $p->titulo, "name" => "titulo", "label" => "Titulo", "required" => true),
	
	/* título */
	array( "value" => $p->servicos, "name" => "servicos", "label" => "Servi&ccedil;os", "required" => true),
	
	array( "value" => $p->link, "name" => "link", "label" => "Link" ),
	
	/* descrição */
	array( "value" => $p->texto, "name" => "texto", "type" => "editor", "label" => "Descri&ccedil;&atilde;o *", "required" => true ),
	array( "name" => "intro", "type" => "textarea", "label" => "Introdu&ccedil;&atilde;o *", "required" => true, 
		"value" => $p->intro 
	),
	
	/* imagens */
	array( "label" => "Imagem Atual", "type" => "image-view", "value" => ( "/" . $p->imagem ) ),
	array( "name" => "imagem", "label" => "Imagem ".ACOMODACAO_IMAGEM_WIDTH."x".ACOMODACAO_IMAGEM_HEIGHT, "type" => "file" ),
	
	// array( "label" => "Imagem Capa Atual", "type" => "image-view", "value" => ( "/" . $p->imagem_capa ) ),
	// array( "name" => "imagem_capa", "label" => "Imagem Capa ( ".ACOMODACAO_CAPA_WIDTH."x".ACOMODACAO_CAPA_HEIGHT. " )", "type" => "file", "required" => true ),

	// array( "label" => "Imagem Topo Atual", "type" => "image-view", "value" => ( "/" . $p->imagem_topo ) ),
	// array( "name" => "imagem_topo", "label" => "Imagem Topo ( Opcional )", "type" => "file" ),
	
		
	'--',
	'Configurações internas da página ( opcional )',
	
	/* headers */
	
	array( "value" => $p->head_titulo, "name" => "head_titulo", "label" => "T&iacute;tulo"),
	array( "value" => $p->head_descricao, "name" => "head_descricao", "label" => "Descri&ccedil;&atilde;o" ),
	array( "value" => $p->head_palavras_chave, "name" => "head_palavras_chave", "label" => "Palavras-Chave"),
	
);


$page->render();

?>