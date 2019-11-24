<?php


class Info {

	public $telefone1;
	public $telefone2;
	public $telefone3;
	public $email;
	public $dominio;
	public $endereco;
	
	public $thumb_localizacao;
	public $mapa_longitude;
	public $mapa_latitude;

	public $home_intro;
	public $home_imagem;
	public $home_imagem_background;

	public $head_titulo;
	public $head_descricao;
	public $head_palavras_chave;

	public $texto_contato;

	public $mensagem;
	public $mensagem_icone;

	public $link_facebook;
	public $usuario_facebook;

	public $link_instagram;
	public $usuario_instagram;

	public $link_twitter;
	public $usuario_twitter;

	public $link_youtube;
	public $usuario_youtube;

	public $titulo_chamada;
	public $link_chamada;
	public $texto_botao_chamada;
	public $texto_chamada;

	public $link_linkedin;
	public $usuario_linkedin;

	public $link_google;
	public $usuario_google;

	public $config_theme_path;
	public $config_theme_id;

	public $config_action_path;
	public $config_action_id;

	public $link_localizacao;

	private $bd;
	
	public function Info(){
		$this->texto_contato = "";
		
		$this->thumb_localizacao = "";
		$this->mapa_longitude = "";
		$this->mapa_latitude = "";

		$this->link_facebook = "";
		$this->home_intro = "";
		$this->endereco = "";
		$this->email = "";
		$this->texto_botao_chamada = "";
		$this->telefone1 = "";
		$this->telefone2 = "";
		$this->telefone3 = "";
		$this->link_chamada = "";
		$this->titulo_chamada = "";
		$this->texto_chamada = "";

		$this->mensagem = "";
		$this->mensagem_icone = "";

		$this->dominio = "";
		$this->home_imagem = "";
		$this->home_imagem_background = "";

		$this->head_titulo = "";
		$this->head_descricao = "";
		$this->head_palavras_chave = "";

		$this->link_instagram = "";
		$this->usuario_facebook = "";
		$this->usuario_instagram = "";
		
		$this->link_linkedin = "";
		$this->usuario_linkedin = "";

		$this->link_google = "";
		$this->usuario_google = "";

		$this->link_youtube = "";
		$this->usuario_youtube = "";

		$this->link_twitter = "";
		$this->usuario_twitter = "";

		$this->config_theme_path = "";
		$this->config_theme_id = "";

		$this->config_action_path = "";
		$this->config_action_id = "";

		$this->link_localizacao = "";

		$this->bd = new InfoDAO();
	}
	
	public function cadastrar(){
		return $this->bd->cadastra($this);
	}

	public function get(){
		return $this->bd->get($this);
	}

	public static function _get(){
		$_info = new Info();
		$_info->get();
		return $_info;
	}

	public function atualizar(){
		return $this->bd->atualiza($this);
	}

}

