                        <div class="header" style="color: gray; background-color: transparent; box-shadow: none; border: 0px;">
                            <img style="width: 60px;" src="/frontend/theme/app_imgs/logo.png" />
                            <br>
                        </div>
                        <form action="" method="post">
                            <div class="body" style="border: 1px solid white; border-top: 0;">
                                <div class="form-group" style="margin-top: 0;">
                                    <input autofocus type="text" name="email" required class="form-control input-lg border-g" placeholder="e-mail" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="pass" required class="form-control input-lg border-g" placeholder="senha" />
                                </div>
                                <input type="text" name="teste" placeholder="pass" class="some" />
                            </div>
                            <div class="footer" style="text-align: right;">
                                <button type="submit" class="btn btn-lg btn-success btn-block">logar</button>

                                
                                <?php if(AppConfig::get()['others']['social-login']) { ?> 
                                    <div class="social-auth-links text-center">
                                        <p>- ou -</p>
                                        <a href="#" class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook" style="font-size: 1em !important"></i>
                                            Logar com Facebook
                                        </a>
                                        <!-- a href="#" class="btn btn-block btn-social btn-google"><i class="fa fa-google-plus" style="font-size: 1em !important"></i>
                                            Logar com Google
                                        </a -->
                                    </div>
                                    <!-- /.social-auth-links -->
                                    <br>
                                <?php } ?>

                                <?php if(AppConfig::get()['others']['create-account']) { ?> 
                                    <a href="/access/forget-pass">Esqueci a senha</a><br>
                                    <a href="/access/register" class="text-center">Criar conta</a>
                                <?php } ?>
                                
                            </div>

                        </form>

<script>
    window.fbAsyncInit = function() {
        
        FB.init({
            appId      : '149270536016951',
            cookie     : true,
            xfbml      : true,
            version    : 'v3.3'
        });
            
        FB.AppEvents.logPageView();   
    };
</script>