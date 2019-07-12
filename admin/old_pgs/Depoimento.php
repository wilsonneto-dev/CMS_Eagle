<?php 

// valida permissão
if( !in_array( "depoimento", $permissoes_admin ) ){
	include("pgs/404.pg.php") ;
	return;
}

$menu_destaque = "depoimento";

$page = new StdAdminPage();
$page->title = "Depoimentos";
$page->page = "Depoimento";


$r = new Repeater();
$r->campos = "titulo;id;nome";
$r->sql = "
	SELECT 
		b.nome,
		b.titulo,
		b.id 
	FROM 
		depoimento as b
	WHERE 
		b.codprojeto = ".CODPROJETO." 
		and b.ativo = 1 
	order by 
		nome ASC;";
$r->txtItem = "
	<tr>
		<td>#nome</td>
		<td>#titulo</td>
		<td class=\"td-controls\">
			<a class=\"controle\" title=\"Editar\" href=\"/admin/?pg=" . $page->page . "Editar&id=#id\"><img src=\"/admin/img/edt.png\" /></a>
			<a class=\"controle\" title=\"Excluir\" onclick=\"return confirm('Excluir?');\" href=\"/admin/?pg=" . $page->page . "Excluir&id=#id\"><img src=\"/admin/img/del.png\" /></a>
		</td>
	</tr>
";
$r->exec();

$page->table = true;
$page->table_header = "<th>Nome</th><th>T&iacute;tulo</th>";
$page->table_content = $r->html;


$page->render();

?>
