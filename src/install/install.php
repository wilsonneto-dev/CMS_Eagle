<?php

include("./aux.php");

chdir ( "../" );

include_once "./core/autoload.php";

AppConfig::load_from_file();
AppConfig::load_from_file("install/install.json");

$bootstrap_script = file_get_contents("install/struct.bootstrap.sql");
$bootstrap_script .= file_get_contents("install/data.bootstrap.sql");

// replace vars in scripts
$bootstrap_script = str_replace('{{root_user_name}}', AppConfig::get()['install']['root_user_name'], $bootstrap_script);
$bootstrap_script = str_replace('{{root_user}}', AppConfig::get()['install']['root_user'], $bootstrap_script);
$bootstrap_script = str_replace('{{root_pass}}', AppConfig::get()['install']['root_pass'], $bootstrap_script);

if(AppConfig::get()['install']['menu_admin_add'])
{
    $dmlExtraMenuAdmin = "INSERT INTO menu_admin(id, icone, texto, ordem) VALUES ";
    $dmlExtraMenuAdmin .= join(AppConfig::get()['install']['menu_admin_add'], ',');
    $dmlExtraMenuAdmin .= ";";
    $bootstrap_script .= $dmlExtraMenuAdmin;
}

// explode queries
$query_array = explode(';', $bootstrap_script);
$i = 0;

$ctx = BaseDAO::multi_query( $bootstrap_script );
echo "Multi Query Initialized...<br /><br />";

while ($result = $ctx->next_result())
{
    $i++;
    ok($query_array[$i]);
    var_dump($result);
    echo "<br /><br />";
    
    // flush
    @ob_end_flush();
    @flush();
    
    if(!$ctx->more_results())
        break;

}

if($ctx->errno > 0){
    err("* Erro: ". $ctx->error);
    err("* Finalizado por erro");
    exit();
}

echo "Eagle Bootstrap Install OK...<br /><br />";
    
?>