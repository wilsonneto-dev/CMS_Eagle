<?php

class EnvironmentUtils
{
	public static function is_local()
	{
		return 
		( 
			$_SERVER['REMOTE_ADDR'] == '127.0.0.1' 
			|| $_SERVER['REMOTE_ADDR'] == '::1'
		);
	}
}

?>