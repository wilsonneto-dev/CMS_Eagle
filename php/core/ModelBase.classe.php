<?php

class ModelBase
{
	private $source = null;
	private $options = null;
	private $data = array();
	private $foreigns = array();

	function get_foreigns()
	{
		return $this->foreigns;
	} 

	function __construct()
	{
		$this->initialize();
	} 

	public function initialize()
	{
		$this->set_source(StringHelper::underscore(get_class($this)));
		$this->set_options(array());
	}

	public function get_key()
	{
		return $this->get_data( $this->get_options('key') ); 
	}

	public function set_key($_p)
	{
		return $this->data[ $this->get_options('key') ] = $_p;
		die($_p); 
	}

	public function get_options($key = null)
	{
		if($key == null)
			return $this->options;
		else
		{
			if(isset($this->options[$key]))
				return $this->options[$key];
			else
				return null;
		}
	}

	public function set_options($array_options)
	{
		$options_merged = array_merge(
			array
			(
				'soft_delete' => true,
				'key' => 'id',
				'title' => StringHelper::label($this->get_source()),
				'title_plural' => StringHelper::label($this->get_source()).'s',
				'menu_destaque' => $this->get_source(),
				'list_edit_button' => true,
				'list_remove_button' => true,
				'list_link_button' => false,
				'list_add_button' => true
			),
			$array_options
		);
		$this->options = $options_merged;
	}

	public function set_source($source)
	{
		$this->source = $source;
	}

	public function get_source()
	{
		return $this->source;
	}

	public function set_properties($array_properties)
	{
		foreach ($array_properties as $property => $options) 
		{
			$this->set_property($property, $options);
		}
	}

	public function set_property($property, $options)
	{
		$default_options = array();
		
		if($property == "id")
		{
			$default_options = array
			(
				'type' => 'int',
				'length' => 15,
				'required' => false,
				'input' => array( 'display' => false ),
				'list' => true,
				'form_visible' => true
			);
		}
		else
		{
			$default_options = array
			(
				'type' => 'varchar',
				'length' => 256,
				'required' => false,
				'input' => array( 'display' => true ),
				'list' => false,
				'form_visible' => true
			);
		}

		if(is_array($options))
			$options_merged = array_merge($default_options, $options);
		else
		$options_merged = $default_options;
		
		if(!isset($options_merged['label']))
		{
			$options_merged['label'] = StringHelper::label($property);	
		}

		if($options_merged['type'] == 'foreign')
		{
			$item_foreign = [];
			$item_foreign['foreign_field'] = $property;

			if(isset($options_merged['foreign']))
			{
				if(isset($options_merged['foreign']['model']))
					$item_foreign['model'] = $options_merged['foreign']['model'];
				else
					$item_foreign['model'] = StringHelper::camel_case(str_replace('cod_', '', $property));

				if(isset($options_merged['foreign']['label']))
					$item_foreign['label'] = $options_merged['foreign']['label'];
				else
					$item_foreign['label'] = 'titulo';

				if(isset($options_merged['foreign']['key']))
					$item_foreign['key'] = $options_merged['foreign']['key'];
				else
					$item_foreign['key'] = 'id';

				if(isset($options_merged['foreign']['source']))
					$item_foreign['source'] = $options_merged['foreign']['source'];
				else
					$item_foreign['source'] = str_replace('cod_', '', $property);
			}else{
				$item_foreign['model'] = StringHelper::camel_case(str_replace('cod_', '', $property));
				$item_foreign['label'] = 'titulo';
				$item_foreign['key'] = 'id';
				$item_foreign['source'] = str_replace('cod_', '', $property);
			}
			$item_foreign['query_select'] = 
				'select '.
				$item_foreign['key'].' as valor,'.
				$item_foreign['label'].' as texto '.
				' 	from '.$item_foreign['source'].
				' 	where ativo = 1 '.
				'	order by '.$item_foreign['label'].' desc;';

			$this->foreigns[ $item_foreign['source'] ] = $item_foreign;	
			$options_merged['foreign'] = array_merge( $options_merged['foreign'], $item_foreign );
		}
		$options_merged['label'] = str_replace('Cod ', '', $options_merged['label']);
		$this->data[$property] = $options_merged;	
	}

