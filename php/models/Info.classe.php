<?php

    class Info extends ModelBase
    {
    	public function initialize()
    	{
    		parent::initialize();
    		
            $this->set_options(
                array(
                    'list_add_button' => false,
                    'list_remove_button' => false
                )
            );

            $this->set_properties([
                'id' => [],

                'dominio' => [ 'type' => 'link', 'list' => true ],
                'telefone1' => [ 'type' => 'phone' ],
                'telefone2' => [ 'type' => 'phone' ],
                'email' => [ 'type' => 'email' ],
                'endereco' => [ 'type' => 'text' ],

                'cod_lista' => 
                [
                    'label' => 'Lista padrão - Cadastros', 
                    'type' => 'foreign',
                    'foreign' => 
                    [
                        'model' => 'Lista',
                        'label' => 'titulo',
                        'key' => 'id'
                    ] 
                ],   

                'logo_header' => [ 'type' => 'image' ],
                'logo_footer' => [ 'type' => 'image' ],
                'icone' => [ 'type' => 'image' ],

                'pre_footer_imagem' => [ 'type' => 'image' ],
                'pre_footer_imagem_alt' => [],
                'pre_footer_imagem_link' => [],

                'header_titulo' => [],
                'header_descricao' => [],
                'header_palavras_chave' => [],

                'newsletter_cta' => [ 'type' => 'text' ],
                'newsletter_botao' => [],

                'cor_cta' => ['type'=>'color'],
                'cor_bg' => ['type'=>'color'],
                'cor_bg_claro' => ['type'=>'color'],

                'config_theme_path' => [ 'form_visible' => false ],
                'config_action_path' => [ 'form_visible' => false ],
                'config_theme_id' => [ 'type' => 'int', 'form_visible' => false ],
                'config_action_id' => [ 'type' => 'int', 'form_visible' => false ],

                'carregar_paginas_info' => [ 'type' => 'checkbox' ],

                'html_header' => [ 'type' => 'text' ],
                'html_pre_body' => [ 'type' => 'text' ],
                'html_pos_body' => [ 'type' => 'text' ],

                'disqus_source' => [],

                'lista_estilo' => [ 
                    'type' => 'enum', 
                    'enum' => [ 
                        'list' => 'Lista',
                        'grid' => 'Grid'
                    ],
                    'list' => true 
                ],
                'lista_qtd' => [ 'type' => 'int', 'label' => 'Qtd posts', 'list' => true ],

                'lista_class' => [ 
                    'type' => 'enum', 
                    'enum' => [ 
                        '' => 'nenhum',
                        'halfs' => '2 Colunas',
                        'thirds' => '3 Colunas',
                        'quarters' => '4 Colunas',
                        'fifths' => '5 Colunas'
                    ],
                    'list' => true 
                ],

                'paginacao_config' => [],

                'paginacao_class' => [ 
                    'type' => 'enum', 
                    'enum' => [ 
                        'square' => 'Quadrados',
                        'round' => 'Bordas Redondas',
                        'circle' => 'Redondo'
                    ] 
                ]

 
			]);

    	}
    }

    