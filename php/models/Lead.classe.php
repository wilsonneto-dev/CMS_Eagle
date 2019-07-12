<?php

    class Lead extends ModelBase
    {
    	public function initialize()
    	{
    		parent::initialize();

            $this->set_options([
                'custom_list' => [
                    'query' => 
                        'select 
                            a.id,
                            ( concat(a.nome, \' \', IFNULL(a.sobrenome,\'\') ) ) as nome, 
                            DATE_FORMAT( a.cadastrado, \'%d/%m/%Y %h:%i\' ) as data,
                            b.titulo as lista,
                            a.email as email,
                            a.ref as ref,
                            a.notas as notas
                        from 
                            lead as a
                        inner join lista as b
                            on a.cod_lista = b.id
                        where 
                            b.ativo = 1
                            and a.ativo = 1
                        order by 
                            a.cadastrado desc',
                    'fields' => [ 
                        'id'    => 'Id', 
                        'email' => 'e-mail', 
                        'nome'  => 'Nome', 
                        'data'  => 'Data', 
                        'lista' => 'Lista' , 
                        'ref'   => 'Ref', 
                        'notas' => 'Notas'  
                    ]
                ]
            ]);

    		$this->set_properties([
                'id' => [],

                'nome' => [],
                'sobrenome' => [],
                'email' => [],
                'ocupacao' => [],
                'empresa' => [],
                'telefone' => [],
                'ref' => [],

                'cod_lista' => [ 
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'Lista',
                        'label' => 'titulo',
                        'key' => 'id'
                    ] 
                ],
                'cod_campanha' => [ 
                    'type' => 'foreign' ,
                    'foreign' => [
                        'model' => 'Campanha',
                        'label' => 'titulo',
                        'key' => 'id',
                    ] 
                ],

                'notas' => [ 'type' => 'text' ]

			]);

    	}
    }

    