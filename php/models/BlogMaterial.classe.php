<?php

    class BlogMaterial extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            $this->set_options([ 
                'title_plural' => 'Materiais'
            ]);

            $this->set_properties
            ([
                'id' => [],
                'url' => [],
                
                 'cod_blog_material_categoria' => [
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'BlogMaterialCategoria',
                        'label' => 'titulo',
                        'key' => 'id'
                    ]
                ],  

                'tipo' => 
                [ 
                    'type' => 'enum', 
                    'enum' => 
                    [ 
                        'ebook' => 'E-book',
                        'kit' => 'Kit',
                        'ferramenta' => 'Ferramenta',
                        'modelo' => 'Modelo'
                    ] 
                ],

                'layout' => 
                [ 
                    'type' => 'enum', 
                    'enum' => 
                    [ 
                        'material_default' => 'Padrão'
                    ] 
                ],

                'titulo' => [ 'list' => true ],
                'texto' => [ 'type' => 'editor' ],
                'texto_botao' => [],

                'cod_lista' => [ 
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'Lista',
                        'label' => 'titulo',
                        'key' => 'id'
                    ] 
                ],

                'arquivo' => [ 'type' => 'file' ],
                'imagem' => [ 'type' => 'image' ],
                'thumb' => [ 'type' => 'image' ],
                'listar' => [ 'type' => 'checkbox', 'label' => 'Mostrar na listagem de materiais?' ]
            
            ]);

        }
    }

/*

    CREATE TABLE blog_material 
    (

      id int(11) NOT NULL primary key auto_increment,
      url varchar(500) DEFAULT NULL,
      
      tipo_form varchar(500) DEFAULT NULL,
      titulo varchar(500) DEFAULT NULL,
      texto_botao varchar(500) DEFAULT NULL,
      texto varchar(10000) DEFAULT NULL,
      
      imagem varchar(500) DEFAULT NULL,
      listar int(1) DEFAULT '1',
      
      ativo int(1) DEFAULT '1',
      cadastrado datetime DEFAULT CURRENT_TIMESTAMP,
      atualizado datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
    )
--------------------

INSERT INTO pagina_admin 
    (ativo, datacadastro, codprojeto, descricao, posicao, url, target, cod_menu_admin, bloqueado, permissao) 
VALUES 
    ('1', '2015-08-25 06:59:37', '1', 'Materiais', '100', 'admin/crud/blog_material', NULL, '11', '0', 'blog_material');

--------------------

INSERT INTO grupo_pagina_admin (cod_grupo_admin, cod_pagina_admin, escrita) VALUES ('4', LAST_INSERT_ID(), '1');


*/
