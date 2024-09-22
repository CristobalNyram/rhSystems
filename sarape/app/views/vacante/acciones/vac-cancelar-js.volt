<style>
  .container-badges-cancelar{
    display: flex;
    justify-content: space-around;
  }
  .container-badges-cancelar .badge{
    font-size: 1rem;
    padding: 1rem;

  }

  .highlight {
    background: #ff0000cc;
    font-size: 1.2rem;    
    }

</style>

<script>
// Llamada a la función con el límite de opciones, el ID del select y el valor seleccionado  
    let _VAC_ID_CANCELAR_VAC=0;
    let _CALLBACK_REOLAD_TABLE__CANCELAR_VAC=0;
    let _VAC_EXP_CANTIDAD=0;

    function fnCancelarVacante(vac_id=0,callbak_table=0)
	  {
        $("#vac_comentario-cancelar_gen_vac").val("");
        $('#vac_estatus-editar_vac_no').parent().hide();
        _VAC_ID_CANCELAR_VAC=vac_id;
        _VAC_EXP_CANTIDAD=0;
        _CALLBACK_REOLAD_TABLE__CANCELAR_VAC=callbak_table;
        let url="<?php echo $this->url->get('vacante/ajax_get_detalle_vac_cancelar/') ?>";
        $.ajax({
            type: "POST",
            url: url+_VAC_ID_CANCELAR_VAC,
            success: function(res)
            {
              let data=res.data;
              let data_exc=res.data_exc;
              if(data_exc.length>0){
                  let template_info_detalle=`
                    <div class="container mt-5">
                        <h6>Vacantes que estan vigentes</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Completo</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                `;
                $("#data_info_detalle-cancelar_gen_vac").html(template_info_detalle);

                // Crea un elemento div temporal para contener el contenido del template
                let tempDiv = document.createElement('div');

                tempDiv.innerHTML = template_info_detalle;

                // Obtén la tabla dentro del div temporal
                let tabla = $(tempDiv).find('table');

                // Obtén el tbody de la tabla dentro del div temporal
                let tbody = $(tabla).find('tbody');

                  // Itera sobre los datos y agrega filas al tbody
                data_exc.forEach(function (item) {
                      let row = $('<tr>');

                      $('<td>').text(item.exc_id).appendTo(row); // Reemplaza 'id' con la propiedad correcta de tus datos
                      $('<td>').text(item.can_nombre).appendTo(row); // Reemplaza 'nombre' con la propiedad correcta de tus datos
                      $('<td>').html(` ${generateBadgeExcEstatusHTML(item.exc_estatus)} `).appendTo(row); // Reemplaza 'estatus' con la propiedad correcta de tus datos
                      // Agrega la fila al tbody

                      row.appendTo(tbody);
                });
                // Crear un elemento <span>
                let spanElement = $('<span class="text-center" >Todos los expedientes que están vigentes serán canceladas</span>');
                _VAC_EXP_CANTIDAD=res.data_exc_count;
                // Establece el contenido del tbody en el elemento con el id "data_info_detalle-cancelar_gen_vac"
                $('#data_info_detalle-cancelar_gen_vac tbody').html($(tbody).html()).after(spanElement);
                $('#data_info_detalle-cancelar_gen_vac table').after(spanElement);

              }else{
                $("#data_info_detalle-cancelar_gen_vac").empty("No hay expedientes vigentes en esta vacante");
              }
          
              let template_info_analiticas_detalle=`
              <span class="badge badge-secondary text-white">  
              <i class="mdi mdi-stop-circle-outline mdi-18px btn-icon text-white"></i>
              Vigentes: ${res.data_exc_count}
              </span>
              <span class="badge badge-success text-white" id="btn-fat-exc">
              <i class="mdi mdi-cash-multiple mdi-18px btn-icon analiticas text-white"></i>
                Facturados: ${res.data_exc_fat_count}
              </span>
              `;
              $("#cancelar_gen_vac-titulo").html(`Cancelar vacante No. ${vac_id}`);
              $("#data_info_analiticas-cancelar_gen_vac").html(template_info_analiticas_detalle);
           
            },
            error: function(data)
            {
              alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText); 
              
            }
          });

	  }

   $(document).ready(()=>{
   
		$("#form_cancelar_gen_vac").submit(function(event) 
        {
        event.preventDefault();
        let $form = $(this);
        let comentario=$("#vac_comentario-cancelar_gen_vac").val();
        if(comentario==""){
          swalalert('Aviso',"Debe ingresar un comentario", "warning", 0);
          return false;
        }

        let template=`
      
          <div>
            <p style="
            font-size: 1.2rem;
            font-weight: bold;
            color: #ff0000ad;
            ">
               Número de expedientes que serán cancelados
            </p>
            <span class="badge badge-info text-white" style="padding: 0.9rem 0.9rem 1rem 0.9rem;font-size: 1.5rem;">
              <i class="mdi mdi-cash-multiple mdi-18px btn-icon analiticas text-white"></i>
                Vigentes : ${_VAC_EXP_CANTIDAD}
            </span>
            <hr/>

            <p 
              style="
                font-size: 0.9rem;
                text-align: start;
                color: #5e5e5e;
                margin-bottom: 0px;
              "
            >
            Comentario:
            </p>
            <p style="
                  font-size: 0.8rem;
                  font-weight: bold;
                  color: #000000a1;
                  line-height: .9rem;
                  text-align: start;
                  margin-top: 1rem;
            ">
              ${comentario}
            </p>
          </div>
        `;

          Swal.fire(
            {
            html: template,
            showCancelButton: true, // Muestra el botón "Cancelar"
            confirmButtonText: 'Si, realizar acción', // Texto del botón "Aceptar"
            cancelButtonText: 'No, cancelar acción' // Texto del botón "Cancelar"
          }
          )
          .then((value) => {
            if(value.value==true){

              // peticion ajax inicio
                let urled="<?php echo $this->url->get('vacante/cancelar_vacante/') ?>";
                $form.find("button").prop("disabled", true);
                $.ajax({
                  type: "POST",
                  url: urled+_VAC_ID_CANCELAR_VAC,
                  data: $form.serialize(),
                  success: function(res)
                  {   
     
                    switch (res['estado']) {
                        case 2:
                        swalalert('Éxito',res['mensaje'], "success", 0);
                      
                          if(_CALLBACK_REOLAD_TABLE__CANCELAR_VAC!=0){
                            _CALLBACK_REOLAD_TABLE__CANCELAR_VAC();
                          }else{
                            window.location.reload();
                          }

                          $('#cancelar_gen_vac-modal').modal('hide');
                          $form.find("button").prop("disabled", false);

                          break;
                      case -1:
                          swalalert('Aviso',res['mensaje'], "warning", 0);
                          $form.find("button").prop("disabled", false);
                          break;
                      
                        case -2:
                        swalalertHTML('Error',`${res['mensaje']} <br> <span class=></span> `, "error");
                        $form.find("button").prop("disabled", false);
                        break;
                        default:
                        
                          break;
                      }
                  
      
                    
                  },
                  error: function(res)
                  { 
                
                    alert(res.responseText);
                  }
                });
              //peticion ajax fin 


            }else{
                 swalalert('Aviso','Acción cancelada', "info", 0);
            }
            
          });
            

   
          
    
          
        });
  });
  
</script>



{{  modal.crear("<span id='cancelar_gen_vac-titulo'><span>", "form_cancelar_gen_vac","cancelar_gen_vac-modal",
[

  {"value":"<div class='col-12 mt-1 mb-1  container-badges-cancelar' id='data_info_analiticas-cancelar_gen_vac'></div>","tipo":"html"},
  {"value":"<div class='col-12 mt-1 mb-1' id='data_info_detalle-cancelar_gen_vac'></div>","tipo":"html"},
  {"tamanio":"12","leyenda":"COMENTARIO ","required":"required","id":"vac_comentario-cancelar_gen_vac","name":"vac_comentario","tipo":"textarea","required":"","complemento":'style="min-height:250px"'}


]
)
}}

