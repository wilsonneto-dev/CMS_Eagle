<?php
 
include("./aux.php");

chdir ( "../" );
include_once "core/autoload.php";

AppConfig::load_from_file();
AppConfig::load_from_file("install/install.json");

$jsonModels = file_get_contents("./models.json");
$models = json_decode($jsonModels, true);
$DbAdapter = new DbAdapterMy();
$index = 1;

foreach ($models as $model_name => $data) 
{
    try{
        echo "<h3><small>config</small> $model_name</h3>";

        $classModel = ModelGenerator::generate($model_name, $data);
        $ddlNewtableExec = $DbAdapter->getCreateTableSQL($classModel);
        
        BaseDAO::query($ddlNewtableExec);
        ok("tabela criada");

        $pg = new PaginaAdmin();
        $pg->url = "crud/{$classModel->get_source()}";
        $pg->descricao = $classModel->get_options("title_plural");
        $pg->cod_menu_admin = 2;
        $pg->posicao = ($index++)*10;
        $pg->target = "";
        $pg->permissao = $classModel->get_source();
        $pg->save();
    
        // (1, 'Usuários', 1, 'crud/admin', NULL, 7, 0, 'admin'),
        ok("pagina cadastrada na base");
        echo $pg->json();  
        
        $permissaoRoot = new GrupoPaginaAdmin();
        $permissaoRoot->cod_grupo_admin = 1;
        $permissaoRoot->cod_pagina_admin = $pg->id;
        $permissaoRoot->escrita = 1;
        $permissaoRoot->save();
        
        $permissaoAdmin = new GrupoPaginaAdmin();
        $permissaoAdmin->cod_grupo_admin = 2;
        $permissaoAdmin->cod_pagina_admin = $pg->id;
        $permissaoAdmin->escrita = 1;
        $permissaoAdmin->save();

        ok("permissões configuradas");
        echo $permissaoRoot->json() ." / ". $permissaoAdmin->json();
    }
    catch(Exception $ex) {
        err("exception");
        echo $ex->getMessage();
    }

    try {
        // try...
    }
    catch(Exception $ex) {
        err("exception");
        echo $ex->getMessage();
    }

    // flush
    @ob_end_flush();
    @flush();

    echo "<hr />";

};


echo "install models OK...";

?>