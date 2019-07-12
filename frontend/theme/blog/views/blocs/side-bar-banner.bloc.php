			<section class="banners mtop-50">			
<?php $this->loops['banner_side_bar']->get_view(
		function($item, $indice){ return '
				<div class="item">
					<a href="'.htmlspecialchars($item->link).'">
						<img class="responsive" src="/'.htmlspecialchars($item->imagem).'" alt="'.htmlspecialchars($item->descricao).'" />
					</a>
				</div> '; 
}); ?>									
			</section>