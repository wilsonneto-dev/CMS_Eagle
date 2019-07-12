<?php

    class MenuAdmin extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            // $this->set_options();

            $this->set_properties
            ([
                'id' => [],
                'texto' => [ 'list' => true ],
                'ordem' => [ 'type' => 'int', 'list' => true ],
                'icone' => []

            ]);

        }
    }
