<?php

class Depoimento{

	public $id;
	public $foto;
	public $nome;
	public $texto;
	public $titulo;

	private $bd;
	
	public function Depoimento( ){

		$this->nome = '';
		$this->foto = "";
		$this->texto = "";
		$this->titulo = "";

		$this->bd = new DepoimentoDAO();

	}
	
	public function cadastrar(){
		return $this->bd->cadastrar($this);
	}

	public function get(){
		return $this->bd->get($this);
	}

	public function atualizar(){
		return $this->bd->atualizar($this);
	}

	public function deletar(){
		return $this->bd->deletar($this);
	}

	// estáticos 
	public static function _get( $p_id ){
		$obj = new Depoimento();
		$obj->id = $p_id;
		if ( $obj->get() ) 
			return $obj;
		else 
			return null;
	}


}

class DepoimentoDAO extends BaseDAO{
	
	public function cadastrar(Depoimento $p){
		try {
			if($this->abreConexao()){
				$str_q = "INSERT INTO 
						depoimento( titulo, nome, texto, foto, codprojeto)
						VALUES('". $this->con->real_escape_string($p->titulo) ."'
						,'". $this->con->real_escape_string($p->nome) ."'
						,'". $this->con->real_escape_string($p->texto) ."'
						,'". $this->con->real_escape_string($p->foto) ."'
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
						titulo, 
						nome,
						foto, 
						texto
					FROM 
						depoimento 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ." 
						AND id = '" . $this->con->real_escape_string( $p->id ) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						
						$obj = $q->fetch_object();
						
						$p->titulo = $obj->titulo;
						$p->texto = $obj->texto;
						$p->nome = $obj->nome;
						$p->foto = $obj->foto;
						
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
						depoimento
					SET 
						titulo = '". $this->con->real_escape_string($p->titulo) ."'
						, nome = '". $this->con->real_escape_string($p->nome) ."'
						, foto = '". $this->con->real_escape_string($p->foto) ."'
						, texto = '". $this->con->real_escape_string($p->texto) ."'
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

	public function deletar(Depoimento $obj){
		try {
			if($this->abreConexao()){
				$str_q = "
						UPDATE depoimento
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