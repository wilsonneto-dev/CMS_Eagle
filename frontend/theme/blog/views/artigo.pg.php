
	<section class="box content mtop-50">
		
		<section class="blocks percents-15-85">
	
			<section class="block padding-r-15px center font-14">
				<img class="responsive circle max-w-64 mbottom-20" src="/<?php $this->out( $this->autor->imagem ); ?>" alt="<?php $this->out( $this->autor->nome ); ?>">
				<br />
				<span class="">por</span><wbr> <span class="bold">
					<a href="/autor/<?php $this->out($this->autor->url); ?>"><?php $this->out($this->autor->nome); ?></a>
				</span>
				<br />
				<span class="">em</span> <span class="no-break"><?php $this->out($this->obj->data_postagem); ?></span>
				<br />
				<br />
				<?php $this->out($this->autor->introducao); ?>
				<br />

				<hr>

				<div class="social-bullets center">
					<?php $this->out_if($this->autor->link_facebook, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-facebook.png').'" alt="Facebook"></a>', true); ?>
					<?php $this->out_if($this->autor->link_twitter, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-twitter.png').'" alt="Twitter"></a>', true); ?>
					<?php $this->out_if($this->autor->link_google_plus, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-google-plus.png').'" alt="Google Plus"></a>', true); ?>
					<?php $this->out_if($this->autor->link_linkedin, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-linkedin.png').'" alt="Linkedin"></a>', true); ?>
					<?php $this->out_if($this->autor->link_instagram, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-instagram.png').'" alt="Instagram"></a>', true); ?>
					<?php $this->out_if($this->autor->link_youtube, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-youtube.png').'" alt="Youtube"></a>', true); ?>
					<?php $this->out_if($this->autor->link_bitbucket, '<a href="#inner" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-bitbucket.png').'" alt="Bitbucket"></a>', true); ?>
				</div>

				
			</section><section class="block">

				<?php $this->bloc("article-title-default"); ?>
				<div class="mtop-20 percents-70-30">
					<div class="block">
						<article>
							<?php $this->out_if( $this->obj->video, '<div class="center"><iframe width="560" height="315" style="max-width: 100%;" src="#inner" frameborder="0" allowfullscreen></iframe></div>', true ); ?>
							<?php $this->out_if( $this->obj->imagem, '<img src="/#inner" class="responsive round" alt="'.$this->obj->titulo.'" />', true ); ?>
							<?php $this->out( $this->obj->texto, ['type' => 'html'] ); ?>
						</article>	
						<section class="comments">
							<div id="disqus_thread"></div>
							<script>
								(function() {
									var d = document, s = d.createElement('script');
									s.src = '<?php $this->out($this->infos->disqus_source); ?>';
									s.setAttribute('data-timestamp', +new Date());
									(d.head || d.body).appendChild(s);
								})();							
							</script>
						</section>
					</div><div class="block border-box side-bar padding-l-15px">
							
						<?php $this->bloc("side-bar-article"); ?>
						
						
					</div>
					
				</div>

			</section>
		</section>

		<div class="mtop-20">
			
			<header class="section w98 mbottom-35">
				<h2>Últimos Artigos: <?php $this->out( $this->categoria->titulo ); ?></h2>
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