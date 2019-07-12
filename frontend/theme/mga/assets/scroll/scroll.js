var js_scroll = {

	interval_time : 5,
	move_by_step : 10,
	vertical_direction : 1,

	target_y_go : 0,

	timer : null, 

	step : function()
	{
		var next_step = true;
		var actual_position = document.getScroll()[1];

		if(this.vertical_direction == 1)
		{ // para baixo
	
			var next_position = actual_position + this.move_by_step;

			if( actual_position > this.target_y_go )
				return;

			if(next_position >= this.target_y_go){
				next_position = this.target_y_go;
				next_step = false;
			}

			window.scrollTo(0, next_position);

		}else{

			var next_position = actual_position - this.move_by_step;

			console.log("actual: "+actual_position+" - target: "+this.target_y_go+" - next: "+next_position);

			if( this.target_y_go > actual_position )
				return;

			if(this.target_y_go > next_position){
				next_position = this.target_y_go;
				next_step = false;
			}

			window.scrollTo(0, next_position);

		}

		if(next_step)
			this.timer = setTimeout( "js_scroll.step()", this.interval_time );
		
		return this.target_y_go;

	},

	break : function(){
		clearTimeout(this.timer);
	},

	move_to_element : function( el_id )
	{
		this.break();
		this.target_y_go = document.getOffset( document.getElementById(el_id) );
		var actual_position = document.getScroll()[1]; 
		this.vertical_direction = ( actual_position < this.target_y_go ) ? 1 : -1; 
		this.step();
		return true;
	}

};

document.getOffset = function(el) 
{
	el = el.getBoundingClientRect();
	return (el.top + window.scrollY)
};

document.getScroll = function()
{
	
	if(window.pageYOffset!= undefined)
	{
 		return [pageXOffset, pageYOffset];
	}
	else
	{
  		var sx, sy, d= document, r= d.documentElement, b= d.body;
  		sx = r.scrollLeft || b.scrollLeft || 0;
  		sy = r.scrollTop || b.scrollTop || 0;
  		return [sx, sy];
 	}

};

function menu_fix_verify()
{
	if(document.getScroll()[1] > 30)
	{
		addClass(document.getElementById("body"), "fix");
	}else{
		removeClass(document.getElementById("body"), "fix");		
	}
}

function addClass(el, classNameToAdd){
    el.className = "fix";   
}

function removeClass(el, classNameToRemove){
    el.className = "";
}