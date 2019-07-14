<?php

class AdminProjetoWorkspace extends ModelBase
{
    public function initialize()
    {
        parent::initialize();

        $this->set_options([ 'soft_delete' => false ]);
        
        $this->set_properties
        ([
            'id' => [],

            'cod_admin' => [
                'type' => 'foreign',
                'foreign' => [
                    'model' => 'Admin',
                    'label' => 'nome',
                    'key' => 'id'
                ]
            ],
            'cod_projeto_workspace' => [
                'type' => 'foreign',
                'foreign' => [
                    'model' => 'ProjetoWorkspace',
                    'label' => 'nome',
                    'key' => 'id'
                ]
            ]
            
        ]);

    }
}

    
/*

    CREATE TABLE admin_projeto_workspace 
    (
      id int(11) NOT NULL primary key,
      cod_admin int(11) NOT NULL,
      cod_projeto_workspace int(11) NOT NULL,
      cadastrado datetime DEFAULT CURRENT_TIMESTAMP,
      atualizado datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
    )

*/