<?php 

// valida permissão
if( !in_array( "projeto", $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$p = new Projeto();
$menu_destaque = "projeto";

// verifica se passou o id
if( !isset( $_GET["id"] ) ) {
	include("pgs/404.pg.php") ;
	return;
}

// verifica se o evento existe de fato
$p->id = $_GET["id"];
if(!$p->get()){
	include("pgs/404.pg.php") ;
	return;
}

// ProjetoFoto::_atualizar_ordem( 13, 10 );

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

	if( isset( $_POST["action"] ) ){
		
		if($_POST["action"] == "save_list_command" ){

			/* salvar a ordem */
			if($_POST["order"] != ""){
				$arr_ordem = explode("&", $_POST["order"]);
				$indice_ordem = 0;
				while ($indice_ordem < count($arr_ordem) ) {
					$id = str_replace("i=", "", $arr_ordem[$indice_ordem] );
					// echo( $id.":".$indice_ordem . "-- " );
					ProjetoFoto::_atualizar_ordem( $id, ( $indice_ordem + 1 ) );

					$indice_ordem++;
				}				
			}

			// salvar as alterações
			$quantidade_total = count( $_POST["id"] );
			$indice = 0;
			$cont_ok = 0;

			while ( $indice < $quantidade_total ){

				ProjetoFoto::_atualizar_descricao(
					intval( $_POST["id"][$indice] ),
					$_POST["descricao"][$indice]
				);
				$cont_ok++;
				$indice++;
			}

			addOnloadScript("message('$cont_ok de $quantidade_total alterações efetuadas com sucesso.','sucess');");
			LogAdmin::_salvar( "Fotos da foto projeto atualizadas", "FotoProjeto" , $admin->id, "", "" );

		}
	
	}else{

		$contador = 0;
		$total = count($_FILES["imagem"]["name"] );
		$cont_ok = 0;
		while( $contador < count($_FILES["imagem"]["name"] ) ){

			$foto = new ProjetoFoto();
			$foto->cod_projeto = $_GET["id"];
			if ( $_FILES["imagem"]["error"][$contador] == 0 ){
				$img_name = $p->id_url ."-". gerar_hash(12);
				$foto->imagem = Upload::salvaArqs( "projetos/" . $img_name, $_FILES["imagem"], $contador );
				$foto->imagem_thumb = Imagem::MiniaturaProporcional( "../".$foto->imagem, SERVICO_GALERIA_HEIGHT, SERVICO_GALERIA_WIDTH );
			}
			$foto->descricao = $_POST["descricao"];
			$foto->ordem = 0;
			if ( $foto->cadastrar() ){
				LogAdmin::_salvar( "Foto projeto cadastrada", "FotoProjeto" , $admin->id, "", json_encode( $foto ) );
				$cont_ok++;
			} else {
				LogAdmin::_salvar( "Erro ao editar banner topo", "FotoProjeto" , $admin->id, "", json_encode( $foto ) );
			}

			++$contador;
		}

		if( $cont_ok > 0 ){
			addOnloadScript("message('$cont_ok de $total fotos salvas com sucesso.','sucess');");
		} else {
			addOnloadScript("message('Houve um erro ao cadastrar...','error');");
		}

	}


}

$page = new StdAdminPage();
$page->title = "Fotos: " . $p->titulo;
$page->page = "Projeto";
$page->cadastrar_parametro = "evento=".$p->id;

$page->html_content = StdGalleryManager::make(
	"SELECT 
		id, 
		descricao as texto, 
		cod_projeto as cod_referencia, imagem_thumb as imagem, 
		ordem FROM projeto_foto WHERE ativo = 1 and cod_projeto = '".str_replace( "'", "", intval( $p->id ) )."' order by ordem asc;",
	"Projeto"
);

/*
$page->table = true;
$page->table_header = "<th>Foto</th><th>Descri&ccedil;&atilde;o</th><th>Ordem</th>";
$page->table_content = $r->html;
*/


$page->cadastrar = false;

$page->form = true;
$page->form_fields = array(
	array( "name" => "imagem[]", "label" => "Imagem", "type" => "file",  "multiple" => "multiple" ),
	array( "name" => "descricao", "label" => "Descri&ccedil;&atilde;o" )
);

$page->sessions_order = array( "form", "table", "html_content" );

$page->back_link = true;
$page->title_back = "Servi&ccedil;os";

$page->render();

?>
