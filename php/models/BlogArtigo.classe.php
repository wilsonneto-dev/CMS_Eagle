<?php

    class BlogArtigo extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            $this->set_options([
                'custom_list' => 
                [
                    'query' => 
                        'select 
                            a.id,
                            a.titulo, 
                            DATE_FORMAT( a.data_postagem, \'%d/%m/%Y %h:%i\' ) as data,
                            a.url,
                            aut.nome as autor,
                            cat.titulo as categoria,
                            a.views as views
                        from 
                            blog_artigo as a
                        inner join blog_categoria as cat
                            on cat.id = a.cod_blog_categoria
                        inner join blog_autor as aut
                            on aut.id = a.cod_blog_autor
                        where 
                            a.ativo = 1
                            and cat.ativo = 1
                            and aut.ativo = 1
                        order by 
                            a.data_postagem desc',
                    
                    'fields' => [ 
                        'id'    => 'Id', 
                        'titulo' => 'Título', 
                        'data'  => 'Data', 
                        'autor' => 'Autor' , 
                        'categoria' => 'Categoria',
                        'views' => 'Views'  
                    ]
                ],

                'list_link_button' => true,
                'list_link' => [ 
                    'property' => 'url', 
                    'link' => '/blog/artigo/#property' 
                ] 

            ]);

            $this->set_properties
            ([
                'id' => [],
                'url' => [],

                'cod_blog_layout' => [
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'BlogLayout',
                        'label' => 'titulo',
                        'key' => 'id'
                    ]
                ],
                
                'cod_blog_autor' => [
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'BlogAutor',
                        'label' => 'nome',
                        'key' => 'id'
                    ]
                ],
                
                'cod_blog_categoria' => [
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'BlogCategoria',
                        'label' => 'titulo',
                        'key' => 'id'
                    ]
                ],
                
                'data_postagem' => [ 'type' => 'date' ],
                
                'titulo' => [],
                'introducao' => [ 'type' => 'text' ],
                'header_titulo' => [],
                'header_descricao' => [],
                'header_keywords' => [],
                
                'texto' => [ 'type' => 'editor' ],
                
                'link' => [],
                'video' => [],
                
                'cod_blog_material' => [
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'BlogMetarial',
                        'label' => 'titulo',
                        'key' => 'id'
                    ],
                    'empty_option' => true
                ],
                
                'thumb' => [ 'type' => 'image'],
                'imagem' => [ 'type' => 'image'],
                'imagem_facebook' => [ 'type' => 'image'],

                'views' => ['type' => 'int', 'form_visible' => false, 'list' => true ]
            
            ]);

        }
    }
