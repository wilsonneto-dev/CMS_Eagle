<?php

    class Lista extends ModelBase
    {
    	public function initialize()
    	{
    		parent::initialize();

            $this->set_options([
                'custom_list' => [
                    'query' => 
                        'select 
                            b.titulo,
                            count(b.id) as leads,
                            b.id
                        from 
                            lista as b
                        left join lead as a
                            on a.cod_lista = b.id
                        where 
                            b.ativo = 1
                            and a.ativo = 1
                        group by
                            b.titulo
                        order by 
                            leads',
                    'fields' => 
                    [ 
                        'id'    => 'Id', 
                        'titulo' => 'Lista', 
                        'leads'  => 'Leads' 
                    ]
                ]
            ]);

            $this->set_properties
    		([
                'id' => [],
                'titulo' => ['label' => 'Título', 'list' => true],
    			'descricao' => [ 'label' => 'Descrição', 'type' => 'text' ]
			]);

    	}
    }
