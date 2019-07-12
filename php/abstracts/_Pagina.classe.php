<?php

class Pagina{
	
	public $id;
	public $imagem_topo;
	public $sub_titulo;
	public $head_titulo;
	public $head_descricao;
	public $head_palavras_chave;
	public $titulo;
	public $texto;
	public $imagem;
	public $url;

	public $ordem;
	public $menu;
	public $cod_tipo;
	public $cod_layout;
	
	private $bd;
	
	public function Pagina(){
		$this->head_descricao = "";
		$this->id = "";
		$this->head_titulo = "";
		$this->head_palavras_chave = "";
		$this->titulo = "";
		$this->texto = "";
		$this->imagem = "";
		$this->url = "";
		$this->imagem_topo = "";
		$this->sub_titulo = "";

		$this->ordem = "";
		$this->menu = "";
		$this->cod_tipo = "";
		$this->cod_layout = "";

		$this->bd = new PaginaDAO();
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
	
	public static function _getById( $_str ){
		$pagina = new Pagina();
		$pagina->id = $_str;
		$pagina->get();
		return $pagina;
	}

	public static function _get( $_str ){
		$pagina = new Pagina();
		$pagina->url = $_str;
		$pagina->getByUrl();
		return $pagina;
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
		$_bd = new PaginaDAO();
		return $_bd->getTotal();
	}
}

class PaginaDAO extends BaseDAO{
	
	public function cadastrar(Pagina $p){
		try {
			if($this->abreConexao()){
				$str_q = "INSERT INTO 
						pagina( 
							titulo, texto, imagem, url, head_descricao, head_palavras_chave, imagem_topo, head_titulo, sub_titulo, cod_layout, cod_tipo, ordem, menu, codprojeto 
						)VALUES(
							'". $this->con->real_escape_string($p->titulo) ."'
							,'". $this->con->real_escape_string($p->texto) ."'
							,'". $this->con->real_escape_string($p->imagem) ."'
							,'". $this->con->real_escape_string($p->url) ."'
							,'". $this->con->real_escape_string($p->head_descricao) ."'
							,'". $this->con->real_escape_string($p->head_palavras_chave) ."'
							,'". $this->con->real_escape_string($p->imagem_topo) ."'
							,'". $this->con->real_escape_string($p->head_titulo) ."'
							,'". $this->con->real_escape_string($p->sub_titulo) ."'

							,'". $this->con->real_escape_string($p->cod_layout) ."'
							,'". $this->con->real_escape_string($p->cod_tipo) ."'
							,'". $this->con->real_escape_string($p->ordem) ."'
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
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />head_titulo:". time().
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
						texto, 
						imagem, 
						url,
						head_descricao, 
						head_palavras_chave, 
						head_titulo, 
						sub_titulo, 
						imagem_topo,
						cod_layout,
						cod_tipo,
						ordem,
						menu
					FROM 
						pagina 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id = '" . $this->con->real_escape_string($p->id) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->titulo = $obj->titulo;
						$p->texto = $obj->texto;
						$p->imagem = $obj->imagem;
						$p->url = $obj->url;
						$p->head_descricao = $obj->head_descricao;
						$p->head_palavras_chave = $obj->head_palavras_chave;
						$p->imagem_topo = $obj->imagem_topo;
						$p->sub_titulo = $obj->sub_titulo;
						$p->head_titulo = $obj->head_titulo;

						$p->cod_layout = $obj->cod_layout;
						$p->cod_tipo = $obj->cod_tipo;
						$p->ordem = $obj->ordem;
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
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />head_titulo:". time().
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
						texto, 
						imagem, 
						url,
						head_descricao, 
						head_titulo, 
						sub_titulo, 
						head_palavras_chave, 
						imagem_topo,
						
						cod_layout,
						cod_tipo,
						ordem,
						menu

					FROM 
						pagina 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND url = '" . $this->con->real_escape_string($p->url) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->id = $obj->id;
						$p->head_titulo = $obj->head_titulo;
						$p->texto = $obj->texto;
						$p->imagem = $obj->imagem;
						$p->sub_titulo = $obj->sub_titulo;
						$p->titulo = $obj->titulo;
						$p->url = $obj->url;
						$p->head_descricao = $obj->head_descricao;
						$p->head_palavras_chave = $obj->head_palavras_chave;
						$p->imagem_topo = $obj->imagem_topo;

						$p->cod_layout = $obj->cod_layout;
						$p->cod_tipo = $obj->cod_tipo;
						$p->ordem = $obj->ordem;
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
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />head_titulo:". time().
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
						url
					FROM 
						pagina 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id <> '" . $this->con->real_escape_string($p->id) ."'
						AND url = '" . $this->con->real_escape_string($p->url) . "';";					
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
					$this->con->error ."\n<br />head_titulo:". time().
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
							pagina
						SET 
							titulo = '". $this->con->real_escape_string($p->titulo) ."'
							, texto = '". $this->con->real_escape_string($p->texto) ."'
							, imagem = '". $this->con->real_escape_string($p->imagem) ."'
							, url = '". $this->con->real_escape_string($p->url) ."'
							, head_descricao = '". $this->con->real_escape_string($p->head_descricao) ."'
							, head_palavras_chave = '". $this->con->real_escape_string($p->head_palavras_chave) ."'
							, sub_titulo = '". $this->con->real_escape_string($p->sub_titulo) ."'
							, head_titulo = '". $this->con->real_escape_string($p->head_titulo) ."'
							, imagem_topo = '". $this->con->real_escape_string($p->imagem_topo) ."'
						
							, cod_tipo = '". $this->con->real_escape_string($p->cod_tipo) ."'
							, cod_layout = '". $this->con->real_escape_string($p->cod_layout) ."'
							, ordem = '". $this->con->real_escape_string($p->ordem) ."'
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
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />head_titulo:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}	

	public function getProxId(Pagina $p){
		try {
			if($this->abreConexao()){
				$str_q = "SELECT (MAX(id) + 1) AS proxId FROM pagina;";					
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
					$this->con->error ."\n<br />head_titulo:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
	public function deleta(Pagina $obj){
		try {
			if($this->abreConexao()){
				$str_q = "UPDATE pagina
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
					$this->con->error ."\n<br />head_titulo:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
	public function getTotal(){
		try {
			if($this->abreConexao()){
				$str_q = "SELECT COUNT(*) AS total FROM pagina WHERE codprojeto = ".CODPROJETO." AND ativo = 1;";					
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
					$this->con->error ."\n<br />head_titulo:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}

	
}

?>