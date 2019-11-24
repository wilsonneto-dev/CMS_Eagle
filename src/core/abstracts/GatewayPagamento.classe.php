<?php

class GatewayPagamento{
	
	public $id;
	public $habilitado;
	public $ordem;
	public $padrao;
	public $pagina_redirecionamento;
	public $email;
	public $token;
	public $codigo;
	private $bd;
	
	public function GatewayPagamento(){
		$this->ordem = "";
		$this->id = "";
		$this->padrao = "0";
		$this->pagina_redirecionamento = "";
		$this->email = "";
		$this->token = "";
		$this->codigo = "";
		$this->habilitado = "1";
		$this->bd = new GatewayPagamentoDAO();
	}
	
	public function cadastrar(){
		return $this->bd->cadastrar($this);
	}

	public function get(){
		return $this->bd->get($this);
	}
	
	public function getByCod(){
		return $this->bd->getByCod($this);
	}
	
	public static function _getById( $_str ){
		$gateway_pagamento = new GatewayPagamento();
		$gateway_pagamento->id = $_str;
		$gateway_pagamento->get();
		return $gateway_pagamento;
	}

	public static function _get( $_str ){
		$gateway_pagamento = new GatewayPagamento();
		$gateway_pagamento->codigo = $_str;
		$gateway_pagamento->getByCod();
		return $gateway_pagamento;
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
		$_bd = new GatewayPagamentoDAO();
		return $_bd->getTotal();
	}
	public static function limpaPadrao(){
		$_bd = new GatewayPagamentoDAO();
		return $_bd->limpaPadrao();
	}
}

class GatewayPagamentoDAO extends BaseDAO{
	
	public function cadastrar(GatewayPagamento $p){
		try {
			if($this->abreConexao()){
				$str_q = "INSERT INTO 
						gateway_pagamento( 
							pagina_redirecionamento, email, token, codigo, ordem, habilitado, padrao, codprojeto 
						)VALUES(
							'". $this->con->real_escape_string($p->pagina_redirecionamento) ."'
							,'". $this->con->real_escape_string($p->email) ."'
							,'". $this->con->real_escape_string($p->token) ."'
							,'". $this->con->real_escape_string($p->codigo) ."'
							,'". $this->con->real_escape_string($p->ordem) ."'
							,'". $this->con->real_escape_string($p->habilitado) ."'
							,'". $this->con->real_escape_string($p->padrao) ."'
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
					$this->con->error ."\n<br />padrao:". time().
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
						pagina_redirecionamento, 
						email, 
						token, 
						codigo,
						padrao, 
						ordem, 
						habilitado
					FROM 
						gateway_pagamento 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id = '" . $this->con->real_escape_string($p->id) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->pagina_redirecionamento = $obj->pagina_redirecionamento;
						$p->email = $obj->email;
						$p->token = $obj->token;
						$p->codigo = $obj->codigo;
						$p->habilitado = $obj->habilitado;
						$p->ordem = $obj->ordem;
						$p->padrao = $obj->padrao;
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
					$this->con->error ."\n<br />padrao:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}

	public function getByCod($p){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						id,
						pagina_redirecionamento, 
						email, 
						token, 
						codigo,
						padrao, 
						ordem, 
						habilitado
					FROM 
						gateway_pagamento 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND codigo = '" . $this->con->real_escape_string($p->codigo) . "';";					
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$p->id = $obj->id;
						$p->padrao = $obj->padrao;
						$p->email = $obj->email;
						$p->token = $obj->token;
						$p->pagina_redirecionamento = $obj->pagina_redirecionamento;
						$p->codigo = $obj->codigo;
						$p->ordem = $obj->ordem;
						$p->habilitado = $obj->habilitado;
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
					$this->con->error ."\n<br />padrao:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
	public function existeCodigo( $p ){
		try {
			if($this->abreConexao()){
				$str_q = "
					SELECT 
						codigo
					FROM 
						gateway_pagamento 
					WHERE 
						ativo = 1
						AND codprojeto = " . $this->codProjeto ."
						AND id <> '" . $this->con->real_escape_string($p->id) ."'
						AND codigo = '" . $this->con->real_escape_string($p->codigo) . "';";					
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
					$this->con->error ."\n<br />padrao:". time().
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
							gateway_pagamento
						SET 
							pagina_redirecionamento = '". $this->con->real_escape_string($p->pagina_redirecionamento) ."'
							, email = '". $this->con->real_escape_string($p->email) ."'
							, token = '". $this->con->real_escape_string($p->token) ."'
							, codigo = '". $this->con->real_escape_string($p->codigo) ."'
							, ordem = '". $this->con->real_escape_string($p->ordem) ."'
							, padrao = '". $this->con->real_escape_string($p->padrao) ."'
							, habilitado = '". $this->con->real_escape_string($p->habilitado) ."'
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
					$this->con->error ."\n<br />padrao:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}	

	public function limpaPadrao(){
		try {
			if($this->abreConexao()){
				$str_q = "
						UPDATE 
							gateway_pagamento
						SET 
							padrao = 0
						WHERE 
							ativo = 1
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
					$this->con->error ."\n<br />padrao:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}	

	public function getProxId(GatewayPagamento $p){
		try {
			if($this->abreConexao()){
				$str_q = "SELECT (MAX(id) + 1) AS proxId FROM gateway_pagamento;";					
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
					$this->con->error ."\n<br />padrao:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
	public function deleta(GatewayPagamento $obj){
		try {
			if($this->abreConexao()){
				$str_q = "UPDATE gateway_pagamento
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
					$this->con->error ."\n<br />padrao:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}
	
	public function getTotal(){
		try {
			if($this->abreConexao()){
				$str_q = "SELECT COUNT(*) AS total FROM gateway_pagamento WHERE codprojeto = ".CODPROJETO." AND ativo = 1;";					
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
					$this->con->error ."\n<br />padrao:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}

	
}

?>