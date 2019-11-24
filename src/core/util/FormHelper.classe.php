<?php

class FormHelper
{
	public static function validate_not_empty()
    {
        foreach(func_get_args() as $arg)
        {
            if(empty($arg))
                return false;
            else
                continue;
        }
        return true;
    }
    
}

?>