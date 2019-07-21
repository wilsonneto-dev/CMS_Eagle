<?php

class Parametro{

	public $id;
	public $nome;
	public $descricao;
	public $identificacao;
	public $valor;
	private $bd;
	
	public function Parametro()
	{
		$this->id = '';
		$this->descricao = '';
		$this->nome = "";
		$this->identificacao = "";
		$this->valor = "";
		$this->bd = new ParametroDAO();
	}
	
	public function getByIdentificacao(){
		return $this->bd->getByIdentificacao($this);
	}
	
	public function getValorByIdentificacao(){
		return $this->bd->getValorByIdentificacao($this);
	}

	public function getLista(){
		return $this->bd->getLista($this);
	}

	public function atualizar(){
		return $this->bd->atualizar($this);
	}

	// estáticos 
	public static function _getByIdentificacao( $p_id ){
		$obj = new Parametro();
		$obj->identificacao = $p_id;
		if ( $obj->getByIdentificacao() ) 
			return $obj;
		else 
			return null;
	}

	public static function _getValorByIdentificacao( $p_id ){
		$obj = new Parametro();
		$obj->identificacao = $p_id;
		return ( $obj->getValorByIdentificacao() );
	}

	public static function _getLista(  ){
		$obj = new Parametro();
		return $obj->getLista();
	}
	
	public static function _getArray(  ){
		return ( new ParametroDAO() )->getArray();
	}

}

class ParametroDAO extends BaseDAO{

	public function getByIdentificacao($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						id, 
						nome, 
						descricao, 
						identificacao, 
						valor 
					FROM 
						parametro 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ." 
						AND identificacao = '" . $this->con->real_escape_string( $p->identificacao ) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->id = $obj->id;
						$p->nome = $obj->nome;
						$p->descricao = $obj->descricao;
						$p->identificacao = $obj->identificacao;
						$p->valor = $obj->valor;
						return true;
					}
					else return false;	
				}
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao ao banco");	
		} catch (Exception $e) {
			erro_bd( $e, $this->con->error );
			return false;
		}
	}

	public function getValorByIdentificacao($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						valor 
					FROM 
						parametro 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ." 
						AND identificacao = '" . $this->con->real_escape_string( $p->identificacao ) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						return $obj->valor;						
					}
					else return "";	
				}
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao ao banco");	
		} catch (Exception $e) {
			erro_bd( $e, $this->con->error );
			return false;
		}
	}

	public function getLista(){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						id, 
						nome, 
						descricao, 
						identificacao, 
						valor, 
						ordem 
					FROM 
						parametro 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ." 
					ORDER BY 
						ordem ASC;";					
				if($q = $this->con->query($str_q)){
					$lista = array();
					if( $q->num_rows > 0)
					{
						while( ( $obj = $q->fetch_object() ) != false )
						{
							$p = new Parametro();
							$p->id = $obj->id;
							$p->nome = $obj->nome;
							$p->descricao = $obj->descricao;
							$p->identificacao = $obj->identificacao;
							$p->valor = $obj->valor;
							$lista[] = $p;
						}
					}
					return $lista;	
				} else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao ao banco");	
		} catch (Exception $e) {
			erro_bd( $e, $this->con->error );
			return false;
		}
	}

	public function getArray(){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						identificacao, 
						valor 
					FROM 
						parametro 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ." 
					ORDER BY 
						ordem ASC;";					
				if($q = $this->con->query($str_q)){
					$lista = array();
					if( $q->num_rows > 0)
						while( ( $obj = $q->fetch_object() ) != false )
							$lista[ $obj->identificacao ] = $obj->valor;
					return $lista;	
				} else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao ao banco");	
		} catch (Exception $e) {
			erro_bd( $e, $this->con->error );
			return false;
		}
	}

	public function atualizar($p){
		try {
			if($this->abreConexao()){
				$str_q = 
					"UPDATE 
						parametro
					SET 
						valor = '". $this->con->real_escape_string($p->valor) ."'
					WHERE 
						identificacao = '".$this->con->real_escape_string($p->identificacao)."' 
						AND ativo = 1
						AND codprojeto = ".$this->codProjeto.";";
				if($q = $this->con->query($str_q))
					return true;
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao");	
		} catch (Exception $e) {
			erro_bd( $e, $this->con->error );
			return false;
		}
	}	
	
}

?>