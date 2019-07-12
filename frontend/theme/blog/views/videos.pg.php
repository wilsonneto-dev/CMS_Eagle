
	<section class="box content mtop-50">
		<section class="block padding-r-15px">
		
			<?php $this->bloc("default-title"); ?>
		
			<div class="mtop-20">

				<ul class="inline blocks thirds">
<?php $this->loops['materiais_source']->get_view(
		function($item, $indice){ return '<li class="padding-15px">
							<a href="/material/'.htmlspecialchars($item->url).'">
								<div class="block middle">
									<img class="round responsive" src="/'.htmlspecialchars($item->thumb).'" alt="'.htmlspecialchars($item->titulo).'">
								</div
								><div class="text block center mbottom-20">
									'.htmlspecialchars($item->titulo).'							
								</div>
							</a>
						</li>'; 
}); ?>	
				</ul>

			</div>

		</section>
	
	</section>