	public function get_data($property = null)
	{
		if($property == null)
			return $this->data;
		else{
			if(isset($this->data[$property]['value']))
				return $this->data[$property]['value'];
			else
				return null;
		}
	} 

	public function get_property($property = null)
	{
		if($property == null)
			return $this->data;
		else{
			if(isset($this->data[$property]))
				return $this->data[$property];
			else
				return null;
		}
	} 

	public function __set($name, $value)
	{
		if (array_key_exists($name, $this->data)) 
		{
					return $this->data[$name]["value"] = $value;
			}
			else
			{
				$this->data[$name] = array('value' => $value);	
			}
	}

	public function __get($name)
	{
		if (array_key_exists($name, $this->data)) 
		{
			if(isset($this->data[$name]["value"]))
				return $this->data[$name]["value"];
		}else{
			// verificar nas relações com outras entidades
			if(array_key_exists($name, $this->foreigns)){
	
				// verifica se tem um id
				if( $this->get_data( $this->foreigns[$name]["foreign_field"]) == null)
					return null;
				
				// instancia um objeto para pegar
				$obj = new $this->foreigns[$name]["model"]();
				
				// verifica se já está em cache
				if( isset($this->foreigns[$name]["cache"]))
					return $this->foreigns[$name]["cache"];

				// se não está em cache traz da base
				$ret = $obj->get( $this->get_data( $this->foreigns[$name]["foreign_field"] ) );
				if($ret)
				{
					// se trouxe algo salva no cache
					$this->foreigns[$name]["cache"] = $ret;
				}
				return $ret; 
			}
		}
		return null;
	}

	public function __isset($name)
	{
			return isset($this->data[$name]);
	}

	public function __unset($name)
	{
			unset($this->data[$name]);
	}

	// database functions
	public function save($options = null) { return ModelBaseDAO::save($this, $options); }
	public function remove($options = null){ return ModelBaseDAO::remove($this, $options); }
	public static function get($options = null, $force_options_array = false){ return ModelBaseDAO::get(new static(), $options, $force_options_array); }
	public static function get_all($options = null, $force_options_array = false) { return ModelBaseDAO::get_all(new static(), $options, $force_options_array); }
	public static function count($options = null) { return ModelBaseDAO::count(new static(), $options); }

	public function get_key_value()
	{
	$array_properties = array();
	foreach ($this->get_data() as $k => $v) 
	{
		$array_properties[$k] = isset($v['value'])?$v['value']:null;
	}    	
	return $array_properties;
	}

	public function json()
	{
	return json_encode($this->get_key_value());
	}

	public function text($show_empty = false)
	{
		$text = '';
		foreach ($this->get_data() as $k => $v)
		{
			if( $show_empty || ( $this->$k != '' ) )
			{
				$text .= ''.$v['label'].': '.$this->$k."\n";
			}
		}
	return $text;
	}

	public static function _get_list_page($write_permission = 1)
	{
		$obj = new static();
		return $obj->get_list_page($write_permission); 
	}	

	public function get_list_item_placeholder($k)
	{
		$property = $this->get_property($k);
		if(isset($property))
		{
			if(isset($property["type"]))
			{
				switch ($property["type"]) 
				{

					case 'image':
						return '<td class="dt_td_img">
									<a class="fancy_inline" href="/#' . $k . '">
										<img class="dt_img_in" src="/#' . $k . '" />
									</a>
								</td>';
						break;
					
					default:
						break;

				}
			}
		}
		
		return '<td>#'.$k.'</td>';
	}

