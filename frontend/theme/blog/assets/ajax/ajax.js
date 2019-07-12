var ws = {
	send : function( url, params )
	{
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
		 	if (this.readyState == 4 && this.status == 200) {
				ws.callback(this);
			}else{
				console.log("json step: ready "+this.readyState + " - status " + this.status);
			}
		};
		xhttp.open("POST", url, true);
		xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhttp.send(params);

		swal({
			title: '',
			text: 'Enviando...',
			onOpen: function () 
			{
				swal.showLoading()
			}
		});
	},

	callback : function(ajax_obj)
	{
		try {
	        var obj_response = JSON.parse(ajax_obj.response);
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
	        console.log(ajax_obj.response);
	        swal(
			  'Oops...',
			  'Ocorreu um erro! Tente novamente em instantes',
			  'error'
			);
	    }
		

	},

	params : function( form_id,  )
	{
		var form = document.getElementById(form_id);
		if(form_id == null)
			return;
		var arr_inputs = form.getElementsByTagName("input");
		var params = [];
		for (var i = arr_inputs.length - 1; i >= 0; i--)
		{
			if(!(arr_inputs[i].name == '' || arr_inputs[i].name == undefined || arr_inputs[i].name == null))
			{
				params.push(encodeURIComponent(arr_inputs[i].name) + "=" + encodeURIComponent(arr_inputs[i].value)); 
			}
		}
		console.log(params.join("&"));
		return params.join("&");
	}

};
