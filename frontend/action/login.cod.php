<?php

    $this->title = $this->cfg["app_name"];
    $this->class_bg = 'bg_login';
    
    try {
        if($this->is_post())
        {
    
            #region verificacoes
            /* verificações */
    
            // tudo preenchido ?
            if( ! FormHelper::validate_not_empty(
                $this->get_param('pass'), 
                $this->get_param('email')
            ))
            throw new Exception("Preencha todos os campos", 1);

            #endregion verificacoes
    
            #region login

            $admin = Admin::get([ 'email' => $this->get_param('email'), 'senha' => $this->get_param('pass') ]);
            
            if($admin == false)
            {
                throw new Exception("Usuário ou senha inválidos", 1);
            }
            
            #endregion
    
            #region recuperar dados e salvar na sessão

            $elo = AdminProjetoWorkspace::get_all(['cod_admin' => $admin->id]);
            $group_admin = GrupoAdmin::get($admin->cod_group_admin);
            
            // verifica se este usuário participa de mais de um workspace
            if(count($elo) > 1)
            {

                // mais de um workspace, vai para tela onde seleciona qual
                $this->save_credentials($admin, $group_admin);
                $this->redirect("/access/workspace_select");
            
            } else {
            
                // apenas um workspace, vai para o dashboard
                $workspace = ProjetoWorkspace::get($elo->cod_projeto_workspace);
                $this->save_credentials($admin, $group_admin, $workspace);
                $this->message("Login realizado com sucesso!", "success");
                $this->redirect("/view/dashboard");
            
            }

            #endregion save
    
    
        }
    } catch (Exception $ex) {
        $this->message($ex->getMessage(), 'error' );
    }
    