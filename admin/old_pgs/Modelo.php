<?php 

// valida permissão
if( !in_array( "modelo", $permissoes_admin ) ){
	include("pgs/404.pg.php") ;
	return;
}

$menu_destaque = "modelo";

$page = new StdAdminPage();
$page->title = "Modelos";
$page->page = "Modelo";

$r = new Repeater();
$r->campos = "descricao;url;id";
$r->sql = "
	SELECT 
		b.descricao,
		b.url,
		b.id 
	FROM 
		modelo as b
	WHERE 
		b.codprojeto = ".CODPROJETO." 
		and b.ativo = 1 
	order by 
		descricao ASC;";
$r->txtItem = "
	<tr>
		<td>#descricao</td>
		<td><a href=\"../#url\" target=\"_blank\">baixar</a></td>
		<td class=\"td-controls\">
			<a class=\"controle\" title=\"Editar\" href=\"/admin/?pg=" . $page->page . "Editar&id=#id\"><img src=\"/admin/img/edt.png\" /></a>
			<a class=\"controle\" title=\"Excluir\" onclick=\"return confirm('Excluir?');\" href=\"/admin/?pg=" . $page->page . "Excluir&id=#id\"><img src=\"/admin/img/del.png\" /></a>
		</td>
	</tr>
";
$r->exec();

$page->table = true;
$page->table_header = "<th>Descri&ccedil;&atilde;o</th><th>Baixar</th>";
$page->table_content = $r->html;

$page->render();

?>
