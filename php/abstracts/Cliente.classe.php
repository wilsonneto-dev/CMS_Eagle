<?php

class Cliente{
	
	public $id;
	public $imagem;
	public $link;
	public $imagem_menor;
	public $texto;
	public $sub_titulo;
	public $titulo;
	public $id_url;

	public $head_titulo;
	public $head_descricao;
	public $head_palavras_chave;

	private $bd;
	
	public function Cliente(){

		$this->texto = "";
		$this->id = "";
		$this->link = "";
		$this->sub_titulo = "";
		$this->imagem_menor = "";
		$this->titulo = "";
		$this->id_url = "";
		$this->imagem = "";
		
		$this->head_titulo = "";
		$this->head_descricao = "";
		$this->head_palavras_chave = "";

		$this->bd = new ClienteDAO();
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
		$cliente = new Cliente();
		$cliente->id_url = $_str;
		$cliente->getByUrl();
		return $cliente;
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
		$_bd = new ClienteDAO();
		return $_bd->getTotal();
	}
}

class ClienteDAO extends BaseDAO{
	
	public function cadastra(Cliente $p){
		try {
			if($this->abreConexao()){
				$str_q = "INSERT INTO 
						cliente( 
							titulo, id_url, texto, sub_titulo, imagem_menor, imagem, link, head_titulo, head_descricao, head_palavras_chave, codprojeto 
						)VALUES(
							'". $this->con->real_escape_string($p->titulo) ."'
							,'". $this->con->real_escape_string($p->id_url) ."'
							,'". $this->con->real_escape_string($p->texto) ."'
							,'". $this->con->real_escape_string($p->sub_titulo) ."'
							,'". $this->con->real_escape_string($p->imagem_menor) ."'
							,'". $this->con->real_escape_string($p->imagem) ."'
							,'". $this->con->real_escape_string($p->link) ."'
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
					$this->con->error ."\n<br />link:". time().
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
						sub_titulo, 
						imagem_menor, 
						link, 
						imagem,
						head_titulo,
						head_descricao,
						head_palavras_chave
					FROM 
						cliente 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id = '" . $this->con->real_escape_string($p->id) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->titulo = $obj->titulo;
						$p->id_url = $obj->id_url;
						$p->texto = $obj->texto;
						$p->sub_titulo = $obj->sub_titulo;
						$p->imagem_menor = $obj->imagem_menor;
						$p->imagem = $obj->imagem;
						$p->link = $obj->link;
						
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
					$this->con->error ."\n<br />link:". time().
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
						link, 
						sub_titulo, 
						imagem_menor, 
						imagem,
						head_titulo,
						head_descricao,
						head_palavras_chave
					FROM 
						cliente 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id_url = '" . $this->con->real_escape_string($p->id_url) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->id = $obj->id;
						$p->link = $obj->link;
						$p->titulo = $obj->titulo;
						$p->id_url = $obj->id_url;
						$p->texto = $obj->texto;
						$p->sub_titulo = $obj->sub_titulo;
						$p->imagem_menor = $obj->imagem_menor;
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
					$this->con->error ."\n<br />link:". time().
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
						cliente 
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
					$this->con->error ."\n<br />link:". time().
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
							cliente
						SET 
							titulo = '". $this->con->real_escape_string($p->titulo) ."'
							,id_url = '". $this->con->real_escape_string($p->id_url) ."'
							, texto = '". $this->con->real_escape_string($p->texto) ."'
							, sub_titulo = '". $this->con->real_escape_string($p->sub_titulo) ."'
							, imagem_menor = '". $this->con->real_escape_string($p->imagem_menor) ."'
							, link = '". $this->con->real_escape_string($p->link) ."'
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
					$this->con->error ."\n<br />link:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}	

	public function getProxId(Cliente $p){
		try {
			if($this->abreConexao()){
				$str_q = "SELECT (MAX(id) + 1) AS proxId FROM cliente;";					
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
					$this->con->error ."\n<br />link:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
	public function deleta(Cliente $obj){
		try {
			if($this->abreConexao()){
				$str_q = "UPDATE cliente
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
					$this->con->error ."\n<br />link:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
	public function getTotal(){
		try {
			if($this->abreConexao()){
				$str_q = "SELECT COUNT(*) AS total FROM cliente WHERE codprojeto = ".CODPROJETO." AND ativo = 1;";					
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
					$this->con->error ."\n<br />link:". time().
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
						cliente 
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
					$this->con->error ."\n<br />link:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
}

?>