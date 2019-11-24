<?php

    $this->title = $this->cfg["app_name"];
    $this->class_bg = 'bg_forget';
    
    try {

        if($this->is_post())
        {
    
            #region verificacoes
            /* verificações */
    
            // tudo preenchido ?
            if( ! FormHelper::validate_not_empty( 
                $this->get_param('email'), 
                $this->get_param('token'), 
                $this->get_param('pass'), 
                $this->get_param('pass_confirm')  
            ))
            throw new Exception("Preencha todos os campos", 1);

            #endregion verificacoes
    
            #region admin existe?

            $admin = Admin::get([ 'email' => $this->get_param('email') ]);
            
            if($admin == false)
            {
                throw new Exception("Usuário não cadastrado", 1);
            }
            
            #endregion
    
            // valida o token
            $token = $this->get_param('token');
            if( $admin->token != $token)
            {
                throw new Exception("Token Incorreto", 1);
            }
            
            // verifica se as senhas são iguais
            if($this->get_param('pass') != $this->get_param('pass_confirm'))
            {
                throw new Exception("Confirme a senha corretamente", 1);
            }

            // atualiza a senha e redireciona pro login
            $admin->senha = $this->get_param('pass');

            // salva
            $admin->save();

            // msg
            $this->message('Atualzado com sucesso!', 'success' );

            // redireciona
            $this->redirect( "/access/login");

    
        }
    } catch (Exception $ex) {
        $this->message($ex->getMessage(), 'error' );
    }
    