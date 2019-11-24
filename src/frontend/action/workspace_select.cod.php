<?php

$this->title = $this->cfg["app_name"];
$this->class_bg = 'bg_login';

// se não está logado no usuário vai para a página de logar antes de escolher o workspace
if($this->credentials[admin] == null)
    $this->redirect("/access/login");

$admin = $this->get_credentials('admin');
$elo = AdminProjetoWorkspace::get_all(['cod_admin' => $admin->id]);

// verifica se este usuário participa de mais de um workspace
if(count($elo) > 1)
{

    $arr_workspaces = [];
    foreach ($elo as $k => $v) {
        $workspace = ProjetoWorkspace::get($v->cod_projeto_workspace);
        if($workspace)
            $arr_workspaces[$workspace->id] = $workspace->nome;
    }

    $this->v->arr_workspaces = $arr_workspaces;

} else {

    // apenas um workspace, vai para o dashboard
    $workspace = ProjetoWorkspace::get($elo->cod_projeto_workspace);
    $this->save_credentials_workspace( $workspace );
    $this->redirect("/view/dashboard");

}

try {

    // usuário selecionou o workspace
    if($this->is_post())
    {

        // validações
        if( ! FormHelper::validate_not_empty( $this->get_param('cod_workspace') ))
            throw new Exception("Preencha todos os campos", 1);

        $workspace = ProjetoWorkspace::get($this->get_param('cod_workspace'));

        if(!$workspace)
            throw new Exception("Workspace Inválido", 1);

        // verifica se este usuário tem permissão no workspace
        if( ! in_array($workspace->id, array_keys($this->v->arr_workspaces)))
            throw new Exception("Você não possui permissão neste workspace selecionado", 1);

        // tendo permissão, salva na sessão e vai pro dashboard
        $this->save_credentials_workspace($workspace);
        $this->message("Login realizado com sucesso!", "success");
        $this->redirect("/view/dashboard");

    }
} catch (Exception $ex) {
    $this->message($ex->getMessage(), 'error' );
}

?>