var modal;
function init_modal()
{
	
	fbq('track', 'AddToCart');
	
	modal = document.getElementById('modal-newsletter');
    modal.style.display = "block";
	
	var span = document.getElementsByClassName("modal-close")[0];
	if(span != null)
	{
		span.onclick = function(){ modal.style.display = "none"; };
	}

	var cancel = document.getElementsByClassName("modal-cancel")[0];
	if(cancel != null)
	{
		cancel.onclick = function(){ modal.style.display = "none"; };
	}

}

function ajax(url, params, callback_function) {
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	 	if (this.readyState == 4 && this.status == 200) {
			callback_function(this);
		}else{
			console.log("json step: ready "+this.readyState + " - status " + this.status);
		}
	};
	xhttp.open("POST", url, true);
	xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhttp.send(params);

	swal({
		text: 'Enviando...',
		onOpen: function () {
			swal.showLoading()
		}
	});

};

function close_modal()
{
	modal.style.display = "none";
};

function submit_form()
{
	subscription();
	close_modal();	
};


function submit_contact()
{
	var
		nome = document.getElementById("contact_nome").value,
		email = document.getElementById("contact_email").value,
		mensagem = document.getElementById("contact_mensagem").value,
		telefone = document.getElementById("contact_telefone").value;

	var params = 
		'nome=' + encodeURIComponent(nome) + 
		'&email=' + encodeURIComponent(email) +
		'&telefone=' + encodeURIComponent(telefone) +
		'&mensagem=' + encodeURIComponent(mensagem);

	ajax(
		'/api/subscription/contact', 
		params, 
		function(r)
		{
			try {
		        var obj_response = JSON.parse(r.response);
				console.log(obj_response);
		        if(obj_response.status == 'success')
			        swal(
					  'Enviado!',
					  obj_response.msg,
					  'success'
					);
		    	else
			        swal(
					  'Oops...',
					  obj_response.msg,
					  'error'
					);
		    } catch (e) {
		        console.log("não é json valido o retorno");
		        console.log(r.response);
		        swal(
				  'Oops...',
				  'Ocorreu um erro! Tente novamente em instantes',
				  'error'
				);
		    }
			

		}
	);

};


function mob_menu_out()
{
	document.getElementById("control-nav").checked = false;
}