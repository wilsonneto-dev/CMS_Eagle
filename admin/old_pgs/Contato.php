<?php 

// valida permissão
if( !in_array( "contato", $permissoes_admin ) ){
	include("pgs/404.pg.php") ;
	return;
}

$menu_destaque = "contato";

$page = new StdAdminPage();
$page->title = "Contatos";
$page->page = "Contato";


$r = new Repeater();
$r->campos = "email;id;nome;data";
$r->sql = "
	SELECT 
		b.nome,
		b.email,
		b.id,
		DATE_FORMAT( datacadastro,'%d/%m/%Y') as data 
	FROM 
		contato as b
	WHERE 
		b.codprojeto = ".CODPROJETO." 
		and b.ativo = 1 
	order by 
		nome ASC;";
$r->txtItem = "
	<tr>
		<td>#nome</td>
		<td>#email</td>
		<td>#data</td>
		<td class=\"td-controls\">
			<a class=\"controle\" title=\"Editar\" href=\"/admin/?pg=" . $page->page . "Editar&id=#id\"><img src=\"/admin/img/edt.png\" /></a>
			<a class=\"controle\" title=\"Excluir\" onclick=\"return confirm('Excluir?');\" href=\"/admin/?pg=" . $page->page . "Excluir&id=#id\"><img src=\"/admin/img/del.png\" /></a>
		</td>
	</tr>
";
$r->exec();

$page->table = true;
$page->cadastrar = false;

$page->table_header = "<th>Nome</th><th>E-mail</th><th>Data</th>";
$page->table_content = $r->html;


$page->render();

?>
