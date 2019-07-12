<?php 

// valida permissão
if( !in_array( "link", $permissoes_admin ) ){
	include("pgs/404.pg.php") ;
	return;
}

$menu_destaque = "link";

$page = new StdAdminPage();
$page->title = "Links";
$page->page = "Link";

$r = new Repeater();
$r->campos = "descricao;link;id";
$r->sql = "
	SELECT 
		b.descricao,
		b.link,
		b.id 
	FROM 
		link as b
	WHERE 
		b.codprojeto = ".CODPROJETO." 
		and b.ativo = 1 
	order by 
		descricao ASC;";
$r->txtItem = "
	<tr>
		<td>#descricao</td>
		<td>#link</td>
		<td class=\"td-controls\">
			<a class=\"controle\" title=\"Editar\" href=\"/admin/?pg=" . $page->page . "Editar&id=#id\"><img src=\"/admin/img/edt.png\" /></a>
			<a class=\"controle\" title=\"Excluir\" onclick=\"return confirm('Excluir?');\" href=\"/admin/?pg=" . $page->page . "Excluir&id=#id\"><img src=\"/admin/img/del.png\" /></a>
		</td>
	</tr>
";
$r->exec();

$page->table = true;
$page->table_header = "<th>Descri&ccedil;&atilde;o</th><th>Link</th>";
$page->table_content = $r->html;

$page->render();

?>
