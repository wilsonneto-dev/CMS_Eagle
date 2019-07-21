<?php

// Classe Categoria e CategoriaDAO
// 06 de Maio de 2012

class Categoria {

	public $id;
	public $id_url;
	public $titulo;
	public $descricao;
	
	public $imagem;
	public $ordem;
	public $listar;
	public $visivel;
	public $menu;
	public $destaque;
	
	private $bd;
	
	public function Categoria(){
		$this->id = '';
		$this->titulo = '';
		$this->id_url = "";
		$this->descricao = "";

		$this->imagem = "";
		$this->ordem = 100;
		$this->listar = 1;
		$this->visivel = 1;
		$this->menu = 1;
		$this->destaque = 0;

		$this->bd = new CategoriaDAO();
	}
	
	public function cadastrar(){
		return $this->bd->cadastrar($this);
	}

	public function get(){
		return $this->bd->get($this);
	}

	public function getByUrl(){
		return $this->bd->getByUrl($this);
	}

	public function atualizar(){
		return $this->bd->atualizar($this);
	}

	public function deletar(){
		return $this->bd->deletar($this);
	}

	// estáticos 
	public static function _get( $p_id ){
		$obj = new Categoria();
		$obj->id = $p_id;
		if ( $obj->get() ) 
			return $obj;
		else 
			return null;
	}

	public static function _getByUrl( $p_idUrl ){
		$obj = new Categoria();
		$obj->id_url = $p_idUrl;
		if ( $obj->getByUrl() ) 
			return $obj;
		else 
			return null;
	}


}

class CategoriaDAO extends BaseDAO {
	
	public function cadastrar(Categoria $p){
		try {
			if($this->abreConexao()){
				$str_q = "
					INSERT INTO 
						categoria( id_url, titulo, descricao, imagem, ordem, listar, visivel, destaque, menu, codprojeto )
					VALUES('". $this->con->real_escape_string($p->id_url) ."'
						,'". $this->con->real_escape_string($p->titulo) ."'
						,'". $this->con->real_escape_string($p->descricao) ."'
						,'". $this->con->real_escape_string($p->imagem) ."'
						,'". $this->con->real_escape_string($p->ordem) ."'
						,'". $this->con->real_escape_string($p->listar) ."'
						,'". $this->con->real_escape_string($p->visivel) ."'
						,'". $this->con->real_escape_string($p->destaque) ."'
						,'". $this->con->real_escape_string($p->menu) ."'
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
			erro_bd( $exception, $this->con->error );
			return false;
		}
	}

	public function get($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						id, 
						id_url, 
						titulo, 
						descricao,
						imagem, 
						ordem, 
						listar, 
						visivel, 
						destaque ,
						menu
					FROM 
						categoria 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ." 
						AND id = '" . $this->con->real_escape_string( $p->id ) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->id = $obj->id;
						$p->id_url = $obj->id_url;
						$p->titulo = $obj->titulo;
						$p->descricao = $obj->descricao;
						$p->imagem = $obj->imagem;
						$p->ordem = $obj->ordem;
						$p->listar = $obj->listar;
						$p->visivel = $obj->visivel;
						$p->destaque = $obj->destaque;
						$p->menu = $obj->menu;
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
			erro_bd( $exception, $this->con->error );
			return false;
		}
	}

	public function getByUrl($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						id, 
						id_url, 
						titulo, 
						descricao,
						imagem, 
						ordem, 
						listar, 
						visivel, 
						destaque ,
						menu
					FROM 
						categoria 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ." 
						AND id_url = '" . $this->con->real_escape_string( $p->id_url ) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$p->id = $obj->id;
						$p->id_url = $obj->id_url;
						$p->titulo = $obj->titulo;
						$p->descricao = $obj->descricao;
						$p->imagem = $obj->imagem;
						$p->ordem = $obj->ordem;
						$p->listar = $obj->listar;
						$p->visivel = $obj->visivel;
						$p->destaque = $obj->destaque;
						$p->menu = $obj->menu;
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
			erro_bd( $exception, $this->con->error );
			return false;
		}
	}

	public function atualizar($p){
		try {
			if($this->abreConexao()){
				$str_q = 
					"UPDATE 
						categoria
					SET 
						id_url = '". $this->con->real_escape_string($p->id_url) ."'
						, titulo = '". $this->con->real_escape_string($p->titulo) ."'
						, descricao = '". $this->con->real_escape_string($p->descricao) ."'
						, dataalteracao = current_timestamp
						, imagem = '". $this->con->real_escape_string($p->imagem) ."'
						, ordem = '". $this->con->real_escape_string($p->ordem) ."'
						, listar = '". $this->con->real_escape_string($p->listar) ."'
						, visivel = '". $this->con->real_escape_string($p->visivel) ."'
						, destaque = '". $this->con->real_escape_string($p->destaque) ."'
						, menu = '". $this->con->real_escape_string($p->menu) ."'
					WHERE 
						id = '".$this->con->real_escape_string($p->id)."' 
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
			erro_bd( $exception, $this->con->error );
			return false;
		}
	}	
	
	public function deletar(Categoria $obj){
		try {
			if($this->abreConexao()){
				$str_q = "
						UPDATE categoria
						SET ativo = 0
						WHERE 
							id = '".$this->con->real_escape_string($obj->id)."' 
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
			erro_bd( $exception, $this->con->error );
			return false;
		}
	}
}

?>