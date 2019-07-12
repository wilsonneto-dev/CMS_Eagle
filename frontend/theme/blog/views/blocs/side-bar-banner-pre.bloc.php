			<section class="banners">			
<?php $this->loops['banner_side_bar_pre']->get_view(
		function($item, $indice){ return '
				<div class="item">
					<a href="'.htmlspecialchars($item->link).'">
						<img class="responsive" src="/'.htmlspecialchars($item->imagem).'" alt="'.htmlspecialchars($item->descricao).'" />
					</a>
				</div> '; 
}); ?>									
			</section>