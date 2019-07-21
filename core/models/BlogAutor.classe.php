<?php

    class BlogAutor extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            $this->set_options([ 
              'title' => 'Autor', 
              'title_plural' => 'Autores',
              'list_link_button' => true,
              'list_link' => [ 
                'property' => 'url', 
                'link' => '/blog/autor/#property' 
              ] 
            ]);

            $this->set_properties
            ([
                'id' => [],

                'url' => [ 'list' => true ],
                'nome' => [ 'list' => true ],
                'texto' => [ 'type' => 'editor' ],
                'introducao' => [],

                'link' => [],
                'link_facebook' => [],
                'link_twitter' => [],
                'link_google_plus' => [],
                'link_linkedin' => [],
                'link_instagram' => [],
                'link_youtube' => [],
                'link_bitbucket' => [],
                
                'imagem' => [ 'type' => 'image', 'list' => true ],
                'thumb' => [ 'type' => 'image'],
                'contato_mostrar' => [ 'type' => 'checkbox']
            
            ]);

        }
    }

/*

    CREATE TABLE `blog_autor` 
    (
      `id` int(11) NOT NULL primary key,
      `url` varchar(500) DEFAULT NULL,
      
      `nome` varchar(500) DEFAULT NULL,
      `introducao` varchar(1000) DEFAULT NULL,
      `texto` varchar(10000) DEFAULT NULL,
      
      `link` varchar(500) DEFAULT NULL,
      `link_facebook` varchar(500) DEFAULT NULL,
      `link_twitter` varchar(500) DEFAULT NULL,
      `link_google_plus` varchar(500) DEFAULT NULL,
      `link_linkedin` varchar(500) DEFAULT NULL,
      `link_instagram` varchar(500) DEFAULT NULL,
      
      `imagem` varchar(500) DEFAULT NULL,
      `thumb` varchar(500) DEFAULT NULL,
      
      `ativo` int(1) DEFAULT '1',
      `cadastrado` datetime DEFAULT CURRENT_TIMESTAMP,
      `atualizado` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
    )

*/