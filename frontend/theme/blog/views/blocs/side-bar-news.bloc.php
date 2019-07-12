		<section class="news">
			<header class="section mtop-50">
				<h2>Últimas Postagens</h2>
			</header>
			<section class="mtop-20">
				<ul class="articles inline responsive">
<?php $this->loops['side_bar_posts_news']->get_view(
		function($item, $indice){ return '
						<li>
							<a href="/artigo/'.htmlspecialchars($item->url).'">
								<div class="thumb block middle">
									<img class="round responsive" src="/'.htmlspecialchars($item->thumb).'" alt="'.htmlspecialchars($item->titulo).'">
								</div
								><div class="text block">
									'.htmlspecialchars($item->titulo).'							
								</div>
							</a>
						</li>

				'; 
}); ?>	
				</ul>
				
			</section>
		</section>