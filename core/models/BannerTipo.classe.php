<?php

    class BannerTipo extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            $this->set_properties
            ([
                'id' => [],
                'nome' => [ 'list' => true ],

                /*
                'cod_banner_tipo' => [
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'BannerTipo',
                        'label' => 'nome',
                        'key' => 'id'
                    ]
                ],
                */
                
                'altura' => [ 'list' => true ],
                'largura' => [ 'list' => true ]
            
            ]);

        }
    }
