		<section class="news mtop-20">
			<header class="section">
				<h2>Leia também</h2>
			</header>
			<section class="mtop-20">
				<ul class="articles inline responsive">
<?php $this->loops['side_bar_article_posts_hottest']->get_view(
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