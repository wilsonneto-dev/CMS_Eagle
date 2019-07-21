<?php

class AppConfig{
    
    private static $config = null;

    public static function get()
    {
        if(self::$config == null){
            self::load_from_file();
        }

        return (self::$config);
    }

    public static function load_from_file($file = "appsettings.json")
    {
        if(file_exists($file))
        {
            $config = file_get_contents($file);
            $arr_config = json_decode($config, true);
            if(self::$config == null)
                self::$config = $arr_config;
            else
               self::$config = array_merge(self::$config, $arr_config);    
        }
    }

}

?>

