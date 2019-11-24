<?php

    class Banner extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            $this->set_properties
            ([
                'id' => [],
                'cod_banner_tipo' => [
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'BannerTipo',
                        'label' => 'nome',
                        'key' => 'id'
                    ]
                ],

                'descricao' => [ 'list' => true ],
                'imagem' => [ 'type' => 'image' ],
                'link' => [],
                
                'visivel' => [ 'type' => 'checkbox', 'list' => true ]

            ]);

        }

    }
