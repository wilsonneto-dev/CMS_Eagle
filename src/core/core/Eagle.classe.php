<?php

class Eagle 
{
	#region	properties

	public $page_name;

	public $_head_title;
	public $_meta_description;
	public $_meta_keywords;
	public $_meta_author;

	public $_header_scripts;
	public $_header_styles;
	public $_infos;

	public $show_master = true;

	public $loops = [];

	public $cfg_app_mode = 1;

	#endregion properties

	#region render methods

	public function get_theme_path($resource = '', $out = false)
	{
		$theme_path = '/frontend/theme/' . $resource;
		if($out){
			$this->out($theme_path);
		}else{
			return $theme_path;
		}
	}

	private function get_name_page(){
	    if(isset($_GET["pg"])){
	    	$pg = $_GET["pg"];
	        $pg = str_replace("/", "", $pg);
	        $pg = str_replace("\\", "", $pg);
	        $pg = str_replace(".", "", $pg);
	        return $pg;
	    }else 
	        return "home";
	}	

	public function __construct(Info $_infos = null)
	{
		if($_infos == null)
			$_infos = Info::get();
		
			$this->infos = $_infos;
		
		$this->page = null;
		
		$this->page_name = $this->get_name_page();

		$this->_header_scripts = array();
		$this->_header_styles = array();

		$this->set_title($_infos->header_titulo);
		$this->set_description($_infos->header_descricao);
		$this->set_keywords($_infos->header_palavras_chave);
	}
	
	public static function _render(Info $_infos = null ){
		$Eagle = new Eagle($_infos);
    	$Eagle->render();
	}	
	
	public function render ()
	{

		/* include action file in "frontend/action" */
		if( file_exists("frontend/action/index.master.cod.php") )
			include("frontend/action/index.master.cod.php");

		if( file_exists("frontend/action/$this->page_name.cod.php") )
			include("frontend/action/$this->page_name.cod.php");
		
		if($this->show_master == false)
		{ // se não for mostrar a página
			$this->get_page_view();
		}
		else
		{
			if( file_exists("frontend/theme/views/index.master.php") )
				include("frontend/theme/views/index.master.php");			
		}
		
	}

	private function header_html() {
		$metas = '	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="pt-br">

	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>'.$this->_head_title.'</title>
	<meta property="og:title" content="'.$this->_head_title.'">
	<meta property="og:site_name" content="'.$this->_head_title.'">

	<meta name="description" content="'.$this->_meta_description.'" />
	<meta property="og:description" content="'.$this->_meta_description.'">

	<meta name="keywords" content="'.$this->_meta_keywords.'" />
	<meta name="author" content="www.wilsonneto.com.br">
	'.
	( 
		( isset($this->_meta_og_image) && $this->_meta_og_image != null && $this->_meta_og_image != '') ? 
		'<meta property="og:image" content="http://'.$this->infos->dominio.'/'.$this->_meta_og_image.'">'
		: ''
	)
	.'
	<meta property="og:locale" content="pt_BR">
	<meta property="og:type" content="website">
	'.
	( 
		( isset($this->infos->icone) && $this->infos->icone != null && $this->infos->icone != '') ? 
		'<link rel="shortcut icon" href="/'.$this->infos->icone.'" />'
		: ''
	)
	.'		
';

		foreach ($this->_header_scripts as $script ) {
			if( strpos($script, "http") === false ){
		        $metas .= "\n".'		<script src="/frontend/theme/assets/'.$script.'"></script>';
			}else{
    			$metas .= "\n".'		<script src="'.$script.'"></script>';
			}
		}

		foreach ($this->_header_styles as $style ) {
		     $metas .= "\n".'		<link href="/frontend/theme/assets/'.$style.'" rel="stylesheet">';			
		}

		return ( $metas );
	}

	public function get_page_view()
	{
	
		if( file_exists("frontend/theme/views/$this->page_name.pg.php") )
			include("frontend/theme/views/$this->page_name.pg.php");
		else {
			if( file_exists( "frontend/theme/$this->theme_path/views/404.pg.php" ) )
			{
				// header("HTTP/1.0 404 Not Found");
				// include("frontend/theme/$this->theme_path/views/404.pg.php");
				$this->redirect('/404');
			}
		}
	
	}

	public function add_header_script( $_str ){
		$this->_header_scripts[] = $_str;	
	}

	public function add_header_styles( $_str ){
		$this->_header_styles[] = $_str;	
	}

	#endregion render methods

	#region set header and html variables

	public function set_title( $_str, $append = false ){
		if(!$append)
			$this->_head_title = $_str;	
		else 
			$this->_head_title = $_str . " - ".$this->_head_title;
	}

	public function set_description( $_str ){
		$this->_meta_description = $_str;	
	}

	public function set_keywords( $_str ){
		$this->_meta_keywords = $_str;	
	}

	public function set_author( $_str ){
		$this->_meta_author = $_str;	
	}
	
	#endregion

	#region output methos

	public function out( $out, $params = null ){
		$final_out = $out;
		if(ArrayHelper::get( $params, 'type' ) == 'html' )
		{
			echo $final_out;
		}else
		{
			echo nl2br(htmlspecialchars($final_out));
		}
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

	#endregion

	#region work with parameters and posts
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

	public function is_post()
	{
		return ($_SERVER['REQUEST_METHOD'] == 'POST');
	}

	#endregion

	#region pages flows and redirects

	public function redirect($path)
	{
		header("Location: ".$path);
		exit();
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

	#region extras / adds

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

	#endregion

}

?>