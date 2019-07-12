<?php

class GrupoAdmin extends ModelBase
    {
    	public function initialize()
    	{
    		parent::initialize();
    		$this->set_properties
    		([
                'id' => [],
				
				'nome' => [ 'list'=> 1],
                'descricao' => []
			]);

    	}
    }
