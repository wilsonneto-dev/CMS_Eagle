<?php

class DbAdapterMy 
{
    public function getCreateTableSQL(ModelBase $model)
    {
        $tableDDL = "create table ". $model->get_source() . " ";
        $fields = [];
        foreach ($model->get_data() as $field_name => $field_data)
        {
            $fields[] = $this->getCreationField($field_name, $field_data);
        }

        $extraFieldsDDL = ", ativo tinyint(1) DEFAULT '1',
        datacadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        codprojeto int(11) DEFAULT 1";

        $finalDDL = "{$tableDDL} (".join($fields, ", ").$extraFieldsDDL.") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        return $finalDDL;
    }

    public function getCreationField($field, $data) 
    {
        $fieldDDL = "$field ";
        $fieldDDL .= $this->getDataDefinition($data);
        if($field == "id")
        {
            $fieldDDL .= " primary key not null auto_increment";
        }
        return $fieldDDL;
    }

    public function getDataDefinition($data) 
    {
        // var_dump($data);
        $dataDef = "";
        switch($data["type"])
        {
            case "varchar":
            case "email":
            case "url":
            case "phone":
            case "link":
            case "color":
            case "file":
            case "image":
            case "enum":
                $dataDef .= "varchar(".$data["length"].")";
            break;

            /* decimals */
            case "decimal":
            case "price":
                $dataDef .= "decimal(15,2)";
            break;

            /* ints */
            case "num":
            case "number":
            case "int":
                $dataDef .= "int(".$data["length"].")";
            break;

            /* date */
            case "date":
            case "data":
                $dataDef .= "date";
            break;

            /* texts */
            case "text":
            case "text-m":
            case "textarea":
            case "textarea-m":
            case "editor":
                $dataDef .= "text";
            break;

            /* boolean */
            case "checkbox":
                $dataDef .= "int(1)";
            break;

            default:
                $dataDef .= "varchar(".$data["length"].")";
            break;

            // case "password":
            // case "location":
            // case "pop-list":
            // case "sql-select":
            // case "foreign":    
            // case "select":
        }

        return $dataDef;
    }
}

?>