<?php 

// valida permissão
if( !in_array( "postagem", $permissoes_admin ) ){
	include("pgs/404.pg.php") ;
	return;
}

$menu_destaque = "postagem";

$p = Pagina::_get( "blog" );

$page = new StdAdminPage();
$page->title = "Postagems";
$page->page = "Postagem";


if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$clone = clone $p;

	$p->head_titulo = $_POST["head_titulo"];	
	$p->head_descricao = $_POST["head_descricao"];	
	$p->head_palavras_chave = $_POST["head_palavras_chave"];
	if($p->url == "") $p->url = "blog";
		

	/*

	if ( $_FILES["imagem_topo"]["error"] == 0 ){
		$img_name = "topo-".$p->url."-". gerar_hash(6);
		$p->imagem_topo = Upload::salvaArq( "paginas/" . $img_name, $_FILES["imagem_topo"] );
	}

	*/


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
		postagem as b
	WHERE 
		b.codprojeto = ".CODPROJETO." 
		and b.ativo = 1 
	order by 
		titulo ASC;";
$r->txtItem = "
	<tr>
		<td>#titulo</td>
		<td class=\"td-controls\">
			<a class=\"controle\" title=\"Fotos\" href=\"/admin/?pg=" . $page->page . "Foto&id=#id\"><img src=\"/admin/img/foto.png\" /></a>
			<a class=\"controle\" title=\"Editar\" href=\"/admin/?pg=" . $page->page . "Editar&id=#id\"><img src=\"/admin/img/edt.png\" /></a>
			<a class=\"controle\" title=\"Excluir\" onclick=\"return confirm('Excluir?');\" href=\"/admin/?pg=" . $page->page . "Excluir&id=#id\"><img src=\"/admin/img/del.png\" /></a>
		</td>
	</tr>
";
$r->exec();

$page->table = true;
$page->table_header = "<th>Postagem</th>";
$page->table_content = $r->html;


$page->form = true;

$page->form_fields = array(

	"Configurações internas da página \"$page->title\"",
	
	/* headers */
	array( "value" => $p->head_titulo, "name" => "head_titulo", "label" => "T&iacute;tulo"),
	array( "value" => $p->head_descricao, "name" => "head_descricao", "label" => "Descri&ccedil;&atilde;o" ),
	array( "value" => $p->head_palavras_chave, "name" => "head_palavras_chave", "label" => "Palavras-Chave")
	
	/* imagens */
	/* array( "label" => "Imagem Topo Atual", "type" => "image-view", "value" => ( "/" . $p->imagem_topo ) ),
	array( "name" => "imagem_topo", "label" => "Imagem Topo ( Opcional )", "type" => "file" ), */


);

$page->render();

?>
