<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel</title>
    
        <link rel="shortcut icon" href="/frontend/theme/app_imgs/logo.png" />

        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="/frontend/theme/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/frontend/theme/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/frontend/theme/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="/frontend/theme/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="/frontend/theme/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- link href="/frontend/theme/js/datepicker/css/redmond/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" / -->
        <link href="/frontend/theme/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- link href="/frontend/theme/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" / -->
        <link href="/frontend/theme/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <link href="/frontend/theme/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="/frontend/theme/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- sweet alert -->
        <link rel="stylesheet" type="text/css" href="/frontend/theme/js/sweetalert/dist/sweetalert.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="/" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img class="icon" src="/frontend/theme/app_imgs/logo.png" style="height: 40px;" />
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Notificações -->
                        <?php $this->v->out($this->get_general_nitifications()); ?>
                        <!-- dados de usuário -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php $this->v->out( $this->get_credentials('admin')->nome ); ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <!-- div class="col-xs-8 text-center pull-right">
                                        <a href="#">Alterar Senha</a>
                                    </div -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="/admin/logout" class="btn btn-default btn-flat">Sair</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="/<?php if($this->get_credentials('admin')->imagem != "") $this->v->out( $this->get_credentials('admin')->imagem ); else $this->v->out( "frontend/theme/img/default-user.png" ) ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Olá, <?php $this->v->out( $this->get_credentials('admin')->nome ); ?></p>
                            <small>
                                <i class="fa fa-circle text-success"></i> 
                                <?php $this->v->out( $this->get_credentials('grupo_admin')->nome ); ?>
                            </small>
                            <!-- br />
                            <small>
                                <i class="fa fa-circle"></i> 
                                <?php $this->v->out( $this->get_credentials('workspace_nome')  ); ?>
                            </small -->
                        </div>
                    </div>

                    <!-- menu -->
                    <?php $this->v->out( $this->get_menu(), array( 'type' => 'html' ) ); ?>
                
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

<?php $this->get_content_view(); ?>

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 -->
        <script src="/frontend/theme/js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="/frontend/theme/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="/frontend/theme/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="/frontend/theme/js/raphael-min.js"></script>
        <script src="/frontend/theme/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="/frontend/theme/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="/frontend/theme/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="/frontend/theme/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="/frontend/theme/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <!-- script src="/frontend/theme/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script -->
        <!-- datepicker -->
        <!-- script src="/frontend/theme/js/datepicker/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script -->
        <script src="/frontend/theme/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script src="/frontend/theme/js/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="/frontend/theme/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="/frontend/theme/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- num -->
        <script src="/frontend/theme/js/jquery.num.js" type="text/javascript"></script>

        <!-- sweet alert -->
        <script src="/frontend/theme/js/sweetalert/dist/sweetalert.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="/frontend/theme/js/sweetalert/dist/sweetalert.css">
  
        <!-- main  -->
        <script type="text/javascript" src="/frontend/theme/js/admin/main.js"></script>
  
        <!-- AdminLTE App -->
        <script src="/frontend/theme/js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- fancybox -->
        <script type="text/javascript" src="/frontend/theme/js/fancybox2/jquery.fancybox.pack.js"></script>
        <link rel="stylesheet" href="/frontend/theme/js/fancybox2/jquery.fancybox.css" /> 

        <!-- CK Editor -->
        <script src="/frontend/theme/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) 
        <script src="/frontend/theme/js/AdminLTE/dashboard.js" type="text/javascript"></script>
        -->
        <!-- AdminLTE for demo purposes
        <script src="/frontend/theme/js/AdminLTE/demo.js" type="text/javascript"></script>
        -->

            <script>
                $(document).ready(function() {

                    <?php if(isset($this->menu_destaque)){ ?>
                        
                        $(".li-menu.<?php echo $this->menu_destaque; ?>").addClass("active");
                        $(".li-menu.<?php echo $this->menu_destaque; ?>")
                            .parents(".treeview-menu").css("display","block")
                            .parents("li.treeview").addClass("active");

                    <?php } ?>

                    $(".gallery_manager").sortable(
                    {
                        update : function(){ 
                            $(".order_input").val(
                                ( $( ".gallery_manager" ).sortable( "serialize", { key: "i", attribute: "id" } ) )
                            );
                        }

                    });
                    
                    // $( "#sortable" ).sortable({ placeholder: "ui-state-highlight" });
                    // $( "#sortable" ).disableSelection();
                });
            </script>

        <!-- DATA TABES SCRIPT -->
        <script src="/frontend/theme/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="/frontend/theme/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        
        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $('.data-table').dataTable({ "bPaginate": true, "bLengthChange": false, "bFilter": true, "bSort": true, "bInfo": false, "bAutoWidth": false });
                $('.data').datepicker({ language : "pt-BR", format: "dd/mm/yyyy" });
                try{ 
                    CKEDITOR.replace('editor_html');
                }catch(ex){}
            });
        </script>

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

