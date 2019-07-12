<?php

class Galeria{
	
	public $id;
	public $imagem;
	public $imagem_topo;
	public $imagem_capa;
	public $texto;
	public $intro;
	public $titulo;
	public $id_url;

	public $head_titulo;
	public $head_descricao;
	public $head_palavras_chave;

	private $bd;
	
	public function Galeria(){
		$this->texto = "";
		$this->id = "";
		$this->imagem_capa = "";
		$this->intro = "";
		$this->titulo = "";
		$this->id_url = "";
		$this->imagem = "";
		$this->imagem_topo = "";
		$this->head_titulo = "";
		$this->head_descricao = "";
		$this->head_palavras_chave = "";

		$this->bd = new GaleriaDAO();
	}
	
	public function cadastrar(){
		return $this->bd->cadastra($this);
	}

	public function get(){
		return $this->bd->get($this);
	}
	
	public function getByUrl(){
		return $this->bd->getByUrl($this);
	}
	
	public static function _getByUrl( $_str ){
		$galeria = new Galeria();
		$galeria->id_url = $_str;
		$galeria->getByUrl();
		return $galeria;
	}

	public function existeTitle(){
		return $this->bd->existeTitle($this);
	}

	public function atualizar(){
		return $this->bd->atualiza($this);
	}

	public function getProxId(){
		return $this->bd->getProxId($this);
	}
	
	public function deletar(){
		return $this->bd->deleta($this);
	}
	public static function getTotal(){
		$_bd = new GaleriaDAO();
		return $_bd->getTotal();
	}
}

class GaleriaDAO extends BaseDAO{
	
	public function cadastra(Galeria $p){
		try {
			if($this->abreConexao()){
				$str_q = "INSERT INTO 
						galeria( 
							titulo, id_url, texto, intro, imagem, imagem_capa, imagem_topo, head_titulo, head_descricao, head_palavras_chave, codprojeto 
						)VALUES(
							'". $this->con->real_escape_string($p->titulo) ."'
							,'". $this->con->real_escape_string($p->id_url) ."'
							,'". $this->con->real_escape_string($p->texto) ."'
							,'". $this->con->real_escape_string($p->intro) ."'
							,'". $this->con->real_escape_string($p->imagem) ."'
							,'". $this->con->real_escape_string($p->imagem_capa) ."'
							,'". $this->con->real_escape_string($p->imagem_topo) ."'
							,'". $this->con->real_escape_string($p->head_titulo) ."'
							,'". $this->con->real_escape_string($p->head_descricao) ."'
							,'". $this->con->real_escape_string($p->head_palavras_chave) ."'
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
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />imagem_capa:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}

	public function get($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						titulo, 
						id_url,
						texto, 
						intro, 
						imagem_capa, 
						imagem_topo, 
						imagem,
						head_titulo,
						head_descricao,
						head_palavras_chave
					FROM 
						galeria 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id = '" . $this->con->real_escape_string( $p->id ) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->titulo = $obj->titulo;
						$p->id_url = $obj->id_url;
						$p->texto = $obj->texto;
						$p->intro = $obj->intro;
						$p->imagem = $obj->imagem;
						$p->imagem_topo = $obj->imagem_topo;
						$p->imagem_capa = $obj->imagem_capa;
						
						$p->head_titulo = $obj->head_titulo;
						$p->head_descricao = $obj->head_descricao;
						$p->head_palavras_chave = $obj->head_palavras_chave;

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
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />imagem_capa:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}

	public function getByUrl($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						id,
						titulo, 
						id_url,
						texto, 
						imagem_capa, 
						imagem_topo, 
						intro, 
						imagem,
						head_titulo,
						head_descricao,
						head_palavras_chave
					FROM 
						galeria 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id_url = '" . $this->con->real_escape_string($p->id_url) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->id = $obj->id;
						$p->imagem_capa = $obj->imagem_capa;
						$p->imagem_topo = $obj->imagem_topo;
						$p->titulo = $obj->titulo;
						$p->id_url = $obj->id_url;
						$p->texto = $obj->texto;
						$p->intro = $obj->intro;
						$p->imagem = $obj->imagem;

						$p->head_titulo = $obj->head_titulo;
						$p->head_descricao = $obj->head_descricao;
						$p->head_palavras_chave = $obj->head_palavras_chave;

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
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />imagem_capa:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
	public function existeTitle($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						id_url
					FROM 
						galeria 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id <> '" . $p->id ."'
						AND id_url = '" . $this->con->real_escape_string($p->id_url) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
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
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />imagem_capa:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}

	public function atualiza($p){
	try {
			if($this->abreConexao()){
				$str_q = "
						UPDATE 
							galeria
						SET 
							titulo = '". $this->con->real_escape_string($p->titulo) ."'
							,id_url = '". $this->con->real_escape_string($p->id_url) ."'
							, texto = '". $this->con->real_escape_string($p->texto) ."'
							, intro = '". $this->con->real_escape_string($p->intro) ."'
							, imagem_topo = '". $this->con->real_escape_string($p->imagem_topo) ."'
							, imagem_capa = '". $this->con->real_escape_string($p->imagem_capa) ."'
							, imagem = '". $this->con->real_escape_string($p->imagem) ."'
							, head_titulo = '". $this->con->real_escape_string($p->head_titulo) ."'
							, head_descricao = '". $this->con->real_escape_string($p->head_descricao) ."'
							, head_palavras_chave = '". $this->con->real_escape_string($p->head_palavras_chave) ."'
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
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />imagem_capa:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}	

	public function getProxId(Galeria $p){
		try {
			if($this->abreConexao()){
				$str_q = "SELECT (MAX(id) + 1) AS proxId FROM galeria;";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->id = $obj->proxId;
					}
					return true;	
				}
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao ao banco");	
		} catch (Exception $e) {
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />imagem_capa:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
	public function deleta(Galeria $obj){
		try {
			if($this->abreConexao()){
				$str_q = "UPDATE galeria
						SET ativo = 0
						WHERE id = '".$this->con->real_escape_string($obj->id)."'
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
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />imagem_capa:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
	public function getTotal(){
		try {
			if($this->abreConexao()){
				$str_q = "SELECT COUNT(*) AS total FROM galeria WHERE codprojeto = ".CODPROJETO." AND ativo = 1;";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$q_obj = $q->fetch_object();
						return $q_obj->total;
					}
					return false;	
				}
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao ao banco");	
		} catch (Exception $e) {
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />imagem_capa:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}

	public function existe_titulo($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						titulo 
					FROM 
						galeria 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto . "
						AND id_url = '" . $this->con->real_escape_string($p->id_url) . "' ;";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
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
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />imagem_capa:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
}

?>