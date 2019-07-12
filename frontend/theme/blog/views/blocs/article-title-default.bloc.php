			<header class="section w98">
				<?php $this->out( $this->location_bullets_html(), [ 'type' => 'html' ] ) ?>				
				<h1 class="font-big bold"><?php $this->out($this->page_header_title); ?></h1>
				<?php $this->out_if( $this->page_header_description, '<span class="description block mtop-10 font-big-sub">#inner</span>', true ) ?>
			</header>
