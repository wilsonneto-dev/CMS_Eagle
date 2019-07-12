<?php

// valida permissão
$permissao_chave = "informacao";
if( !in_array( $permissao_chave, $permissoes_admin ) ){
	include("pgs/404.pg.php");
	return;
}

$menu_destaque = $permissao_chave;

$p = new Info();
$p->get();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$clone = clone $p;

	$p->telefone1 = _post( "telefone1" );
	$p->telefone2 = _post( "telefone2" );
	$p->telefone3 = _post( "telefone3" );

	$p->dominio = _post( "dominio" );
	$p->email = _post( "email" );
	$p->endereco = _post( "endereco" );

	$p->link_facebook = _post( "link_facebook" );
	$p->usuario_facebook = _post( "usuario_facebook" );
	$p->link_instagram = _post( "link_instagram" );
	$p->usuario_instagram = _post( "usuario_instagram" );

	$p->link_linkedin = _post( "link_linkedin" );
	$p->usuario_linkedin = _post( "usuario_linkedin" );

	$p->link_google = _post( "link_google" );
	$p->usuario_google = _post( "usuario_google" );

	$p->link_localizacao = _post( "link_localizacao" );
	$p->mapa_latitude = _post( "localizacao_latitude" );
	$p->mapa_longitude = _post( "localizacao_longitude" );

	$p->home_intro = _post( "home_intro" );

	$p->texto_contato = _post( "texto_contato" );

	$p->titulo_chamada = _post( "titulo_chamada" );
	$p->link_chamada = _post( "link_chamada" );
	$p->texto_botao_chamada = _post( "texto_botao_chamada" );
	$p->texto_chamada = _post( "texto_chamada" );

	$p->head_titulo = _post( "head_titulo" );	
	$p->head_descricao = _post( "head_descricao" );	
	$p->head_palavras_chave = _post( "head_palavras_chave" );

	$p->mensagem = _post( "mensagem" );	

	/* remover imagens */
	$remover_thumb_localizacao = 0;
	if ( isset( $_POST["remover_thumb_localizacao"] ) ) 
		if( $_POST["remover_thumb_localizacao"] == "ativo" ) 
			$p->thumb_localizacao = "";

	$remover_home_imagem = 0;
	if ( isset( $_POST["remover_home_imagem"] ) ) 
		if( $_POST["remover_home_imagem"] == "ativo" ) 
			$p->home_imagem = "";

	$remover_imagem_background = 0;
	if ( isset( $_POST["remover_imagem_background"] ) ) 
		if( $_POST["remover_imagem_background"] == "ativo" ) 
			$p->home_imagem_background = "";

	$remover_mensagem_icone = 0;
	if ( isset( $_POST["remover_mensagem_icone"] ) ) 
		if( $_POST["remover_mensagem_icone"] == "ativo" ) 
			$p->mensagem_icone = "";

	/* imagens */
	// home imagem
	if( isset( $_FILES["home_imagem"] )){
		if ( $_FILES["home_imagem"]["error"] == 0 ){
			$img_name = "home-". gerar_hash(6);
			$p->home_imagem = Upload::salvaArq( "home/" . $img_name, $_FILES["home_imagem"] );
		}		
	}

	// mensagem icone
	if( isset( $_FILES["mensagem_icone"] )){
		if ( $_FILES["mensagem_icone"]["error"] == 0 ){
			$img_name = "info-mensagem_icone-". gerar_hash(6);
			$p->mensagem_icone = Upload::salvaArq( "home/" . $img_name, $_FILES["mensagem_icone"] );
		}		
	}

	// background home
	if( isset( $_FILES["home_imagem_background"] )){
		if ( $_FILES["home_imagem_background"]["error"] == 0 ){
			$img_name = "home-". gerar_hash(6);
			$p->home_imagem_background = Upload::salvaArq( "home/" . $img_name, $_FILES["home_imagem_background"] );
		}
	}

	if( isset( $_FILES[ "thumb_localizacao" ] ) ){
		if ( $_FILES["thumb_localizacao"]["error"] == 0 ){
			$img_name = "home-location-". gerar_hash( 6 );
			$p->thumb_localizacao = Upload::salvaArq( "home/" . $img_name, $_FILES["thumb_localizacao"] );
		}
	}

	if( $permissoes_admin[$permissao_chave] == 1 ){
		if($p->atualizar()){
			LogAdmin::_salvar( "Editado", "Informacao" , $admin->id, json_encode( $clone ), json_encode( $p ) );
			addOnloadScript("message('Atualizado com sucesso.','sucess');");
		} else {
			LogAdmin::_salvar( "Erro ao editar", "Informacao" , $admin->id, json_encode( $clone ), json_encode( $p ) );
			addOnloadScript("message('Erro ao atualizar.','error');");
		}
	}else{
		addOnloadScript("message('Sem permissão para atualizar dados.','error');");
	}

}

$page = new StdAdminPage();

$page->title = "Informa&ccedil;&otilde;es Gerais";
$page->page = "Informacao";

$page->form = true;

