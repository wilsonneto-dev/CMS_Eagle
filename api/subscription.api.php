<?php

$this->registrar_acoes
([

	'lead' => function()
	{

		$lead = Lead::get([ 'email' => $this->get_param('email'), 'cod_lista' => $this->get_param('cod_lista') ]);

		if($lead == null)
			$lead = new Lead();	
		
		$lead->load( $_POST );
		
		$this->set_funcao_apos( 
			function($ws) use($lead) 
			{
				Email::enviaNota( "Novo lead cadastrado no form de newsletter: \n\n". $lead->text() );
			}
		);

		
		if($lead->save())
		{
			return 
			([
				'status' => 'success', 
				'msg' => 'Cadastrado com sucesso!'
			]);
		}
		else
		{
			return 
			([
				'status' => 'fail', 
				'msg' => 'Ocorreu um erro',
				'obj' => $lead->json()
			]);			
		}

	},

	'lead_dmv' => function()
	{
		$lead = Lead::get([ 'email' => $this->get_param('email'), 'cod_lista' => $this->get_param('cod_lista') ]);

		if($lead == null)
			$lead = new Lead();	
		
		$lead->load( $_POST );
		
		$notas = "Referencia: ".$this->get_param('ref_pessoa')." ".$this->get_param('ref_pessoa_tel')."\n";
		$notas .= "Referencia 2: ".$this->get_param('ref_pessoa2')." ".$this->get_param('ref_pessoa2_tel');
		$lead->notas = $notas;

		$this->set_funcao_apos( 
			function($ws) use($lead) 
			{
				Email::enviaNota( "Novo checkout cadastrado: \n\n". $lead->text() );
			}
		);

		if($lead->save())
		{
			return 
			([
				'status' => 'success', 
				'msg' => 'Cadastrado com sucesso!'
			]);
		}
		else
		{
			return 
			([
				'status' => 'fail', 
				'msg' => 'Ocorreu um erro',
				'obj' => $lead->json()
			]);			
		}

	},

	'contact' => function()
	{
		$text = "";
		foreach ($_POST as $key => $value) 
		{
			$text .= "<b>$key: </b>".htmlspecialchars($value)."<br />";
		}
		
		if(Email::enviaContato( $_POST['nome'], $_POST['email'], $text )) 
		{
			return 
			([
				'status' => 'success', 
				'msg' => 'Contato enviado!'
			]);		
		} 
		else 
		{
			return 
			([
				'status' => 'fail', 
				'msg' => 'Ocorreu um erro ao tentar enviar'
			]);			
		}
	}		

]);