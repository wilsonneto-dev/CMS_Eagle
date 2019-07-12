<?php

    class ThemeBloc extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            $this->set_properties
            ([
                'id' => [],

                'bloc' => [ 'list' => true ],
                'descricao' => [ 'list' => true ],
                'tipo' => [ 
                    'type' => 'enum', 
                    'enum' => [ 
                        'header' => 'Header',
                        'sub-header' => 'Sub-Header',
                        'pre-footer' => 'Pré-Footer',
                        'footer' => 'Footer',
                        'general' => 'General'                        
                    ],
                    'list' => true 
                ]
            
            ]);

        }
    }

/*

CREATE TABLE `theme_bloc` 
(

    `id` int(11) NOT NULL primary key AUTO_INCREMENT,
    `bloc` varchar(500) DEFAULT NULL,
    `descricao` varchar(500) DEFAULT NULL,
    `tipo` varchar(500) DEFAULT NULL,
    `ativo` int(1) DEFAULT '1',
    `cadastrado` timestamp DEFAULT CURRENT_TIMESTAMP,
    `atualizado` timestamp

)

--------------------

INSERT INTO `pagina_admin` 
    (`id`, `ativo`, `datacadastro`, `codprojeto`, `descricao`, `posicao`, `url`, `target`, `cod_menu_admin`, `bloqueado`, `permissao`) 
VALUES 
    (NULL, '1', '2015-08-25 06:59:37', '1', 'Tema - Blocos', '900', 'admin/crud/theme_bloc', NULL, '5', '0', 'theme_bloc');

--------------------

INSERT INTO `grupo_pagina_admin` (`cod_grupo_admin`, `cod_pagina_admin`, `escrita`) VALUES ('4', LAST_INSERT_ID(), '1');

*/