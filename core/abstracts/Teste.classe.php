<?php

class Teste extends ModelBase
{
	
	public function initialize()
	{
		$this->set_data(array
		(
			'nome' 		=> array('required' => true, 'list' => false),
			'sobrenome' => array(),
			'email' 	=> array()
		));
	}

}
