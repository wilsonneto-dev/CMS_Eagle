<?php

class AcomodacaoFoto{

	public $id;
	public $imagem;
	public $descricao;
	public $imagem_thumb;
	public $cod_acomodacao;
	public $ordem;
	
	private $bd;
	
	public function __construct(){
		$this->id = "";
		$this->imagem = "";
		$this->descricao = "";
		$this->imagem_thumb = "";
		$this->cod_acomodacao = "";
		$this->ordem = "";
		$this->bd = new AcomodacaoFotoDAO();
	}
	
	//CRUD
	public function cadastrar(){
		return $this->bd->cadastrar($this);
	}
	public function get(){
		return $this->bd->get($this);
	}
	public function atualizar(){
		return $this->bd->atualizar($this);
	}

	public function atualizar_ordem(){
		return $this->bd->atualizar_ordem($this);
	}
	public static function _atualizar_ordem( $p_id, $p_ordem ){
		$foto = new AcomodacaoFoto();
		$foto->ordem = $p_ordem;
		$foto->id = $p_id;
		$foto->atualizar_ordem();
	}
	

	public function atualizar_descricao(){
		return $this->bd->atualizar_descricao($this);
	}
	public static function _atualizar_descricao( $p_id, $p_descricao ){
		$foto = new AcomodacaoFoto();
		$foto->descricao = $p_descricao;
		$foto->id = $p_id;
		$foto->atualizar_descricao();
	}
	
	public function deletar(){
		return $this->bd->deletar($this);
	}
	// FIM CRUD	

	// estáticos
	public static function _get( $p_id ){
		$obj = new AcomodacaoFoto();
		$obj->id = $p_id;
		if ( $obj->get() ) return $obj;
		else return null;
	}
	
	public static function _deletar( $p_id ){
		$obj = new AcomodacaoFoto();
		$obj->id = $p_id;
		if ( $obj->deletar() ) return true;
		else return false;
	}

}

class AcomodacaoFotoDAO extends BaseDAO {
	
	//CRUD
	public function cadastrar( AcomodacaoFoto $obj ){
		try {
			if( $this->abreConexao() ){
				$str_q = "
					INSERT INTO 
						acomodacao_foto( 
							imagem,
							descricao,
							imagem_thumb,
							cod_acomodacao,
							codprojeto
						)VALUES(
							'". $this->con->real_escape_string( $obj->imagem ) ."'
							, '". $this->con->real_escape_string( $obj->descricao ) ."'
							,'". $this->con->real_escape_string( $obj->imagem_thumb ) ."'
							,'". $this->con->real_escape_string( $obj->cod_acomodacao ) ."'
							, ". $this->codProjeto.
						");";
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

	public function get( $obj ){
		try {
			if($this->abreConexao()){
				$str_q = 
				" SELECT 
				 	id, 
					imagem, 
					descricao,
					imagem_thumb,
					cod_acomodacao,
					ordem
				FROM 
					acomodacao_foto
				WHERE 
					ativo = 1 
					AND codprojeto in ( ".$this->codProjeto." ) 
					AND id = '" . $this->con->real_escape_string( $obj->id ) . "';";					
				if( $q = $this->con->query( $str_q ) )
				{
					if( !$q->num_rows == 0 ){
						$reg = $q->fetch_object();
						$obj->id = $reg->id;
						$obj->imagem = $reg->imagem;
						$obj->descricao = $reg->descricao;
						$obj->imagem_thumb = $reg->imagem_thumb;
						$obj->cod_acomodacao = $reg->cod_acomodacao;
						$obj->ordem = $reg->ordem;
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

	public function atualizar( $obj ){
		try {
			if($this->abreConexao()){
				$str_q = "
					UPDATE 
						acomodacao_foto
					SET 
						imagem = '". $this->con->real_escape_string($obj->imagem) ."'
						, descricao = '". $this->con->real_escape_string( $obj->descricao ) ."'
						, imagem_thumb = '". $this->con->real_escape_string($obj->imagem_thumb) ."'
						, cod_acomodacao = '". $this->con->real_escape_string( $obj->cod_acomodacao ) ."'
						, ordem = '". $this->con->real_escape_string( $obj->ordem ) ."'
					WHERE 
						id = '".$this->con->real_escape_string( $obj->id )."'
						AND ativo = 1
						AND codprojeto = " . $this->codProjeto . ";";
				if($q = $this->con->query($str_q))
					return true;
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao");	
		} catch (Exception $e) {
			erro_bd( $exception, $this->con->error );
			return false;
		}
	}

	public function atualizar_ordem( $obj ){
		try {
			if($this->abreConexao()){
				$str_q = "
					UPDATE 
						acomodacao_foto
					SET 
						ordem = '". $this->con->real_escape_string( $obj->ordem ) ."'
					WHERE 
						id = '".$this->con->real_escape_string( $obj->id )."'
						AND ativo = 1
						AND codprojeto = " . $this->codProjeto . ";";
				if($q = $this->con->query($str_q))
					return true;
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao");	
		} catch (Exception $e) {
			erro_bd( $exception, $this->con->error );
			return false;
		}
	}

	public function atualizar_descricao( $obj ){
		try {
			if($this->abreConexao()){
				$str_q = "
					UPDATE 
						acomodacao_foto
					SET 
						descricao = '". $this->con->real_escape_string( $obj->descricao ) ."'
					WHERE 
						id = '".$this->con->real_escape_string( $obj->id )."'
						AND ativo = 1
						AND codprojeto = " . $this->codProjeto . ";";
				if($q = $this->con->query($str_q))
					return true;
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao");	
		} catch (Exception $e) {
			erro_bd( $exception, $this->con->error );
			return false;
		}
	}

	public function deletar( AcomodacaoFoto $obj ){
		try {
			if($this->abreConexao()){
				$str_q = "
					UPDATE 
						acomodacao_foto
					SET 
						ativo = 0 
					WHERE 
						id = '".$this->con->real_escape_string( $obj->id )."'
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
