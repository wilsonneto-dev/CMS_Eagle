<?php

class Projeto{
	
	public $id;
	public $imagem;
	public $cod_categoria;
	public $imagem_capa;
	public $servicos;
	public $link;
	public $texto;
	public $intro;
	public $titulo;
	public $id_url;

	public $head_titulo;
	public $head_descricao;
	public $head_palavras_chave;

	private $bd;
	
	public function Projeto(){
		$this->texto = "";
		$this->id = "";
		$this->imagem_capa = "";
		$this->intro = "";
		$this->servicos = "";
		$this->link = "";
		$this->titulo = "";
		$this->id_url = "";
		$this->imagem = "";
		$this->cod_categoria = "";
		
		$this->head_titulo = "";
		$this->head_descricao = "";
		$this->head_palavras_chave = "";

		$this->bd = new ProjetoDAO();
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
		$projeto = new Projeto();
		$projeto->id_url = $_str;
		$projeto->getByUrl();
		return $projeto;
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
		$_bd = new ProjetoDAO();
		return $_bd->getTotal();
	}
}

class ProjetoDAO extends BaseDAO{
	
	public function cadastra(Projeto $p){
		try {
			if($this->abreConexao()){
				$str_q = "INSERT INTO 
						projeto( 
							titulo, id_url, texto, intro, servicos, link, imagem, imagem_capa, cod_categoria, head_titulo, head_descricao, head_palavras_chave, codprojeto 
						)VALUES(
							'". $this->con->real_escape_string($p->titulo) ."'
							,'". $this->con->real_escape_string($p->id_url) ."'
							,'". $this->con->real_escape_string($p->texto) ."'
							,'". $this->con->real_escape_string($p->intro) ."'
							,'". $this->con->real_escape_string($p->servicos) ."'
							,'". $this->con->real_escape_string($p->link) ."'
							,'". $this->con->real_escape_string($p->imagem) ."'
							,'". $this->con->real_escape_string($p->imagem_capa) ."'
							,'". $this->con->real_escape_string($p->cod_categoria) ."'
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
						servicos, 
						link, 
						imagem_capa, 
						cod_categoria, 
						imagem,
						head_titulo,
						head_descricao,
						head_palavras_chave
					FROM 
						projeto 
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
						$p->intro = $obj->intro;
						$p->servicos = $obj->servicos;
						$p->link = $obj->link;
						$p->imagem = $obj->imagem;
						$p->cod_categoria = $obj->cod_categoria;
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
						cod_categoria, 
						intro, 
						servicos, 
						link, 
						imagem,
						head_titulo,
						head_descricao,
						head_palavras_chave
					FROM 
						projeto 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id_url = '" . $this->con->real_escape_string($p->id_url) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->id = $obj->id;
						$p->imagem_capa = $obj->imagem_capa;
						$p->cod_categoria = $obj->cod_categoria;
						$p->titulo = $obj->titulo;
						$p->id_url = $obj->id_url;
						$p->texto = $obj->texto;
						$p->intro = $obj->intro;
						$p->servicos = $obj->servicos;
						$p->link = $obj->link;
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
						projeto 
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
							projeto
						SET 
							titulo = '". $this->con->real_escape_string($p->titulo) ."'
							,id_url = '". $this->con->real_escape_string($p->id_url) ."'
							, texto = '". $this->con->real_escape_string($p->texto) ."'
							, intro = '". $this->con->real_escape_string($p->intro) ."'
							, servicos = '". $this->con->real_escape_string($p->servicos) ."'
							, link = '". $this->con->real_escape_string($p->link) ."'
							, cod_categoria = '". $this->con->real_escape_string($p->cod_categoria) ."'
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

	public function getProxId(Projeto $p){
		try {
			if($this->abreConexao()){
				$str_q = "SELECT (MAX(id) + 1) AS proxId FROM projeto;";					
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
	
	public function deleta(Projeto $obj){
		try {
			if($this->abreConexao()){
				$str_q = "UPDATE projeto
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
				$str_q = "SELECT COUNT(*) AS total FROM projeto WHERE codprojeto = ".CODPROJETO." AND ativo = 1;";					
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
						projeto 
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