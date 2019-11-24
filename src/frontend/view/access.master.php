<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php $this->out($this->title) ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="/frontend/theme/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/frontend/theme/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/frontend/theme/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
        <link rel="shortcut icon" href="/frontend/theme/app_imgs/logo.png" />

        <!-- sweet alert -->
        <link rel="stylesheet" type="text/css" href="/frontend/theme/js/sweetalert/dist/sweetalert.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="/frontend/theme/js/html5shiv.js"></script>
          <script src="/frontend/theme/js/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body class="<?php $this->out($this->class_bg); ?>">

        <style>
            input.border-g{
                border: 1px solid #aaa !important;
            }
        </style>

        <div class="">
            <div class="row clearfix">
                <div class="col-md-4 full_height bg_white">
                    
                    <div class="login-wrapper">    

                        <div class="form-box" id="login-box">
                            
<?php $this->get_content_view(); ?>

                        </div>
                        <br />
                    </div>

                </div>
                <div class="col-md-8">
                </div>
                
            </div>
        </div>

        <script src="/frontend/theme/js/jquery.min.js"></script>
        <script src="/frontend/theme/js/bootstrap.min.js" type="text/javascript"></script>        

        <!-- sweet alert -->
        <script src="/frontend/theme/js/sweetalert/dist/sweetalert.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="/frontend/theme/js/sweetalert/dist/sweetalert.css">

        <script src="/frontend/theme/js/admin/main.js"></script>

        <?php 
            // echo $_SESSION["notification_remove"];
            if(isset( $_SESSION["notification_remove"]))
            {
                $ok = ($_SESSION["notification_remove"] == "ok");
                unset($_SESSION["notification_remove"]);
                if($ok) 
                	$this->add_onload_js("message('Excluido com sucesso.','sucess');");
                else 
                	$this->add_onload_js("message('Ocorreu um erro ao excluir.','error');");
            }
            $this->v->out($this->get_onload_js(true) , array( 'type' => 'html')); 
        ?>
        
    </body>
</html>