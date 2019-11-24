<?php

    class Landing extends ModelBase
    {
    	public function initialize()
    	{
    		parent::initialize();
    		$this->set_properties
    		([
                'id' => [],
                'url' => [],
                'titulo' => ['label' => 'Título', 'list' => true],
                'titulo_header' => [ 'label' => 'Título Cabeçario'],
    			'palavras_chave' => [],
    			'descricao'	=> [ 'label' => 'Descrição' ],
    			'texto' => [ 'type' => 'editor' ],
                'texto_meio' => [ 'type' => 'text' ],
                'texto_pre_form' => [ 'type' => 'text' ],
                'texto_final' => [ 'type' => 'text' ],
                'data_evento' => [ 'type' => 'date' ],
                'titulo_agradecimento' => [],
                'texto_agradecimento' => [ 'type' => 'text' ],
                'botao_texto' => [],
                'tipo' => [ 
                    'type' => 'enum', 
                    'enum' => [ 
                        'inscricao' => 'Inscrição',
                        'download' => 'Download',
                        'checkout' => 'Checkout'
                    ],
                    'list' => true 
                ],
                'layout' => [], 
                /*    'type' => 'enum', 
                    'enum' => [ 
                        'two_columns' => 'Duas Colunas - Compacto'
                    ] 
                ],*/
                'tipo_form' => [ 
                    'type' => 'enum', 
                    'enum' => [ 
                        'nenhum' => 'Nenhum',
                        'simples' => 'Nome, E-mail',
                        'profissional' => 'Informações Profissionais'
                    ] 
                ],
                'popup_lead' => [ 'type' => 'checkbox', 'label' => 'Ativar popup de captação de lead' ],
                'popup_lead_cancelar' => ['type' => 'checkbox', 'label' => 'Ativar cancelar na popup'],
                'cod_lista' => [ 
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'Lista',
                        'label' => 'titulo',
                        'key' => 'id'
                    ] 
                ],    

                'video' => [ 'label' => 'Vídeo' ],
                'arquivo' => [ 'type' => 'file' ],
                'link_pagseguro' => [],
                'imagem_topo' => ['type' => 'image'],
                'imagem_quadrada' => ['type' => 'image'],
                'imagem_thumb' => ['type' => 'image'],
                'imagem_facebook' => ['type' => 'image'],

                'oferta' => [ 'type' => 'checkbox', 'label' => 'Ativar oferta na tela de agradecimento?' ],
                'oferta_titulo' => [],
                'oferta_texto' => [ 'type' => 'text' ],
                'oferta_video' => [],
                'oferta_imagem' => [ 'type' => 'image' ],
                'oferta_texto_final' => [],
                'oferta_botao_texto' => [],
                'oferta_botao_link' => [],
                
                'general_style' => [ 'type' => 'text' ],

                'enviar_email' => [ 'type' => 'checkbox' ]
			
            ]);

    	}
    }
