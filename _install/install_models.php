<?php
 
chdir ( "../" );
include_once "core/autoload.php";

AppConfig::load_from_file();
AppConfig::load_from_file("_install/install.json");

if( isset( AppConfig::get()["install"]["models"] ))
{
    $models = AppConfig::get()["install"]["models"];
    // echo( json_encode( $models , JSON_PRETTY_PRINT ) );

    $DbAdapter = new DbAdapterMy();

    foreach ($models as $k => $v) {
        echo "Instalando $k <br /><br />";
        
        $retorno = $DbAdapter->getCreateTableSQL(new $k());

        // flush
        @ob_end_flush();
        @flush();

    }

    echo "install OK...";

}

?>