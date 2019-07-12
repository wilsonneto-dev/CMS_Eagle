<?php

class WebService {

	private $entidade = "";
	private $acao = "";

	private $params = [];
	private $acoes = [];

	private $funcao_apos = null;
	private $ha_funcao_apos = false;

	function __construct(){

	}

	private function processa_rota()
	{

		$this->params = ( isset( $_GET[ "token" ] ) ? $_GET : $_POST );

		// pegar as varaveis da url
		if ( isset( $_GET["entidade"] ) ) {
			$this->entidade = ($_GET["entidade"]);
			$this->entidade = str_replace("/", "", $this->entidade);
			$this->entidade = str_replace("\\", "", $this->entidade);
			$this->entidade = str_replace(".", "", $this->entidade);
			if ( file_exists("api/".$this->entidade.".api.php") ){
				include("api/".$this->entidade.".api.php");
			} else if ( file_exists( "api/404.api.php" ) ){
				include("api/404.api.php");
			}
		} else if( file_exists( "api/default.api.php" ) ){
			include( "api/default.api.php" );
		}

		if(isset($_GET["acao"])){
			$this->acao = ($_GET["acao"]);
			$this->acao = str_replace("/", "", $this->acao);
			$this->acao = str_replace("\\", "", $this->acao);
			$this->acao = str_replace(".", "", $this->acao);
		}


	}

	public function get_param($str){
		if(isset($_GET[$str]))
		{
			return $_GET[$str];
		}else if(isset($_POST[$str]))
		{
			return $_POST[$str];
		}{
			return null;
		}
	}
	
	function executar(){
		$this->processa_rota();
		
		if( array_key_exists( $this->acao , $this->acoes ) ){
			$this->resposta( $this->acoes[$this->acao]() );
		}else{
			$this->bad_request( "ação inválida." );
		}

		if($this->ha_funcao_apos)
		{
			$this->encerrar_requisicao();
			$func = $this->funcao_apos;
			$func($this);
		}
	}

	private function encerrar_requisicao(){
		@ob_end_flush();
	    @ob_flush();
	    @flush();
	}

	function set_funcao_apos( $func ){
		$this->ha_funcao_apos = true;
		$this->funcao_apos = $func;
	}

	function registrar_acoes( $arr_acoes_novas ){
		$this->acoes = array_merge( $this->acoes, $arr_acoes_novas );
	}

	function bad_request( $msg ){
		$this->resposta( [ "ha_erro"=> 1, "mensagem" => htmlentities( $msg ) ] );
	}

	function resposta( $obj ){
		$formato = "json";
		if( array_key_exists( "formato", $this->params ) ){
			$formato = strtolower( $this->params["formato"] );
		}

		switch ( $formato ) {
			case 'json':
				echo json_encode( $obj, JSON_PRETTY_PRINT );
				break;
			default:
				echo json_encode( $obj );
				break;
		}
	}

}  

?>