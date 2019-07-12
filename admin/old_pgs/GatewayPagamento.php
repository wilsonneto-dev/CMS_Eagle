<?php 

// valida permissão
if( !in_array( "gateway", $permissoes_admin ) ){
	include("pgs/404.pg.php") ;
	return;
}

$menu_destaque = "gateway";

$page = new StdAdminPage();
$page->title = "gateways";
$page->page = "GatewayPagamento";


$r = new Repeater();
$r->campos = "padrao_classe;habilitado_classe;codigo;padrao;habilitado;id";
$r->sql = "
	SELECT 
		b.codigo,
		CASE WHEN b.padrao = 1 THEN 'Padrao' ELSE '' END AS padrao,
		CASE WHEN b.padrao = 1 THEN 'Ativo' ELSE 'Inativo' END AS padrao_classe,
		CASE WHEN b.habilitado = 1 THEN 'Habilitado' ELSE 'Inativo' END AS habilitado,
		CASE WHEN b.habilitado = 1 THEN 'Ativo' ELSE 'Inativo' END AS habilitado_classe,
		b.id 
	FROM 
		gateway_pagamento as b
	WHERE 
		b.codprojeto = ".CODPROJETO." 
		and b.ativo = 1 
	order by 
		ordem ASC;";
$r->txtItem = "
	<tr>
		<td>#codigo</td>
		<td class=\"#padrao_classe\">#padrao</td>
		<td class=\"#habilitado_classe\">#habilitado</td>
		<td class=\"td-controls\">
			<a class=\"controle\" title=\"Editar\" href=\"/admin/?pg=" . $page->page . "Editar&id=#id\"><img src=\"/admin/img/edt.png\" /></a>
			<a class=\"controle\" title=\"Excluir\" onclick=\"return confirm('Excluir?');\" href=\"/admin/?pg=" . $page->page . "Excluir&id=#id\"><img src=\"/admin/img/del.png\" /></a>
		</td>
	</tr>
";
$r->exec();

$page->table = true;
$page->table_header = "<th>Cod.</th><th>Padr&atilde;o</th><th>Status</th>";
$page->table_content = $r->html;

$page->render();

?>
