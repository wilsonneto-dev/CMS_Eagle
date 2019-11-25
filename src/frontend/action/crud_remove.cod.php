<?php

$entity_str = StringHelper::camel_case($this->route['entity']);
$instance = null; 
$clone = null;

$write_permission = $this->check_permissions( $this->route['entity'] );

if( $this->route['id'] == null )
{
	$this->redirect( '/crud/' . $this->route[ 'entity' ] );
}
else
{
	$instance = ModelGenerator::get_models($entity_str);
	if($instance == null)
	{
		$instance = $entity_str::get( $this->route['id'] );
	}
	else 
	{
		$instance = $instance::get_static($instance, $this->route['id']);
	}

	$clone = clone $instance;
	if( $instance == null )
		$this->redirect( '/crud/' . $this->route[ 'entity' ] );
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

$this->redirect( '/crud/' . $this->route[ 'entity' ] );
