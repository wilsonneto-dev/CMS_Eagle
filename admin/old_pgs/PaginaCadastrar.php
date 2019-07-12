<?php
// valida permissão
if( !in_array( "pagina", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "pagina";

$p = new Pagina();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$url = SEO::gerar_link($_POST["url"]);
	$p = Pagina::_get( $url );

	$clone = clone $p;

	$p->texto = _post( "texto" );
	$p->head_titulo = _post( "head_titulo" );	
	$p->head_descricao = _post( "head_descricao" );	
	$p->head_palavras_chave = _post( "head_palavras_chave" );

	$p->ordem = _post( "ordem" );
	$p->cod_tipo = _post( "cod_tipo" );
	$p->cod_layout = _post( "cod_layout" );

	$menu = 0;
	if ( isset( $_POST["menu"] ) ) 
		if( $_POST["menu"] == "ativo" ) 
			$menu = 1; 
	
	$p->menu = $menu;

	if ( isset( $_POST["remover_imagem"] ) ) 
		if( $_POST["remover_imagem"] == "ativo" ) 
			$p->imagem = "";
	
	if ( isset( $_POST["remover_imagem_topo"] ) ) 
		if( $_POST["remover_imagem_topo"] == "ativo" ) 
			$p->imagem_topo = "";
	
	if(isset($_FILES["imagem"])){
		if ( $_FILES["imagem"]["error"] == 0 ){
			$img_name = "pagina-". $url . "-" . gerar_hash(6);
			$p->imagem = Upload::salvaArq( "paginas/" . $img_name, $_FILES["imagem"] );
		}
	}

	if(isset($_FILES["imagem_topo"])){
		if ( $_FILES["imagem_topo"]["error"] == 0 ){
			$img_name = "topo-".$p->url."-". gerar_hash(6);
			$p->imagem_topo = Upload::salvaArq( "paginas/" . $img_name, $_FILES["imagem_topo"] );
		}		
	}		

	$atualizou_header = false;
	if( $p->id == "" ){ // se ainda não tem cadastrado, cadastra
		$p->url = $url;
		$atualizou_header = $p->cadastrar();
		if($atualizou_header){
			LogAdmin::_salvar( "Pagina Atualizada", "Pagina" , $admin->id, json_encode( $clone ) , json_encode( $p ));
			addOnloadScript("message('Atualizado com sucesso.','sucess');");
		} else {
			LogAdmin::_salvar( "Erro ao editar pagina", "Pagina" , $admin->id, json_encode( $clone ), json_encode( $p ));
			addOnloadScript("message('Erro ao atualizar.','error');");
		}
	} else { // se já há na base de dados, atualiza
		$atualizou_header = $p->atualizar();
		if($atualizou_header){
			LogAdmin::_salvar( "Pagina Editada", "Pagina" , $admin->id, json_encode( $clone ), json_encode( $p ) );
			addOnloadScript("message('Atualizado com sucesso.','sucess');");
		} else {
			LogAdmin::_salvar( "Erro ao editar pagina", "Pagina" , $admin->id, json_encode( $clone ), json_encode( $p ));
			addOnloadScript("message('Erro ao atualizar.','error');");
		}
	}

}

$sel_layout = new SqlSelect("SELECT code as valor, descricao as texto FROM pagina_layout WHERE codprojeto = ".CODPROJETO." AND ativo = 1 ORDER BY descricao"); 
$sel_layout->nome = "cod_layout";
if( $p != "" ) 
	$sel_layout->valorSelecionado = $p->cod_layout; 
$sel_layout->exec();

$sel_tipo = new SqlSelect("SELECT code as valor, descricao as texto FROM pagina_tipo WHERE codprojeto = ".CODPROJETO." AND ativo = 1 ORDER BY descricao"); 
$sel_tipo->nome = "cod_tipo";
if( $p != "" ) 
	$sel_tipo->valorSelecionado = $p->cod_tipo; 
$sel_tipo->exec();

$p = new Pagina();

$page = new StdAdminPage();

$page->title = "Cadastrar P&aacute;gina";
$page->page = "Pagina";
$page->back_link = true;
$page->title_back = "P&aacute;ginas";

$page->form = true;

$page->form_fields = array(

	/* descrição */
	array( "value" => $p->texto, "name" => "texto", "type" => "editor", "label" => "Texto" ),
	
	/* imagens */
	array( "label" => "Imagem Atual", "type" => "image-view", "value" => ( "/" . $p->imagem ) ),
	array( "value" => "0", "name" => "remover_imagem", "label" => "remover imagem", "type" => "checkbox", "cond" => $p->imagem ),
	array( "name" => "imagem", "label" => "Imagem", "type" => "file" ),

	'--',
	array( "label" => "Grupo", "type" => "html-field", "html" => $sel_tipo->html ),
	array( "label" => "Layout", "type" => "html-field", "html" => $sel_layout->html ),	
	array( "value" => $p->ordem, "name" => "ordem", "label" => "Ordem", "type" => "num" ),
	array( "value" => $p->menu, "name" => "menu", "label" => "Aparecer no menu", "type" => "checkbox" ),
	
	'--',
	
	/* headers */
	array( "value" => $p->url, "name" => "url", "label" => "URL ( endere&ccedil;o )"),
	array( "value" => $p->head_titulo, "name" => "head_titulo", "label" => "T&iacute;tulo"),
	array( "value" => $p->head_descricao, "name" => "head_descricao", "label" => "Descri&ccedil;&atilde;o" ),
	array( "value" => $p->head_palavras_chave, "name" => "head_palavras_chave", "label" => "Palavras-Chave"),
	
	/* imagens */
	// array( "label" => "Imagem Topo Atual", "type" => "image-view", "value" => ( "/" . $p->imagem_topo ) ),
	// array( "name" => "imagem_topo", "label" => "Imagem Topo ( Opcional )", "type" => "file" ),

);

$page->render();


?>