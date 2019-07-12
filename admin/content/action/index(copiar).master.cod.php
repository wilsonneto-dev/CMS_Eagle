<?php

$this->infos = Info::_get();

$this->set_title("BF Contábil");
$this->set_description( 
	$this->infos->telefone2.
	( ( $this->infos->telefone2 != "" ) ? ( " - ".$this->infos->telefone2 ) : "" ).
	".".
	"Somos uma empresa de serviços de contabilidade constituída por profissionais com larga experiência nas áreas de gestão empresarial."
);
$this->set_keywords("BF Contábil, Escritório de Contabilidade, Contabilidade, Inovação, São José do Rio Preto");
$this->set_author("Wilson Neto");

$this->links = new Repeater();
$this->links->campos = "descricao;link";
$this->links->sql = "
	SELECT 
		link, 
		descricao
	FROM 
		link
	WHERE 
		codprojeto = ".CODPROJETO." 
		AND ativo = 1 
	ORDER BY 
	descricao ASC";
$this->links->txtVazio = "";
$this->links->txtItem = '<li><a href="#link" title="#intag_descricao" target="_blank">#descricao</a></li>'."\n";
$this->links->exec();

$this->modelos = new Repeater();
$this->modelos->campos = "descricao;url";
$this->modelos->sql = "
	SELECT 
		url, 
		descricao
	FROM 
		modelo
	WHERE 
		codprojeto = ".CODPROJETO." 
		AND ativo = 1 
	ORDER BY 
	descricao ASC";
$this->modelos->txtVazio = "";
$this->modelos->txtItem = '<li><a href="#url" title="#intag_descricao" target="_blank">#descricao</a></li>'."\n";
$this->modelos->exec();

$this->add_header_script("main/main-v1.0.0.min.js");

$this->n = new Newsletter();
$this->msg_popup = "";
$this->popup = false;

if( ( !isset($_SESSION["popup_showed"]) ) && ( $this->infos->popup == "1" ) ){
	$this->popup = true;
	$_SESSION["popup_showed"] = true;
}

try{
	if( $_SERVER["REQUEST_METHOD"] == "POST" ){

	    if( isset( $_POST["action"] ) ){

	    	if( $_POST["action"] == "newsletter-form" && isset( $_POST["nome"], $_POST["email"] ) ){
		        $this->n->nome = $_POST["nome"];
		        $this->n->email = $_POST["email"];
		        $this->n->telefone = $_POST["telefone"];

	        	if( ! filter_var($this->n->email, FILTER_VALIDATE_EMAIL)){
		            $this->msg_popup = "Email inserido inválido";
		        	throw new Exception($this->msg_popup, 1);		        	
		        }
		        	
	        	if( !$this->n->getByEmail() ){
	                if( $this->n->cadastrar() ){
	                    $erro = 0;
	                    $this->msg_popup = ( "Obrigado por se cadastrar. Em breve entraremos em contato" );
	                }
	                else{
	                    $this->msg_popup = ( "Ocorreu um erro ao tentar cadastrar ".$this->n->email."." );
	                }
	            }else{
	                $this->msg_popup = ( "O email \"".$this->n->email."\" já consta em nossa base de dados" );
	            }  

	    	}

		}
	}	
} catch( Exception $ex ){  }

?>