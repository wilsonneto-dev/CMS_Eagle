<?php


class Sobre{

	public $texto;
	public $imagem;

	public $head_titulo;
	public $head_descricao;
	public $head_palavras_chave;

	public $bd;
	
	public function Sobre(){
		
		$this->texto = "";
		$this->imagem = "";

		$this->head_titulo = "";
		$this->head_descricao = "";
		$this->head_palavras_chave = "";

		$this->bd = new SobreDAO();
	
	}
	
	public function cadastrar(){
		return $this->bd->cadastra($this);
	}

	public function get(){
		return $this->bd->get($this);
	}
	
	public static function _get(){
		$sobre = new Sobre();
		$sobre->get();
		return $sobre;
	}

	public function atualizar(){
		return $this->bd->atualiza($this);
	}

}

class SobreDAO extends BaseDAO{
	public function cadastra(Sobre $sobre){
		try {
			if($this->abreConexao()){
				$str_q = "
					INSERT INTO sobre(texto,imagem, head_titulo, head_descricao, head_palavras_chave, codprojeto) 
					VALUES( '','','' ,'' ,'' ,". $this->codProjeto." );";
				if($q = $this->con->query($str_q))
					return true;
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao");	
		} catch (Exception $e) {
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />data:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}

	public function get($sobre){
		try{
			if($this->abreConexao()){
				$str_q = "
					SELECT
						 texto, 
						 imagem, 
						 head_titulo, 
						 head_descricao, 
						 head_palavras_chave
					FROM 
						sobre 
					WHERE 
						codprojeto = '" . $this->codProjeto ."';";
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						
						$sobre->texto = $obj->texto;
						$sobre->imagem = $obj->imagem;

						$sobre->head_titulo = $obj->head_titulo;
						$sobre->head_descricao = $obj->head_descricao;
						$sobre->head_palavras_chave = $obj->head_palavras_chave;
						
						return true;
					}else{
						$sobre->cadastrar();
						return true;
					}
				}
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao ao banco");	
		} catch (Exception $e) {
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />data:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}

	public function atualiza($sobre){
		try {
			if($this->abreConexao()){
				$str_q = "
					UPDATE 
						sobre
					SET 
						texto = '". $this->con->real_escape_string($sobre->texto) ."'
						, imagem = '". $this->con->real_escape_string($sobre->imagem) ."'
						, head_descricao = '". $this->con->real_escape_string($sobre->head_descricao) ."'
						, head_titulo = '". $this->con->real_escape_string($sobre->head_titulo) ."'
						, head_palavras_chave = '". $this->con->real_escape_string($sobre->head_palavras_chave) ."'
					WHERE codprojeto = ".$this->codProjeto.";";
				if($q = $this->con->query($str_q))
					return true;
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao");	
		} catch (Exception $e) {
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />data:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}	
	
}

?>