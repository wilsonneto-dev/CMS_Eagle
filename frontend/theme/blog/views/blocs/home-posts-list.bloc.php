				<ul class="article-list inline w98 <?php $this->out( $this->infos->lista_class ); ?>">
<?php $this->home_posts->exec('
		<li class="full">
			<article>	
				
				<div class="thumb block">
					<a href="/artigo/#url"><img src="/#imagem" alt=""></a>
				</div
				><div class="text block">

					<header>
				        <a href="/artigo/#url"><h1 class="title">#titulo</h1></a>
				        <div class="by">
				            <address class="author">Por <a rel="author" href="/autor/#autor_url">#autor</a></address> 
				            em <time pubdate datetime="#data_code" title="#data_code">#data</time>
				        </div>
				    </header>

				    <div class="content">
				    	<a href="/artigo/#url">
					    	<p>
								#introducao
					    	</p>
				    	</a>
			    	</div>
				</div>

			</article>
		</li>
', '<br /><br /><h2 class="align-center">Nenhum artigo encontrado...</h2>', $this );
 ?>
						
				</ul>