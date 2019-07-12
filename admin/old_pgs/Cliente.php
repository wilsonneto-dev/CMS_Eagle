<?php 

// valida permissão
if( !in_array( "cliente", $permissoes_admin ) ){
	include("pgs/404.pg.php") ;
	return;
}

$menu_destaque = "cliente";

$p = Pagina::_get( "cliente" );

$page = new StdAdminPage();
$page->title = "Clientes";
$page->page = "Cliente";

$r = new Repeater();
$r->campos = "titulo;id;sub_titulo";
$r->sql = "
	SELECT 
		b.titulo,
		b.sub_titulo,
		b.id 
	FROM 
		cliente as b
	WHERE 
		b.codprojeto = ".CODPROJETO." 
		and b.ativo = 1 
	order by 
		titulo ASC;";
$r->txtItem = "
	<tr>
		<td>#titulo</td>
		<td>#sub_titulo</td>
		<td class=\"td-controls\">
			<a class=\"controle\" title=\"Editar\" href=\"/admin/?pg=" . $page->page . "Editar&id=#id\"><img src=\"/admin/img/edt.png\" /></a>
			<a class=\"controle\" title=\"Excluir\" onclick=\"return confirm('Excluir?');\" href=\"/admin/?pg=" . $page->page . "Excluir&id=#id\"><img src=\"/admin/img/del.png\" /></a>
		</td>
	</tr>
";
$r->exec();

$page->table = true;
$page->table_header = "<th>Cliente</th><th>Sub Título</th>";
$page->table_content = $r->html;

$page->render();

?>
