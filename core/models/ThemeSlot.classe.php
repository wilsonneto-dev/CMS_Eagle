<?php

    class ThemeSlot extends ModelBase
    {
        public function initialize()
        {
            parent::initialize();

            $this->set_options([
                'custom_list' => 
                [
                    'query' => 
                        'select 
                            slot.id,
                            slot.ordem,
                            bloc.bloc,
                            bloc.descricao
                        from 
                            theme_slot as slot
                        inner join theme_bloc as bloc
                            on slot.cod_theme_bloc = bloc.id
                        where 
                            bloc.ativo = 1
                            and slot.ativo = 1
                        order by 
                            slot.ordem asc',
                    
                    'fields' => [ 
                        'id' => 'Id', 
                        'ordem' => 'Ordem', 
                        'bloc'  => 'Bloc', 
                        'descricao' => 'Descrição'  
                    ]
                ],

            ]);

            $this->set_properties
            ([
                'id' => [],

                'ordem' => [ 'type' => 'int', 'list' => true ],

                'cod_theme_bloc' => 
                [
                    'type' => 'foreign',
                    'foreign' => [
                        'model' => 'ThemeBloc',
                        'label' => 'bloc',
                        'key' => 'id'
                    ],
                    'empty_option' => true,
                    'list' => true
                ]                
            
            ]);

        }

        public static function get_slots()
        {
            return BaseDao::query(
            '   select 
                    slot.id,
                    slot.ordem,
                    bloc.bloc,
                    bloc.descricao
                from 
                    theme_slot as slot
                inner join theme_bloc as bloc
                    on slot.cod_theme_bloc = bloc.id
                where 
                    bloc.ativo = 1
                    and slot.ativo = 1
                order by 
                    slot.ordem asc
            ');
        }

    }

/*

CREATE TABLE `theme_slot` 
(

    `id` int(11) NOT NULL primary key AUTO_INCREMENT,
    `cod_theme_bloc` varchar(500) DEFAULT NULL,
    `ordem` int DEFAULT 0,
    `ativo` int(1) DEFAULT '1',
    `cadastrado` timestamp DEFAULT CURRENT_TIMESTAMP,
    `atualizado` timestamp

);


INSERT INTO `pagina_admin` 
    (`id`, `ativo`, `datacadastro`, `codprojeto`, `descricao`, `posicao`, `url`, `target`, `cod_menu_admin`, `bloqueado`, `permissao`) 
VALUES 
    (NULL, '1', '2015-08-25 06:59:37', '1', 'Tema - Slots', '11', 'admin/crud/theme_slot', NULL, '5', '0', 'theme_slot');



INSERT INTO `grupo_pagina_admin` (`cod_grupo_admin`, `cod_pagina_admin`, `escrita`) VALUES ('4', LAST_INSERT_ID(), '1');

*/