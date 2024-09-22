$(function () 
{
	$("#formcpassword").submit(

		function(event) {
			var $form = $(this);
			$form.find("button").prop("disabled", true);
			var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,}$/;
			var p=$("#password").val();
			var p1=$("#password1").val();
			var p2=$("#password2").val();

			var valido= regex.test(p1);
			var valido2= regex.test(p2);
			if(valido && valido2){
				if(p1==p2){
					encriptada=SHA256($('#password').val());
					encriptada1=SHA256($('#password1').val());
					encriptada2=SHA256($('#password2').val());
					/* Act on the event */	
					$.ajax({
						type: "POST",
						url: campas,
						// data: $("#formcpassword").serialize(),
						data:{
							password:encriptada,
							password1: encriptada1,
							password2: encriptada2
						},
						success: function(res)
						{
							if(res[0]=='0')
							{
								alertify.alert("Error",res[1]);
							}
							if(res[0]=='1')
							{
								alertify.alert("Gracias","Hemos cambiado con éxito la contraseña", function(){ $('#cpassword').modal('hide');})
								$('#formcpassword').trigger("reset");

							}
							// alert(url5);
							$form.find("button").prop("disabled", false);
						},
						error: function(res)
						{	
							$form.find("button").prop("disabled", false);	
						}
					});
					return false;
					
				}else{
					alertify.alert("Error","Las contraseñas no coinciden reintente");
					$form.find("button").prop("disabled", false);
					return false;
				}
			}else{
				alertify.alert("Error","La nueva contraseña debe tener al menos 8 dígitos, 1 mayúscula, 1 minúscula, 1 número y 1 caracter no alfanumérico (@,*,_,# por ejemplo)");
				$form.find("button").prop("disabled", false);
				return false;
			}
			

		});

	$("#formcpasswordadmin").submit(

		function(event) {
			var $form = $(this);
			$form.find("button").prop("disabled", true);
			var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,}$/;
			var usu_id=$("#usu_id_contra").val();
			var p1=$("#password1").val();
			var p2=$("#password2").val();
			var valido= regex.test(p1);
			var valido2= regex.test(p2);
			if(valido && valido2){
				if(p1==p2){
					encriptada1=SHA256($('#password1').val());
					encriptada2=SHA256($('#password2').val());
					/* Act on the event */	
					$.ajax({
						type: "POST",
						url: contraadmin,
						// data: $("#formcpassword").serialize(),
						data:{
							usu_id: usu_id,
							password1: encriptada1,
							password2: encriptada2
						},
						success: function(res)
						{
							if(res[0]=='0')
							{
								alertify.alert("Error",res[1]);
							}
							if(res[0]=='1')
							{
								alertify.alert("Gracias","Hemos cambiado con éxito la contraseña", function(){ $('#cpassword').modal('hide');})
								$('#formcpasswordadmin').trigger("reset");

							}
							// alert(url5);
							$form.find("button").prop("disabled", false);
						},
						error: function(res)
						{	
							$form.find("button").prop("disabled", false);	
						}
					});
					return false;
					
				}else{
					alertify.alert("Error","Las contraseñas no coinciden reintente");
					$form.find("button").prop("disabled", false);
					return false;
				}
			}else{
				alertify.alert("Error","La nueva contraseña debe tener al menos 8 dígitos, 1 mayúscula, 1 minúscula, 1 número y 1 caracter no alfanumérico (@,*,_,# por ejemplo)");
				$form.find("button").prop("disabled", false);
				return false;
			}

		});
});