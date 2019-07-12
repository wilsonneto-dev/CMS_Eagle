<?php

// valida permissão
if( !in_array( "parametros", $this->get_credentials()['permissoes_admin'] ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "parametros";

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	$arr = Parametro::_getLista();
	foreach ( $arr as $k => $p ) {
		$parametro = new Parametro();
		$parametro->identificacao = $p->identificacao;
		$parametro->getByIdentificacao();
		$clone = clone $parametro;
		$parametro->valor = $_POST[ $p->identificacao ];
		$parametro->atualizar();
		LogAdmin::_salvar( "Parametro Editado", "Parametro" , $this->get_credentials()['admin']->id, json_encode( $clone ), json_encode( $p ) );
	}
	$this->message( "Atualizado com sucesso" );
			
}

$page = new StdAdminPage();

$page->title = "Parametros";
$page->page = "Parametro";
$page->back_link = true;
$page->title_back = "Parametros";

$page->form = true;

$page->form_fields = array();

$arr = Parametro::_getLista();

foreach ($arr as $k => $p) {
	$page->form_fields[] = array( "value" => $p->valor, "name" => $p->identificacao, 'type' => 'varchar', "label" => $p->nome );
}

/*
	array( "value" => $p->nome, "name" => "nome", "label" => "Parceiro *", "required" => true, "autofocus" => true ),
	array( "label" => "Imagem Atual", "type" => "image-view", "value" => ( "/" . $p->foto ) ),
	array( "name" => "foto", "label" => "Imagem (".PARCEIRO_WIDTH."x".PARCEIRO_HEIGHT.")", "type" => "file" ),
	array( "value" => $p->link, "name" => "link", "label" => "Link *" ),
	array( "value" => $p->intro, "name" => "intro", "label" => "Intro *", "type" => "textarea", "required" => true ),
	array( "value" => $p->texto, "name" => "texto", "label" => "Texto *", "type" => "textarea", "required" => true )
);
*/

$page->render();

?>