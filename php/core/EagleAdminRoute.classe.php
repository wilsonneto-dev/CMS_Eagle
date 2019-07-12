<?php

class EagleAdminRoute 
{

	public static function proccess( $get )
	{
		$route = explode('/', ArrayHelper::get($get, 'route', ''));
		$route_arr = array();

		// pegar da maneira antiga
		if( 
			isset($get["pg"]) || 
			ArrayHelper::get( $route, 0) == 'old' 
		)
		{
			$route_arr['type'] = 'old';
			$route_arr['content'] = isset($get["pg"]) ? $get["pg"] : $route[1];
			return $route_arr;			
		}

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
			case 'logout':
				$route_arr['type'] = 'logout';
				$route_arr['content'] = '';
				break;
			default:
				$route_arr['type'] = '';
				$route_arr['content'] = '';
				break;
		}

		return $route_arr;
	} 

}
		

?>