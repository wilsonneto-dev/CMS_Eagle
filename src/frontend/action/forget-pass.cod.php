<?php

    $this->title = $this->cfg["app_name"];
    $this->class_bg = 'bg_forget';
    
    try {

        if($this->is_post())
        {
    
            #region verificacoes
            /* verificações */
    
            // tudo preenchido ?
            if( ! FormHelper::validate_not_empty( $this->get_param('email') ))
            throw new Exception("Preencha todos os campos", 1);

            #endregion verificacoes
    
            #region admin existe?

            $admin = Admin::get([ 'email' => $this->get_param('email') ]);
            
            if($admin == false)
            {
                throw new Exception("Usuário não cadastrado", 1);
            }
            
            #endregion
    
            #region gerar token e link
            
            // criar token
            $token = (GeneralHelper::gerar_hash(15));
            $admin->token = $token;
            $admin->save();

            #endregion save
    
            // enviar token no e-mail
            Email::send_pass_token($token, $admin->email);

            $this->redirect( "/access/forget-pass-token?email=".$admin->email );

    
        }
    } catch (Exception $ex) {
        $this->message($ex->getMessage(), 'error' );
    }
    