<?php

    class Admin extends ModelBase
    {
    	public function initialize()
    	{
    		parent::initialize();
    		$this->set_properties
    		([
                'id' => [],
				
				'cod_grupo_admin' => [
					'type' => 'foreign',
                    'foreign' => [
                        'model' => 'GrupoAdmin',
                        'label' => 'nome',
                        'key' => 'id'
                    ]
				],

				'nome' => [ 'list' => true ],
				'email' => [ 'list' => true ],
				'codprojeto' => [ 'type' => 'int' ],
				'token' => '',
				
                'senha' => [ 'type' => 'password' ],

				// 'ultimo_acesso' => [ 'type' => 'date', 'display' => false ],

				'ip' => [ 'display' => false ],
				'bloqueado' => ['type' => 'checkbox'],
				'imagem' => ['type' => 'image']

			]);

		}
		
    }
