
	<header class="main box big-header">
		
		<div class="logo">
			<a href="/"><img src="/<?php $this->out( $this->infos->logo_header, ['type'=>'html']); ?>"></a>
		</div>

		<nav class="f-right block">
			<ul class="inline">
				<li>
					<a class="nav-link" href="/">Home</a>
				</li>
				<li>
					<a class="nav-link" href="/autor/ronaldo-bitencourt-dutra">Sobre</a>
				</li>
				<li>
					<a class="nav-link" href="/videos">V&iacute;deos</a>
				</li>
				<li>
					<a class="nav-link" href="/">Blog</a>
				</li>
				<li>
					<a class="nav-link" href="/autor/treinamentos">Treinamentos</a>
				</li>
				<li>
					<a class="nav-link" href="/materiais">Ferramentas e E-books</a>
				</li>
				<li>
					<a class="nav-link" href="/contato">Contato</a>
				</li>
			</ul>
		</nav>

	</header>

<?php $this->loops['master_banners']->get_view(
	function($item, $indice){ return '
				<aside class="billboard" style="background-image: url(\'/'.$item->imagem.'\')">
					<a href="'.$item->link.'" target="_blank" class="full"></a>
				</aside>
		'; 
	}); ?>									

	<!-- nav class="sub-nav bg-secondary">
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
	</nav -->

