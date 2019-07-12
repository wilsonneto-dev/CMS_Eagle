
	<section class="box content mtop-50">
		
		<section class="blocks">
	
			<section class="block">

				<?php $this->bloc("article-title-default"); ?>
				
				<div class="mtop-20">

					<div class="block">
						<div class="block fract-2-1">
							<article class="block padding-15">
								<?php $this->out_if( $this->obj->imagem, 
									'<img class="responsive round" src="/'.$this->obj->imagem.'" alt="'.$this->obj->titulo.'"><br />', 
								true ); ?>								
								<?php $this->out( $this->obj->texto, ['type' => 'html'] ); ?>
							</article><div class="block padding-15">
								
								<div class="form custom">
									<header class="center mbottom-35">
										<h2>
											Faça o download grátis aqui!
										</h2>
										<span>
											Basta preencher o formulário abaixo para baixar o material.
										</span>
									</header>

									<form action="<?php $this->out( $this->link_submit ); ?>" method="post">
										<div class="input-field">
											<label for="nome">Nome: *</label>
											<input type="text" class="input-text" name="nome" required>
										</div>
										<div class="input-field">
											<label for="email">Email: *</label>
											<input type="text" class="input-text" name="email" required>
										</div>
										<div class="input-field">
											<label for="telefone">Telefone: *</label>
											<input type="text" class="input-text" name="telefone" required>
										</div>
										<div class="input-field">
											<label for="cargo">Ocupação:</label>
											<input type="text" class="input-text" name="ocupacao">
										</div>
										
										<input class="param" type="hidden" name="ref" value="<?php $this->out( $this->get_session('ref') ); ?>" />
										<input class="param" type="hidden" name="cod_lista" value="<?php $this->out( $this->infos->cod_lista_downloads ); ?>" />
										
										<div class="">
											<input type="submit" class="button bg-secondary2 round" value="Receber" />
										</div>

									</form>
								</div>
							</div>								
						</div>
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
					</div>
					
				</div>

			</section>

		</section>

	</section>