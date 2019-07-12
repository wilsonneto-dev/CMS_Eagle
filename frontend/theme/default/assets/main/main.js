

var menu_fix_visivel = false;
window.addEventListener("scroll", function(event) {
	
	var top = this.scrollY;
  	
  	if( top > 360 ) {
  	
  		if( menu_fix_visivel == false ){
	  		menu_fix_visivel = true;
	  		document.querySelector("nav.fix").classList.toggle('hidden');
		} 
  	
  	} else {
		if( menu_fix_visivel == true ){
	  		menu_fix_visivel = false;
	  		document.querySelector("nav.fix").classList.toggle('hidden');
		} 
  	
  	}
  
}, false);


function rollToContent() {
    
    try {
	    var top = this.scrollY;
	  	var content_top = ( document.querySelector(".content").offsetTop - 100);
    } catch(ex){
	    var top = 0;
	  	var content_top = 0;
    }	

    if( top < content_top ){
	  	
	    var scrollStep = ( (content_top - top) / ( 500 / 15 ) );

	    var scrollInterval = setInterval(function(){
	        if ( window.scrollY < content_top ) {
	            window.scrollBy( 0, scrollStep );
	        }
	        else clearInterval( scrollInterval ); 
	    } ,15);

    }

}

var window_roll = true;

window.onload = function(e) {
    if( window_roll ) rollToContent();
};



function init_modal(){
	
	var modal = document.getElementById('modal-newsletter');
    modal.style.display = "block";
	
	var span = document.getElementsByClassName("modal-close")[0];
	span.onclick = function(){ modal.style.display = "none"; };

	var cancel = document.getElementsByClassName("modal-cancel")[0];
	cancel.onclick = function(){ modal.style.display = "none"; };

	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    }
	}

}

