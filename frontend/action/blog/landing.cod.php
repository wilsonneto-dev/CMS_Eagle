<?php

$this->obj = Landing::get(['url' => $this->get_param('url')]);

if($this->obj == null)
	die($this->get_param('url') . ': missed...');

$this->layout = $this->obj->layout;

if($this->get_param('obrigado') == 'obrigado')
{
	$this->layout .= '_obrigado';	
}

if($this->is_post())
{

	$lead = Lead::get([ 'email' => $this->get_param('email'), 'cod_lista' => $this->obj->cod_lista ]);
	if($lead == null)
		$lead = new Lead();	

	$lead->load( $_POST );
	$lead->ref = $this->get_param('ref','');
	$lead->notas = $this->get_param('btn','');
	$lead->cod_lista = $this->obj->cod_lista;

	if( 
		( $this->get_param('ref','') == "Quero Me Cadastrar!" )
		&& ( $this->obj->link_pagseguro != "" )
	)
	{
		$this->redirect( $this->obj->link_pagseguro );
	}

	$lead->save();

	if($this->obj->enviar_email == 1)
	{
		Email::enviaNota( "Novo lead - em \"".$this->obj->url."\": \n\n". $lead->text() );
	}

	if ( in_array( $this->obj->tipo, [ 'inscricao', 'download'] ) )
	{
		$this->redirect('/landing/'.$this->obj->url.'/obrigado');
	}

	if ( in_array( $this->obj->tipo, [ 'checkout' ] ) )
	{
		$this->redirect( $this->obj->link_pagseguro );
	}

}

?>

