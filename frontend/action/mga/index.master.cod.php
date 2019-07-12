<?php

$this->message = "";
if($this->is_post())
{

	$lead = Lead::get([ 
		'email' => $this->get_param('email'), 
		'cod_lista' => $this->get_param('cod_lista') 
	]);

	if($lead == null)
		$lead = new Lead();	

	$lead->load( $_POST );

	$notas = "Pré cadastro";
	$lead->notas = $notas;

	@Email::enviaNota( "Novo lead: \n\n". $lead->text() );

	if($lead->save())
	{
		$this->message = "Obrigado, inscrição realizada com sucesso, até breve!";
	}
	else
	{
		$this->message = "Ocorreu um erro. Tente novamente mais tarde!";
	}

}
	
?>