<?php 

/* 04/10/2017 - Wilson Neto */

class Loop
{

	public $source;
	public $item_html;
	public $html;

	public $empty;

	public function Loop( $source = null, $item_html = null)
	{
		$this->source = $source;
		$this->item_html = $item_html;
		$this->html = '';
		$this->empty = '';
		
		if($this->item_html != null)
			$this->exec();
	}

	public function exec()
	{

		$index = 0;
		$this->html = '';
		$func = $this->item_html;

		if( $this->source != false)
		{
			foreach ($this->source as $key => $value) 
			{
				$this->html .= $func($value, $index++);
			}			
		}
		
		if($this->html == '')
			$this->html = $this->empty;
		
		return $this->html;

	}
	
	public function get_view($item_html = null, $out = true)
	{
		if($item_html != null)
			$this->item_html = $item_html;
		
		if($out)
			echo $this->exec();
		else
			return $this->exec();
	}

}

?>
