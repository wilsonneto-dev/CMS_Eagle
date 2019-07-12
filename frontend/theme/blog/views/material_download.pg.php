
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
											Obrigado!<br />
											Clique para efetuar o Download
										</h2>
									</header>
									<div class="center">
										<a href="<?php $this->out( $this->link_download ); ?>" target="_blank">
											<input type="button" class="button bg-secondary2 round big" value="BAIXAR MATERIAL" />
										</a>
									</div>
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