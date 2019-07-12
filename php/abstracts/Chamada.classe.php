<?php

class Chamada{
	
	public $id;
	public $imagem;
	public $link;
	public $texto_botao;
	public $texto;
	public $titulo;
	private $bd;
	
	public function Chamada(){
		$this->texto = "";
		$this->id = "";
		$this->texto_botao = "";
		$this->titulo = "";
		$this->imagem = "";
		$this->link = "";
		$this->bd = new ChamadaDAO();
	}
	
	public function cadastrar(){
		return $this->bd->cadastra($this);
	}

	public function get(){
		return $this->bd->get($this);
	}
	
	public function atualizar(){
		return $this->bd->atualiza($this);
	}

	public function deletar(){
		return $this->bd->deleta($this);
	}

}

class ChamadaDAO extends BaseDAO{
	
	public function cadastra(Chamada $p){
		try {
			if($this->abreConexao()){
				$str_q = "INSERT INTO 
						chamada( 
							titulo, texto, imagem, texto_botao, link, codprojeto 
						)VALUES(
							'". $this->con->real_escape_string($p->titulo) ."'
							,'". $this->con->real_escape_string($p->texto) ."'
							,'". $this->con->real_escape_string($p->imagem) ."'
							,'". $this->con->real_escape_string($p->texto_botao) ."'
							,'". $this->con->real_escape_string($p->link) ."'
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
					$this->con->error ."\n<br />texto_botao:". time().
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
						texto_botao, 
						link, 
						imagem
					FROM 
						chamada 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id = '" . $p->id . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->titulo = $obj->titulo;
						$p->texto = $obj->texto;
						$p->imagem = $obj->imagem;
						$p->link = $obj->link;
						$p->texto_botao = $obj->texto_botao;
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
					$this->con->error ."\n<br />texto_botao:". time().
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
							chamada
						SET 
							titulo = '". $this->con->real_escape_string($p->titulo) ."'
							, texto = '". $this->con->real_escape_string($p->texto) ."'
							, link = '". $this->con->real_escape_string($p->link) ."'
							, texto_botao = '". $this->con->real_escape_string($p->texto_botao) ."'
							, imagem = '". $this->con->real_escape_string($p->imagem) ."'
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
					$this->con->error ."\n<br />texto_botao:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}	

	public function deleta(Chamada $obj){
		try {
			if($this->abreConexao()){
				$str_q = "UPDATE chamada
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
					$this->con->error ."\n<br />texto_botao:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
}

?>