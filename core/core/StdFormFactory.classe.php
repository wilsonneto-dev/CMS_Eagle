<?php

class StdFormFactory{
	
	public static function _getValorCheckbox( $_param ){
		$retorno = 0;
		if ( isset( $_POST[$_param] ) ) 
			if( $_POST[$_param] == "ativo" ) 
				$retorno = 1; 
		return $retorno;
	}

	public static function field( $args, $permissao = 1 ){
		
		$html_field = "";
		
		if( $args == "--" ){ // shortcut to add a separator
			return "
				<hr />
			";
		}
		
		if( ( !is_array($args) ) && ( is_string($args) ) ){ // shortcut to add a label
			return "
				<span><center>".($args)."</center></span>
			";
		}

		if(isset( $args["input"] ))
		{
			if(count($args["input"]) > 0)
			{
				$args = array_merge($args["input"], $args);
			}	
		}

		if(ArrayHelper::get($args,'display', true) == false)
			return;

		$label = isset( $args["label"] ) ? $args["label"] : "Legenda";
		$type = isset( $args["type"] ) ? $args["type"] : "text";
		$required = isset( $args["required"] ) ? $args["required"] : false;
		$autofocus = isset( $args["autofocus"] ) ? $args["autofocus"] : false;
		$value = isset( $args["value"] ) ? $args["value"] : "";
		$placeholder = isset( $args["placeholder"] ) ? $args["placeholder"] : "";
		$name = isset( $args["name"] ) ? $args["name"] : "campo";
		$html = isset( $args["html"] ) ? $args["html"] : "";
		$sql = isset( $args["sql"] ) ? $args["sql"] : "";
		$options = isset( $args["options"] ) ? $args["options"] : array();
		$checked = isset( $args["checked"] ) ? $args["checked"] : false;
		$icon = isset( $args["icon"] ) ? $args["icon"] : "";
		$cond = isset( $args["cond"] ) ? $args["cond"] : true;
		$empty_option = isset( $args["empty_option"] ) ? $args["empty_option"] : false;

		if($type == 'enum')
			$options = isset( $args["enum"] ) ? $args["enum"] : array();
		

		if
		( 
			( 
				is_string( $cond ) 
				&& ( $cond == "" ) 
			) || 
			( $cond == false ) 
		)
		{ 
			return ""; 
		}
				
		/* add 25/09/2016 */
		$tooltip = isset( $args["tooltip"] ) ? $args["tooltip"] : ( isset( $args["?"] ) ? $args["?"] : "" );

		$addon_label = isset( $args["addon_label"] ) ? $args["addon_label"] : "";
		
		$checkbox_name = isset( $args["checkbox_name"] ) ? $args["checkbox_name"] : "";
		$checkbox_value = isset( $args["checkbox_value"] ) ? $args["checkbox_value"] : "";

		/* add 28/09/2016 */
		$multiple = isset( $args["multiple"] ) ? $args["multiple"] : "";

		switch( $type ){

			case "location":
				$lat = "";
				$lng = "";
				if($value != ""){
					$arr = explode(";", $value);
					if(isset($arr[0])) $lat = $arr[0];
					if(isset($arr[1])) $lng = $arr[1];
				}
	 			$html_field .= ('
					<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD5omzifASkKQXB-fsiNYpYRVanpV7kyi0&sensor=false"></script>
					<script type="text/javascript" src="/admin/js/location/control.js"></script>
					<label>' . $label . ':</label><br />
					<div id="mapa" style="width: 500px; height: 300px; border: 1px solid #aaaaaa;"></div>
					<input type="hidden" id="coord_x" name="'.$name.'_latitude" value="'.$lat.'" data-value="-20.806047438659185" />
					<input type="hidden" id="coord_y" name="'.$name.'_longitude" value="'.$lng.'" data-value="-49.38074469566345" />
				');
				break;

			case "pop-list":
				$r = new Repeater();
				$r->campos = "value;text";
				$r->sql = $sql;
				$r->txtVazio = "<h4>N&atilde;o h&aacute; itens cadastrados...</h4>";
				$r->txtItem = "
					<li class=\"item\" id=\"list-".$name."-li-#value\"><input type=\"checkbox\" value=\"#value\" class=\"chk\" />#text</li>
				";
				$r->exec();
				$html_field .= ('
					<label for="'.$name.'">'.$label.':</label>
					<input type="hidden" id="'.$name.'" name="'.$name.'" />
					<ul class="pop-list-selected" id="list-'.$name.'-selected"></ul>
					<img src="/adm/imgs/pop-list.png" class="pop-list-button" data-title="'.$name.'" data-list="#list-'.$name.'" />
					<br />
					<div class="pop-list-wrapper" id="list-'.$name.'">
						<center>
							<input type="text" class="pop-list-filter txt_m" />
						</center>
						<ul data-field="' . $name . '" data-selected="#list-'.$name.'-selected" id="list-pop-'.$name.'" data-input="#'.$name.'">
						' . $r->html . '
						</ul>
					</div>
					');
				if( $value != "" ){
					$html_field .= "<script>$(document).ready(function(){";
					foreach( explode(",", $value) as $val ){
						$html_field .= "pre_check('#list-".$name."-li-".$val."');";
					}
					$html_field .= "});</script>";
				}
				break;
			case "sql-select":
				//select sub-categoria
				$selCategoria = new SqlSelect( $sql ); 
				$selCategoria->nome = $name;
				if( $value != "" ) { $selCategoria->valorSelecionado = $value; }
				$selCategoria->exec(); 
				$html_field .= ('
					<label for="'.$name.'">'.$label.':</label>
					' . $selCategoria->html . '<br />
					');
				break;
			case "foreign":
				$opts_html = "";
				$select = new SqlSelect( $args['foreign']['query_select'] ); 
				$select->nome = $name;
				if( $empty_option )
					$select->extra .= "<option value=\"0\">Nenhum</option>";
				if( $value != "" ) { $select->valorSelecionado = $value; }
				$select->exec(); 
				$html_field .= ('
					<label for="'.$name.'">'.$label.':</label>
					' . $select->html . '<br />
					');
				break;
			// case "text":
			case "varchar":
			case "email":
			case "password":
			case "url":
			case "num":
			case "phone":
			case "number":
			case "link":
			case "color":
			case "int":
				$html_field .= ('
					<div class="form-group">
	                    <label for="'.$name.'">'.
	                    $label.
                    	( ($tooltip != '') ? ('<span class="glyphicon glyphicon-question-sign tooltip_admin" data-toggle="tooltip" data-placement="right" title="'.$tooltip.'"></span>' ) : '' ).
						'</label>
	                    ' 
	                    . ( ( ($icon != "") || ($checkbox_name != "") || ($addon_label != "") ) ? ('
	                    <div class="input-group">
                            <div class="input-group-addon">
                                '.
                            	( ($icon != "") ? '<i class="fa '.$icon.'"></i> &nbsp;' : '' ).
                            	( ($checkbox_name != "") ? '<input type="checkbox" value="ativo" name="'.$checkbox_name.'" '.( ( $checkbox_value != "0" ) ? " checked=\"checked\"" : "" ).'></input> &nbsp;' : '' ).
                            	( ($addon_label != "") ? '<span>'.$addon_label.'</span> &nbsp;' : '' ).
                                '
                            </div>
			            ') : "" )
			            .'   <input 
		                    	type="'.( ($type == 'data' || $type == 'num' ) ? 'text' : $type ). '" 
		                    	class="form-control' . ($required?' obrigatorio':'' ) .($type == "data"?' data':'' ) .(($type == "num" || $type == "int")?' num':'' ) . '" 
		                    	id="'.$name.'" 
		                    	'. ( ($placeholder != '') ? ('placeholder="'.$placeholder.'" ') : '' ) .'
								'. ( ($required != '') ? ('required="'.$required.'" ') : '' ) .'
								' . ($autofocus ?' autofocus ' : '' ) .' 
								' . ($permissao == 0 ?' readonly ' : '' ) .' 
								name="'.$name.'"
								'. ( ($value != '' && $type != 'password') ? ('value="'.GeneralHelper::bd_limpa( $value ).'" ') : '' ).'
							/>
' 
	                    . ( ( ($icon != "") || ($checkbox_name != "") || ($addon_label != "") ) ? ('</div>') : "" )
			            .'
	                </div>');
				break;
			case "date":
			case "data":
				$html_field .= ('
						<div class="form-group">
	            	        <label for="'.$name.'">'.$label.'</label>
	                        <div class="input-group">
	                            <div class="input-group-addon">
	                                <i class="fa fa-calendar"></i>
	                            </div>
				                <input 
			                    	type="'.( ($type == 'data' ||$type == 'date' || $type == 'num' ) ? 'text' : $type ). '" 
			                    	class="form-control pull-right' . ($required?' obrigatorio':'' ) .(($type == "data" || $type == "date")?' data':'' ) .($type == "num"?' num':'' ) . '" 
			                    	id="'.$name.'" 
			                    	'. ( ($placeholder != '') ? ('placeholder="'.$placeholder.'" ') : '' ) .'
									'. ( ($required != '') ? ('required="'.$required.'" ') : '' ) .'
									' . ($autofocus ?' autofocus ' : '' ) .' 
									' . ($permissao == 0 ?' readonly ' : '' ) .' 
									name="'.$name.'"
									'. ( ($value != '') ? ('value="'.GeneralHelper::bd_limpa( $value ).'" ') : '' ).'
								/>
	                        </div><!-- /.input group -->
	                    </div><!-- /.form group -->
					');
				break;
			case "file":
                if($value != ''){
					$html_field .= ('
					<label>' . $label . ' - atual:</label>
					<a target="_blank" href="/'.$value.'">'.$value.'</a>
					<br />
                    <label>
                        <input type="checkbox" value="ativo" name="exclude_'.$name.'" /> excluir ' . $label . '?
                    </label>
					<br />
					');
                }
				if( $permissao != "0" )  $html_field .= ('
					<div class="form-group">
	                    <label for="'.$name.'">'.$label.'</label>
	                    <input 
	                    	type="file" 
	                    	class="' . ($required?' obrigatorio':'' ) .($type == "data"?' data':'' ) .($type == "num"?' num':'' ) . '" 
	                    	'. ( ($required != '') ? ('required="'.$required.'" ') : '' ) .'
							id="'.$name.'" 
	                    	'. ( ($placeholder != '') ? ('placeholder="'.$placeholder.'" ') : '' ) .'
							' . ($autofocus ?' autofocus ' : '' ) .' 
							name="'.$name.'"
							'. ( ($value != '') ? ('value="'.GeneralHelper::bd_limpa( $value ).'" ') : '' ).'
							'. ( ($multiple != '') ? ('multiple="'.GeneralHelper::bd_limpa( $multiple ).'" ') : '' ).'
						/>
	                </div>');
				break;
			case "image":
				if( $value != "" && $value != "/"  ){
					$html_field .= ('
					<label>' . $label . ' - atual:</label>
					<img style="vertical-align: top; max-width: 400px;max-height: 200px;" src="/'.$value.'" />
					<br />
                    <label>
                        <input type="checkbox" value="ativo" name="exclude_'.$name.'" /> excluir ' . $label . '?
                    </label>
					<br />
					');

				}
				if( $permissao != "0" )  $html_field .= ('
					<div class="form-group">
	                    <label for="'.$name.'">'.$label.'</label>
	                    <input 
	                    	type="file" 
	                    	class="' . ($required?' obrigatorio':'' ) .($type == "data"?' data':'' ) .($type == "num"?' num':'' ) . '" 
	                    	'. ( ($required != '') ? ('required="'.$required.'" ') : '' ) .'
							id="'.$name.'" 
	                    	'. ( ($placeholder != '') ? ('placeholder="'.$placeholder.'" ') : '' ) .'
							' . ($autofocus ?' autofocus ' : '' ) .' 
							name="'.$name.'"
							'. ( ($value != '') ? ('value="'.GeneralHelper::bd_limpa( $value ).'" ') : '' ).'
							'. ( ($multiple != '') ? ('multiple="'.GeneralHelper::bd_limpa( $multiple ).'" ') : '' ).'
						/>
	                </div>');
				break;
			case "image-view":
				if( $value != "" && $value != "/"  ){
					$html_field .= ('
					<label>' . $label . ':</label>
					<img style="vertical-align: top; max-width: 400px;max-height: 200px;" src="'.$value.'" />
					<br />
					');
				}
				break;
			case "text":
			case "text-m":
			case "textarea":
			case "textarea-m":
					$html_field .= ('
					<label>' . $label . ':</label> '. ( $type == "textarea" ? '<br />' : '' ) .
					'<textarea '.
						'id="'.$type.'" '.
						'class="form-control ' . ($required?'obrigatorio':'' ) . ($type == "textarea" ? ' txt_g txt_a' : ' txt_m txt_a_m' ) . '" '.
						'' . ($required ?' required ':'' ) . 
						''. ( ($placeholder != '') ? ('placeholder="'.$placeholder.'" ') : '' ) .
						'' . ($autofocus ?' autofocus ' : '' ) . 
						($permissao == 0 ?' readonly ' : '' ) 
						.'name="'.$name.'">'.
						($value != "" ? $value : '').
					'</textarea><br />
					');
				break;
			case "enum":
			case "select":
				$opts_html = "";
				if( $empty_option )
				{
					$opts_html .= "<option value=\"0\">Nenhum</option>";
				}
				foreach ($options as $k => $v) {
					$opts_html .= "<option value=\"$k\" ".(($k == $value) ? "selected=\"selected\"":"").">$v</option>";
				}
				$html_field .= ('
					<div class="form-group">
	                    <label for="'.$name.'">'.$label.'</label>
	                    <select class="form-control" id="'.$name.'" name="'.$name.'">'.$opts_html.'</select>
	                </div>');
				break;
			case "html-field":
				$html_field .= ('
					<label>' . $label . ':</label> '.
					'' . $html . '<br />' .
					'');
				break;
			case "checkbox":
				$html_field .= ('
						<div class="checkbox">
	                        <label>
	                            <input type="checkbox" value="ativo" name="'.$name.'" '.( ( $value != "0" ) ? " checked=\"checked\"" : "" ).'> ' . $label . '
	                        </label>
	                    </div>
				');
				break;			
			case "editor":
						$html_field .= ('
					<label>' . $label . ':</label> '.  '<br />' .
					'<textarea id="editor_html" name="'.$name.'" rows="10" cols="80">'.$value.'</textarea>
                    <br />
					');
				break;
			case "separator":
						$html_field .= ('
					<hr />
					');
				break;
			default:
				$html_field = "Erro ao gerar campo $label - $type...";
		}
		
		
		return $html_field;
	}

}

?>