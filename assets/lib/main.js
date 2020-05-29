// sweet alert 

$('.msg').ready(()=>{

	let msg = $("#msg").text();
	let rol = $("#condition").text();
	let msg_type = $("#msg_type").text();
	
		if(rol == 11){
			Swal.fire(
					'',
					msg,
					msg_type
				)
		}			                     	
});

