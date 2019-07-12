<?php

// valida permissão
if( !in_array( "gateway", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = "gateway";

$p = new GatewayPagamento();

if( isset($_GET["id"]) ){
	$p->id = $_GET["id"];
	if($p->get()){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$clone = clone $p;

			$p->codigo = _post( "codigo" );
			$p->email = _post( "email" );
			$p->token = _post( "token" );
			$p->pagina_redirecionamento = _post( "pagina_redirecionamento" );
			$p->ordem = intval( _post( "ordem" ) );

			$padrao = 0;
			if ( isset( $_POST[ "padrao" ] ) ) 
				if( _post( "padrao" ) == "ativo" ) 
					$padrao = 1; 
			
			$habilitado = 0;
			if ( isset( $_POST[ "habilitado" ] ) ) 
				if( _post( "habilitado" ) == "ativo" ) 
					$habilitado = 1; 
			
			$p->padrao = $padrao;
			$p->habilitado = $habilitado;
			
			if( $p->padrao == 1 ){
				GatewayPagamento::limpaPadrao();
			}

			if( $p->atualizar() ){
				LogAdmin::_salvar( "Gateway Cadastrado", "Gateway" , $admin->id , "", json_encode( $p ) );
				addOnloadScript("message('Cadastrado com sucesso.','sucess');");
			} else {
				LogAdmin::_salvar( "Erro ao atualizar Gateway", "Gateway" , $admin->id , "", json_encode( $p ) );
				addOnloadScript("message('Ocorreu um erro ao atualizar.','error');");
			}



		}

	}
}

$page = new StdAdminPage();

$page->title = "Editar Gateway";
$page->page = "GatewayPagamento";
$page->back_link = true;
$page->title_back = "Gateways";

$page->form = true;

$page->form_fields = array(

	/* descrição */
	array( "value" => $p->codigo, "name" => "codigo", "label" => "C&oacute;digo" ),

	array( "value" => $p->ordem, "name" => "ordem", "label" => "Ordem", "type" => "num", "required" => true ),
	
	array( "value" => $p->habilitado, "name" => "habilitado", "label" => "Habilitado", "type" => "checkbox" ),
	array( "value" => $p->padrao, "name" => "padrao", "label" => "Padr&atilde;o", "type" => "checkbox" ),

	'--', 

	array( "value" => $p->email, "name" => "email", "label" => "E-mail" ),
	array( "value" => $p->token, "name" => "token", "label" => "Token" ),
	array( "value" => $p->pagina_redirecionamento, "name" => "pagina_redirecionamento", "label" => "P&aacute;gina redirecionar" )

);


$page->render();

?>