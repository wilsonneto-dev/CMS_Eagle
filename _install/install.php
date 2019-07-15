<?php

chdir ( "../" );
include_once "php/autoload.php";

AppConfig::load_from_file();
AppConfig::load_from_file("_install/install.json");

$bootstrap_script = file_get_contents("_install/struct.bootstrap.sql");
$bootstrap_script .= file_get_contents("_install/data.bootstrap.sql");

// replace vars in scripts
$bootstrap_script = str_replace('{{root_user_name}}', AppConfig::get()['install']['root_user_name'], $bootstrap_script);
$bootstrap_script = str_replace('{{root_user}}', AppConfig::get()['install']['root_user'], $bootstrap_script);
$bootstrap_script = str_replace('{{root_pass}}', AppConfig::get()['install']['root_pass'], $bootstrap_script);

// explode queries
$query_array = explode(';', $bootstrap_script);
$i = 0;

$ctx = BaseDao::multi_query( $bootstrap_script );
echo "Multi Query Initialized...<br /><br />";

while ($result = $ctx->next_result())
{
    $i++;
    echo $query_array[$i] . "<br />";
    var_dump($result);
    echo "<br /><br />";
    
    // flush
    @ob_end_flush();
    @flush();
    
    if(!$ctx->more_results())
        break;

}

if($ctx->errno > 0){
    echo "* Erro: ". $ctx->error."<br />";
    echo "* Finalizado por erro.<br />";
    exit();
}

echo "Eagle Bootstrap Install OK...<br /><br />";
    
?>