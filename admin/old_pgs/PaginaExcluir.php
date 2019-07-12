<?php

// valida permissão
if( !in_array( "pagina", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$lbl_page = "Pagina";
$p = new Pagina();

if(isset($_GET["id"])){
	$p->id = $_GET["id"];
	$p->get();
	LogAdmin::_salvar( "Pagina Deletado", "Pagina" , $admin->id, json_encode( $p ), "" );
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