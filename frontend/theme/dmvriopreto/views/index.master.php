<!doctype html>

<html lang="en">
<head>
    <?php echo $this->header_html(); ?> 

	<!-- styles -->
	<link rel="stylesheet" href="<?php $this->get_theme_path( 'assets/main/main.css', true ); ?>">
	
	<!-- Facebook Pixel Code -->
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '1461709057249728');
	  fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	  src="https://www.facebook.com/tr?id=1461709057249728&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->


</head>

<body onscroll="menu_fix_verify();" id="body">
	
	<header id="home" class="transition-1">
		
		<input type="checkbox" id="control-nav" />
		<label for="control-nav" class="control-nav"></label>
		
		<div class="innner box">
			<div class="logo block">
				<a href="/"><img src="<?php $this->get_theme_path( 'imgs/logo-header.png', true ); ?>"></a>			
			</div>
			<nav class="f-right block check-show">
				<ul class="inline lighter hover-cta-links">
					<li><a href="#home" class="move-to" data-to="home" onclick="js_scroll.move_to_element('body'); mob_menu_out(); return false;">Home</a></li>
					<li><a href="#copy" class="move-to" data-to="copy" onclick="js_scroll.move_to_element('copy'); mob_menu_out(); return false;">O Evento</a></li>
					<li><a href="#trainners" class="move-to" data-to="trainners"  onclick="js_scroll.move_to_element('trainners'); mob_menu_out(); return false;">Trainners</a></li>
					<li><a href="#parceiros" class="move-to" data-to="parceiros"  onclick="js_scroll.move_to_element('parceiros'); mob_menu_out(); return false;">Parceiros</a></li>
					<li><a href="#contato" class="move-to" data-to="contato"  onclick="js_scroll.move_to_element('contato'); mob_menu_out(); return false;">Contato</a></li>
				</ul>
				<a href="#popup" class="button bg-secondary transition-05" onclick="init_modal(); mob_menu_out(); return false;">Reserve Seu Lugar</a>
			</nav>
		</div>
	</header>
	
	<section class="billboard bg-secondary bg-image bg-image-01">
		<div class="line-top"></div>
		<div class="inner box">
			<header class="no-default-styles center">
				<h2>10 a 12 de Novembro<br /> Ipê Park Hotel</h2>
				<h1>DESPERTE SUA MENTALIDADE VENCEDORA</h1>
			</header>
			<section class="count blocks center">
				
				<div>
					<div class="text t-left full-blocks">
						<span class="big" id="ct_day">
							XX
						</span>
						<span class="small">
							dias
						</span>						
					</div>
				</div>
				<div>
					<div class="text t-left full-blocks">
						<span class="big" id="ct_hour">
							XX
						</span>
						<span class="small">
							horas
						</span>						
					</div>
				</div>
				<div>
					<div class="text t-left full-blocks">
						<span class="big" id="ct_minute">
							XX
						</span>
						<span class="small">
							minutos
						</span>						
					</div>
				</div>
				<div>
					<div class="text t-left full-blocks">
						<span class="big" id="ct_second">
							XX
						</span>
						<span class="small">
							segundos
						</span>						
					</div>
				</div>

			</section>

			<section class="buttons border center hover-white transition-05">
				<a href="#" onclick="init_modal(); return false;">Reservar Sua Vaga</a>
				<a href="#" onclick="js_scroll.move_to_element('contato'); return false;">Solicitar Contato</a>
			</section>

		</div>
	</section>	

	<section class="intro box blocks" id="copy">
		<div class="copy box">
			<header class="no-default-styles title center">
				<h2 class="lighter">Desperte sua Mentalidade Vencedora</h2>
				<h1>O Evento</h1>
				<div class="separator bg-secondary block"></div>
			</header>
			<div class="text little-box m-h-auto">Perguntamos, com frequência, a nós mesmos:
- Como quero viver minha vida?
- O que mais me entusiasma? 
- Tenho algo para ser grato?

