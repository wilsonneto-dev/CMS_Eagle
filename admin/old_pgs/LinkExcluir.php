<?php

// valida permissão
if( !in_array( "link", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$lbl_page = "Link";
$p = new Link();

if(isset($_GET["id"])){
	$p->id = $_GET["id"];
	$p->get();
	LogAdmin::_salvar( "Link Deletado", "Link" , $admin->id, json_encode( $p ), "" );
	if($p->deletar()){
		addOnloadScript("message('Excluido com sucesso.','sucess');");
		echo '<script type="text/javascript">document.location.href = "/admin/?pg='.$lbl_page.'";</script>';
	}else{
		addOnloadScript("message('Erro ao excluir.','error');");
		echo '<script type="text/javascript">document.location.href = "/admin/?pg='.$lbl_page.'"; </script>';
	}
} else {
	addOnloadScript("message('Erro ao excluir.','error');");
	echo '<script type="text/javascript">document.location.href = "/admin/?pg='.$lbl_page.'";</script>';
}

die();

?>