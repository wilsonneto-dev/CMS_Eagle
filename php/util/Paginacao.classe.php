<?php
/*
	classe para paginação
	11 de outubro de 2011
	
	setar a $pg_atual o $total_elems...
	calcular() e montarHTML()...
	css: span 'paginacao', links 'pgs_links' e 'pg_atual' e 'pg_inicial' e 'pg_final'
*/


class Paginacao
{
	
	public $pg_atual; // a pg atual
	public $total_elems; //o total de elementos (geral)
	public $num_elems_pg; // o tatal de elementos por página
	public $total_pgs; // o total de páginas
	public $ini; // o registro inicial (q será chamado na query)
	public $link; //o formato do link (href, exemplo "paginada.php?pg=#pg", #pg será substituído pelo número da página)
	public $num_links_nav; // numero de links na navegação , ex: 3 1.. 5 6 7 -8- 9 10 11 ..20
	public $html;
	public $prefixo;
	
	public function Paginacao($link = "")
	{
		$this->num_elems_pg = 7;
		$this->num_links_nav = 2;
		$this->total_elems = 0;
		$this->total_pgs = 0;
		$this->html = 0;
		$this->pg_atual = 1;
		$this->ini = 0;
		$this->link = $link;
		$this->prefixo = "";
	}

	public function load($arr_options = null)
	{
		if( is_array($arr_options) )
		{
			foreach ($arr_options as $k => $v) 
			{
				$this->$k = $v;
			}			
		}
	}

	public static function get_instance($link, $arr_options = null)
	{
		$n = new static($link);
		$n->load($arr_options);
		return $n;
	}
	
	public function calcular()
	{
		$this->ini = (($this->pg_atual - 1) * $this->num_elems_pg);
		$this->total_pgs = ceil($this->total_elems/$this->num_elems_pg);
	}
	
	public function montarHTML(){
		if($this->num_elems_pg >= $this->total_elems){
			$this->html = "";
		}else{
			$this->calcular();
			$this->html = $this->prefixo.'<ul class="pagination inline">';
			$pg_inicial = $this->pg_atual - $this->num_links_nav;
			$pg_final = $this->pg_atual + $this->num_links_nav;
			if($pg_inicial == 2) $this->html .= '<li><a href="'.str_replace("#pg",1,$this->link).'" class="pgs_links">1</a></li>';
			else if($pg_inicial > 2) $this->html .= '<li><a href="'.str_replace("#pg",1,$this->link).'" class="pgs_links pg_ini">1..</a></li>';
			$pg_link;
			for($pg_link = $pg_inicial; $pg_link <= $pg_final; $pg_link++){
				if($pg_link > 0 && $pg_link <= $this->total_pgs && $pg_link != $this->pg_atual)
					$this->html .= '<li><a href="'.str_replace("#pg",$pg_link,$this->link).'" class="pgs_links">'.$pg_link.'</a></li>';
				else if( $pg_link == $this->pg_atual )
					$this->html .= '<li><a href="'.str_replace("#pg",$pg_link,$this->link).'" class="pgs_links bg-cta">'.$pg_link.'</a></li>';
			}
			if($pg_final == ($this->total_pgs - 1)) $this->html .= '<li><a href="'.str_replace("#pg",$this->total_pgs,$this->link).'" class="pgs_links">'.$this->total_pgs.'</a></li>';
			else if($pg_final < ($this->total_pgs - 1)) $this->html .= '<li><a href="'.str_replace("#pg",$this->total_pgs,$this->link).'" class="pgs_links pg_final">..'.$this->total_pgs.'</a></li>';
			$this->html .= '</ul>';
		}
		return $this->html;
	}

	public function html(){
		return $this->montarHTML();
	}
}

?>