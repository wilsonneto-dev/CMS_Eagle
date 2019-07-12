<?php

// valida permissão
if( !in_array( "tema", $this->get_credentials()['permissoes_admin'] ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "tema";

$p = Info::get();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$clone = clone $p;
	
	$arr_config_theme = explode("/", $_POST["config_theme"]);
	$arr_config_action = explode("/", $_POST["config_action"]);

	$p->config_theme_path = $arr_config_theme[1];
	$p->config_theme_id = $arr_config_theme[0];
	
	$p->config_action_path = $arr_config_action[1];
	$p->config_action_id = $arr_config_action[0];
	
	if( $p->save() )
	{
		LogAdmin::_salvar( "Tema editado", "Sobre" , $this->get_credentials()['admin']->id, json_encode( $clone ) , json_encode( $p ));
		$this->message("Atualizado com sucesso.");
	} 
	else 
	{
		LogAdmin::_salvar( "Erro ao editar tema", "Sobre" , $this->get_credentials()['admin']->id, json_encode( $clone ) , json_encode( $p ));
		$this->message("Ocorreu um erro.", 'fail');
	}

}

$page = new StdAdminPage();

$page->title = "Configurar Tema";
$page->page = "Tema";

$page->form = true;


$sel_tema = new SqlSelect("SELECT concat( id, '/', path ) as valor, descricao as texto FROM config_theme WHERE ativo = 1 ORDER BY descricao"); 
$sel_tema->nome = "config_theme";
if( $p != "" ) 
	$sel_tema->valorSelecionado = $p->config_theme_id."/".$p->config_theme_path; 
$sel_tema->exec();

$sel_action = new SqlSelect("SELECT concat( id, '/', path ) as valor, descricao as texto FROM config_action WHERE ativo = 1 ORDER BY descricao"); 
$sel_action->nome = "config_action";
if( $p != "" ) 
	$sel_action->valorSelecionado = $p->config_action_id."/".$p->config_action_path; 
$sel_action->exec();

$page->form_fields = array(
	
	array( "label" => "Tema / Theme", "type" => "html-field", "html" => $sel_tema->html ),
	array( "label" => "A&ccedil;&otilde;es / Actions", "type" => "html-field", "html" => $sel_action->html )
	
);


$page->render();

?>