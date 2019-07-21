<?php

    class GrupoPaginaAdmin extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            $this->set_options([
                'custom_list' => 
                [
                    'query' => 
                        'select 
                            pga.id,
                            g.nome,
                            p.url,
                            p.descricao,
                            m.texto,
                            pga.escrita
                        from 
                            grupo_pagina_admin as pga
                        inner join grupo_admin as g
                            on pga.cod_grupo_admin = g.id
                        inner join pagina_admin as p
                            on pga.cod_pagina_admin = p.id
                        inner join menu_admin as m
                            on p.cod_menu_admin = m.id
                        where 
                            p.ativo = 1
                            and g.ativo = 1
                            and m.ativo = 1
                        order by 
                            g.nome, p.posicao asc',
                    
                    'fields' => [
                        'id'    => 'Id', 
                        'nome' => 'Grupo', 
                        'url'  => 'URL', 
                        'descricao' => 'Página',
                        'texto' => 'Menu',
                        'escrita' => 'Write'  
                    ]
                ],
                'soft_delete' => false
            ]);

            $this->set_properties
            ([
                'id' => [],

                'cod_grupo_admin' => [
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'GrupoAdmin',
                        'label' => 'nome',
                        'key' => 'id'
                    ]
                ],
                'cod_pagina_admin' => [
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'GrupoAdmin',
                        'label' => 'descricao',
                        'key' => 'id'
                    ]
                ],

                'escrita' => ['type' => 'checkbox']   

            ]);

        }
    }
