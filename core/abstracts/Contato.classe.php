<?php

class Contato{

	public $id;
	public $nome;
	public $email;
	public $telefone;
	public $assunto;
	public $mensagem;
	public $tipo;
	public $pagina;
	public $ip;
	public $data;


	private $bd;
	
	public function Contato(){
		$this->nome = "";
		$this->email = '';
		$this->telefone = "";
		$this->assunto = "";
		$this->mensagem = "";
		$this->tipo = "";
		$this->pagina = "";
		$this->ip = "";
		$this->data = "";
		$this->bd = new ContatoDAO();
	}
	
	public function get(){
		return $this->bd->get($this);
	}

	public function cadastrar(){
		return $this->bd->cadastrar($this);
	}

	public function deletar(){
		return $this->bd->deletar($this);
	}


}

class ContatoDAO extends BaseDAO{
	
	public function cadastrar(Contato $p){
		try {
			if($this->abreConexao()){
				$str_q = "
					INSERT INTO contato( 
						nome, 
						email, 
						telefone, 
						assunto, 
						mensagem,
						tipo, 
						pagina, 
						ip,
						codprojeto
					)VALUES(
						'". $this->con->real_escape_string($p->nome) ."'
						,'". $this->con->real_escape_string($p->email) ."'
						,'". $this->con->real_escape_string($p->telefone) ."'
						,'". $this->con->real_escape_string( $p->assunto ) ."'
						,'". $this->con->real_escape_string($p->mensagem) ."'
						,'". $this->con->real_escape_string($p->tipo) ."'
						,'". $_SERVER['REQUEST_URI'] ."'
						,'". $_SERVER['REMOTE_ADDR'] ."'
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
	

	public function get($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						nome, 
						email, 
						telefone, 
						assunto, 
						mensagem,
						tipo, 
						pagina, 
						ip,
						DATE_FORMAT( datacadastro,'%d/%m/%Y') as data
					FROM 
						contato 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ." 
						AND id = '" . $this->con->real_escape_string( $p->id ) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						
						$obj = $q->fetch_object();
						
						$p->nome = $obj->nome;
						$p->email = $obj->email;
						$p->telefone = $obj->telefone;
						$p->assunto = $obj->assunto;
						$p->mensagem = $obj->mensagem;
						$p->tipo = $obj->tipo;
						$p->pagina = $obj->pagina;
						$p->ip = $obj->ip;
						$p->data = $obj->data;
						
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

	public function deletar(Contato $obj){
		try {
			if($this->abreConexao()){
				$str_q = "
						UPDATE contato
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