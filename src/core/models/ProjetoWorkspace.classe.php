<?php

    class ProjetoWorkspace extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            $this->set_properties
            ([
                'id' => [],
                'nome' => [ 'list' => true ],
                'cod_admin' => [ 'type' => 'int' ],
                'hash' => []
                
            ]);

        }
    }

/*

    CREATE TABLE `projeto_workspace` 
    (
      `id` int(11) NOT NULL primary key,
      
      `nome` varchar(500) DEFAULT NULL,
      `cod_admin` int(11) DEFAULT NULL,
      `hash` varchar(256) DEFAULT NULL,
      
      `ativo` int(1) DEFAULT '1',
      `cadastrado` datetime DEFAULT CURRENT_TIMESTAMP,
      `atualizado` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
    )

*/