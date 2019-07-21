<?php


class EmailConfig{

	public $email;
	public $senha;
	public $smtp;

	public $bd;
	
	public function EmailConfig(){
		
		$this->email = "";
		$this->senha = "";
		$this->smtp = "";

		$this->bd = new EmailConfigDAO();
	
	}
	
	public function cadastrar(){
		return $this->bd->cadastra($this);
	}

	public function get(){
		return $this->bd->get($this);
	}
	
	public static function _get(){
		$email_config = new EmailConfig();
		$email_config->get();
		return $email_config;
	}

	public function atualizar(){
		return $this->bd->atualiza($this);
	}

}

class EmailConfigDAO extends BaseDAO{
	public function cadastra(EmailConfig $email_config){
		try {
			if($this->abreConexao()){
				$str_q = "
					INSERT INTO email_config(email,senha, smtp, codprojeto) 
					VALUES( '','','' ,". $this->codProjeto." );";
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

	public function get($email_config){
		try{
			if($this->abreConexao()){
				$str_q = "
					SELECT
						 email, 
						 senha, 
						 smtp
					FROM 
						email_config 
					WHERE 
						codprojeto = '" . $this->codProjeto ."';";
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						
						$email_config->email = $obj->email;
						$email_config->senha = $obj->senha;
						$email_config->smtp = $obj->smtp;

						return true;

					}else{
						$email_config->cadastrar();
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

	public function atualiza($email_config){
		try {
			if($this->abreConexao()){
				$str_q = "
					UPDATE 
						email_config
					SET 
						email = '". $this->con->real_escape_string($email_config->email) ."'
						, senha = '". $this->con->real_escape_string($email_config->senha) ."'
						, smtp = '". $this->con->real_escape_string($email_config->smtp) ."'
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