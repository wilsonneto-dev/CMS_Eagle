<?php

class ArrayHelper
{
	public static function get($arr, $prop, $default = null)
	{
		if(isset($arr[$prop]))
		{
			return $arr[$prop];
		}
		else
		{
			return $default;
		}
	}
}


?>