	public function get_list_page($write_permission = 1)
	{
		$entity_str = StringHelper::camel_case($this->get_source());
		$menu_destaque = $this->get_options('menu_destaque');
		$page = new StdAdminPage();
		$page->title = $this->get_options('title');
		$page->page = $this->get_source();

		$properties = array_keys( $this->get_data() );
		$arr_fields = [];
		$arr_titles = [];
		foreach ($properties as $property) 
		{
			if($this->get_data()[$property]['list'])
			{
				$arr_fields[] = $property;
				$arr_titles[] = $this->get_data()[$property]['label'];
			}	
		}				

		$r = new Repeater();
		$r->campos = implode(';', $arr_fields);

		$custom_list = $this->get_options('custom_list');
		
		$r->sql = "
			SELECT 
				".implode(',', $arr_fields)." 
			FROM 
				" . $this->get_source() . "
			WHERE 
				ativo = 1";


		$html_items = '';
		foreach ($arr_fields as $k => $v) 
		{
			$html_items .= $this->get_list_item_placeholder($v);
		}

		if( $custom_list != null )
		{
			$r->sql = $custom_list['query'];
			$r->campos = implode(';', array_keys($custom_list['fields']));
			$html_items = '';
			foreach ($custom_list['fields'] as $k => $v) 
			{
				$html_items .= $this->get_list_item_placeholder($k);
			}
			$arr_titles = $custom_list['fields'];
		}

		$controls = '';
		if($this->get_options('list_link_button'))
		{
			if($this->get_options('list_link') != null)
			{	
				$options_link = $this->get_options('list_link');
				$link = $options_link['link'];
				if(isset($options_link['property']))
				{
					$link = str_replace('#property', '#'.$options_link['property'], $link);
				}else{
					if($this->get_data('src') != null)
					{
						$link = str_replace('#property', '#'.$options_link['property'], $link);
					}		
				}

			}
			$controls .= "<a class=\"controle\" target=\"_blank\" title=\"Link\" href=\"$link\"><img src=\"/admin/theme/img/link.png\" /></a>";
		}
		if($this->get_options('list_edit_button'))
		{
			$controls .= "<a class=\"controle\" title=\"Editar\" href=\"/admin/crud/" . $this->get_source() . "/form/#".$this->get_options('key')."\"><img src=\"/admin/theme/img/edt.png\" /></a>";
		}
		if($this->get_options('list_remove_button') && ($write_permission == 1))
		{
			$controls .= "<a class=\"controle\" title=\"Excluir\" onclick=\"return confirm('Excluir?');\" href=\"/admin/crud/" . $this->get_source() . "/remove/#".$this->get_options('key')."\"><img src=\"/admin/theme/img/del.png\" /></a>";
		}

		$r->txtItem = "
			<tr>
				".$html_items."
				<td class=\"td-controls\">
					".$controls."					
				</td>
			</tr>
		";
		$r->exec();

		if($write_permission == 1)
			$page->cadastrar = $this->get_options('list_add_button');
		else
			$page->cadastrar = 0;
		
		$page->table = true;
		$page->table_header = "<th>".implode('</th><th>', $arr_titles)."</th>";
		$page->table_content = $r->html;

		return $page; 
	}


	public static function _get_form_page($permission = 1)
	{
		$obj = new static();
		return $obj->get_form_page($permission); 
	}	

	public function get_form_page($permission = 1)
	{
		$entity_str = StringHelper::camel_case($this->get_source());
		$menu_destaque = $this->get_options('menu_destaque');

		$page = new StdAdminPage();
		$page->title = $this->get_options('title');
		$page->page = $this->get_source();

		$page->back_link = true;
		$page->back_link_url = 'crud/'.$this->get_source();
		$page->title_back = $this->get_options('title_plural');

		$page->form = true;
		$page->form_fields = [];

		$page->permissao = $permission;

		foreach ($this->get_data() as $property => $arr) 
		{
			if($arr['form_visible'] == true)
			{
				$field = array_merge($arr);
				$field['name'] = $property;
				$page->form_fields[] = $field;				
			}
		}

		return $page; 
	}

	public function load($arr)
	{
		foreach ( array_keys( $this->get_data() ) as $property ) 
		{
			if( isset( $arr[$property] ) )
			{
				$this->$property = $arr[$property];
			}
		}
	}

