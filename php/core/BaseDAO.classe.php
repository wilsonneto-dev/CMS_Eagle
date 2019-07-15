<?php

class BaseDAO{

	public static $sl = false; // somente leitura
	
	// depreciada a variável abaixo
	public $codProjeto = 1;

	/*
	protected $base;
	protected $host = AppConfig::get()["db"]["host"];

	protected $usuario = AppConfig::get()["db"]["user"];
	protected $pass = AppConfig::get()["db"]["pass"];

	protected $leitura_usuario = AppConfig::get()["db"]["user-readonly"];
	protected $leitura_pass = AppConfig::get()["db"]["pass-readonly"];

	// protected $base_local = "eagle";
	// protected $host_local = "localhost";
	// protected $usuario_local = "root";
	// protected $pass_local = "";
	*/

	protected function get_usuario(){ return BaseDAO::$sl ? AppConfig::get()["db"]["user-readonly"] : AppConfig::get()["db"]["user"]; }
	protected function get_pass(){ return BaseDAO::$sl ? AppConfig::get()["db"]["pass-readonly"] : AppConfig::get()["db"]["pass"]; }

	public function __construct(){}
	
	protected function AbreConexao(){
		try {
			
			/* activate reporting */
			$driver = new mysqli_driver();
			$driver->report_mode = MYSQLI_REPORT_OFF;
			
			$this->con = new mysqli(
				AppConfig::get()["db"]["host"], 
				$this->get_usuario(), 
				$this->get_pass(), 
				AppConfig::get()["db"]["base"]
			);		

			if( !$this->con->connect_error )
			{
				$this->con->set_charset( "utf8" );
				return true;
			} 
			else
				return false;
		}
		catch (Exception $e) 
		{
			$this->exception($e);
			return false;
		}
	}

	protected function FechaConexao(){
		try {
			return $this->con->close();
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function get_mysqli(){
		new mysqli(
			AppConfig::get()["db"]["host"], 
			$this->get_usuario(), 
			$this->get_pass(), 
			AppConfig::get()["db"]["base"]
		);
	}
	
	public static function _get_mysqli(){
		$bd = new BaseDAO();
		return $bd->get_mysqli();
	}

	public static function exception(Exception $exception)
	{
		throw $exception;
	} 

	public static function prepare_var( $var, $params = 'string')
	{
		// tipo do dado a ser trabalhado
		$data_type = null;
		$new_var = $var;

		// se veio array de config pega só o tipo
		if(is_array($params))
			$data_type = $params['data_type'];
		else if(is_string($params))
			$data_type = $params;

		if($data_type == 'string')
		{
			$new_var = str_replace("'", "''", $new_var);
		}

		return $new_var;

	}

	public static function is_local()
	{
		return false;
		// return ( EnvironmentUtils::is_local() );
	}

	public static function query( $query, $force_array = false )
	{
		try 
		{
			$_this = new static();
			if($_this->abreConexao())
			{
				if( $q = $_this->con->query($query) )
				{
					if($q->num_rows > 0)
					{
						if($q->num_rows == 1 && (!$force_array) )
						{
							$fetch = $q->fetch_object();
							return $fetch;
						}
						else
						{
							$return_arr = [];
							while($fetch = $q->fetch_object())
								$return_arr[] = $fetch;
							return $return_arr;
						}
					}
					else 
					{
						return false;	
					}
				}
				else
				{
					throw new Exception($_this->con->error);
				}
			}
			else 
			{
				throw new Exception($_this->con->error);
			}
		} 
		catch (Exception $e) 
		{
			BaseDao::exception($e);
		}
	}

	public static function multi_query( $query, $force_array = false )
	{
		try 
		{
			$_this = new static();
			if($_this->abreConexao())
			{
				$_this->con->multi_query($query);
				if($_this->con->errno > 0)
				{
					throw new Exception($_this->con->error);
				}
				return $_this->con;
			}
			else 
			{
				throw new Exception($_this->con->error);
			}
		} 
		catch (Exception $e) 
		{
			BaseDao::exception($e);
		}
	}

}

function erro_bd($ex)
{
	BaseDao::exception($ex);
}

?>