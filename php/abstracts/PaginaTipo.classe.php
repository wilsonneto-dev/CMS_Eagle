<?php

class PaginaTipo{
	
	public $id;
	public $descricao;
	public $code;
	public $path;

	private $bd;
	
	public function PaginaTipo(){
		$this->id = "";
		$this->descricao = "";
		$this->code = "";
		$this->path = "";

		$this->bd = new PaginaTipoDAO();
	}

	public function get(){
		return $this->bd->get($this);
	}

}

class PaginaTipoDAO extends BaseDAO{
	
	public function get($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						id, 
						descricao, 
						code, 
						path
					FROM 
						pagina_tipo 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND code = '" . $this->con->real_escape_string( $p->code ) . "';";					
	
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						
						$obj = $q->fetch_object();
					
						$p->id = $obj->id;
						$p->descricao = $obj->descricao;
						$p->code = $obj->code;
						$p->path = $obj->path;

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
			erro_bd( "$errMsg" );
			return false;
		}
	}

}

?>