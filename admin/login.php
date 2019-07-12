<?php 

    $alert = "";

    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        // verifica o "testar"
        if( $_POST["teste"] != "" ){
            $alert = AdminViews::alert( "Requisi&ccedil;&atilde;o negada!","Verifique os dados inseridos.<br />Seus dados foram registrados para uma poss&iacute;vel auditoria, ip: ".$_SERVER["REMOTE_ADDR"].", data: ".date("d/m/Y H.i.s")."","danger" ); 
        } else {
            // testa o login
            // $adm = Admin::_logar( $_POST["email"],  $_POST["pass"] );
            $adm = Admin::get(['email' => $_POST["email"], 'senha' => $_POST["pass"] ]);

            if( $adm == null ){
                // mensagem de acesso negado e salvar log
                $alert = AdminViews::alert( "Acesso negado!","Verifique o e-mail e senha inseridos.<br />Seus dados foram registrados para uma poss&iacute;vel auditoria, ip: ".$_SERVER["REMOTE_ADDR"].", data: ".date("d/m/Y H.i.s")."","danger" ); 
                LogAdmin::_salvar( "Tentativa de login com e-mail \"".$_POST["email"]."\" falhou.", "Login", '', '', 0, 0);
            } 
            else 
            {
                if($adm->bloqueado == 1)
                {
                    $alert = AdminViews::alert( "Acesso bloqueado!","Entre em contato com o administrador para mais detalhes.<br />Seus dados foram registrados para uma poss&iacute;vel auditoria, ip: ".$_SERVER["REMOTE_ADDR"].", data: ".date("d/m/Y H.i.s")."","danger" ); 
                    LogAdmin::_salvar( "Usu&aacute;rio \"".$adm->nome."\", e-mail \"".$_POST["email"]."\" tentou efetuar logou, mas está bloqueado.", "Login", '', '', 0, 0);
                } else {
                    // logou
                    LogAdmin::_salvar( "Usu&aacute;rio \"".$adm->nome."\", e-mail \"".$_POST["email"]."\" logou.", "Login", "", "", ($adm->id != '') ? $adm->id  : '0', 0 );
                    // salvar o admin na sessão
                    $_SESSION["admin"] = $adm;
                    // $adm->atualizar_ultimo_acesso();
                    // salvar o grupo
                    $grupo = GrupoAdminOld::_get( $adm->cod_grupo_admin );
                    $_SESSION["admin_grupo"] = $grupo;
                    // salvar permissões na sessão
                    $_SESSION["admin_permissoes"] = PaginaAdminOld::_getListaPermissoesByGrupoMenu($adm->cod_grupo_admin);
                    // salvar o menu
                    $_SESSION["admin_menu_html"] = AdminViews::gerar_menu( $adm->cod_grupo_admin );
                    // salvar as notificações gerais
                    $_SESSION["admin_notificacoes_gerais_html"] = AdminViews::gerar_notificacoes_gerais( $adm->id );
                    // redirecionar
                    $pg = PaginaAdminOld::_get( $grupo->cod_pagina_admin );
                    if($pg->url == '')
                        $pg->url = 'admin/';
                    header( "Location: /" . $pg->url );
                    exit;
                }
            }
        }

    } else {
        // se não foi tentativa de logar, destruir sessões anteriores
        unset( 
            $_SESSION["admin"], 
            $_SESSION["admin_notificacoes_gerais_html"],
            $_SESSION["admin_menu_html"],
            $_SESSION["admin_grupo"],
            $_SESSION["admin_permissoes"]
        ); 
    }
    
    $info = Info::get();

?>
<!DOCTYPE html>
<html style="background-image: url(/admin/theme/img/bg-login.jpg); background-size: cover; ">
    <head>
        <meta charset="UTF-8">
        <title>Eagle CMS - login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="/admin/theme/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/theme/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/theme/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
        <link rel="shortcut icon" href="theme/img/admin.png" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="/admin/theme/js/html5shiv.js"></script>
          <script src="/admin/theme/js/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body style="background-color: transparent;">

        <div class="login-wrapper">    

            <div class="form-box" id="login-box">
                <div class="header bg-gray" style="color: gray; box-shadow: none; border: 1px solid white; border-bottom: 0;">
                    <?php if($info->logo_header != '') { echo '<img style="width: 60px;" src="/'.$info->logo_header.'" />'; } ?>
                    <br>
                    Eagle CMS
                </div>
                <form action="" method="post">
                    <div class="body bg-gray" style="border: 1px solid white; border-top: 0;">
                        <div class="form-group" style="margin-top: 0;">
                            <input autofocus type="text" name="email" required class="form-control" placeholder="e-mail"/>
                        </div>
                        <div class="form-group">
                            <input type="password" name="pass" required class="form-control" placeholder="pass"/>
                        </div>          
                        <input type="text" name="teste" placeholder="pass" class="some" />
                    </div>
                    <div class="footer" style="text-align: right;">    
                        <button type="submit" class="btn btn-primary btn-block">logar</button>
                    </div>
                </form>
            </div>
            <br />
            <?php echo $alert; ?>     
        
        </div>

        <script src="/admin/theme/js/jquery.min.js"></script>
        <script src="/admin/theme/js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>