Por várias vezes nos sentimos presos em nossa vida! E incapazes de mudar, de romper crenças. 
O problema é que na maioria das vezes buscamos as respostas no lugar errado, com o olhar voltado para fora, longe da solução que já existe dentro nós. 
Agora você terá a oportunidade de encontrar suas próprias respostas, descobrir suas forças interiores, o que te motiva e com clareza do que você quer da vida, encarando-a de forma diferente!
No evento "Desperte sua Mentalidade Vencedora – DMV", você vai identificar e eliminar aquilo que te limita, encontrando significado e propósito. Você aprenderá a explorar seus pontos fortes e potencializar seus pontos de melhoria. Começará a se sentir merecedor de aproveitar tudo aquilo que conquistou com os própros esforços, de reivindicar e de assumir a responsabilidade pelo futuro que você quer construir, mudando não só a sua vida, mas de todos ao seu redor.  

Neste treinamento você aprenderá a: 
- tornar-se uma pessoa mais decidida e decisiva, que age com inteligência, descobrindo o que empurra você adiante;
- eliminar crenças limitantes e padrões negativos; 
- descobrir seu grande propósito e missão de vida;
- ter mais confiança e autoestima;
- condicionar-se física, mental e emocionalmente para criar resultados extraordinários;
- encontrar e a desenvolver sua própria estratégia de sucesso; 
- e muito mais. 

Para quem este treinamento não serve? 
- Para quem tem uma vida perfeita;
- Para quem acredita que não tem nada a melhorar; 
- Para quem não sabe diferenciar treinamento comportamental e mudança de mentalidade de técnicas de auto-ajuda sem comprovação científica. 

Para quem este treinamento será fundamental?
- Para quem busca evolução e quer ampliar suas capacidades e competências;
- Para quem reconhece que não há perfeição;
- Para quem quer despertar sua mentalidade vencedora para viver uma vida com propósito. 

Chegou a hora de voltar o olhar para dentro, a buscar as respostas no lugar certo, assumindo a responsabilidade e o controle da sua vida, pois tudo que você precisa já existe dentro de você!
Desperte sua Mentalidade Vencedora! 
Um forte abraço

Este evento ocorrerá nos dias 10, 11 e 12 de Novembro no Ipê Park Hotel em São José do Rio Preto, tendo início na sexta dia 10 às 20:29, sábado e domingo o evento terá início às 8h, e encerramento no domingo dia 12 após o almoço, por volta das 13h.

Não perca mais tempo, participe deste evento extraordinário. Desperte sua mentalidade de campeão através de diversas técnicas de coaching, investindo apenas <b>6 parcelas de R$ 276,25</b>, ou caso prefira à vista, o investimento é ainda menor: <b>R$ 1.497,00</b>


			</div>
			<div class="buttons little-box m-h-auto cta">
				<a href="#" class="bg-secondary open-popup-checkout" onclick="init_modal(); return false;">Reserve seu Lugar</a>
				<!-- a href="#" class="bg-secondary">Veja a programação</a --->
			</div>
		</div><!-- div class="right">
			<img class="responsive" src="<?php $this->get_theme_path( 'imgs/intro-image.jpg', true ); ?>">
		</div -->
	</section>

	<section class="quote center bg-secondary bg-image bg-image-03">
		<div class="inner little-box">
			<div class="up"></div>
			<div class="text">
				<span class="autor">Ronaldo B. Dutra, Master Coach</span>
				<span class="text">
					“Eu sou quem eu fui e quem eu quero ser”
				</span>
			</div>
			<div class="down"></div>
		</div>
	</section>

	<section class="professionals padding80" id="trainners">
		<header class="no-default-styles title center box">
			<h2 class="lighter">nossa equipe</h2>
			<h1>Os Trainners</h1>
			<div class="separator bg-secondary block"></div>
			<p class="lighter little-box">
				A equipe que irá coordenar e liderar estes três dias de evento serão:
			</p>
		</header>
		<div class="little-box each halfs center">
			
			<!-- div>
				<img class="responsive" src="<?php $this->get_theme_path( 'imgs/profile-luciano.jpg', true ); ?>">
				<div class="text">
					<div class="name">Luciano Sobrenome</div>
					<div class="ocuppation lighter">Treinador Comportamental</div>
					<div class="text lighter pre justify"><br /></div>
				</div>
			</div --><div>
				<img class="responsive" src="<?php $this->get_theme_path( 'imgs/profile-ronaldo.jpg', true ); ?>">
				<div class="text">
					<div class="name">Ronaldo B. Dutra</div>
					<div class="ocuppation lighter">Master Coach</div>
					<div class="text lighter pre justify"><br />Master Coach; Analista de Perfil Comportamental, Coaching Assessment e Analista 360º. Treinador Comportamental pelo Instituto de Formação de Treinadores – IFT, do Professor Massaru Ogata. Trainer e sócio da D & S Ação – Desenvolvimento de Pessoas Ltda, palestrante, e pós-graduando em Gestão de Pessoas com Coaching também pelo Instituto Brasileiro de Coaching. Procurador do Município de São José do Rio Preto, SP, desde de junho de 2009; pós-graduado em Direito Público, também foi Procurador do Município de Mirassol, SP, entre fevereiro de 2007 a junho de 2009, período no qual exerceu também os cargos em comissão de Secretário Jurídico, Secretário de Administração e Assessor Técnico do Gabinete do Prefeito. </div>
				</div>
			</div><div>
				<img class="responsive" src="<?php $this->get_theme_path( 'imgs/profile-sergio.jpg', true ); ?>">
				<div class="text">
					<div class="name">Sergio Luis de Carlos</div>
					<div class="ocuppation lighter">Coach e Treinador Comportamental</div>
					<div class="text lighter pre justify"><br />Treinador Comportamental, Practitioner em PNL, Coach, Palestrante e Hipnólogo. Graduado em administração de Empresas e pós-graduações em Gestão Estratégica de Negócios e Gestão de Pessoas, tem uma sólida carreira de 30 anos em vendas atuando em grandes empresas.
