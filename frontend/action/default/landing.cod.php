<?php

$this->obj = Landing::get(['url' => $this->get_param('url')]);

if($this->obj == null)
	die($this->get_param('url') . ': missed...');

$this->layout = $this->obj->layout;

if($this->get_param('obrigado') == 'obrigado')
{
	if($this->get_session("landing-subscribe") == null)
	{
		$this->redirect('/landing/'.$this->obj->url);		
	}else{
		$this->layout .= '_obrigado';
	}
}

if($this->is_post())
{

	$lead = Lead::get([ 'email' => $this->get_param('email'), 'cod_lista' => $this->obj->cod_lista ]);
	if($lead == null)
		$lead = new Lead();	
	
	$lead->load( $_POST );
	$lead->ref = $this->get_param('ref','');
	$lead->cod_lista = $this->obj->cod_lista;

	$lead->save();

	if ( in_array( $this->obj->tipo, [ 'inscricao', 'download'] ) )
	{
		$this->set_session("landing-subscribe", "ok");
		$this->redirect('/landing/'.$this->obj->url.'/obrigado');
	}

	if ( in_array( $this->obj->tipo, [ 'checkout' ] ) )
	{
		$this->redirect( $this->obj->link_pagseguro );
	}

}

?>

