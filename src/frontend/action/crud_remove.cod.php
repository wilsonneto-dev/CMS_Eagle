<?php

$entity_str = StringHelper::camel_case($this->route['entity']);
$instance = null; 
$clone = null;

$write_permission = $this->check_permissions( $this->route['entity'] );

if( $this->route['id'] == null )
{
	$this->redirect( '/admin/crud/' . $this->route[ 'entity' ] );
}
else
{
	$instance = $entity_str::get( $this->route['id'] );
	$clone = clone $instance;
	if( $instance == null )
		$this->redirect( '/admin/crud/' . $this->route[ 'entity' ] );
}

if($write_permission)
{
	$removed = $instance->remove();

	LogAdmin::_salvar
	( 
		$instance->get_options('label')." - remove - " .$removed, 
		$instance->get_source(), $this->get_credentials('admin')->id, 
		json_encode($clone), 
		'' 
	);
	
	if($removed)
		$this->message('Removido com sucesso');
	else 
		$this->message('Ocorreu um erro', 'error');
	
}
else
{
	$this->message('Usuário sem permissão', 'error');	
}

$this->redirect( '/admin/crud/' . $this->route[ 'entity' ] );
