<?php

global $admin; 
global $permissoes_admin; 

$menu_destaque = "acomodacao";

// $p = Pagina::_get( "acomodacoes" );

$page = new StdAdminPage();
$page->title = "Acomoda&ccedil;&otilde;es";
$page->page = "Acomodacao";


if($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$clone = clone $p;

	$p->head_titulo = $_POST["head_titulo"];	
	$p->head_descricao = $_POST["head_descricao"];	
	$p->head_palavras_chave = $_POST["head_palavras_chave"];
	if($p->url == "") $p->url = "sobre";
		
	if ( $_FILES["imagem_topo"]["error"] == 0 ){
		$img_name = "topo-".$p->url."-". gerar_hash(6);
		$p->imagem_topo = Upload::salvaArq( "paginas/" . $img_name, $_FILES["imagem_topo"] );
	}


	$atualizou_header = false;
	if( $p->id == "" ){ // se ainda não tem cadastrado, cadastra
		$atualizou_header = $p->cadastrar();
	}else{ // se já há na base de dados, atualiza
		$atualizou_header = $p->atualizar();
	}

	if( $atualizou_header ){
		LogAdmin::_salvar( "Sobre Editado", "Sobre" , $admin->id, json_encode( $clone ) , json_encode( $p ) );
		addOnloadScript("message('Atualizado com sucesso.','sucess');");
	} else {
		LogAdmin::_salvar( "Erro ao editar sobre", "Sobre" , $admin->id, json_encode( $clone ) , json_encode( $p ) );
		addOnloadScript("message('Erro ao atualizar.','error');");
	}

}


$r = new Repeater();
$r->campos = "titulo;id";
$r->sql = "
	SELECT 
		b.titulo,
		b.id 
	FROM 
		acomodacao as b
	WHERE 
		b.codprojeto = ".CODPROJETO." 
		and b.ativo = 1 
	order by 
		titulo ASC;";
$r->txtItem = "
	<tr>
		<td>#titulo</td>
		<td class=\"td-controls\">
			<!-- a class=\"controle\" title=\"Fotos\" href=\"/admin/?pg=" . $page->page . "Foto&id=#id\"><img src=\"/admin/img/foto.png\" /></a -->
			<a class=\"controle\" title=\"Editar\" href=\"/admin/?pg=" . $page->page . "Editar&id=#id\"><img src=\"/admin/img/edt.png\" /></a>
			<a class=\"controle\" title=\"Excluir\" onclick=\"return confirm('Excluir?');\" href=\"/admin/?pg=" . $page->page . "Excluir&id=#id\"><img src=\"/admin/img/del.png\" /></a>
		</td>
	</tr>
";
$r->exec();

$page->table = true;
$page->table_header = "<th>T&iacute;tulo</th>";
$page->table_content = $r->html;

$page->render();

?>
