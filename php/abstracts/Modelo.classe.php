<?php

class Modelo{
	
	public $id;
	public $id_url;
	public $descricao;
	public $url;

	private $bd;
	
	public function Modelo(){
		$this->id_url = "";
		$this->url = "";
		$this->descricao = "";
		$this->bd = new ModeloDAO();
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

	public function existeUrl(){
		return $this->bd->existeUrl($this);
	}

	public function atualizar(){
		return $this->bd->atualiza($this);
	}
	
	public function deletar(){
		return $this->bd->deleta($this);
	}

}

class ModeloDAO extends BaseDAO{
	
	public function cadastra(Modelo $p){
		try {
			if($this->abreConexao()){
				$str_q = "INSERT INTO 
						modelo( 
							descricao, url, id_url, codprojeto 
						)VALUES(
							'". $this->con->real_escape_string($p->descricao) ."'
							,'". $this->con->real_escape_string($p->url) ."'
							,'". $this->con->real_escape_string($p->id_url) ."'
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
					$this->con->error ."\n<br />url:". time().
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
						url, 
						descricao,
						id_url
					FROM 
						modelo 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id = '" . $p->id . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->descricao = $obj->descricao;
						$p->url = $obj->url;
						$p->id_url = $obj->id_url;
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
					$this->con->error ."\n<br />url:". time().
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
						url, 
						descricao,
						id_url
					FROM 
						modelo 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id_url = '" . $p->id_url . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->id = $obj->id;
						$p->id_url = $obj->id_url;
						$p->url = $obj->url;
						$p->descricao = $obj->descricao;
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
					$this->con->error ."\n<br />url:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
	public function existeUrl($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						id_url
					FROM 
						modelo 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id <> '" . $p->id ."'
						AND id_url = '" . $p->id_url . "';";					
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
					$this->con->error ."\n<br />url:". time().
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
							modelo
						SET 
							id_url = '". $this->con->real_escape_string($p->id_url) ."'
							, url = '". $this->con->real_escape_string($p->url) ."'
							, descricao = '". $this->con->real_escape_string($p->descricao) ."'
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
					$this->con->error ."\n<br />url:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}	

	public function deleta(Modelo $obj){
		try {
			if($this->abreConexao()){
				$str_q = "UPDATE modelo
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
					$this->con->error ."\n<br />url:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
}

?>