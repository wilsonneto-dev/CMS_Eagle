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

	<style>

		/* modal / home */
		.modal {
		    display: block; 
		    position: fixed; 
		    z-index: 100;
		    padding-top: 100px; 
		    left: 0;
		    top: 0;
		    width: 100%; 
		    height: 100%; 
		    overflow: auto; 
		    background-color: rgb(0,0,0); 
		    background-color: rgba(0,0,0,0.4); 
		}

		.modal-content {
		    background-color: #fefefe;
		    margin: auto;
		    padding: 20px;
		    border: 1px solid #888;
		    width: 80%;
		    text-align: center;
		    max-width: 500px;
		    border-radius: 3px;
		}

		.modal-content h2 {
			clear: both;
			font-weight: normal;
			font-size: 20px;
			color: #494949;
		}
		.modal-content p {
			font-size: 17px;
			color: #696969;
		}

		.modal-close {
		    color: #aaaaaa;
		    float: right;
		    font-size: 20px;
		    font-weight: bold;
		}
		.modal-close:hover,
		.modal-close:focus {
		    color: #000;
		    text-decoration: none;
		    cursor: pointer;
		}

		.newsletter-form .line {
			display: inline-block;
			width: 100%;
			margin-bottom: 5px;
		}
			.newsletter-form .line .btn_default { padding: 0; }
			.newsletter-form .line .btn_default.cancel { background-color: #ef5050; }

			.newsletter-form .line .txt_m,
			.newsletter-form .line .btn_default { 
				width: 100%;  
				height: 40px;
				font-size: 14px;
			}
			.txt_m
			{
				padding: 15px;
			} 

			.newsletter-form .line .half-line {
				display: inline-block;
				width: 50%;
				box-sizing: border-box;
			}
				.newsletter-form .line .half-line:first-child .txt_m,
				.newsletter-form .line .half-line:first-child .btn_default {
					width: 99%;
					float: left;
					margin-right: 0;
				}
				.newsletter-form .line .half-line:last-child .txt_m, 
				.newsletter-form .line .half-line:last-child .btn_default {
					width: 99%;
					float: right;
					margin-right: 0;
				}

		div.author{ text-align: center; color: #ccc; font-size: 13px; margin-top: 40px; }
		div.author a { color: inherit; }


		@media only screen and (max-width: 740px) {
			
			.modal {
			    padding-top: 20px; 
			}


		}

		.btn_default { 	
			margin-top: 10px;
			height: 35px;
			/* width: 90%; */
			border: 0;
			background-color: #00508d;
			color: white;
			cursor: pointer;
			padding-left: 50px;
			padding-right: 50px; 
			text-align: center !important;
			text-transform: uppercase;
		 }
				
	</style>

	<script type="text/javascript">
		var modal;
		function init_modal()
		{
			
			modal = document.getElementById('modal-newsletter');
		    modal.style.display = "block";
			
			var span = document.getElementsByClassName("modal-close")[0];
			if(span != null)
			{
				span.onclick = function(){ modal.style.display = "none"; };
			}

			var cancel = document.getElementsByClassName("modal-cancel")[0];
			if(cancel != null)
			{
				cancel.onclick = function(){ modal.style.display = "none"; };
			}

		}

		function ajax(url, params, callback_function) {
			var xhttp;
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			 	if (this.readyState == 4 && this.status == 200) {
					callback_function(this);
				}
			};
			xhttp.open("POST", url, true);
			xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhttp.send(params);
		}

		function close_modal()
		{
			modal.style.display = "none";
		}

		function subscription()
		{
			var
				nome = document.getElementById("news_nome").value,
				email = document.getElementById("news_email").value,
				telefone = document.getElementById("news_telefone").value;

			var params = 
				'nome=' + encodeURIComponent(nome) + 
				'&email=' + encodeURIComponent(email) +
				'&telefone=' + encodeURIComponent(telefone) +
				'&ref=' + encodeURIComponent("<?php $this->out( $this->get_param('ref','') ); ?>") +
				'&cod_lista=' + encodeURIComponent(<?php $this->out($this->obj->cod_lista); ?>);

			ajax(
				'/api/subscription/lead', 
				params, 
				function(r)
				{
					console.log(r);
				}
			);

		}

		function submit_form()
		{
			subscription();
			close_modal();	
		}

	</script>

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
<?php

$this->out_if
(
	$this->obj->video,
    '<div style="text-align: center;">
    	<br />
		<iframe width="560" height="315" src="#inner" frameborder="0" allowfullscreen></iframe>
	</div>',
	$this->obj->video != ''
);

?>
	        <div class="row colctrl__row">
	          <div class="col-lg-7 col-md-7 col-sm-7 left-column">
	            <div class="left-outer">
	              <div class="rich-text">
	                <div class="textindent">
	                  <h2><?php $this->out( $this->obj->titulo ); ?></h2>
	                  <!--<p> <a href="#">Download the full article</a> </p>-->
	                  <p>
	                  	<?php $this->out( $this->obj->texto , [ 'type' => 'html' ] ); ?>
	                  </p>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="col-lg-5 col-md-5 col-sm-5 right-column">
	            <div class="right-outer">
	              <div class="rich-text">
	                <div class="textindent">
	                  <div class="font-18 darkgreen">
	                    <p>Preencha os dados abaixo:</p>
	                  </div>
	                  <div class="leadgen-form">
	                    <form name="registration" method="post">
	                      
	                      <fieldset>

<?php

	$this->out_if
	(
		'ok',
'							<ul>
	                          <li>
	                            <label for="nome">Nome <span class="required">*</span> <span class="right"><span class="required">*</span>Obrigatório</span></label>
	                            <input type="text" name="nome" id="nome" class="Required" required placeholder="Nome" />
	                          </li>
	                          <li>
	                            <label for="sobrenome">Sobrenome <span class="required">*</span></label>
	                            <input type="text" id="sobrenome" name="sobrenome" required class="Required" placeholder="Sobrenome" />
	                          </li>
	                          <li>
	                            <label for="email">Email <span class="required">*</span></label>
	                            <input type="email" id="email" name="email" class="Required" required placeholder="Email corporativo" />
	                          </li>
	                          <li>
	                            <label for="ocupacao">Ocupação <span class="required"></span></label>
	                            <input type="text" id="ocupacao" name="ocupacao" class="Required" placeholder="Ocupação" />
	                          </li>
	                          <li>
	                            <label for="empresa">Empresa <span class="required"></span></label>
	                            <input type="text" id="empresa" name="empresa" class="Required" placeholder="Empresa" />
	                          </li>
	                          <li>
	                            <label for="telefone">Telefone</label>
	                            <input type="text" id="telefone" name="telefone" class="Included" placeholder="Telefone" />
	                          </li>
	                          <li>
	                            <p class="tctext pt10">
	                            	'.$this->obj->texto_final.'
	                            </p>
	                          </li>
	                        </ul>
	                        <div class="clearfix"></div>
	                        
	                        <div class="cta-row">
	                          <button type="submit" class="cta btn grey-dark" id="btn-submit"> 
	                          	<span class="btn-copy"> 
	                          		' . $this->obj->botao_texto . ' 
                          		</span> 
                          		<span class="btn-cta"> 
                          			<span class="icon-default"></span>
                      			</span>
                          	  </button>
	                        </div>',
		$this->obj->tipo_form == 'profissional'
	);

	$this->out_if
	(
		'ok',
'							<ul>
	                          <li>
	                            <label for="nome">Nome <span class="required">*</span> <span class="right"><span class="required">*</span>Obrigatório</span></label>
	                            <input type="text" name="nome" id="nome" class="Required" required placeholder="Nome" />
	                          </li>
	                          <li>
	                            <label for="email">Email <span class="required">*</span></label>
	                            <input type="email" id="email" name="email" class="Required" required placeholder="Email" />
	                          </li>
	                          <li>
	                            <label for="telefone">Telefone</label>
	                            <input type="text" id="telefone" name="telefone" class="Included" placeholder="Telefone" />
	                          </li>
	                          <li>
	                            <p class="tctext pt10">
	                            	'.$this->obj->texto_final.'
	                            </p>
	                          </li>
	                        </ul>
	                        <div class="clearfix"></div>
	                        
	                        <div class="cta-row">
	                          <button type="submit" class="cta btn grey-dark" id="btn-submit"> 
	                          	<span class="btn-copy"> 
	                          		' . $this->obj->botao_texto . ' 
                          		</span> 
                          		<span class="btn-cta"> 
                          			<span class="icon-default"></span>
                      			</span>
                          	  </button>
	                        </div>',
		$this->obj->tipo_form == 'simples'
	);

?>
	                        
	                      
	                      </fieldset>

	                    </form>
	                  </div>
	                </div>
	              </div>
	              <div> 
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
<?php
	$this->out_if
	(
		'popup',
'		<div id="modal-newsletter" class="modal">
			  
			  <div class="modal-content">
			    <!-- span class="modal-close">×</span -->
			    <h2>Se inscreva</h2>
			    <p>Inscreva-se e receba nossas novidades, eventos, workshops, promoções e novidades.</p>
			    <form class="newsletter-form contato" method="post" onsubmit="submit_form(); return false;">
			    	<input type="hidden" name="action" value="newsletter-form" />
			    	<div class="line">
			    		<input value="" type="text" class="txt_m" name="nome" id="news_nome" placeholder="Nome *" required />
					</div>
			    	<div class="line"
			    		><div class="half-line"
			    		><input value="" type="email" class="txt_m" name="email" placeholder="E-mail" id="news_email" required /
		    			></div
						><div class="half-line"
						><input value="" type="text" class="txt_m" id="news_telefone" name="telefone" placeholder="Telefone" /
						></div
					></div>
			    	<div class="line"
			    		><div class="half-line"
			    		>'.
			    		
			    		(
		    				$this->obj->popup_lead_cancelar == '1' ?
			    			'<input type="button" class="btn_default cancel modal-cancel" value="Não, Obrigado" />'
		    				:''
		    			)

		    			.'</div
						><div class="half-line"
						><input type="submit" class="btn_default" value="Cadastrar" /
						></div
					></div>
			    </form>
			  </div>
	  		 </div>
			 <script> init_modal(); </script>

	    </div>',
		$this->obj->popup_lead == '1'
	
	);

?>	

	    <footer>
	      <div class="copyright">&copy; 2017 D&amp;S A&ccedil;&atilde;o - Desenvolvendo pessoas e empresas</div>
	    </footer>


	  </div>
	</div>

	<script>
	
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-73769327-2', 'auto');
	  ga('send', 'pageview');

	</script>

</body>
</html>