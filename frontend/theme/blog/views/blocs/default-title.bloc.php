			<header class="section w98 mbottom-35">
				<h1><?php $this->out($this->page_header_title); ?></h1>
				<?php $this->out( $this->location_bullets_html(), [ 'type' => 'html' ] ) ?>				
				<?php $this->out_if( $this->page_header_description, '<br /><span class="description block mtop-10">#inner</span>', true ) ?>
			</header>
