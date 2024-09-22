function guardar()
{
	
}
$(function () 
{
	$("#btn_edit").click(
		function(event) {
			$.ajax({
				type: "POST",
				url: url,
				success: function(res)
				{
					// alert(res);
					$('#perfil_content').html(res);
				},
				error: function(res)
				{	
				}
			});
		});
	$("#formcpassword").submit(
		function(event) {
			var $form = $(this);
			$form.find("button").prop("disabled", true);
			
			var p1=$("#password1").val();
			var p2=$("#password2").val();
			if(p1==p2){

				encriptada=SHA256($('#password').val());
				encriptada1=SHA256($('#password1').val());
				encriptada2=SHA256($('#password2').val());
				/* Act on the event */	
				$.ajax({
					type: "POST",
					url: url5,
					// data: $("#formcpassword").serialize(),
					data:{
						password: encriptada,
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
		});
});

