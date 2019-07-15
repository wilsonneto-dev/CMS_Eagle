<?php

class StdAdminPage{
	
	private $html;
	
	public $title;
	public $sub_title;
	public $page;
	
	public $form;
	public $table;
	
	public $table_header;
	public $table_content;
	
	public $form_fields;
	public $submit_text;
		
	public $cadastrar;
	public $back_link;
	public $back_link_url;
	public $title_back;
	
	public $botoes_extras;

	public $html_content;

	public $form_action;
	public $form_button_text;

	public $cadastrar_parametro;
	public $sessions_order;

	public $permissao;

	public function __construct(){
		
		$this->cadastrar = true;
		$this->html 		= "";
		$this->sub_title 	= "";
		$this->title 	= "";
		$this->title_back = "";
		$this->table_header 		= "";
		$this->table_content		= "";
		$this->form		= false;
		$this->table		= false;
		$this->form_fields 		= array();
		$this->back_link = false;
		$this->title_back = "";
		$this->submit_text = "Salvar";
		$this->botoes_extras = array();		
		$this->html_content = "";
		$this->form_action = "";
		$this->form_button_text = "";
		$this->cadastrar_parametro = "";	
		$this->sessions_order = array( "table","form", "html_content", "extra_buttons" );
		$this->permissao = 1;	
	
	}
	
	private function make_page(){

		$this->html .= $this->make_header( $this->back_link );

		foreach ($this->sessions_order as $session) {
			
			/* trabalhar a ordem das sessões */

			if( $session == "table" && $this->table ){
				$this->html .= $this->make_table();
			}
			else if( $session == "form" && $this->form ){
				$this->html .= $this->make_form();
			}
			else if( $session == "html_content" && $this->html_content <> '' ){
				$this->html .= $this->make_html_content();
			}
			else if( $session == "extra_buttons" ){
				$this->html .= $this->make_extra_buttons();
			}
		}

	}	
	
	public function render($ret = false){
		$this->make_page();
		if($ret)
			return $this->html;
		echo $this->html;
	}
	
	public function add_field( $args ){
		$this->form_fields[] = $args;
	}
	
	private function make_header( $back = false ){
		$header = "";
		if($back == true){
			$header = sprintf('
				<section class="content-header">
                    <h1>
                        %s
                        <small>%s</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/%s"><i class="fa fa-angle-double-left"></i> %s</a></li>
                    </ol>
                </section>
				', $this->title, $this->sub_title, $this->back_link_url, $this->title_back
			);
		}else{
			$header = sprintf('
				<section class="content-header">
                    <h1>
                        %s
                        <small>%s</small>
                    </h1>
                </section>
				', $this->title, $this->sub_title
			);
		}
		return $header;
	}	
	
	private function make_table( $back = false ){
		$table = sprintf('
			<section class="content">
	            
	            <section style="text-align: right; display: '.( ( $this->cadastrar == false || $this->permissao == "0" ) ? 'none':'block' ).'" >
	    			<a href="/crud/%s/form%s" class="btn btn-primary">
						Novo / Cadastrar
					</a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<br /><br />
				</section>
		
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

							  	<div class="box-body table-responsive">
                                    <table class="table table-bordered table-hover data-table">
                                        <thead>
                                            <tr>
                                            	%s
                                            	<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            %s
                              			</tbody>
                              			<tfoot>
                                            <tr>
                                            	%s
                                            	<th></th>
                                            </tr>
                                        </tfoot>
                          			</table>
                      			</div>
				
						</div>
					</div>
				</div>	
			</section>
			', $this->page, ( ($this->cadastrar_parametro != "")?("&".$this->cadastrar_parametro):("") ), $this->table_header, $this->table_content, $this->table_header
			);
		return $table;
	}

	private function make_form(){
		$form = sprintf('
			<section class="content">
	
		       <div class="row">
                    <div class="col-xs-12">
                		
                			<div class="box">
                                <!-- form start -->
                                <form class="f_admin" name="f_post" method="post" enctype="multipart/form-data" '.( $this->form_action == "" ? "" : ('action="'.$this->form_action.'"') ).'>
                                    <div class="box-body">
                                        
                                        %s

                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" style="display: '.( ( $this->cadastrar == false || $this->permissao == "0" ) ? 'none':'block' ).'">'.( $this->form_button_text == "" ? "Salvar" : $this->form_button_text ).'</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->

					</div>
				</div>	

			</section>
			', 
			$this->make_fields(), $this->page 
		);
		return $form;
	}
	
	private function make_html_content( ){
		$form = sprintf('
			<section class="content">
	
		       <div class="row">
                    <div class="col-xs-12">
                		
                			<div class="box box-primary">
                                <!-- form start -->
                                <div class="box-body">
                                    
                                    %s

                                </div>
	                        </div><!-- /.box -->

					</div>
				</div>	

			</section>
			', 
			$this->html_content
		);
		return $form;
	}
	
	private function make_fields(){
		
		$fields = "";
		foreach( $this->form_fields as $field ){ 
			$fields .= StdFormFactory::field( $field, $this->permissao ); 
		}
		unset($field);
		return $fields; 
	}
	
	private function make_extra_buttons(){
		
		$buttons = "";
		if(count($this->botoes_extras) > 0 ){
			$buttons .= '<section class="content">';
			foreach( $this->botoes_extras as $btn ){ 
				$buttons .= "<a class=\"btn btn-primary\" href=\"$btn[url]\" target=\"$btn[target]\">$btn[legenda]</a>&nbsp;&nbsp;"; 
			}
			$buttons .= '</section>';
		}
		return $buttons; 
		
	}
		
}


class StdGalleryManager 
{
	
	public static function make( $_sql_repeater, $_page ){

		$html = ""; 
		$html .= "
		<form method=\"post\">
			<input type=\"hidden\" name=\"action\" value=\"save_list_command\" />
			<input type=\"hidden\" class=\"order_input\" name=\"order\" value=\"\" />
			<ul class=\"gallery_manager\">"; 

		/* rodar o repeater */
		$r = new Repeater();
		$r->campos = "texto;id;cod_referencia;imagem;ordem";
		$r->sql = $_sql_repeater;
		$r->txtItem = "
			<li id=\"id_#id\">
				<div class=\"gallery_manager_item\">
					<div class=\"wrap_image\">
						<img src=\"/#imagem\" />
					</div>
					<div class=\"info_wrapper\">
						<input type=\"hidden\" name=\"id[]\" value=\"#id\" />
						<textarea name=\"descricao[]\">#texto</textarea>
						<a class=\"controle\" title=\"Excluir\" onclick=\"return confirm('Excluir?');\" href=\"/?pg=" . $_page . "FotoExcluir&id=#id\"><img src=\"/img/del.png\" /></a>
					</div>
				</div>
			</li>
		";
		$r->exec();

		$html .= $r->html; 
		$html .= "
			</ul>
			<br />
			<input class=\"btn btn-primary\" type=\"submit\" value=\" Salvar Alterações \" />
		</form>
		"; 

		return $html;

	} 

}
		

?>