	public function form_save($post, $context)
	{
		foreach ($this->get_data() as $property => $arr) 
		{
			$type_property = $this->get_data()[$property]['type'];
			
			/* se for imagem verifica o excluir */
			if( in_array($type_property, ['image', 'file'] ) )
			{
				if(isset($post['exclude_'.$property]))
				{
					if($post['exclude_'.$property] == 'ativo' || $post['exclude_'.$property] == '1')
					{
						$this->$property = '';
					}
				}
			}


			/* para aqueles q nao aparecem no post mas tem q colocar valor */
			if( in_array($type_property, ['checkbox'] ) )
			{
				if(isset($post[$property]))
				{
					if($post[$property] == 'ativo' || $post[$property] == '1')
					{
						$this->$property = 1;
						continue;
					}	
				}
				$this->$property = 0;
			}

			if(isset($post[$property]) || isset($_FILES[$property]))
			{

				switch ($arr['type']) 
				{
					case 'image':
					case 'file':
					if ( $_FILES[$property]["error"] == 0 )
					{
						$hash = $this->get_source() ."-". GeneralHelper::gerar_hash(12);
						$this->$property = Upload::salvaArq( $hash, $_FILES[$property] );
					}
					break;

					default:
						$this->$property = $post[$property];			
						break;
				
				}

			}
		}
		return $this->save();
	} 

}

class ModelBaseDAO extends BaseDAO
{
	
	private static function build_query(ModelBase $model, $options, $force_options_array = false, $extra_options = null)
	{
		if($extra_options == null)
			$extra_options = [];

		if( !is_array($options) )
		{
			if( $options != null )
			{
				$options = array($model->get_options('key') => $options);
			}else{
				$options = [];
			}
		}

		$where_array = $options;
		if(array_key_exists('where', $options))
			$where_array = $options['where'];
		else if($force_options_array == true)
			$where_array = [];	

		$not_where_array = [];
		if(array_key_exists('not-where', $options))
			$not_where_array = $options['not-where'];

		$where_like_array = [];
		if(array_key_exists('where-like', $options))
			$where_like_array = $options['where-like'];


		$options = array_merge($extra_options, $options);
		$query_mode = '';
		if( array_key_exists('query_mode', $options) )
		{
			$query_mode = $options['query_mode'];
		}

		$properties = array_keys( $model->get_data() );

		if(isset($options['properties']))
		{
			$arr_options_properties = array();
			if(is_string($options['properties']))
			{
				$arr_options_properties = explode(',', $options['properties']);
			}
			else
			{
				$arr_options_properties = $options['properties'];
			}
			$properties = $arr_options_properties;
		}
		$query_fields = implode( ', ', $properties );
		
		$source = $model->get_source();
		
		$where = '';
		if($model->get_options('soft_delete') == true)
			$where = ' ativo = 1 ';
		
		foreach ($where_array as $key => $value) 
		{
			if(strlen($where)>0)
				$where .= ' AND ';
			
			switch ($model->get_property($key)['type']) 
			{
				case 'password':
					$where .= $key.' = MD5( \''.BaseDAO::prepare_var($value).'\' )';
					break;
				
				default:
					$where .= $key.' = \''.BaseDAO::prepare_var($value).'\'';
					break;
			}
		}

		if(count($not_where_array) > 0)
		{
			$not_where_count = 0;
			$where .= ' AND NOT ( ';
			foreach ($not_where_array as $key => $value) 
			{
				if($not_where_count++ > 0)
					$where .= ' OR ';

				$where .= ' '.$key.' = \''.BaseDAO::prepare_var($value).'\'';
			
			}
			$where .= ' ) ';	
		}

		if(count($where_like_array) > 0)
		{
			$where_like_count = 0;
			$where .= ' AND ( ';
			foreach ($where_like_array as $key => $value) 
			{
				if($where_like_count++ > 0)
					$where .= ' OR ';

				$where .= ' '.$key.' like \'%'.BaseDAO::prepare_var($value).'\'%';
			
			}
			$where .= ' ) ';	
		}

		// $not_where_array

		$order = '';
		if(array_key_exists('order', $options))
		{
			$order_array = $options['order'];
			
			if(is_array($order_array))
			{
				if( count($order_array) > 0){
					$order = 'ORDER BY ';
					foreach ($order_array as $k => $v) 
					{
						if($order != 'ORDER BY ')
							$order .= ', ';
						$order .= $k . ' ' . ($v == -1 ? 'desc': 'asc');
					}
				}
			}
			else if(is_string($order_array))
			{
				$order = 'ORDER BY '.$order_array;
			}
			
		}

		$limit = '';
		if(array_key_exists('limit', $options))
		{
			$limit_array = $options['limit'];
			
			if(is_array($limit_array))
			{
				if( count($limit_array) > 0){
					$limit = 'LIMIT ';
					foreach ($limit_array as $k => $v) 
					{
						if($limit != 'LIMIT ')
							$limit .= ', ';
						$limit .= $v;
					}
				}
			}
			else
			{
				$limit = 'LIMIT '.$limit_array;
			}
			
		}


		$query = 
			' SELECT '	.$query_fields.
			' FROM '	.$source.
			' WHERE '	.$where.
			' '.$order.
			' '.$limit;

		// echo ("<br />".$query."<br />");

		return $query;

	}

