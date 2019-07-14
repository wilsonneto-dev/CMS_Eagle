                        <div class="header" style="color: gray; background-color: transparent; box-shadow: none; border: 0px;">
                            <img style="width: 60px;" src="/frontend/theme/app_imgs/logo.png" />
                            <br>
                        </div>

                        <form action="" method="post">
                            <div class="body" style="border: 1px solid white; border-top: 0;">
                                
                                <?php $this->form_field( [
                                    'type' => 'select', 
                                    'name' => 'cod_workspace',
                                    'options' => $this->v->arr_workspaces,
                                    'label' => 'Selecione o Projeto'
                                    ], 1 ); ?>
                                    
                            </div>

                            <div class="footer" style="text-align: right;">    
                                <button type="submit" class="btn btn-lg btn-success btn-block">Continuar</button>
                            </div>
                            
                        </form>
