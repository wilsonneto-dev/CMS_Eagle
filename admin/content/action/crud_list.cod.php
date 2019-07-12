<?php

$entity_str = StringHelper::camel_case($this->route['entity']);

$write_permission = $this->check_permissions( $this->route['entity'] );

$this->html_content = $entity_str::_get_list_page($write_permission)->render(true);
