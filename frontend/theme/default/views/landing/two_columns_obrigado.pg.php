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

	<link rel="stylesheet" href="/frontend/theme/default/assets/landing/two_columns/css/css-vendor.css" type="text/css">
	<link rel="stylesheet" href="/frontend/theme/default/assets/landing/two_columns/css/style-original-not-shareable.css" type="text/css">

	<style type="text/css">
		
		.btn.grey-dark {
    		background-color: rgb(0, 165, 20);
		}

		.btn.grey-dark:hover {
    		background-color: rgb(0, 100, 00);
		}
		
		.promotional {
		    background: transparent !important;
		    padding: 15px !important;
		}

	</style>

</head>
<body>

	<div class="page-wrap">
	 
	  <div class="page-wrap__inner">
	    
	    <header class="container-fluid">
	      <div id="sticky-header-nav">
	        <nav class="main-nav" role="navigation">
	          <div class="logo"> <a href="http://dsacao.com.br" title="D&S Ação"><img style="height: 35px;" src="/frontend/theme/default/assets/landing/logo.png"></a></div>
	        </nav>
	      </div>
	    </header>

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

			      <br /><br />
	              <div class="rich-text">
	                <div class="textindent">
	                  <h2><?php $this->out( $this->obj->titulo_agradecimento ); ?></h2>
	                  
	                  <p>
	                  	<?php $this->out( $this->obj->texto_agradecimento ); ?>
	                  </p>

	                </div>
	              </div>

	              <?php if($this->obj->oferta == 1){ ?>
			      
			      <br /><br />
	              <div class="rich-text promotional">
	                <div class="textindent">
	                	<center>
	                  		<h2><?php $this->out( $this->obj->oferta_titulo ); ?></h2>
	                  	</center>
		                <p>
		                	<?php $this->out( $this->obj->oferta_texto ); ?>
		                </p>

		                <?php $this->out_if
						(
							$this->obj->oferta_video,
						    '<div style="text-align: center;">
						    	<br />
								<iframe width="560" height="315" src="#inner" frameborder="0" allowfullscreen></iframe>
							</div>',
							$this->obj->oferta_video != ''
						); ?>

	                  	<?php $this->out_if(
					    	'ok',
					    	'
					    	<center style="margin-bottom: 5px;">
						    	'.$this->obj->oferta_texto_final.' 
			    		 	</center>
				    		',
				    		 $this->obj->oferta_texto_final != ''
					    ) ?>

	                  	<?php $this->out_if(
					    	$this->obj->url,
					    	'
					    	<center>
						    	<a type="submit" target="_blank" href="'.$this->obj->oferta_botao_link.'" class="cta btn grey-dark" id="btn-submit"> 
						    		<span class="btn-copy">'.$this->obj->oferta_botao_texto.'</span> 
						    		<span class="btn-cta"> <span class="icon-default"></span> </span>
					    		 </a>
			    		 	</center>
				    		',
				    		 $this->obj->oferta_botao_link != ''
					    ) ?>

	                </div>
	              </div>

	              <?php } ?>



	            </div>
	          </div>
	          
	        </div>
	      
	      </div>


	    </div>

	    <footer>
	      <div class="copyright">&copy; 2017 D&amp;S A&ccedil;&atilde;o - Desenvolvendo pessoas e empresas</div>
	    </footer>


	  </div>
	</div>


</body>
</html>