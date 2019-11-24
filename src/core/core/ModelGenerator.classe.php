<?php

class ModelGenerator {

    static function generate($name, $data) 
    {
        $obj = new ModelBase();
        $obj->initialize();
        
        $obj->set_source(StringHelper::underscore( $name ));

        if(array_key_exists("options", $data))
        {
            $obj->set_options($data["options"]);
        }
        else
        {
            $obj->set_options([]);
        }

        if(array_key_exists("properties", $data))
        {
            $obj->set_properties($data["properties"]);
        } else {
            $obj->set_properties($data);
        }

        return $obj;    
    } 

    static function get_models($model_name = null)
    {
        $jsonModels = file_get_contents("./models.json");
        $models = json_decode($jsonModels, true);

        if($model_name != null)
        {
            if(key_exists($model_name, $models)){
                return ModelGenerator::generate($model_name, $models[$model_name]);
            }else{
                return null;
            }
        }else{
            return $models;
        }
    }

}

?>