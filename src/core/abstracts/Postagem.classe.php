<?php

class Postagem{
	
	public $id;
	public $imagem;
	public $imagem_topo;
	public $imagem_capa;
	public $thumb;
	public $tags;
	public $texto;
	public $intro;
	public $titulo;
	public $id_url;

	public $head_titulo;
	public $head_descricao;
	public $head_palavras_chave;

	private $bd;
	
	public function Postagem(){
		$this->texto = "";
		$this->id = "";
		$this->imagem_capa = "";
		$this->intro = "";
		
		$this->data = "";
		$this->video = "";

		$this->tags = "";
		$this->titulo = "";
		$this->id_url = "";
		$this->imagem = "";
		$this->imagem_topo = "";
		$this->thumb = "";
		
		$this->head_titulo = "";
		$this->head_descricao = "";
		$this->head_palavras_chave = "";

		$this->bd = new PostagemDAO();
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
		$postagem = new Postagem();
		$postagem->id_url = $_str;
		$postagem->getByUrl();
		return $postagem;
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
		$_bd = new PostagemDAO();
		return $_bd->getTotal();
	}
}

class PostagemDAO extends BaseDAO{
	
	public function cadastra(Postagem $p){
		try {
			if($this->abreConexao()){
				$str_q = "INSERT INTO 
						postagem( 
							titulo, id_url, texto, intro, data, video, tags, imagem, thumb, imagem_capa, imagem_topo, head_titulo, head_descricao, head_palavras_chave, codprojeto 
						)VALUES(
							'". $this->con->real_escape_string($p->titulo) ."'
							,'". $this->con->real_escape_string($p->id_url) ."'
							,'". $this->con->real_escape_string($p->texto) ."'
							,'". $this->con->real_escape_string($p->intro) ."'
							, str_to_date('". $this->con->real_escape_string( $p->data->format('d/m/Y') ) ."','%d/%m/%Y')
							,'". $this->con->real_escape_string($p->video) ."'
							,'". $this->con->real_escape_string($p->tags) ."'
							,'". $this->con->real_escape_string($p->imagem) ."'
							,'". $this->con->real_escape_string($p->thumb) ."'
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
						data, 
						video, 
						tags, 
						imagem_capa, 
						imagem_topo, 
						imagem,
						thumb,
						head_titulo,
						head_descricao,
						head_palavras_chave
					FROM 
						postagem 
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
						
						if( is_null( $obj->data) ) $p->data = null;
						else $p->data = new DateTime( $obj->data );
						
						$p->video = $obj->video;
						$p->tags = $obj->tags;
						$p->imagem = $obj->imagem;
						$p->thumb = $obj->thumb;
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
						data, 
						video, 
						tags, 
						imagem,
						thumb,
						head_titulo,
						head_descricao,
						head_palavras_chave
					FROM 
						postagem 
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
						if( is_null( $obj->data) ) $p->data = null;
						else $p->data = new DateTime( $obj->data );
						
						$p->video = $obj->video;
						$p->tags = $obj->tags;
						$p->imagem = $obj->imagem;
						$p->thumb = $obj->thumb;

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
						postagem 
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
							postagem
						SET 
							titulo = '". $this->con->real_escape_string($p->titulo) ."'
							,id_url = '". $this->con->real_escape_string($p->id_url) ."'
							, texto = '". $this->con->real_escape_string($p->texto) ."'
							, intro = '". $this->con->real_escape_string($p->intro) ."'
							, data = str_to_date('". $this->con->real_escape_string( $p->data->format('d/m/Y') ) ."','%d/%m/%Y')
							, video = '". $this->con->real_escape_string($p->video) ."'
							, tags = '". $this->con->real_escape_string($p->tags) ."'
							, imagem_topo = '". $this->con->real_escape_string($p->imagem_topo) ."'
							, imagem_capa = '". $this->con->real_escape_string($p->imagem_capa) ."'
							, imagem = '". $this->con->real_escape_string($p->imagem) ."'
							, thumb = '". $this->con->real_escape_string($p->thumb) ."'
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

	public function getProxId(Postagem $p){
		try {
			if($this->abreConexao()){
				$str_q = "SELECT (MAX(id) + 1) AS proxId FROM postagem;";					
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
	
	public function deleta(Postagem $obj){
		try {
			if($this->abreConexao()){
				$str_q = "UPDATE postagem
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
				$str_q = "SELECT COUNT(*) AS total FROM postagem WHERE codprojeto = ".CODPROJETO." AND ativo = 1;";					
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
						postagem 
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