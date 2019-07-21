<?php

class GeneralHelper
{

	#FUNÇÕES GERAIS
		
	#protege contra sql injection substituindo ' por ''
	public static function anti_sqli($s){ return str_replace("'","''",$s); }
		
	#limpa a string para apresentar nos inputs do painel
	public static function bd_limpa($s){ return stripcslashes(htmlspecialchars($s)); }
		
	#tira as \
	public static function bd_limpa_barra($s){ return stripcslashes($s); }

	#tira as \
	public static function _post( $s, $substituto = "" ){ return ( isset( $_POST[ $s ] ) ? $_POST[ $s ] : $substituto ); }
	public static function _get( $s, $substituto = "" ){ return ( isset( $_GET[ $s ] ) ? $_GET[ $s ] : $substituto ); }

	// função que pega a URL da página atual
	public static function pg(){ return ( $_SERVER["REQUEST_URI"] ); }

	// direto do bd para a tela
	public static function _echo($str){ echo str_replace("\n", "",  nl2br(htmlspecialchars($str)) ); }

	public static function intag($str){ return str_replace("\"", "dsfdsf", $str); }
	public static function _echo_intag($str){ echo intag($str); }
		
	// função de log
	public static function _log( $str, $tipo = "log", $arq  = "relatorio" ){
		$f = fopen($arq.".".$tipo, "a+");
		$data = date("d/m/Y H.i.s");
		$info = $_SERVER['REMOTE_ADDR'].":".$_SERVER['REQUEST_URI'].":".$_SERVER['REQUEST_METHOD'] ;
		fwrite($f, $data." : ".$info." : [".$tipo."] ".$str."\n");
		fclose($f);
	}

	public static function erro_bd( $exption , $conexao_erro ){
		$errMsg = "exceção: ". $exption->getMessage()."\n<br />error: ".
			$conexao_erro ."\n<br />data:". time().
			"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
		_log($errMsg);
		// quando ocorre erro na base de dados
	}
		
	public static function addOnloadScript($script){
		if(isset($_SESSION["OnloadScript"])) 
			$_SESSION["OnloadScript"] .= $script;
		else	
			$_SESSION["OnloadScript"] = $script;
	}

	public static function getOnloadScript($append_script){
		if(isset( $_SESSION["OnloadScript"] )){
			$script = $_SESSION["OnloadScript"];
			if( $append_script == true)
				$script = '<script> $(document).ready(function(){ ' . $script . ' }); </script>';
			unset( $_SESSION["OnloadScript"] );
			return ( $script );
		}
	}

	public static function gerar_hash( $length = 23 ){
		$today = microtime(true);
		$out = substr(hash('md5', $today), 0, $length);
		return $out;
	}

	public static function data( $string ){
		$d = new DateTime();
		$dia = substr ( $string , 0 , 2 );
		$mes = substr ( $string , 3 , 2 );
		$ano = substr ( $string , 6, 4 );
		// echo ( "$dia / $mes / $ano" );
		$d->setDate ( $ano , $mes , $dia );
		$d->setTime ( 0 , 0 , 0 );
		// echo $d->format('d/m/Y');
		// strtotime( str_replace( "/" , "-", $_POST["data_sair"] ) ) )
		return $d;
	}


}

?>