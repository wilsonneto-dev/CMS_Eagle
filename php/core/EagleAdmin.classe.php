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

	public $cfg = array();

	#endregion attributes

	#region configs
	public function cfg_setup()
	{
		$this->cfg = AppConfig::get()["app"];
		$this->cfg["app_name"] = $this->cfg["name"];

	}

	#endregion configs

	#region processing
	
	public function __construct($get = null, $options = null)
	{
		$this->get = ($get != null) ? $get : array();
		$this->options = ($options != null) ? $options : array();
	}
	
	public static function init($get = null, $options = null)
	{
		$eagle = new EagleAdmin($get, $options);
		$eagle->cfg_setup();
    	$eagle->route = EagleAdminRoute::proccess($get);
    	$eagle->init_credentials();
    	$eagle->v = new ViewHelper();

    	header('X-XSS-Protection: 0');

		if(
			EagleAdminRoute::route_type_need_login($eagle->route['type']) 
			&& $eagle->credentials == null
		){
			$eagle->login_page();
		}
		else
		{
			$eagle->run();
		}
	}	

	public function run() 
	{
		$this->menu_destaque = $this->route['menu_highlight'];

		$this->include_file( $this->route['master_action_file'] );
		$this->include_file($this->route['action_file']);
		if($this->route['master_view_file_disable'] != 1)
			$this->include_file( $this->route['master_view_file'] );	
		else
			$this->get_content_view();
	}

	public function debug($obj, $kill = true)
	{
		echo "<pre>".json_encode($obj, JSON_PRETTY_PRINT)."<pre>";
		if($kill)
			exit();
	}
	
	public function get_content_view()
	{
		$this->include_file($this->route['view_file']);		
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
		$this->redirect( EagleAdminRoute::get_login_route() );
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
	
	public function out_html( $out, $params = null )
	{
		echo $out;
	}

	
	public function out_template( $out, $template, $params = null )
	{
		if( $out != '' && $out != null )
		{
			$final_out = $template;
			$final_out = str_replace('#inner', nl2br(htmlspecialchars($out)), $final_out);
			echo $final_out;			
		}
	}

	public function out_if( $out, $template, $condition, $params = null )
	{
		if($condition)
		{
			if( $out != '' && $out != null )
			{
				$final_out = $template;
				$final_out = str_replace('#inner', nl2br(htmlspecialchars($out)), $final_out);
				echo $final_out;			
			}			
		}
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

	#region forms e campos

	public function form_field($args, $out = false)
	{
		$field = StdFormFactory::field($args);
		if($out)
			$this->out_html($field);	
		return $field;
	}

	#endregion forms e campos

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
			
			$this->credentials['workspace_id'] 		= $this->get_session('workspace_id');
			$this->credentials['workspace_nome']	= $this->get_session('workspace_nome');
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

	public function save_credentials($admin, $grupo_admin, $workspace = null)
	{
		$this->set_session("admin", $admin);
        $this->set_session("admin_grupo", $grupo_admin);
        $this->set_session("admin_permissoes", PaginaAdminOld::_getListaPermissoesByGrupoMenu($admin->cod_grupo_admin));
        $this->set_session("admin_menu_html", AdminViews::gerar_menu( $admin->cod_grupo_admin ));
        $this->set_session("admin_notificacoes_gerais_html", AdminViews::gerar_notificacoes_gerais( $admin->id ) );
		
		if($workspace){
			// salvar também o workspace na sessão
			$this->set_session("workspace_id", $workspace->id);
			$this->set_session("workspace_nome", $workspace->nome);
		}

	}
	
	public function save_credentials_workspace( $workspace )
	{
		// salvar também o workspace na sessão
		$this->set_session("workspace_id", $workspace->id);
		$this->set_session("workspace_nome", $workspace->nome);
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

	#region parameters

	public function get_param($str, $default = null){
		if(isset($_GET[$str]))
		{
			return $_GET[$str];
		}else if(isset($_POST[$str]))
		{
			return $_POST[$str];
		}{
			return $default;
		}
	}

	#endregion

	#region work with page blocs

	public function bloc($bloc_name)
	{
		if( file_exists("frontend/theme/views/blocs/$bloc_name.bloc.php") )
			include("frontend/theme/views/blocs/$bloc_name.bloc.php");
	}

	public function bloc_cod($bloc_name)
	{
		if( file_exists("frontend/action/blocs/$bloc_name.bloc.php") )
			include("frontend/action/blocs/$bloc_name.bloc.php");
	}

	#endregion
	
	#region bullets / extras / adds

	public $location_bullets = [];
	public function location_bullets_html()
	{
		$html = '<span class="path">';
		foreach ($this->location_bullets as $k => $v) 
		{
			if($html != '<span class="path">')
				$html .= ' > ';

			if(isset($v['link']))
				$html .= '<a href="/'.$v['link'].'">'.$v['label'].'</a>';
			else
				$html .= $v['label'];

		}
		$html .= '</span>';
		return $html;
	}

	public function get_year(){
		return date("Y");
	}

	#endregion
}

		
?>