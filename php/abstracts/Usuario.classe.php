<?php

//Classe Usuario e UsuarioDAO
//01 de Agosto de 2016

class Usuario{

	public $id;
	public $fb_id;
	public $nome;
	public $sobrenome;
	public $cod_figura_publica;
	public $email;
	public $fb_token;
	private $bd;
	
	public function Usuario(){
		$this->nome = "";
		$this->sobrenome = "";
		$this->cod_figura_publica = "";
		$this->id = "";
		$this->fb_id = "";
		$this->email = "";
		$this->fb_token = "";
		$this->bd = new UsuarioDAO();
	}

	public function getListaUsuariosByFigura( $id ){
		return $this->bd->getListaUsuariosByFigura( $id );
	}
	public function getListaUsuarios(){
		return $this->bd->getListaUsuarios();
	}

	public function cadastra(){
		return $this->bd->cadastra( $this );
	}

	public static function _getListaUsuarios()
	{
		$obj = new Usuario();
		return $obj->getListaUsuarios( $p_cod_grupo );
	}
	
	public static function _getListaUsuariosByFigura( $id )
	{
		$obj = new Usuario();
		return $obj->getListaUsuariosByFigura( $id );
	}
	
	

	public function update_fbtoken()
	{
		return $this->bd->update_fbtoken( $this );
	}
	
	public static function getUsuarioByFbId( $p_fb_id, $id )
	{
		$obj = new Usuario();
		return $obj->bd->getUsuarioByFbId( $p_fb_id, $id );
	}

}

class UsuarioDAO extends BaseDAO{
	
	public function cadastra(Usuario $p){
		try {
			if($this->abreConexao()){
				$str_q = "INSERT INTO 
						usuario(fb_id, nome, sobrenome, cod_figura_publica, email, fb_token, codprojeto)
						VALUES('". $this->con->real_escape_string($p->fb_id) ."'
						,'". $this->con->real_escape_string($p->nome) ."'
						,'". $this->con->real_escape_string($p->sobrenome) ."'
						,'". $this->con->real_escape_string($p->cod_figura_publica) ."'
						,'". $this->con->real_escape_string($p->email) ."'
						,'". $this->con->real_escape_string($p->fb_token) ."'
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
					$this->con->error ."\n<br />data:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}

	public function update_fbtoken(Usuario $p){
		try {
			if($this->abreConexao()){
				$str_q = "update 
						usuario
						set fb_token = '". $this->con->real_escape_string($p->fb_token) ."'
						where fb_id = '". $this->con->real_escape_string($p->fb_id) ."' ;";
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


	public function getListaUsuarios(){
		try {
			if($this->abreConexao()){
				$str_q = "
					select 
						id,
						fb_id,
						nome,
						sobrenome,
						cod_figura_publica,
						email,
						fb_token
					from 
						usuario
					where
						ativo = 1 
					order by 
						nome";
				if($q = $this->con->query($str_q)){
					$lista = array();
					if($q->num_rows > 0){
						while( ( $obj = $q->fetch_object() ) != false )
						{

							$u = new Usuario();
							$u->id = $obj->id;
							$u->fb_id = $obj->fb_id;
							$u->nome = $obj->nome;
							$u->sobrenome = $obj->sobrenome;
							$u->email = $obj->email;
							$u->fb_token = $obj->fb_token;

							$lista[] = $u;
						}
					}
					return $lista;
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



	public function getListaUsuariosByFigura( $id_figura ){
		try {
			if($this->abreConexao()){
				$str_q = "
					select 
						id,
						fb_id,
						nome,
						sobrenome,
						cod_figura_publica,
						email,
						fb_token
					from 
						usuario
					where
						ativo = 1 
						and cod_figura_publica = '". $this->con->real_escape_string($id_figura) ."' 
					order by 
						nome";
				if($q = $this->con->query($str_q)){
					$lista = array();
					if($q->num_rows > 0){
						while( ( $obj = $q->fetch_object() ) != false )
						{

							$u = new Usuario();
							$u->id = $obj->id;
							$u->fb_id = $obj->fb_id;
							$u->nome = $obj->nome;
							$u->sobrenome = $obj->sobrenome;
							$u->email = $obj->email;
							$u->fb_token = $obj->fb_token;

							$lista[] = $u;
						}
					}
					return $lista;
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


	public function getUsuarioByFbId( $p_fb_id, $id ){
		try {
			if($this->abreConexao()){
				$str_q = "
					select 
						id,
						fb_id,
						nome,
						sobrenome,
						email,
						fb_token
					from 
						usuario
					where
						ativo = 1
						and fb_id = '". $this->con->real_escape_string($p_fb_id) ."' 
						and cod_figura_publica = '". $this->con->real_escape_string($id) ."' 
					";
				if($q = $this->con->query($str_q)){
					$lista = array();
					if($q->num_rows > 0){
						while( ( $obj = $q->fetch_object() ) != false )
						{

							$u = new Usuario();
							$u->id = $obj->id;
							$u->fb_id = $obj->fb_id;
							$u->nome = $obj->nome;
							$u->sobrenome = $obj->sobrenome;
							$u->email = $obj->email;
							$u->fb_token = $obj->nome;
							$u->nome = $obj->nome;

							return( $u );
						}
					}
					return null;
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

}

?>