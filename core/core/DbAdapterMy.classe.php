<?php

class DbAdapterMy 
{
    public function getCreateTableSQL(ModelBase $model)
    {
        var_dump( $model->options );
    }
}

?>