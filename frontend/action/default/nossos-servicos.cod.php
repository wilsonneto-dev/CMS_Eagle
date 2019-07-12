<?php

$this->set_title( "Nossos Serviços", true );
$this->set_description( "Conheça os serviços que oferecemos, estamos à disposição para te auxiliar." );


$this->home_servicos = new Repeater();
$this->home_servicos->campos = "id_url;intro;foto_capa;titulo";
$this->home_servicos->sql = "
	SELECT 
		id_url,intro,foto_capa,titulo
	FROM 
		servico
	WHERE 
		codprojeto = ".CODPROJETO." 
		AND ativo = 1 
	ORDER BY 
		titulo ASC";
$this->home_servicos->txtVazio = "";
$this->home_servicos->txtItem = '
				<div class="item">
					<div class="img_wrapper">
						<a href="/servico/#id_url" title="#intag_titulo"><img alt="#intag_titulo" src="#foto_capa" /></a>
					</div>
					<div class="info_wrapper">
						<h2><a href="/servico/#id_url" title="#intag_titulo">#titulo</a></h2>
						<p>
							#nl2br_intro
						</p>
					</div>
				</div>'."\n";
$this->home_servicos->exec();

?>

