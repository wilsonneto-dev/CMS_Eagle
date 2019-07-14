<?php

$entity_str = StringHelper::camel_case($this->route['entity']);
$instance = null; 
$clone = null;

$write_permission = $this->check_permissions( $this->route['entity'] );

// se tem um id de objeto e é para editar
if( $this->route['id'] == null )
{
	$instance = new $entity_str();
}
else
{
	$instance = $entity_str::get( $this->route['id'] );
	$clone = clone $instance;
	if( $instance == null )
		$this->redirect( '/admin/crud/' . $this->route[ 'entity' ] );
}

if($this->is_post())
{
	if($write_permission)
	{
		$saved = $instance->form_save($_POST, $this);

		LogAdmin::_salvar
		( 
			$instance->get_options('label')." - save - " .$saved, 
			$instance->get_source(), $this->get_credentials('admin')->id, 
			json_encode($clone), json_encode( $instance ) 
		);
	
		if($saved)
		{
			$this->message('Salvo com sucesso');
			$this->redirect( '/admin/crud/' . $this->route[ 'entity' ] );
		}
		else 
			$this->message('Ocorreu um erro ao cadastrar', 'error');
	
	}
	else
	{
		$this->message('Usuário sem permissão de alteração.', 'error');
	}

}

$this->html_content = $instance->get_form_page($write_permission)->render(true);