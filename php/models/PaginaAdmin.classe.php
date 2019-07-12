<?php

    class PaginaAdmin extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            $this->set_options([
                'custom_list' => 
                [
                    'query' => 
                        'select 
                            pg.id,
                            pg.descricao, 
                            m.texto as menu,
                            pg.posicao,
                            pg.bloqueado
                        from 
                            pagina_admin as pg
                        inner join menu_admin as m
                            on pg.cod_menu_admin = m.id
                        where 
                            pg.ativo = 1
                            and m.ativo = 1
                        order by 
                            pg.posicao desc',
                    
                    'fields' => [ 
                        'id'    => 'Id', 
                        'descricao' => 'Página', 
                        'menu'  => 'Menu', 
                        'posicao' => 'Posição',
                        'bloqueado' => 'Bloqueado'  
                    ]
                ]

            ]);

            $this->set_properties
            ([
                'id' => [],
                'url' => [],
                'permissao' => [],
                'descricao' => [],

                'cod_menu_admin' => [
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'MenuAdmin',
                        'label' => 'texto',
                        'key' => 'id'
                    ]
                ],

                'descricao' => [],
                'posicao' => ['type' => 'int'],
                'target' => [
                    'type' => 'enum', 
                    'enum' => 
                    [ 
                        '' => 'Normal',
                        '_blank' => 'Nova Aba',
                        '_blank' => 'Externo'
                    ] 
                ]

            ]);

        }
    }
