<?php

$this->slots = ThemeSlot::get_slots();
if($this->slots != null)
	foreach ($this->slots as $item) 
		$this->bloc_cod($item->bloc);

?>