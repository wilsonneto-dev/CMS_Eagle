<?php

//Classe Txt e TxtDAO
//06 de Maio de 2012

class Txt{

	public $id;
	public $link;
	public $texto;

	private $bd;
	
	public function Txt(){
		$this->link = '';
		$this->texto = "";
		$this->bd = new TxtDAO();
	}
	
	public function cadastrar(){
		return $this->bd->cadastrar($this);
	}

	public function get(){
		return $this->bd->get($this);
	}

	public function getByLink(){
		return $this->bd->getByLink($this);
	}

	public function atualizar(){
		return $this->bd->atualizar($this);
	}

	public function deletar(){
		return $this->bd->deletar($this);
	}

	// estáticos 
	public static function _get( $p_id ){
		$obj = new Txt();
		$obj->id = $p_id;
		if ( $obj->get() ) 
			return $obj;
		else 
			return null;
	}

	public static function _getByLink( $p_id ){
		$obj = new Txt();
		$obj->link = $p_id;
		if ( $obj->getByLink() ) 
			return $obj;
		else 
			return null;
	}


}

class TxtDAO extends BaseDAO{
	
	public function cadastrar(Txt $p){
		try {
			if($this->abreConexao()){
				$str_q = "INSERT INTO 
						txt( texto, link, codprojeto)
						VALUES(
						'". $this->con->real_escape_string($p->texto) ."'
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
			erro_bd( $e, $this->con->error );
			return false;
		}
	}

	public function getByLink($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						texto, 
						link,
						id
					FROM 
						txt 
					WHERE 
						( 
							DATE_FORMAT( datacadastro , '%Y-%m-%d') = DATE_FORMAT( current_timestamp , '%Y-%m-%d')
							or link like '!%'
							or link like 'fix%'
						)
						and link = '" . $this->con->real_escape_string( $p->link ) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->id = $obj->id;
						$p->texto = $obj->texto;
						$p->link = $obj->link;
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
			erro_bd( $e, $this->con->error );
			return false;
		}
	}


	public function get($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						texto, 
						link,
					FROM 
						txt 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ." 
						AND id = '" . $this->con->real_escape_string( $p->id ) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->texto = $obj->texto;
						$p->link = $obj->link;
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
						txt
					SET 
						texto = '". $this->con->real_escape_string($p->texto) ."'
						, link = '". $this->con->real_escape_string($p->link) ."'
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
	
	public function deletar(Txt $obj){
		try {
			if($this->abreConexao()){
				$str_q = "
						UPDATE txt
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