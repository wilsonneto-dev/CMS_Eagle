				<ul class="inline w98 full <?php $this->out( $this->infos->lista_class ); ?>">
<?php $this->home_posts->exec('<li>
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