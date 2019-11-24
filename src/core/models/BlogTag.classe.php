<?php

    class BlogTag extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();
            $this->set_properties
            ([

                'id' => [],

                'url' => [ 'list' => true ],
                'titulo' => ['list' => true],
                'texto' => [ 'type' => 'text' ]

            ]);

        }
    }
