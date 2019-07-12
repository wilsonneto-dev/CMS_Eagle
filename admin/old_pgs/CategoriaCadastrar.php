<?php
// valida permissão
$verificar_permissao = "categorias";
if( !in_array( $verificar_permissao, $permissoes_admin ) 
	|| $permissoes_admin[ $verificar_permissao ] == 0 
){
	include("pgs/404.pg.php");
	return;
}

$page = new StdAdminPage();
$page->permissao = $permissoes_admin[$verificar_permissao]; // permissão para a página: 0 => Leitura / 1 => escrita
$menu_destaque = "categorias";

$p = new Categoria();
$_parametro_id_url_manual = Parametro::_getValorByIdentificacao("id_url_manual");

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

	$p->descricao = _post("descricao");
	$p->titulo = _post("titulo");
	$p->ordem = _post("ordem");

	// SEO veriicar se cadastra manual ou automático
	if( $_parametro_id_url_manual == "1" ){
		$p->id_url = SEO::gerar_link( _post("id_url") );
	}else{
		SEO::id_url( $p->titulo, $p );		
	}

	if( trim($p->ordem) == "" ) 
		$p->ordem = 100;

	/* booleans */	
	$p->visivel = StdFormFactory::_getValorCheckbox("visivel");
	$p->listar = StdFormFactory::_getValorCheckbox("listar");
	$p->menu = StdFormFactory::_getValorCheckbox("menu");
	$p->destaque = StdFormFactory::_getValorCheckbox("destaque");

	if ( $_FILES["imagem"]["error"] == 0 ){
		$img_name = "categoria-".gerar_hash();
		$p->imagem = Upload::salvaArq( "/" . $img_name, $_FILES["imagem"] );
		Imagem::MiniaturaNaMedida( "../".$p->imagem, PRODUTO_IMAGEM_THUMB_WIDTH, PRODUTO_IMAGEM_THUMB_HEIGHT );
	}

	if( $p->cadastrar() ){
		LogAdmin::_salvar( "\"$p->titulo\" cadastrada", "Categoria" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Cadastrado com sucesso.','sucess');");
	} else {
		LogAdmin::_salvar( "Erro ao cadastrar", "Categoria" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Ocorreu um erro ao cadastrar.','error');");
	}
	
}

$p = new Categoria();

$page->title = "Cadastrar Categoria";
$page->page = "Categoria";
$page->back_link = true;
$page->title_back = "Categorias";

$page->form = true;
$page->form_fields = array(

	array( "value" => $p->titulo, "name" => "titulo", "label" => "Categoria *", "required" => true, "autofocus" => true ),
	
	// url mostrar dependendo de como o parametro está setado
	( $_parametro_id_url_manual ? array( "value" => $p->id_url, "name" => "id_url", "label" => "Endere&ccedil;o / URL *", "required" => true ) : "" ),
	
	array( "value" => $p->descricao, "type" => "textarea", "name" => "descricao", "label" => "Descri&ccedil;&atilde;o *", "required" => true ),
	array( "value" => $p->ordem, "type" => "num", "name" => "ordem", "label" => "Ordem *", "required" => true ),

	/* imagem */
	array( "label" => "Imagem", "type" => "image-view", "value" => ( "/" . $p->imagem ) ),
	array( "value" => "0", "name" => "remover_imagem", "label" => "remover imagem", "type" => "checkbox", "cond" => $p->imagem ),
	array( "name" => "imagem", "label" => "Imagem", "type" => "file" ),

	array( "value" => $p->visivel, "name" => "visivel", "type" => "checkbox" , "label" => "Visivel" ),
	array( "value" => $p->menu, "name" => "menu", "type" => "checkbox" , "label" => "Menu" ),
	array( "value" => $p->listar, "name" => "listar", "type" => "checkbox" , "label" => "Listar" ),
	array( "value" => $p->destaque, "name" => "destaque", "type" => "checkbox" , "label" => "Destaque" )


);

$page->render();


?>