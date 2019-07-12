<?php

    class ConfigAction extends ModelBase
    {
    	public function initialize()
    	{
    		parent::initialize();
    		$this->set_properties
    		([
                'id' => [],
                'descricao' => ['label' => 'Descrição', 'list' => true ],
                'code' => [ 'list' => true ],
                'path' => [ 'list' => true ]
			]);

    	}
    }
