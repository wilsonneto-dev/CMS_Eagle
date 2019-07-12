<?php

class EagleAdmin 
{
	
	#region attributes
	
	public $get = array();
	public $options = array();
	public $route = array();
	public $credentials = array();
	public $html_content = '';
	public $v;

	#endregion attributes

	#region processing
	
	public function __construct($get = null, $options = null)
	{
		$this->get = ($get != null) ? $get : array();
		$this->options = ($options != null) ? $options : array();
	}
	
	public static function init($get = null, $options = null)
	{
	    $eagle = new EagleAdmin($get, $options);
    	$eagle->route = EagleAdminRoute::proccess($get);
    	$eagle->init_credentials();
    	$eagle->v = new ViewHelper();

    	header('X-XSS-Protection: 0');

    	// print_r($eagle->route); exit();

    	if($eagle->credentials == null)
    	{
    		$eagle->login_page();
    	}
    	else
    	{
	    	$eagle->run();
    	}
	}	

	public function run() 
	{
		// code da master
		$this->include_file('content/action/index.master.cod.php');
		switch ($this->route['type']) {
			case 'crud':
				$this->menu_destaque = $this->route['entity'];
				$this->include_file('content/action/crud_'.$this->route['action'].'.cod.php');
				break;		
			case 'logout':
				$this->logout();
				$this->login_page();
				break;		
			default:
				break;
		}
		$this->include_file('content/view/index.master.php');
	}

	
	public function get_content_view()
	{
		
		switch ($this->route['type']) 
		{
			case 'old':
				$this->include_file('old_pgs/'.$this->route['content'].'.php');
				break;

			case 'crud':
				$this->include_file('content/view/crud_'.$this->route['action'].'.php');
				break;

			default:
				$this->include_file('content/view/'.$this->route['content'].'.php');
				break;
		}
	}
	
	public function is_post()
	{
		return ($_SERVER['REQUEST_METHOD'] == 'POST');
	}

	#endregion

	#region helpers: alerts, redirect , etc

	public function message($msg, $type = 'success')
	{
		$this->add_onload_js("message('".$msg."','".$type."');");
	} 

	#endregion

	#region redirects and pages
	public function login_page()
	{
		if($_SERVER['REQUEST_URI'] != '/admin/login.php')
		{
			$this->redirect('/admin/login.php');
		}
		else
		{
			include('login.php');
			exit();
		}
	}

	public function redirect($path)
	{
		header("Location: ".$path);
		exit();
	}

	#endregion redirects and pages

	#region html header, menus, etc

	public function get_menu()
	{
		return $this->get_session('admin_menu_html');
	} 

	private function header_html() {
		$header_tags = '';
		return ( $header_tags );
	}

	public function add_header_script( $_str ){
		$this->_header_scripts[] = $_str;	
	}

	public function add_header_styles( $_str ){
		$this->_header_styles[] = $_str;	
	}

	#endregion

	#region out

	public function out( $out, $params = null )
	{
		$final_out = $out;
		if(is_numeric($out))
			$final_out = number_format($out, is_int($params)?$params:2);
		echo nl2br(htmlspecialchars($final_out));
	}

	public function include_file($path)
	{
		if($path != null)
		{
			if(file_exists($path))
			{
				include($path);
			}
		}
	}
	#endregion

	#region session
	private function get_session($key = null)
	{
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		if($key == null)
		{
			return $_SESSION;
		}else
		{
			if(isset($_SESSION[$key]))
				return $_SESSION[$key];
			else
				return null;
		}

	}

	private function set_session($key = null, $value = null)
	{
		if (session_status() == PHP_SESSION_NONE) 
		{
		    session_start();
		}
		if($key == null)
		{
			return false;
		}
		else
		{
			$_SESSION[$key] = $value;
		}
	}

	#endregion session

	#region credentials
	public function init_credentials()
	{
		if($this->get_session('admin') != null)
		{
			$this->credentials['admin'] 			= $this->get_session('admin');
			$this->credentials['grupo_admin'] 		= $this->get_session('admin_grupo');
			$this->credentials['permissoes_admin'] 	= $this->get_session('admin_permissoes');
			$GLOBALS["admin"] = $this->credentials['admin'];
			$GLOBALS["grupo_admin"] = $this->credentials['grupo_admin'];
			$GLOBALS["permissoes_admin"] = $this->credentials['permissoes_admin'];
		}
		else
		{
			$this->credentials = null;
		}
	} 

	public function get_credentials($key = null)
	{
		if($key == null)
		{
			return $this->credentials;
		}
		else
		{
			return ArrayHelper::get($this->credentials, $key, null);
		}
	}
	
	public function get_general_nitifications()
	{
		if($this->get_session("admin_notificacoes_gerais_html") == null) 
			return $this->get_session("admin_notificacoes_gerais_html");
	}

	
	public function logout()
	{
		unset( 
	        $_SESSION["admin"], 
	        $_SESSION["admin_notificacoes_gerais_html"],
	        $_SESSION["admin_menu_html"],
	        $_SESSION["admin_grupo"],
	        $_SESSION["admin_permissoes"]
	    );
	} 

	public function check_permissions($p)
	{
		if( !in_array( $p, $this->get_credentials('permissoes_admin') ) )
		{
			$this->message( 'Sem permissão', 'error');
			$this->redirect("/admin");
		}
		else
		{
			return $this->get_credentials('permissoes_admin')[$this->route['entity']];
		}		
	}

	#endregion credentials

	#region onload
	public function add_onload_js($script)
	{
		if(isset($_SESSION["OnloadScript"])) 
			$_SESSION["OnloadScript"] .= $script;
		else	
			$_SESSION["OnloadScript"] = $script;
	}

	public static function get_onload_js($append_script)
	{
		if(isset( $_SESSION["OnloadScript"] ))
		{
			$script = $_SESSION["OnloadScript"];
			if( $append_script == true)
				$script = '<script> $(document).ready(function(){ ' . $script . ' }); </script>';
			unset( $_SESSION["OnloadScript"] );
			return ( $script );
		}
	}

	#endregion onload






}

		
?>