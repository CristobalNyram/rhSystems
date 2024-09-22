<script type="text/javascript">
	function incidenciaformulario(ese_id,formulario){
		let url_incidencia="<?php echo $this->url->get('incidencia/incidenciaformulario/') ?>";
    $.ajax({
      type: "POST",
      url: url_incidencia+ese_id+"/"+formulario,
      success: function(data)
      {
        if (data[0]==0) {
        }
        else
        {
          $('#divincidencia').empty();
        	for (var i = 0; i < data[1].length ; i++) {
            let a='<li class="padre_menu puntos"><p style="margin-top: 0px; margin-bottom: 0px;"><input id="'+data[1][i].inc_id+'" name="'+data[1][i].inc_id+'" onchange="incidenciaactualizar(event);" type="checkbox" '+data[1][i].checked+' data-estudio="'+ese_id+'" data-formulario="'+formulario+'" data-incidencia="'+data[1][i].inc_id+'"/> <label for="'+data[1][i].inc_id+'"><b>'+data[1][i].inc_texto+'</b></label></p></li>';
            $('#divincidencia').append(a);
        	}
        }
      },
      error: function(res)
      {

        Swal.fire({title:'ERROR',text:'No se pudieron cargar los datos, vuelve a intentar de nuevo.',type:"error"})
                                                                 .then((value) => {
                                                                    location.reload();  
                                                                     });
      }
    });
	}

  function incidenciaactualizar(event){
		let formulario = event.target.dataset.formulario;
    let incidencia = event.target.dataset.incidencia;
    let estudio = event.target.dataset.estudio;
    let value = document.getElementById(incidencia).checked;
    // console.log(value);
    var urled="<?php echo $this->url->get('incidencia/registrarincidencia/') ?>";
    
    $.ajax({
      type: "POST",
      url: urled+incidencia+'/'+formulario+'/'+estudio+'/'+value,
      
      success: function(res)
      {
        if(res[0]<=0)
        {
          alertify.alert("Error",res[1]);
        }
        else
        {
          Swal.fire({title:"Éxito",text:"Incidencia registrada correctamente.",type:"success"})
            .then((value) => {
              //acciones
            });
        }
        
      },
      error: function(res)
      { 
          alert('Error en el servidor...');
      }
    });
    return false;
	}
</script>

<div class="modal fade" id="incidencias-modal" tabindex="-1" style="z-index:  999999; ;" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5><div id="">INCIDENCIAS</div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_actualizarincidencia" class="form-vertical mt-1">
          <div class="form-group row">
            <div class="col-lg-12" id="divincidencia">
            	
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>