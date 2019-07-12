<?php 

// valida permissão
if( !in_array( "pagina", $permissoes_admin ) ){
	include("pgs/404.pg.php") ;
	return;
}

$menu_destaque = "pagina";

$page = new StdAdminPage();
$page->title = "P&aacute;ginas";
$page->page = "Pagina";


$r = new Repeater();
$r->campos = "url;head_titulo;id";
$r->sql = "
	SELECT 
		b.url,
		b.head_titulo,
		b.id 
	FROM 
		pagina as b
	WHERE 
		b.codprojeto = ".CODPROJETO." 
		and b.ativo = 1 
		and b.listagem = 1 
	order by 
		url ASC;";
$r->txtItem = "
	<tr>
		<td>#url</td>
		<td>#head_titulo</td>
		<td class=\"td-controls\">
			<a class=\"controle\" title=\"Editar\" href=\"/admin/?pg=" . $page->page . "Editar&id=#id\"><img src=\"/admin/img/edt.png\" /></a>
			<a class=\"controle\" title=\"Excluir\" onclick=\"return confirm('Excluir?');\" href=\"/admin/?pg=" . $page->page . "Excluir&id=#id\"><img src=\"/admin/img/del.png\" /></a>
		</td>
	</tr>
";
$r->exec();

$page->table = true;
$page->table_header = "<th>Url</th><th>T&iacute;tulo</th>";
$page->table_content = $r->html;


$page->render();

?>