	// DATE_FORMAT( a.data_postagem, \'%d/%m/%Y %h:%i\' ) as data
	public static function fill_model_from_fech( ModelBase $model, $fetch )
	{
		$data = $model->get_data();
		foreach ( array_keys( $data ) as $property)
		{
			if(isset($fetch->$property))
			{
				switch ($data[$property]['type']) 
				{
					case 'date':
						$model->$property = (new DateTime($fetch->$property))->format('d/m/Y');
						break;
					
					default:
						$model->$property = $fetch->$property;
						break;
				}
			}
		} 
		return $model;
	}

	public static function get(ModelBase $model, $options = null, $force_options_array = false)
	{
		if($options == null)
			$options = [];

		$query = self::build_query( $model, $options, $force_options_array, [ 'limit' => 1 ] );

		try 
		{
			$_this = new static();
			if($_this->abreConexao()){
				if( $q = $_this->con->query($query) )
				{
					if($q->num_rows > 0)
					{
						$fetch = $q->fetch_object();
						return self::fill_model_from_fech($model, $fetch);						
					}
					else 
					{
						return false;	
					}
				}
				else
				{
					throw new Exception($_this->con->error);
				}
			}
			else 
			{
				throw new Exception($_this->con->error);
			}
		} 
		catch (Exception $e) 
		{
			BaseDao::exception($e);
		}
	}

	public static function get_all(ModelBase $model, $options = null, $force_options_array = false)
	{
		$query = self::build_query($model, $options, $force_options_array);

		try 
		{
			$_this = new static();
			if($_this->abreConexao()){
				if( $q = $_this->con->query($query) )
				{
					if($q->num_rows > 0)
					{
						$listObjects = array();
						while($fetch = $q->fetch_object())
						{	
							$class_name = get_class($model);
							$new_obj = new $class_name();
							self::fill_model_from_fech($new_obj, $fetch);						
							$listObjects[] = $new_obj;
						}
						return $listObjects;
					}
					else 
					{
						return false;	
					}
				}
				else
				{
					throw new Exception($_this->con->error);
				}
			}
			else 
			{
				throw new Exception($_this->con->error);
			}
		} 
		catch (Exception $e) 
		{
			BaseDao::exception($e);
		}
	}

