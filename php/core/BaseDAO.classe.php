<?php
// v1.1.2
class BaseDAO{
/*
 * classe com as configura��es do banco
 * as classes que usam acesso ao banco devem ser derivadas desta
 * v1.1.2 - add function add user - Wilson Neto
*/
	public static $sl = false; // somente leitura
	
	// depreciada a variável abaixo
	public $codProjeto = 1;

	protected $base = "eagle";
	protected $host = "localhost";

	protected $usuario = "root";
	protected $pass = "";

	protected $leitura_usuario = "root";
	protected $leitura_pass = "";

	protected $base_local = "eagle";
	protected $host_local = "localhost";
	protected $usuario_local = "root";
	protected $pass_local = "";

	protected function get_usuario(){ return BaseDAO::$sl ? $this->leitura_usuario : $this->usuario; }
	protected function get_pass(){ return BaseDAO::$sl ? $this->leitura_pass : $this->pass; }

	/*configura��es do banco*/
	public function __construct(){}
	
	/*controla conex�o com o banco*/
	protected function AbreConexao(){
		try {
			/* activate reporting */
			$driver = new mysqli_driver();
			$driver->report_mode = MYSQLI_REPORT_OFF;
			if( ! $this->is_local() )
			{
				$this->con = new mysqli(
					$this->host, 
					$this->get_usuario(), 
					$this->get_pass(), 
					$this->base
				);		
			}
			else
			{
				$this->con = new mysqli
				( 
					$this->host_local, 
					$this->usuario_local, 
					$this->pass_local, 
					$this->base_local 
				);
			}

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
		if(!$this->is_local())
		{
			return new mysqli( $this->host, $this->get_usuario(), $this->get_pass(), $this->base );		
		}
		else
		{
			return new mysqli
			( 
				$this->host_local, 
				$this->usuario_local, 
				$this->pass_local, 
				$this->base_local 
			);
		}
		return new mysqli( $this->host, $this->get_usuario(), $this->get_pass(), $this->base );
	}
	
	public static function _get_mysqli(){
		$bd = new BaseDAO();
		return $bd->get_mysqli();
	}

	public static function exception(Exception $exception)
	{
		if(self::is_local())
			echo "Localhost - BaseDao::exception - Erro ao executar comando SQL: ".$exception->getMessage();
		
		throw new Exception("Erro ao executar comando SQL.");
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
		return ( EnvironmentUtils::is_local() );
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

}

function erro_bd($ex)
{
	if($ex == null)
		$ex = new Exception("Erro na base de dados...");
	BaseDao::exception($ex);
}

?>