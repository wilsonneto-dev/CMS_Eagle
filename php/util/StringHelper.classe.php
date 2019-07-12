<?php

class StringHelper
{
	public static function underscore($string, $replace = "_") 
	{
	    return strtolower(preg_replace('/(?<!^)[A-Z]+|(?<!^|\d)[\d]+/', $replace.'$0', $string));
	}

	public static function camel_case($str) 
	{
	    $i = array("-","_");
	    $str = preg_replace('/([a-z])([A-Z])/', "\\1 \\2", $str);
	    $str = preg_replace('@[^a-zA-Z0-9\-_ ]+@', '', $str);
	    $str = str_replace($i, ' ', $str);
	    $str = str_replace(' ', '', ucwords(strtolower($str)));
	    // $str = strtolower(substr($str,0,1)).substr($str,1);
	    return $str;
	}

	public static function label($str) 
	{
	    $i = array("-","_");
	    $str = preg_replace('/([a-z])([A-Z])/', "\\1 \\2", $str);
	    $str = preg_replace('@[^a-zA-Z0-9\-_ ]+@', '', $str);
	    $str = str_replace($i, ' ', $str);
	    $str = str_replace(' ', ' ', ucwords(strtolower($str)));
	    // $str = strtolower(substr($str,0,1)).substr($str,1);
	    return $str;
	}

}

?>