Ganhador do Prêmio Feras em Vendas 2014, é especialista em formação de equipes de alta performance, gerando resultado quantitativo e qualitativo em número absoluto de vendas e Tiquete Médio.
Improvisador da Cia do Humor e formado em Comunicação Eficaz pelo Instituto Dale Carnegie tem uma forma divertida e congruente de ensinar.</div>
				</div>
			</div>

		</div>
	</section>

	<section class="quote center bg-secondary bg-image bg-image-04">
		<div class="inner little-box">
			<div class="up"></div>
			<div class="text">
				<span class="autor">Ronaldo B. Dutra, Master Coach</span>
				<span class="text">
					“Tudo o que você precisa já existe dentro de você!”
				</span>
			</div>
			<div class="down"></div>
		</div>
	</section>

	<section class="sponsors box padding80" id="parceiros">
		<header class="no-default-styles title center box">
			<h2 class="lighter">parceiros</h2>
			<h1>Nossos patrocinadores</h1>
			<div class="separator bg-secondary block"></div>
			<p class="lighter little-box">
				Veja as marcas e empresas que contribuiram para a organização e execução deste grande evento
			</p>
		</header>

		<div class="line quarters margin center">
			<div><img class="responsive" src="<?php $this->get_theme_path( 'imgs/logo-dsacao.png', true ); ?>">
		</div>

	</section>

	<section class="newsletter padding80 bg-secondary transition-05 bg-image bg-image-05">
		<header class="no-default-styles title box">
			<h2>o que está esperando?</h2>
			<h1>Cadastre-se e receba as novidades</h1>
			<div class="separator bg-white block"></div>
			<form action="">
				<input class="email input-text" placeholder="coloque seu e-mail aqui" required="required" type="email" name="lead_email" id="lead_email">
				<a href="#" class="button border hover-white" onclick="subscription_lead(); return false;">Me Cadastrar</a>
			</form>
		</header>
	
	</section>

	<section class="contact padding-top-80" id="contato">

		<header class="no-default-styles title center box mbottom-35">
			<h2 class="lighter">contato</h2>
			<h1>Ficou com alguma dúvida?</h1>
			<div class="separator bg-secondary block"></div>
			<p class="lighter little-box">
				Ainda tem alguma dúvida sobre o evento, entre em contato por um de nossos meios de contato ou nos envie sua mensagem que responderemos o mais breve possível.
			</p>
		</header>

		<div class="inner halfs">
			<div class="middle">
				<div class="infos box half-box m-left-auto center bg-image bg-image-06">
					<header class="no-default-styles mbottom-35">
						<h2>10 a 12 de Novembro</h2>
						<h1>IPÊ PARK HOTEL</h1>					
					</header>
					<p>
						<span class="info lighter block">Mais Informações</span><br />
						<spam class="tel block">17 3363-2975</spam><br />
						<spam class="tel block">17 99775-8793</spam><br />
						<spam class="email block">contato@dsacao.com.br</spam>
					</p>					
				</div>
			</div><div class="bg-secondary padding-bottom-80 middle bg-image bg-image-02">
				<div class="form box half-box no-margin padding20 padding80 ">
					<header class="no-default-styles title mbottom-35">
						<h1>Envie sua mensagem</h1>
						<div class="separator bg-white block"></div>
					</header>
					<form method="post" id="form-contact" onsubmit="submit_contact(); return false;">
						<div class="input-field">
							<input type="text" class="input-text" placeholder="Seu Nome (obrigatório)" required name="contact_nome" id="contact_nome">
						</div>
						<div class="input-field">
							<input type="email" class="input-text" placeholder="Seu E-mail (obrigatório)" required name="contact_email" id="contact_email">
						</div>
						<div class="input-field">
							<input type="text" class="input-text" placeholder="Seu Telefone"  name="contact_telefone" id="contact_telefone">
						</div>
						<div class="input-field">
							<textarea rows="4" placeholder="Mensagem" class="input-text"  name="contact_mensagem" id="contact_mensagem"></textarea>
						</div>
						<div class="input-field">
							<a href="#" onclick="submit_contact(); return false;" class="button hover-white border">Enviar</a>
						</div>
					</form>	
				</div>
			</div>
		</div>

	</section>
	
	<section class="footer">
	
		<div class="inner box padding-top-20">
			<div class="halfs">
				<div class="text lighter padding-bottom-20">
					<?php $this->out($this->get_year()) ?> todos os direitos reservados © D&amp;S Ação
				</div><div class="socials t-right">
					<a href="https://www.facebook.com/DS-A%C3%87%C3%83O-1308959249211603/" target="_blank"><img src="<?php $this->get_theme_path( 'imgs/ico-facebook.jpg', true ); ?>"></a>
				</div>				
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="end bg-secondary clear"></div>
	
	</section>

	<div id="modal-newsletter" class="modal border-box">
		  <div class="modal-content">
		  	<center><img class="logo" src="<?php $this->get_theme_path( 'imgs/logo-header.png', true ); ?>"></center>
		    <!-- span class="modal-close">×</span -->
		    <h2>Desperte sua Mentalidade Vencedora</h2>
		    <p>Não perca mais tempo, participe deste evento extraordinário. Desperte seu mindset de campeão investindo apenas <b>6 parcelas de R$ 276,25</b>, ou caso prefira à vista, o investimento é ainda menor: <b>R$ 1.497,00</b>.</p>
		    <form class="newsletter-form contato" method="post" onsubmit="submit_form(); return false;">
		    	<input type="hidden" name="action" value="newsletter-form" />
		    	<div class="line">
		    		<input value="" type="text" class="txt_m" name="nome" id="news_nome" placeholder="Nome Completo *" required />
				</div>
		    	<div class="line"
		    		><div class="half-line"
		    		><input value="" type="email" class="txt_m" name="email" placeholder="E-mail" id="news_email" required /
	    			></div
					><div class="half-line"
					><input value="" type="text" class="txt_m" id="news_telefone" name="telefone" placeholder="Telefone" /
					></div
				></div>
		    	<div class="line">
		    		<input value="" type="text" class="txt_m" name="news_ocupacao" id="news_ocupacao" placeholder="Ocupação *" required />
				</div>
		    	<div class="line" style="display: none;">
					<center>Indique duas pessoas para referência</center>
				</div>
		    	<div class="line"  style="display: none;"
		    		><div class="half-line"
		    		><input value="" type="text" class="txt_m" name="news_ref_pessoa" placeholder="Primeira referencia" id="news_ref_pessoa" /
	    			></div
					><div class="half-line"
					><input value="" type="text" class="txt_m" id="news_ref_pessoa_tel" name="news_ref_pessoa_tel" placeholder="Telefone" /
					></div
				></div>
		    	<div class="line"  style="display: none;"
		    		><div class="half-line"
		    		><input value="" type="text" class="txt_m" name="news_ref_pessoa2" placeholder="Outra referencia" id="news_ref_pessoa2" /
	    			></div
					><div class="half-line"
					><input value="" type="text" class="txt_m" id="news_ref_pessoa2_tel" name="news_ref_pessoa2_tel" placeholder="Telefone" /
					></div
				></div>
		    	<div class="line"
		    		><div class="half-line"
		    		><input type="button" class="btn_default cancel modal-cancel" value="Não, Obrigado" /></div
					><div class="half-line"
					><input type="submit" class="btn_default" value="Me Cadastrar" onclick="fbq('track', 'CompleteRegistration'); return true;" /
					></div
				></div>
		    </form>
		  </div>
  		 </div>
    </div>

	<script src="<?php $this->get_theme_path( 'assets/main/main.js', true ); ?>"></script>
	<script src="<?php $this->get_theme_path( 'assets/counter/counter.js', true ); ?>"></script>
	<script src="<?php $this->get_theme_path( 'assets/scroll/scroll.js', true ); ?>"></script>

	<!-- sweet alert -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.js"></script>
	<script>

		counter.init(
			document.getElementById("ct_day"), 
			document.getElementById("ct_hour"), 
			document.getElementById("ct_minute"), 
			document.getElementById("ct_second"), 
			new Date(2017, 10, 10, 8, 0, 0, 0)
		);
		
		function subscription()
		{
			fbq('track', 'InitiateCheckout');
			
			var
				nome = document.getElementById("news_nome").value,
				email = document.getElementById("news_email").value,
				ocupacao = document.getElementById("news_ocupacao").value,
				ref_pessoa = document.getElementById("news_ref_pessoa").value,
				ref_pessoa_tel = document.getElementById("news_ref_pessoa_tel").value,
				ref_pessoa2 = document.getElementById("news_ref_pessoa2").value,
				ref_pessoa2_tel = document.getElementById("news_ref_pessoa2_tel").value,
				telefone = document.getElementById("news_telefone").value;

			var params = 
				'nome=' + encodeURIComponent(nome) + 
				'&email=' + encodeURIComponent(email) +
				'&telefone=' + encodeURIComponent(telefone) +
				'&ocupacao=' + encodeURIComponent(ocupacao) +
				'&ref_pessoa=' + encodeURIComponent(ref_pessoa) +
				'&ref_pessoa_tel=' + encodeURIComponent(ref_pessoa_tel) +
				'&ref_pessoa2=' + encodeURIComponent(ref_pessoa2) +
				'&ref_pessoa2_tel=' + encodeURIComponent(ref_pessoa2_tel) +
				'&ref=' + encodeURIComponent("<?php $this->out( $this->get_param('ref','') ); ?>") +
				'&cod_lista=1';

			ajax(
				'/api/subscription/lead_dmv', 
				params, 
				function(r)
				{
					document.location = "https://pag.ae/bkpsZbz";
					console.log(r);
				}
			);

		}


		function subscription_lead()
		{
			var email = document.getElementById("lead_email").value;
			if(email == "")
			{
				swal(
				  'Oops...',
				  'Preencha o e-mail',
				  'error'
				);
				return;
			}

			var params = 
				'email=' + encodeURIComponent( email ) +
				'&ref=' + encodeURIComponent("<?php $this->out( $this->get_param('ref','') ); ?>") +
				'&cod_lista=1';

			ajax(
				'/api/subscription/lead', 
				params, 
				function(r)
				{
					try 
					{
				        var obj_response = JSON.parse(r.response);
						console.log(obj_response);
				        if(obj_response.status == 'success')
				        {
					        swal(
							  'Obrigado!',
							  obj_response.msg,
							  'success'
							);
					    	init_modal();
					    }
				    	else
					        swal(
							  'Oops...',
							  obj_response.msg,
							  'error'
							);
				    } catch (e) 
				    {
				        console.log("não é json valido o retorno");
				        console.log(r.response);
				        swal(
						  'Oops...',
						  'Ocorreu um erro! Tente novamente em instantes',
						  'error'
						);
				    }
				}
			);

		}


	</script>

	<!-- Global Site Tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-73769327-4"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments)};
	  gtag('js', new Date());

	  gtag('config', 'UA-73769327-4');
	</script>


</body>

</html>

<?php
/* $this->get_page_view(); */