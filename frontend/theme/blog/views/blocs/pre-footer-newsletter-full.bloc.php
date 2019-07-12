	<br /><br />
	<section class="newsletter bg-secondary">
		<div class="inner box center">
			<p>
				<?php $this->out( $this->infos->newsletter_cta ); ?>
			</p>
			<form onsubmit="ws.send('/api/subscription/lead',ws.params('form-main-newsletter')); return false;" id="form-main-newsletter">
				
				<input class="param" type="hidden" name="ref" value="<?php $this->out( $this->get_session('ref') ); ?>" />
				<input class="param" type="hidden" name="cod_lista" value="<?php $this->out( $this->infos->cod_lista ); ?>" />

				<input class="param hidden" type="text" name="code" />
				<input type="email" name="email" class="email param" id="newsletter_email"
				/><input class="bg-secondary2" type="submit" value="<?php $this->out( $this->infos->newsletter_botao ); ?>" />

			</form>
		</div>
	</section>