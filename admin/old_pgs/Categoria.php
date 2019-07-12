<?php 

// valida permissão
$verificar_permissao = "categorias";
if( !in_array( $verificar_permissao, $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$page = new StdAdminPage();
$page->permissao = $permissoes_admin[$verificar_permissao]; // permissão para a página: 0 => Leitura / 1 => escrita
$menu_destaque = "categorias";

$page->title = "Categorias";
$page->page = "Categoria";

$r = new Repeater();
$r->campos = "descricao;nome;id;ordem;listar;visivel";
$r->sql = "
	SELECT 
		titulo as nome, 
		descricao, 
		id,
		ordem,
		listar,
		visivel 
	FROM 
		categoria 
	WHERE 
		codprojeto = ".CODPROJETO." 
		and ativo = 1 
	order by 
		datacadastro DESC;";
$r->txtItem = "
	<tr>
		<td>#nome</td>
		<td>#descricao</td>
		<td>#listar</td>
		<td>#visivel</td>
		<td>#ordem</td>
		<td class=\"td-controls\">
			<a class=\"controle\" title=\"Editar\" href=\"/admin/?pg=" . $page->page . "Editar&id=#id\"><img src=\"/admin/img/edt.png\" /></a>
			<a class=\"controle\" title=\"Excluir\" onclick=\"return confirm('Excluir?');\" href=\"/admin/?pg=" . $page->page . "Excluir&id=#id\" style=\"display: ".( ( $page->permissao == "0" ) ? 'none':'inline-block' )."\" ><img src=\"/admin/img/del.png\" /></a>
		</td>
	</tr>
";
$r->exec();

$page->table = true;
$page->table_header = "<th>Nome</th><th>Descri&ccedil;&atilde;o</th><th>Listar</th><th>Visivel</th><th>Ordem</th>";
$page->table_content = $r->html;

$page->render();

?>