$page->form_fields = array(


	/* headers */
	array( "value" => $p->head_titulo, "name" => "head_titulo", "label" => "T&iacute;tulo Padr&atilde;o"),
	array( "value" => $p->head_descricao, "name" => "head_descricao", "label" => "Descri&ccedil;&atilde;o Padrão" ),
	array( "value" => $p->head_palavras_chave, "name" => "head_palavras_chave", "label" => "Palavras-Chave Padrão"),
	array( "value" => $p->dominio, "name" => "dominio", "label" => "Dom&iacute;nio"),

	'--', // 'Contatos',
	
	/* contatos */
	array( "value" => $p->telefone1, "name" => "telefone2", "label" => "Telefone" ),
	// array( "value" => $p->telefone2, "name" => "telefone2", "label" => "Telefone" ),
	// array( "value" => $p->telefone3, "name" => "telefone3", "label" => "Telefone" ),
	array( "value" => $p->email, "name" => "email", "label" => "E-mail"),

	'--', // 'Redes Sociais',
	
	/* links das redes sociais */
	// face
	array( "value" => $p->link_facebook, "name" => "link_facebook", "label" => "Link facebook"),
	// array( "value" => $p->usuario_facebook, "name" => "usuario_facebook", "label" => "Usu&aacute;rio facebook"),
	
	// insta
	array( "value" => $p->link_instagram, "name" => "link_instagram", "label" => "Link instagram"),
	// array( "value" => $p->usuario_instagram, "name" => "usuario_instagram", "label" => "Usu&aacute;rio instagram"),
	
	// linkedin
	// array( "value" => $p->link_linkedin, "name" => "link_linkedin", "label" => "Link linkedin"),
	// array( "value" => $p->usuario_linkedin, "name" => "usuario_linkedin", "label" => "Usu&aacute;rio linkedin"),
	
	// twitter
	// array( "value" => $p->link_twitter, "name" => "link_twitter", "label" => "Link twitter"),
	array( "value" => $p->usuario_twitter, "name" => "usuario_twitter", "label" => "Usu&aacute;rio twitter"),
	
	// youtube
	// array( "value" => $p->link_youtube, "name" => "link_youtube", "label" => "Link youtube"),
	array( "value" => $p->usuario_youtube, "name" => "usuario_youtube", "label" => "Usu&aacute;rio youtube"),
	
	// google
	array( "value" => $p->link_google, "name" => "link_google", "label" => "Link google"),
	// array( "value" => $p->usuario_google, "name" => "usuario_google", "label" => "Usu&aacute;rio google"),
	
	'--',	

	/* endereço */
	array( "name" => "endereco", "type" => "textarea", "label" => "Endere&ccedil;o", "value" => $p->endereco ),

	/* link localização */
	// array( "value" => $p->link_localizacao, "name" => "link_localizacao", "label" => "Link da localização"),

	/* imagens rodapé ( localização ) */
	// array( "label" => "Imagem Localização (rodapé)", "type" => "image-view", "value" => ( "/" . $p->thumb_localizacao ) ),
	// array( "value" => "0", "name" => "remover_thumb_localizacao", "label" => "remover imagem", "type" => "checkbox", "cond" => $p->thumb_localizacao ),
	// array( "name" => "thumb_localizacao", "label" => "Imagem Localização (rodapé)", "type" => "file" ),
	
	// localização no mapa
	// array( "value" => ( $p->mapa_latitude.";".$p->mapa_longitude ), "name" => "localizacao", "label" => "Localiza&ccedil;&atilde;o", "type" => "location" ),

	// '--',
	/* textos */

	// texto da home
	// array( "name" => "home_intro", "type" => "textarea", "label" => "introdu&ccedil;&atilde;o na Home", "value" => $p->home_intro ),

	/* imagens */
	// array( "label" => "Imagem Home ( Foco )", "type" => "image-view", "value" => ( "/" . $p->home_imagem ) ),
	// array( "value" => "0", "name" => "remover_home_imagem", "label" => "remover imagem", "type" => "checkbox", "cond" => $p->home_imagem ),
	// array( "name" => "home_imagem", "label" => "Imagem Home ( Foco )", "type" => "file" ),

	
	/* imagens */
	// array( "label" => "Imagem Home Fundo", "type" => "image-view", "value" => ( "/" . $p->home_imagem_background ) ),
	// array( "value" => "0", "name" => "remover_imagem_background", "label" => "remover imagem", "type" => "checkbox", "cond" => $p->home_imagem_background ),
	// array( "name" => "home_imagem_background", "label" => "Imagem Home Fundo", "type" => "file" ),


	// array( "name" => "texto_contato", "type" => "textarea", "label" => "Texto da p&aacute;gina Contato",  "value" => $p->texto_contato ),

	// '--',
	/* chamada */

	// array( "value" => $p->titulo_chamada, "name" => "titulo_chamada", "label" => "T&iacute;tulo da Chamada"),
	// array( "value" => $p->texto_chamada, "name" => "texto_chamada", "label" => "Texto da Chamada"),
	// array( "value" => $p->texto_botao_chamada, "name" => "texto_botao_chamada", "label" => "Bot&atilde;o da Chamada"),
	// array( "value" => $p->link_chamada, "name" => "link_chamada", "label" => "Link da Chamada")

	'--', // 'Topo',
	/* mensagem no topo */

	array( "value" => $p->mensagem, "name" => "mensagem", "label" => "Mensagem"),
	
	array( "label" => "Icone", "type" => "image-view", "value" => ( "/" . $p->mensagem_icone ) ),
	array( "value" => "0", "name" => "remover_mensagem_icone", "label" => "remover imagem", "type" => "checkbox", "cond" => $p->mensagem_icone ),
	array( "name" => "mensagem_icone", "label" => "Icone", "type" => "file" ),


);


$page->render();

?>
