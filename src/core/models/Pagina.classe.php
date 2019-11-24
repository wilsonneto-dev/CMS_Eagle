<?php

    class Pagina extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            $this->set_properties
            ([
                'id' => [],
                'url' => ['list' => true],

                'titulo' => [ 'list' => true ],
                'sub_titulo' => [],
                'header_titulo' => [],
                'header_descricao' => [],
                'header_palavras_chave' => [],

                'texto' => [ 'type' => 'editor' ],
                'imagem' => [ 'type' => 'image' ],
                
                'ordem' => [ 'type' => 'int' ],
                
                'menu' => [ 'type' => 'checkbox' ],
                'visivel' => [ 'type' => 'checkbox' ],

                'tipo' => 
                [ 
                    'type' => 'enum', 
                    'enum' => 
                    [ 
                        'default' => 'Padrão'
                    ] 
                ],

                'Layout' => 
                [ 
                    'type' => 'enum', 
                    'enum' => 
                    [ 
                        'default' => 'Padrão'
                    ] 
                ]
            
            ]);

        }
    }
