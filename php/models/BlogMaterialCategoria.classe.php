<?php

    class BlogMaterialCategoria extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();
            $this->set_properties
            ([

                'id' => [],

                'url' => [],
                'titulo' => ['list' => true],
                'texto' => [ 'type' => 'text' ]

            ]);

        }
    }



/*

    CREATE TABLE `blog_material_categoria` 
    (

      `id` int(11) NOT NULL primary key auto_increment,
      `url` varchar(500) DEFAULT NULL,
      
      `titulo` varchar(500) DEFAULT NULL,
      `texto` varchar(10000) DEFAULT NULL,
      
      `ativo` int(1) DEFAULT '1',
      `cadastrado` datetime DEFAULT CURRENT_TIMESTAMP,
      `atualizado` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP

    )
--------------------

INSERT INTO `pagina_admin` 
    (`id`, `ativo`, `datacadastro`, `codprojeto`, `descricao`, `posicao`, `url`, `target`, `cod_menu_admin`, `bloqueado`, `permissao`) 
VALUES 
    (NULL, '1', '2015-08-25 06:59:37', '1', 'Material Categorias', '1000', 'admin/crud/blog_material_categoria', NULL, '11', '0', 'blog_material_categoria');

--------------------

INSERT INTO `grupo_pagina_admin` (`cod_grupo_admin`, `cod_pagina_admin`, `escrita`) VALUES ('4', LAST_INSERT_ID(), '1');


*/