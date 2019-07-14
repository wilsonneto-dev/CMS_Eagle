(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function message(_str, _type)
{
	var settings = { title : "", text: _str, type : "", confirmButtonText: "Ok" };
	if( _type == "success" ||  _type == "sucess"  ) { settings.title = "Sucesso"; settings.type = "success";  }
	else if( _type == "error" ) { settings.title = "Erro"; settings.type = "error";  }
	else { settings.title = "Mensagem"; settings.type = _type;  }
	swal(settings);
}

// collapsible
function open_collapsible(elm){
	try{
		$elm = $( elm );
		$parent = $( $elm.parent() );
		$collapsible = $( $parent.find(".collapsible")[0] );
		$collapsible.toggle(300);
	}catch(ex){ alert(ex); }
}

function new_window( _url ){
	$("<div></div>").load( _url , function(){ triggers_update( this ); } ).dialog({width: 800, height: 400 });
}

$(document).ready( function(){ 
	try{ 
		initialize(); 
		// $(".gallery_manager").sortable();
	} catch( ex ){} 
});

/*
function triggers_update( _elm ) {
	
	//alert("ok");

	try{

		// $( _elm ).find("a").on("click",function(){ new_window( $(this).attr("href") ); return false; });

		$( _elm ).find(".button_open_collapsible").click(function(){
			open_collapsible(this);
		});
		$( _elm ).find("#TabelaSort").columnFilters({excludeColumns:[0]});
		$( _elm ).find("#TabelaSort").tablesorter({widthFixed: true, widgets: ['zebra'], headers: { 0: { sorter: false } }}) ;
		$( _elm ).find( ".data" ).datepicker({changeYear: true, yearRange: '2000:2020'});
		$( _elm ).find( ".data" ).keypress(function(){ return false; });
	
		$( _elm ).find("a.iframe").fancybox({
			'width'				: '75%',
			'height'			: '75%',
			'autoScale'			: false,
			'type'				: 'iframe'
		});
		
	}
	catch(ex){}

}

// jquery onload
$(document).ready(function(){
	$(".fancy_image").fancybox();
});

*/
