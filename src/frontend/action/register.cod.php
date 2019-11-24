<?php

$group_admin_default = GrupoAdmin::get(['padrao' => 1]);

// echo json_encode($group_admin_default->get_foreigns());

// die();

$this->title = $this->cfg["app_name"];
$this->class_bg = 'bg_register';
    
try {
    if($this->is_post())
    {

        #region verificacoes
        /* verificações */

        // tudo preenchido ?
        if( ! FormHelper::validate_not_empty(
            $this->get_param('pass'), 
            $this->get_param('project'),
            $this->get_param('name'),
            $this->get_param('email')
        ))
        throw new Exception("Preencha todos os campos", 1);

        // verificar pass
        if($this->get_param('pass') != $this->get_param('pass_confirm'))
        {
            throw new Exception("Confirme a senha corretamente", 1);
        }

        // verificar se já existe este usuário
        $admin = Admin::get([ 'email' => $this->get_param('email') ]);
        if($admin != false)
        {
            throw new Exception("Este e-mail já consta em nossa base de dados. Faça login ou recupere a senha para acessar", 1);
        }

        #endregion verificacoes

        #region save
        /* salvar o workspace, o usuario e vincular os dois */
        
        $projeto = new ProjetoWorkspace();
        $projeto->nome = $this->get_param('project');
        $projeto->hash = GeneralHelper::gerar_hash(35);
        $projeto->save();

        $group_admin_default = GrupoAdmin::get(['padrao' => 1]);
        
        $admin = new Admin();
        $admin->nome = $this->get_param('name');
        $admin->email = $this->get_param('email');
        $admin->senha = $this->get_param('pass');
        $admin->bloqueado = 0;
        $admin->codprojeto = $projeto->id;
        $admin->cod_grupo_admin = $group_admin_default->id;
        $admin->save();

        // atualizar com o código do admin proprietário o workspace
        $projeto->cod_admin = $admin->id;
        $projeto->save();

        // elo entre workspace e o admin
        $elo = new AdminProjetoWorkspace();
        $elo->cod_projeto_workspace = $projeto->id;
        $elo->cod_admin = $admin->id;
        $elo->save();

        #endregion save

        #region salvar na sessão
  
        $this->save_credentials($admin, $group_admin_default, $projeto);

        #endregion

        $this->message("Cadastro realizado com sucesso!", "success");
        $this->redirect("/view/dashboard");

    }
} catch (Exception $ex) {
    $this->message($ex->getMessage(), 'error' );
}
