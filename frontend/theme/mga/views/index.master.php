<!DOCTYPE html>
<html lang="pt-BR">
  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

  	<?php echo $this->header_html(); ?> 

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Lista de Espera - Master Group Aprovar" />
    <meta property="og:url" content="http://mastergroupaprovar.com.br/" />
    <meta property="og:site_name" content="Master Group Aprovar - Inscrições" />

    <style type="text/css">
      img.wp-smiley,
      img.emoji {
      	display: inline !important;
      	border: none !important;
      	box-shadow: none !important;
      	height: 1em !important;
      	width: 1em !important;
      	margin: 0 .07em !important;
      	vertical-align: -0.1em !important;
      	background: none !important;
      	padding: 0 !important;
      }

      body .bg-main{
        background-image:url( <?php $this->get_theme_path( 'imgs/bg-trailer.jpg', true ); ?> ); 
        background-color: #1e73be ; 
      }

    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link href='https://fonts.googleapis.com/css?family=Raleway:400,800,900,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/trueno" type="text/css" />

    <link rel="stylesheet" href="<?php $this->get_theme_path( 'assets/main/main.css', true ); ?>">

    <script src="<?php $this->get_theme_path( 'assets/main/main.js', true ); ?>"></script>
    <!-- sweet alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.js"></script>
    
    
    <?php $this->out( $this->infos->html_header, ['type'=>'html']); ?>

  </head>

  <body class="home page-template page-template-page-templates page-template-list page-template-page-templateslist-php page page-id-14 header-image">
  
    <?php $this->out( $this->infos->html_pre_body, ['type'=>'html']); ?>

    <br style="display:none;">

    <div class="bg-main">

      <main class="main-content">
        
        <header class="main-header">

          <div class="container">
            <img src="<?php $this->get_theme_path( 'imgs/logo.png', true ); ?>" alt="Logotipo Master Group Aprovar" class="main-logo">  
            <h1>Inscrições Encerradas</h1>
            <p class="intro">Mais uma turma do Master Group Aprovar completa!<br />Para garantir a máxima qualidade e preparação em nosso Master Group as vagas são limitadas a 20 pessoas por turma, se inscreva abaixo e receba nosso link assim que iniciarmos a pré-venda da próxima turma.</p>
          </div>

        </header>

        <hr class="hr-hidden hr-xs">

        <article class="container text-center">

          <div id="mc_embed_signup ">
            <h3></h3>

            <?php if( $this->message == '' ){ ?>
            <form method="post" class="validate form-inline form-couple mc-form" onsubmit="fbq('track', 'CompleteRegistration')">

                <div class="form-group">
                  
                  <input type="hidden" name="cod_lista" value="3">
                  <input type="hidden" name="ref" value="<?php $this->out( $this->get_param('ref') ); ?>">
                  
                  <input type="email" name="email" class="form-control input-lg required email" placeholder="Qual seu e-mail?" required="required">
                  
                  <input type="submit" id="track-cta-1" class="btn btn-primary btn-lg" value="Inscreva-se" name="subscribe" id="mc-embedded-subscribe" class="button">
                
                </div>

                <p class="list-out">Seu e-mail está 100% seguro.</p>

                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                  <input type="text" CompleteRegistration="b_c17ba392b5bb70bf966ac9589_6486cd27b5" tabindex="-1" value="">
                </div>

              </div>

            </form>
            <?php } else { ?>
              <center>
                <?php $this->out($this->message); ?>
              </center>
            <?php } ?>

          </div>

        </article>

      </main>

    </div>

    <?php $this->out( $this->infos->html_pos_body, ['type'=>'html']); ?>

  </body>

</html>

