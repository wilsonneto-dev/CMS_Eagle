
	<section class="box content mtop-50">
		
		<section class="padding-r-15px">
			<?php $this->bloc("default-title"); ?>
			<div class="mtop-20">

				<article class="fract-1-4">	
						
					<div class="block padding-r-15px">
						<img class="responsive circle" src="/<?php $this->out( $this->obj->imagem ); ?>" alt="<?php $this->out( $this->obj->nome ); ?>">
						<hr>
						<div class="social-bullets center">
							<?php $this->out_if($this->obj->link_facebook, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-facebook.png').'" alt="Facebook"></a>', true); ?>
							<?php $this->out_if($this->obj->link_twitter, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-twitter.png').'" alt="Twitter"></a>', true); ?>
							<?php $this->out_if($this->obj->link_google_plus, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-google-plus.png').'" alt="Google Plus"></a>', true); ?>
							<?php $this->out_if($this->obj->link_linkedin, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-linkedin.png').'" alt="Linkedin"></a>', true); ?>
							<?php $this->out_if($this->obj->link_instagram, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-instagram.png').'" alt="Instagram"></a>', true); ?>
							<?php $this->out_if($this->obj->link_youtube, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-youtube.png').'" alt="Youtube"></a>', true); ?>
							<?php $this->out_if($this->obj->link_bitbucket, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-bitbucket.png').'" alt="Bitbucket"></a>', true); ?>
						</div>
					</div
					><div class="block">

					    <div class="content">
							<?php $this->out( $this->obj->texto, ['type' => 'html'] ); ?>
				    	</div>
					</div>

				</article>
		
			</div>
			<div class="mtop-20">
				
				<header class="section w98 mbottom-35">
					<h2>Últimos Artigos de <?php $this->out( $this->obj->nome ); ?></h2>
				</header>


				<ul class="inline w98 quarters full">
<?php $this->autor_posts->exec('<li>
			<article class="padding-5 mbottom-35">	
				
				<div>
					<a href="/artigo/#url">
						<img src="/#imagem" alt="#titulo" class="responsive round">
					</a>
				</div
				><div>

					<header class="center">
						<a href="/artigo/#url">
				        	<h1 class="title mbottom-5 mtop-10">#titulo</h1>
				        </a>
				        <div class="by-default">
				            <address class="author">Por <a rel="author" href="/autor/#autor_url">#autor</a></address> 
				            em <time pubdate datetime="#data_code" title="#data_code">#data</time>
				        </div>
				    </header>
				</div>

			</article>
		</li>', '<br /><br /><h2 class="align-center">Nenhum artigo encontrado...</h2>', $this );
 ?>
						
				</ul>
			</div>

		</section>

	</section>