
			<section class="contact">
				<h1>Entre em contato</h1>
				<p>
					<?php _echo( $this->infos->texto_contato ); ?>
					<br /><br />
					<b>Telefone/Whatsapp:</b> 							
					<span class="nowrap"><?php _echo( $this->infos->telefone1 ); ?></span>
					<?php if ( $this->infos->telefone2 != "" ) { echo "<span class=\"nowrap\">"; _echo( " / ".$this->infos->telefone2 ); echo "</span>"; } ?>
					<?php if ( $this->infos->telefone3 != "" ) { echo "<span class=\"nowrap\">"; _echo( " / ".$this->infos->telefone3 ); echo "</span>"; } ?>
					<br />
					<b>E-mail:</b> 							
					<?php _echo( $this->infos->email ); ?>
					<br />					
					<b>Facebook:</b> 							
					<a href="<?php _echo( $this->infos->link_facebook ); ?>" title="Curta nossa página no facebook" target="_blank"><?php _echo( str_replace("http://www.", "", $this->infos->link_facebook ) ); ?></a>
					<br /><br />
					Ou envie-nos sua mensagem
				</p>
				
				<section class="default_page_content">
					<form class="contato" method="post">
						<input value="<?php echo $this->_nome; ?>" type="text" class="txt_m" name="nome" placeholder="Nome *" required />
						<input value="<?php echo $this->_email; ?>" type="text" class="txt_m" name="email" placeholder="E-mail *" required />
						<input value="<?php echo $this->_telefone; ?>" type="text" class="txt_m" name="telefone" placeholder="Telefone" />
						<input value="<?php echo $this->_assunto; ?>" type="text" class="txt_m" name="assunto" placeholder="Assunto *" />
						<textarea name="mensagem" class="text_area txt_m" placeholder="Mensagem *" required><?php echo $this->_mensagem; ?></textarea>
						<input type="text" name="as" class="txt txt_as" />
						<?php if( $this->msg_contato != "" ){ ?> 
						<div class="msg status<?php echo $erro; ?>">
							<?php echo $this->msg_contato; ?>
						</div>
						<?php } ?>
						<div class="">
							<input type="submit" class="btn_default" value="Enviar Mensagem" />
						</div>
					</form>
				</section>
				<div class="map-info" id="info">
					<p class="">
						<img alt="BF Contábil" src="/frontend/theme/<?php echo $this->theme_path; ?>/imgs/logo.png" />
						<br /><br />
						<b>Nosso endereço:</b><br /> 							
						<?php _echo( $this->infos->endereco ); ?>

					</p>
				</div>
				<br /><br />
				<div id="map" class="map" data-coords="<?php _echo($this->infos->mapa_latitude); ?>/<?php _echo($this->infos->mapa_longitude); ?>"></div>

			</section>
