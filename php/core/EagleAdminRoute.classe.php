<?php

class EagleAdminRoute 
{

	// rotas que não precisam de login
	public static function route_type_need_login($route_type)
	{
		$free_access_types = array( 'access' );
		$need_login = !in_array( $route_type, $free_access_types );
		return $need_login;
	}

	// rota da página de login
	public static function get_login_route()
	{
		return "/access/login";
	}

	public static function proccess( $get )
	{
		$route = explode('/', ArrayHelper::get($get, 'route', ''));
		$route_arr = array();

		switch ( ArrayHelper::get( $route, 0, '') ) 
		{
			case 'crud':
				$route_arr['type'] = 'crud';
				$route_arr['entity'] = ArrayHelper::get( $route , 1);
				$route_arr['action'] = ArrayHelper::get( $route , 2);
				$route_arr['id'] = ArrayHelper::get( $route , 3);
				if($route_arr['action'] == '')
					$route_arr['action'] = 'list';
			break;
			
			default:
				$route_arr['type'] = ArrayHelper::get( $route , 0, '');
				$route_arr['content'] = ArrayHelper::get( $route , 1, '');
				$route_arr['entity'] = ArrayHelper::get( $route , 2, '');
				$route_arr['action'] = ArrayHelper::get( $route , 3, '');
				$route_arr['id'] = ArrayHelper::get( $route , 4, '');
			break;
		}

		// action file
		switch ($route_arr['type']) {
			case 'crud':
				$route_arr['action_file'] = 'frontend/action/crud_'.$route_arr['action'].'.cod.php';
				break;		
			default:
				$route_arr['action_file'] = 'frontend/action/'.$route_arr['content'].'.cod.php';
				break;
		}

		// view file
		switch ($route_arr['type']) 
		{
			case 'crud':
				$route_arr["view_file"] = ('frontend/view/crud_'.$route_arr['action'].'.php');
				break;

			default:
			$route_arr["view_file"] = ('frontend/view/'.$route_arr['content'].'.php');
				break;
		}


		// masters
		$route_arr['master_view_file_disable'] = 0;

		switch ($route_arr['type']) {
			case 'access':
				$route_arr['master_action_file'] = 'frontend/action/access.master.cod.php';
				$route_arr['master_view_file'] = 'frontend/view/access.master.php';
				break;			
			default:
				$route_arr['master_action_file'] = 'frontend/action/index.master.cod.php';
				$route_arr['master_view_file'] = 'frontend/view/index.master.php';
				break;
		}

		// menu
		$route_arr['menu_highlight'] = $route_arr['entity'];

		return $route_arr;
	} 

}
		

?>