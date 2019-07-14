<?php

class GrupoAdmin extends ModelBase
{
	public function initialize()
	{
		parent::initialize();
		$this->set_properties
		([
			'id' => [],
			
			'nome' => [ 'list'=> 1],
			'descricao' => [],
			'padrao' => [],

			'cod_pagina_admin' => [
				'type' => 'foreign',
				'foreign' => [
					'model' => 'PaginaAdmin',
					'label' => 'descricao',
					'key' => 'id'
				]
			]
			
		]);

	}
}
