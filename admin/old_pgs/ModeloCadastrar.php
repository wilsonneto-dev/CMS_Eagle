<?php
// valida permissão
if( !in_array( "modelo", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "modelo";

$p = new Modelo();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	
	$p->descricao = $_POST["descricao"];

	SEO::id_url( $p->descricao, $p );

	if ( $_FILES["arquivo"]["error"] == 0 ){
		$img_name = $p->id_url; // gerar_hash();
		$p->url = Upload::salvaArq( "arquivos/" . $img_name, $_FILES["arquivo"] );
	}

	if( $p->cadastrar() ){
		LogAdmin::_salvar( "Modelo Cadastrado", "Modelo" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Cadastrado com sucesso.','sucess');");
	} else {
		LogAdmin::_salvar( "Erro ao cadastrar Modelo", "Modelo" , $admin->id , "", json_encode( $p ) );
		addOnloadScript("message('Ocorreu um erro ao cadastrar.','error');");
	}
}

$p = new Modelo();

$page = new StdAdminPage();

$page->title = "Cadastrar Modelo";
$page->page = "Modelo";
$page->back_link = true;
$page->title_back = "Modelos";

$page->form = true;

$page->form_fields = array(
	array( "value" => $p->descricao, "name" => "descricao", "label" => "Descri&ccedil;&atilde;o *", "required" => true, "autofocus" => true ),
	array( "name" => "arquivo", "label" => "Arquivo", "type" => "file", "required" => true )
);

$page->render();


?>