	public static function save(ModelBase $model, $options = null)
	{ 
		if($options == null)
			$options = array();

		$query = '';
		if($model->get_key() == null)
		{
			$query_values = '';
			$query_fields = '';
			foreach ($model->get_data() as $property => $data) 
			{

				if($model->$property != null)
				{
					if($query_values != '')
					{
						$query_values .= ',';
						$query_fields .= ',';
					}

					$type = $model->get_data()[$property]['type'];

					switch ($type) {
						case 'password':
							$query_values .= 'MD5( \''.$model->$property.'\' )';
							break;

						case 'date':
							$query_values .= "STR_TO_DATE('".str_replace("'", "''", $model->$property)."', '%d/%m/%Y')";
							break;

						default:
							$query_values .= '\''.str_replace("'", "''", $model->$property).'\'';
							break;
					}

					$query_fields .= $property;					
				}
			}

			// save
			$query = 
				'INSERT INTO '.$model->get_source().
				' ('.$query_fields.')'.
				' values ('.$query_values.');';
		}
		else
		{
			// update
			$query_values = '';
			$properties = array_keys( $model->get_data() );
			if(isset($options['properties']))
			{
				$arr_options_properties = array();
				if(is_string($options['properties']))
				{
					$arr_options_properties = explode(',', $options['properties']);
				}
				else
				{
					$arr_options_properties = $options['properties'];
				}
				$properties = $arr_options_properties;
			}

			foreach ($properties as $property) 
			{

				if($model->$property !== null && $property != $model->get_options('key'))
				{
					if($query_values != '')
					{
						$query_values .= ',';
					}

					$type = $model->get_property($property)['type'];
					
					switch ($type) 
					{
						case 'password':
							if($model->$property != '')
								$query_values .= $property.' = MD5( \''.$model->$property.'\' )';
							else
								$query_values .= $property.' = '.$property.' ';							
							break;

						case 'date':
							$query_values .= ' '.$property.' = '."STR_TO_DATE('".str_replace("'", "''", $model->$property)."', '%d/%m/%Y') ";
							break;

						default:
							$query_values .= ' '.$property.' = \''.str_replace("'", "''", $model->$property).'\'';
							break;
					}
						
				}	
			}				

			// save
			$query = 
				'UPDATE '.$model->get_source().
				' SET '.$query_values.' '.
				' WHERE '.$model->get_options('key').' = \''.$model->get_key().'\'';
		}

		try {
			$_this = new static();
			if($_this->abreConexao()){
				if($q = $_this->con->query($query))
				{
					if($model->get_key() == null)
					{
						$model->id = $_this->con->insert_id;
					}
					return $model;
				}
				else
				{
					throw new Exception($_this->con->error);
				}
			}
			else {
				throw new Exception($_this->con->error);
			}
		} catch (Exception $e) 
		{
			BaseDao::exception($e);
		}

	}

	public static function remove(ModelBase $model, $options = null)
	{
		$query = '';
		if($model->get_options('soft_delete') == true)
		{
			$query = 
				'UPDATE '.$model->get_source().
				' SET ativo = 0 '.
				' WHERE '.$model->get_options('key').' = \''.$model->get_key().'\'';
		}
		else
		{
			$query = 
				'DELETE '.$model->get_source().
				' WHERE '.$model->get_options('key').' = \''.$model->get_key().'\'';
		}

		try {
			$_this = new static();
			if($_this->abreConexao()){
				if($q = $_this->con->query($query))
					return true;
				else
					throw new Exception($_this->con->error);
			}
			else 
				throw new Exception($_this->con->error);
		} catch (Exception $e) {
			BaseDao::exception($e);
		}
		
	}
	
	public static function count(ModelBase $model, $options = null)
	{
		$query = self::build_query($model, $options, false, ['properties' => 'count(*) as total']);

		try 
		{
			$_this = new static();
			if($_this->abreConexao())
			{
				if( $q = $_this->con->query($query) )
				{
					if($q->num_rows > 0)
					{
						$obj = $q->fetch_object();
						return $obj->total;
					}
					else 
					{
						return 0;	
					}
				}
				else
				{
					throw new Exception($_this->con->error);
				}
			}
			else 
			{
				throw new Exception($_this->con->error);
			}
		} 
		catch (Exception $e) 
		{
			BaseDao::exception($e);
		}
	}

}

?>