class InfoDAO extends BaseDAO{
	public function cadastra(Info $info){
		try {
			if($this->abreConexao()){
				$str_q = "
					INSERT INTO info(
						texto_contato,
						endereco,
						codprojeto, 
						email, 
						telefone1, 
						telefone2, 
						telefone3, 
						titulo_chamada,
						texto_botao_chamada,
						link_chamada,
						home_intro,
						mapa_latitude,
						link_facebook,
						texto_chamada,
						dominio,

						home_imagem,
						home_imagem_background,

						head_titulo,
						head_descricao,
						head_palavras_chave,

						link_instagram,
						usuario_facebook,
						usuario_instagram,

						link_linkedin,
						usuario_linkedin,

						link_google,
						usuario_google,

						link_youtube,
						usuario_youtube,

						link_twitter,
						usuario_twitter,

						config_theme_path,
						config_theme_id,

						config_action_path,
						config_action_id,
						thumb_localizacao,

						link_localizacao,
					
						mensagem,
						mensagem_icone
					
					) 
					VALUES(
						'','',". $this->codProjeto.",'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','' , '',''
					);";
				if($q = $this->con->query($str_q))
					return true;
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao");	
		} catch (Exception $e) {
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />data:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}

	public function get($info){
		try{
			if($this->abreConexao()){
				$str_q = "SELECT 
				 	texto_contato,
					endereco,
					mapa_longitude,
					email,
					telefone1,
					telefone2,
					telefone3,
					titulo_chamada,
					texto_botao_chamada,
					link_chamada,
					home_intro,
					mapa_latitude,
					link_facebook,
					texto_chamada,
					dominio,

					home_imagem,
					mensagem,
					mensagem_icone,
					home_imagem_background,

					head_titulo,
					head_descricao,
					head_palavras_chave,

					link_instagram,
					usuario_facebook,
					usuario_instagram,

					link_linkedin,
					usuario_linkedin,

					link_google,
					usuario_google,

					link_youtube,
					usuario_youtube,

					link_twitter,
					usuario_twitter,

					config_theme_path,
					config_theme_id,

					config_action_path,
					config_action_id,

					thumb_localizacao,

					link_localizacao
					
					FROM info 
					WHERE codprojeto = '" . $this->codProjeto ."';";
				if($q = $this->con->query($str_q)){
					if(!$q->num_rows == 0){
						$obj = $q->fetch_object();
						$info->endereco = $obj->endereco;
						$info->link_chamada = $obj->link_chamada;
						$info->email = $obj->email;
						$info->mapa_longitude = $obj->mapa_longitude;
						$info->mapa_latitude = $obj->mapa_latitude;
						$info->link_facebook = $obj->link_facebook;
						$info->texto_contato = $obj->texto_contato;
						$info->telefone1 = $obj->telefone1;
						$info->telefone2 = $obj->telefone2;
						$info->telefone3 = $obj->telefone3;
						$info->titulo_chamada = $obj->titulo_chamada;
						$info->texto_botao_chamada = $obj->texto_botao_chamada;
						$info->home_intro = $obj->home_intro;
						$info->texto_chamada = $obj->texto_chamada;

						$info->dominio = $obj->dominio;

						$info->home_imagem = $obj->home_imagem;
						$info->home_imagem_background = $obj->home_imagem_background;

						$info->head_titulo = $obj->head_titulo;
						$info->head_descricao = $obj->head_descricao;
						$info->head_palavras_chave = $obj->head_palavras_chave;

						$info->link_instagram = $obj->link_instagram;
						$info->usuario_facebook = $obj->usuario_facebook;
						$info->usuario_instagram = $obj->usuario_instagram;

						$info->link_linkedin = $obj->link_linkedin;
						$info->usuario_linkedin = $obj->usuario_linkedin;

						$info->link_google = $obj->link_google;
						$info->usuario_google = $obj->usuario_google;

						$info->link_youtube = $obj->link_youtube;
						$info->usuario_youtube = $obj->usuario_youtube;

						$info->link_twitter = $obj->link_twitter;
						$info->usuario_twitter = $obj->usuario_twitter;

						$info->config_theme_path = $obj->config_theme_path;
						$info->config_theme_id = $obj->config_theme_id;

						$info->config_action_path = $obj->config_action_path;
						$info->config_action_id = $obj->config_action_id;

						$info->thumb_localizacao = $obj->thumb_localizacao;
						$info->link_localizacao = $obj->link_localizacao;

						$info->mensagem = $obj->mensagem;
						$info->mensagem_icone = $obj->mensagem_icone;

						return true;
					}else{
						$info->cadastrar();
						return true;
					}
				}
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao ao banco");	
		} catch (Exception $e) {
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />data:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}

	public function atualiza($info){
		try {
			if($this->abreConexao()){
				$str_q = "
					UPDATE 
						info
					SET 
						endereco = '". $this->con->real_escape_string($info->endereco) ."'
						, link_chamada = '". $this->con->real_escape_string($info->link_chamada) ."'
						, mapa_longitude = '". $this->con->real_escape_string($info->mapa_longitude) ."'
						, texto_contato = '". $this->con->real_escape_string($info->texto_contato) ."'
						, email = '". $this->con->real_escape_string($info->email) ."'
						, telefone1 = '". $this->con->real_escape_string( $info->telefone1 ) ."'
						, telefone2 = '". $this->con->real_escape_string( $info->telefone2 ) ."'
						, telefone3 = '". $this->con->real_escape_string( $info->telefone3 ) ."'
						, titulo_chamada = '". $this->con->real_escape_string($info->titulo_chamada) ."'
						, texto_botao_chamada = '". $this->con->real_escape_string($info->texto_botao_chamada) ."'
						, texto_chamada = '". $this->con->real_escape_string($info->texto_chamada) ."'
						, home_intro = '". $this->con->real_escape_string($info->home_intro) ."'
						, mapa_latitude = '". $this->con->real_escape_string($info->mapa_latitude) ."'
						, link_facebook = '". $this->con->real_escape_string($info->link_facebook) ."'
						
						, dominio = '". $this->con->real_escape_string($info->dominio)."'

						, home_imagem = '". $this->con->real_escape_string($info->home_imagem)."'
						, home_imagem_background = '". $this->con->real_escape_string($info->home_imagem_background)."'

						, head_titulo = '". $this->con->real_escape_string($info->head_titulo)."'
						, head_descricao = '". $this->con->real_escape_string($info->head_descricao)."'
						, head_palavras_chave = '". $this->con->real_escape_string($info->head_palavras_chave)."'

						, link_instagram = '". $this->con->real_escape_string($info->link_instagram)."'
						, usuario_facebook = '". $this->con->real_escape_string($info->usuario_facebook)."'
						, usuario_instagram = '". $this->con->real_escape_string($info->usuario_instagram)."'

						, link_linkedin = '". $this->con->real_escape_string($info->link_linkedin)."'
						, usuario_linkedin = '". $this->con->real_escape_string($info->usuario_linkedin)."'

						, link_youtube = '". $this->con->real_escape_string($info->link_youtube)."'
						, usuario_youtube = '". $this->con->real_escape_string($info->usuario_youtube)."'

						, link_twitter = '". $this->con->real_escape_string($info->link_twitter)."'
						, usuario_twitter = '". $this->con->real_escape_string($info->usuario_twitter)."'

						, link_google = '". $this->con->real_escape_string($info->link_google)."'
						, usuario_google = '". $this->con->real_escape_string($info->usuario_google)."'

						, config_theme_path = '". $this->con->real_escape_string($info->config_theme_path)."'
						, config_theme_id = '". $this->con->real_escape_string($info->config_theme_id)."'

						, config_action_path = '". $this->con->real_escape_string($info->config_action_path)."'
						, config_action_id = '". $this->con->real_escape_string($info->config_action_id)."'

						, thumb_localizacao = '". $this->con->real_escape_string($info->thumb_localizacao)."'
						
						, link_localizacao = '". $this->con->real_escape_string($info->link_localizacao)."'
					
						, mensagem = '". $this->con->real_escape_string($info->mensagem)."'
						, mensagem_icone = '". $this->con->real_escape_string($info->mensagem_icone)."'
						
					WHERE codprojeto = ".$this->codProjeto.";";
				if($q = $this->con->query($str_q))
					return true;
				else
					throw new Exception("erro ao executar query<br />".$str_q);
			}
			else 
				throw new Exception("erro na conexao");	
		} catch (Exception $e) {
			$errMsg = "exceção: ". $e->getMessage()."\n<br />error: ".
					$this->con->error ."\n<br />data:". time().
					"\n<br />ip: ". $_SERVER["REMOTE_ADDR"] ;
			echo "$errMsg";
			return false;
		}
	}	
	
}

?>