<?php

$this->msg_contato = "";
$this->erro = 1;


$this->set_title( "Contato", true );
$this->set_description( $this->infos->texto_contato );

/*variáveis para manter o estado dos inputs*/
$this->_nome = "";
$this->_email = "";
$this->_telefone = "";
$this->_assunto = "";
$this->_mensagem = "";

$this->add_header_script("map/main.js");
$this->add_header_script("http://maps.googleapis.com/maps/api/js?key=AIzaSyD5omzifASkKQXB-fsiNYpYRVanpV7kyi0&sensor=false");

if( $_SERVER["REQUEST_METHOD"] == "POST" ){

	extract($_POST);
	if( isset( $nome, $email, $mensagem, $assunto ) ){
		$this->_nome = $nome;
		$this->_telefone = isset($telefone) ? $telefone : "";
		$this->_email = $email;
		$this->_assunto = $assunto;
		$this->_mensagem = $mensagem;
		
		if( ! filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->msg_contato = "Email inserido inv&aacute;lido ";
		}
		else if( trim( $nome ) == "" || trim( $email ) == "" || trim( $mensagem ) == "" || trim( $assunto ) == "" ){
			$this->msg_contato = utf8_encode( "Preencha todos os campos marcados com * por favor..." );
		}else{

			// salvar
			/* $c = new Contato();
			$c->nome = $this->_nome;
			$c->email = $this->_email;
			$c->tipo = "Contato";
			$c->assunto = $this->_assunto;
			$c->telefone = $this->_telefone;
			$c->mensagem = $this->_mensagem;
			$c->cadastrar(); */


			if(Email::enviaContato(
				$nome,
				$email,
					"<b>Nome:</b> ".$this->_nome."<br />".
					"<b>E-mail:</b> ".$this->_email."<br />".
					"<b>Telefone:</b> ".$this->_telefone."<br />".
					"<b>Assunto:</b> ".$this->_assunto."<br />".
					"<b>Mensagem:</b><br />".htmlspecialchars($this->_mensagem)
			)) {
				$this->msg_contato = 'Mensagem enviada com sucesso. Obrigado, retornaremos o contato o mais breve possível!';
				$this->erro = 0;

				// apagar o campo
				$this->_nome = "";
				$this->_email = "";
				$this->_mensagem = "";
				$this->_assunto = "";
				$this->_telefone = "";
			
			} else {
				$this->msg_contato = 'Desculpe, ocorreu um erro ao enviar a mensagem ';
			}
		}
	}else{
		$this->msg_contato = utf8_encode('Preencha todos os campos marcados com * por favor...');
	}
}

if( $this->msg_contato != "" ){
	$this->msg_popup = $this->msg_contato;
	// $footer_extra_scripts .= "<script> $(document).ready( function(){ alert($(\".msg\").text()); } ); </script>";	
}

?>