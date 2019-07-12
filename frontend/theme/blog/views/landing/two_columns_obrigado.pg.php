<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="keywords" content="" />
	<link rel="icon" type="image/ico" href="images/favicon.ico"/>

	<title><?php $this->out( $this->obj->titulo_header ); ?></title>

	<meta name="description" content="<?php $this->out( $this->obj->descricao ); ?>" />

	<link rel="stylesheet" href="/frontend/theme/blog/assets/landing/two_columns/css/css-vendor.css" type="text/css">
	<link rel="stylesheet" href="/frontend/theme/blog/assets/landing/two_columns/css/style-original-not-shareable.css" type="text/css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

	<?php $this->out( $this->infos->html_header, ['type'=>'html']); ?>

</head>
<body>

	<?php $this->out( $this->infos->html_pre_body, ['type'=>'html']); ?>
	<div class="page-wrap">
	 
	  <div class="page-wrap__inner">
	    
	    <div id="content" class="container-fluid container-guttered" role="main" tabindex="-1">
	 
			<div class="parsys contentpar">
	        <div class="hero banners">
	          <div class="hero-banner-wrapper full">
	            <div class="col-lg-12 col-md-12 col-sm-12 vcenter"> <img src="/<?php $this->out( $this->obj->imagem_topo ); ?>" alt="Banner" title="Banner" class="img-responsive"></div>
	          </div>
	        </div>

	        <div class="row colctrl__row">
	          
	          <div class="col-lg-12 col-md-12 col-sm-12 vcenter">
	            <div class="left-outer" style="padding: 20px 100px 50px 100px;">
	
			    <?php $this->out_if(
			    	$this->obj->url,
			    	'<a type="submit" target="_blank" href="/download/landing/#inner" class="cta btn grey-dark" id="btn-submit"> 
			    		<span class="btn-copy">Efetuar Download</span> 
			    		<span class="btn-cta"> <span class="icon-default"></span> </span>
		    		 </a>',
		    		 in_array($this->obj->tipo, ['download'])
			    ) ?>

			    <?php $this->out_if(
			    	$this->obj->oferta_botao_link,
			    	'<a type="submit" target="_blank" href="#inner" class="cta btn grey-dark" id="btn-submit"> 
			    		<span class="btn-copy">'.$this->obj->oferta_botao_texto.'</span> 
			    		<span class="btn-cta"> <span class="icon-default"></span> </span>
		    		 </a>',
		    		 1
			    ) ?>

			      <br /><br />
	              <div class="rich-text">
	                <div class="textindent">
	                  <h2><?php $this->out( $this->obj->titulo_agradecimento ); ?></h2>
	                  
	                  <p>
	                  	<?php $this->out( $this->obj->texto_agradecimento ); ?>
	                  </p>

	                </div>
	              </div>
	            </div>
	          </div>
	          
	        </div>
	      
	      </div>


	    </div>


		<footer class="footer-distributed">

<div class="footer-left">

	<a href="/">
		<img src="<?php $this->get_theme_path( 'imgs/logo-landing-2-cols.png', true ); ?>" alt="Ronaldo B Dutra" />
	</a>

	<p style="margin-top: 20px;" class="footer-company-name">Ronaldo Bitencourt Dutra &copy; <?php $this->out(date("Y")); ?> - CNPJ: 26.759.732/0001-53
		<br><br>Ronaldo Bitencourt Dutra irá compartilhar a experiência de quem passou por todos os desafios que você está passando e que irá passar e acumulou várias aprovações e cargos, entre eles aprovado em 1º lugar para Procurador de Mirassol e em 3º lugar para Procurador de São José do Rio Preto.
	</p>

	<p class="footer-links">
		<a href="http://www.ronaldobdutra.com.br" target="_blank">Blog</a>.
		<a href="http://www.ronaldobdutra.com.br/ja-passei" target="_blank">Programa Já Passei!</a>.
		<a href="http://www.ronaldobdutra.com.br/palestra" target="_blank">Palestra</a>.
		<a href="http://www.ronaldobdutra.com.br/aula" target="_blank">Aula Online</a>
	</p>

</div>

<div class="footer-center">

	<div>
		<i class="fa fa-phone"></i>
		<p>17 4141-4248</p>
	</div>

	<div>
		<i class="fa fa-comment"></i>
		<p>17 98834-4364</p>
	</div>

	<div>
		<i class="fa fa-envelope"></i>
		<p><a href="mailto:contato@dsacao.com.br">contato@dsacao.com.br</a></p>
	</div>

	<div>
		<i class="fa fa-map-marker"></i>
		<p><span>Av. Romeu Strazzi, 325, Sala 904</span> S. J. do Rio Preto, São Paulo</p>
	</div>


</div>

<div class="footer-right">

	<div class="footer-icons" style="margin-top: 0px; margin-bottom: 25px;">
		<a href="https://www.facebook.com/ronaldobdutracoach/" target="_blank"><i class="fa fa-facebook"></i></a>
		<a href="https://www.instagram.com/ronaldo_coach/" target="_blank"><i class="fa fa-instagram" target="_blank"></i></a>
		<a href="http://www.ronaldobdutra.com.br/" target="_blank"><i class="fa fa-link" target="_blank"></i></a>
	</div>

	<p class="footer-company-about">
		<span>Programa Já Passei!</span>
		Programa Já Passei! é feito para aqueles que querem ser aprovados em concursos! Com duração de 5 meses, serão 10 sessões, de mentoria e de coaching, acompanhamento individual e técnicas de aprendizado acelerado para você otimizar sua preparação e conquistar sua aprovação!
	</p>

</div>

</footer>


	  </div>
	</div>

	<?php $this->out( $this->infos->html_pos_body, ['type'=>'html']); ?>

</body>
</html>