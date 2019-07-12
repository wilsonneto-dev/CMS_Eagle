<?php

    class VideoCategoria extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();
            $this->set_properties
            ([

                'id' => [],

                'url' => [],
                'titulo' => ['list' => true],
                'chamada' => ['list' => true],
                'texto' => [ 'type' => 'text' ],
                'imagem' => [ 'type' => 'image' ]

            ]);

        }
    }



/*

    CREATE TABLE `video_categoria` 
    (

      `id` int(11) NOT NULL primary key auto_increment,
      `url` varchar(500) DEFAULT NULL,
      
      `titulo` varchar(500) DEFAULT NULL,
      `chamada` varchar(1000) DEFAULT NULL,
      `texto` varchar(10000) DEFAULT NULL,
      
      `imagem` varchar(500) DEFAULT NULL,
      `thumb` varchar(500) DEFAULT NULL,
      
      `ativo` int(1) DEFAULT '1',
      `cadastrado` datetime DEFAULT CURRENT_TIMESTAMP,
      `atualizado` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
    )
--------------------

INSERT INTO `pagina_admin` 
    (`id`, `ativo`, `datacadastro`, `codprojeto`, `descricao`, `posicao`, `url`, `target`, `cod_menu_admin`, `bloqueado`, `permissao`) 
VALUES 
    (NULL, '1', '2015-08-25 06:59:37', '1', 'Categorias', '100', 'admin/crud/video_categoria', NULL, '11', '0', 'video_categoria');

--------------------

INSERT INTO `grupo_pagina_admin` (`cod_grupo_admin`, `cod_pagina_admin`, `escrita`) VALUES ('4', LAST_INSERT_ID(), '1');


*/