	<section class="box content mtop-50">
		
		<section>
	
			<section>

				<?php $this->bloc("default-title"); ?>
				
				<div class="mtop-20">

					<div>

						<div class="fract-1-2">
							<article class="block padding-15">
							
									<?php $this->loops['contato_autores']->get_view(
									function($item, $indice){ return '
										<section class="full padding-r-15px center font-14">
											<img class="responsive circle mbottom-20 max-w-80p" src="'. $item->imagem.'" alt="'. $item->nome.'">
											<br />
											<span class="bold">
												<a href="/autor/'. $item->url.'">'. $item->nome.'</a>
											</span>
											<br />
											<hr>

											<div class="social-bullets center">
												'. 
												( ($item->link_facebook != '') ? 
												'<a href="'.$item->link_facebook.'" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-facebook.png').'" alt="Facebook"></a> '
												: ' ').
												( ($item->link_twitter != '') ? 
												'<a href="'.$item->link_twitter.'" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-twitter.png').'" alt="twitter"></a> '
												: ' ').
												( ($item->link_google_plus != '') ? 
												'<a href="'.$item->link_google_plus.'" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-google_plus.png').'" alt="google plus"></a> '
												: ' ').
												( ($item->link_linkedin != '') ? 
												'<a href="'.$item->link_linkedin.'" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-linkedin.png').'" alt="Linkedin"></a> '
												: ' ').
												( ($item->link_instagram != '') ? 
												'<a href="'.$item->link_instagram.'" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-instagram.png').'" alt="instagram"></a> '
												: ' ').
												( ($item->link_youtube != '') ? 
												'<a href="'.$item->link_youtube.'" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-youtube.png').'" alt="youtube"></a> '
												: ' ').
												( ($item->link_bitbucket != '') ? 
												'<a href="'.$item->link_bitbucket.'" target="_blank"><img src="'.$this->get_theme_path('imgs/socials/ic-bitbucket.png').'" alt="bitbucket"></a> '
												: ' ').
												'
											</div>
											
										</section>
										'; 
									}); ?>

									<?php $this->out( $this->page->texto, ['type' => 'html'] ); ?>
							
							</article><div class="block padding-15">
								
								<div class="form custom">
									<header class="center mbottom-35">
										<h2>
											Nos envie sua mensagem
										</h2>
									</header>

									<form id="form-main-contact" action="/contato" onsubmit="ws.send('/api/subscription/contact',ws.params('form-main-contact')); return false;" method="post">
										<div class="input-field">
											<label for="nome">Nome: *</label>
											<input type="text" class="input-text" name="nome" required>
										</div>
										<div class="input-field">
											<label for="email">Email: *</label>
											<input type="text" class="input-text" name="email" required>
										</div>
										<div class="input-field">
											<label for="telefone">Telefone:</label>
											<input type="text" class="input-text" name="telefone">
										</div>
										<div class="input-field">
											<label for="cargo">Mensagem:</label>
											<textarea class="input-text" name="mensagem"></textarea>
										</div>
										
										<input class="param" type="hidden" name="ref" value="<?php $this->out( $this->get_session('ref') ); ?>" />
										<input class="param" type="hidden" name="cod_lista" value="<?php $this->out( $this->infos->cod_lista_downloads ); ?>" />
										
										<div class="">
											<input type="submit" class="button bg-secondary2 round" value="Enviar" />
										</div>

									</form>
								</div>
							</div>								
						</div>

					</div>
					
				</div>

			</section>

		</section>

	</section>