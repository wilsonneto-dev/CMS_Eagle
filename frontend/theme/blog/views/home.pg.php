
	<nav class="sub-nav bg-secondary">
		<div class="box">
			<ul class="inline">
<?php $this->loops['master_categorias']->get_view(
	function($item, $indice){ return '
				<li>
					<a class="nav-link" href="/blog/categoria/'.htmlspecialchars($item->url).'">
						'.htmlspecialchars($item->titulo).'
					</a>
				</li>'; 
	}); ?>									
			</ul>
		</div>
	</nav>

	<section class="box content mtop-50">
		
		<section class="block main padding-r-15px">
			<?php $this->bloc("default-title"); ?>
			<div class="mtop-20">
				<?php $this->bloc( 'home-posts-'.$this->infos->lista_estilo ); ?>
			</div>

			<div class="center mtop-50 <?php $this->out( $this->infos->paginacao_class ); ?>">
				<?php $this->out($this->paginacao->html(), ['type'=>'html']); ?>
			</div>

		</section
		><section class="block border-box side-bar">
			
			<section class="news">
				<section class="">
					<form class="newsletter" action="/blog/busca">
						<input type="text" class="search" name="q" placeholder="Busca..." />
					</form>		
				</section>
			</section>
				
			<?php $this->bloc("side-bar"); ?>

		</section>

	</section>