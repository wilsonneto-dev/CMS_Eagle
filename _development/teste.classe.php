<?php

class Cliente extends ModelBase
{
	
	public function initialize()
	{
		$this->set_source("cliente");

		$this->set_data(array
		(
			'nome' 		=> array('type' => 'text', 'required' => true, 'list' => false),
			'sobrenome' => array(),
			'email' 	=> array()
		));
	}

}
