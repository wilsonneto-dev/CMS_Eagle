                            <div class="header" style="color: gray; background-color: transparent; box-shadow: none; border: 0px;">
                                <img style="width: 60px;" src="/frontend/theme/app_imgs/logo.png" />
                                <br>
                                Atualize a Senha
                            </div>
                            <form action="" method="post">
                            <p>
                                Enviamos um e-mail com o token. Insira o token e a nova senha.
                            </p>
                            <div class="body" style="border: 1px solid white; border-top: 0;">

                                <div class="form-group" style="margin-top: 0;">
                                    <input autofocus type="text" name="token" required class="form-control input-lg border-g" placeholder="Token"/>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="pass" required class="form-control input-lg border-g" placeholder="senha"/>
                                </div>          
                                
                                <div class="form-group">
                                    <input type="password" name="pass_confirm" required class="form-control input-lg border-g" placeholder="Confirmar senha"/>
                                </div> 

                            </div>
                            <div class="footer" style="text-align: right;">    
                                <button type="submit" class="btn btn-lg btn-success btn-block">Atualizar Senha</button>
                                <br>
                                <a href="/access/login">Login</a><br>
                                <a href="/access/register" class="text-center">Criar conta</a>

                            </div>
                            
                        </form>
