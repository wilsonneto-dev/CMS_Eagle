<?php

    class BlogLayout extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            $this->set_properties
            ([
                'id' => [],

                'titulo' => [ 'list' => true ],
                'tipo' => [ 
                    'type' => 'enum', 
                    'enum' => [ 
                        'artigo' => 'Artigos'
                    ],
                    'list' => true 
                ],
                'path' => [ 'list' => true ]
            
            ]);

        }
    }

/*

CREATE TABLE `blog_layout` 
(

    `id` int(11) NOT NULL primary key AUTO_INCREMENT,
    `path` varchar(500) DEFAULT NULL,

    `titulo` varchar(500) DEFAULT NULL,
    `tipo` varchar(500) DEFAULT NULL,
    `ativo` int(1) DEFAULT '1',
    `cadastrado` datetime DEFAULT CURRENT_TIMESTAMP,
    `atualizado` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP

)

--------------------

INSERT INTO `pagina_admin` 
    (`id`, `ativo`, `datacadastro`, `codprojeto`, `descricao`, `posicao`, `url`, `target`, `cod_menu_admin`, `bloqueado`, `permissao`) 
VALUES 
    (NULL, '1', '2015-08-25 06:59:37', '1', 'Layout', '100', 'admin/crud/blog_layout', NULL, '11', '0', 'blog_layout');

--------------------

INSERT INTO `grupo_pagina_admin` (`cod_grupo_admin`, `cod_pagina_admin`, `escrita`) VALUES ('4', LAST_INSERT_ID(), '1');

*/