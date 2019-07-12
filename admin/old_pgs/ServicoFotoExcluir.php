<?php

// valida permissão
if( !in_array( "servico", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$lbl_page = "ServicoFoto";
$p = new ServicoFoto();

if(isset($_GET["id"])){
	$p->id = $_GET["id"];
	$p->get();
	if($p->deletar()){
		addOnloadScript("message('Excluido com sucesso.','sucess');");
		echo '<script type="text/javascript">document.location.href = "/admin/?pg='.$lbl_page.'&id='.$p->cod_servico.'";</script>';
		LogAdmin::_salvar( "Ingresso excluido", "Ingresso" , $admin->id , "", json_encode( $p ) );
	}else{
		addOnloadScript("message('Erro ao excluir.','error');");
		echo '<script type="text/javascript">document.location.href = "/admin/?pg='.$lbl_page.'&id='.$p->cod_servico.'";</script>';
		LogAdmin::_salvar( "Erro ao excluir ingresso", "Ingresso" , $admin->id , "", json_encode( $p ) );
	}
} else {
	addOnloadScript("message('Erro ao excluir.','error');");
	echo '<script type="text/javascript">document.location.href = "/admin/?pg='.$lbl_page.'";</script>';
}

die();

?>