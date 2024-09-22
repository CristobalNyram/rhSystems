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
    let _VAC_ID_COMPARTIR_VAC=0;
    let _CALLBACK_REOLAD_TABLE__COMPARTIR_VAC=0;
    function fnCompartirVacanteEje(vac_id=0,callbak_table=0)
	  {
      
        $("#form_compartir_vac_eje .btn-limpiar, #form_compartir_vac_eje .btn-buscar").hide();

        $("#rve_eje_id-compartir_vac_eje").html('');
        $('#btn_template-compartir_vac_eje').html("");

        _VAC_ID_COMPARTIR_VAC=vac_id;
        _CALLBACK_REOLAD_TABLE__COMPARTIR_VAC=callbak_table;
        let url="<?php echo $this->url->get('relvacanteejecutivo/ajax_get_detalle_relacion/') ?>";
        $.ajax({
            type: "POST",
            url: url+_VAC_ID_COMPARTIR_VAC,
            success: function(res)
            {
              let data_usu=res.data_usu;
              let data_rve=res.data_rve;
              let data_vac=res.data_vac;
              let template_checkbox = ``;
              let template_select  = ``;
              let template_btn_otro_lugar=`
              <div class="row col-lg-12">
                  <div class="col-sm-6 col-md-6 text-center mt-5">
                    <!-- Contenido del primer bloque -->
                  </div>

                  <div class="col-sm-3 col-md-3 text-center mt-5">
                    <div class="form-group">
                      <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal">
                        <i class="mdi mdi-close white"></i> Cancelar
                      </a>
                    </div>
                  </div>

                  <div class="col-sm-3 col-md-3  text-center mt-5">
                    <div class="form-group">
                      <button class="btn-dark btn-rounded btn btn-buscar" type="submit">
                        Guardar <i class="mdi mdi-chevron-right white"></i>
                      </button>
                    </div>
                  </div>
                </div>
              `;


              let mensaje=` de la vacante Folio  ${data_vac.vac_id} - empresa: ${data_vac.emp_nombre} `+generateBadgeVacEstatusHTML(data_vac.vac_estatus);
              $('#compartir_vac_eje-titulo').html(mensaje);
              $('#btn_template-compartir_vac_eje').html(template_btn_otro_lugar);

                   


            data_usu.forEach((usuario) => {
                let tieneCorrespondencia = data_rve.some((rve) => rve.eje_id === usuario.usu_id);
              if( tieneCorrespondencia==false){
               template_select += `
                  <option value="${usuario.usu_id}" data-rve-eje-id="${usuario.eje_id}" >
                    ${usuario.usu_nombre} ${usuario.usu_primerapellido} ${usuario.usu_segundoapellido}
                  </option>
                `;
              }
              
              });

            $("#rve_eje_id-compartir_vac_eje").html(template_select).select2({
                placeholder: "Seleccione al/los ejecutivo(s) con quien desea compartir la vacante.",
                allowClear: true // Esto permite borrar la selección actual
            });   
            $("#vac_eje_id-compartir_vac_eje").val(data_vac.eje_nombre);
            $("#eje_id-compartir_vac_eje").val(data_vac.eje_id);

            config={
            id_div_contenedor :"rve_eje_tabla-listado"
            }
            fnCargarTablaGeneralRVE(data_vac.vac_id,config);
              
              
            },
            error: function(data)
            {
              alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText); 
              
            }
          });

	  }

   $(document).ready(()=>{
   
		$("#form_compartir_vac_eje").submit(function(event) 
        {
        event.preventDefault();
        //SELECT VALID -FIN
        let isValidSelects = true;
        let select_mult_eje = $("#rve_eje_id-compartir_vac_eje").val();
          if (!select_mult_eje || select_mult_eje.length === 0) {
            isValidSelects = false;
          }
          // Mostrar la alerta si el select está vacío
          if (!isValidSelects) {
            Swal.fire({
              title: 'AVISO',
              text: 'Por favor, selecciona al menos un ejecutivo.',
            });
            return false;
          }
        //SELECT VALID -INI

        let $form = $(this);
        // peticion ajax inicio
        let urled="<?php echo $this->url->get('vacante/compartir_vacante/') ?>";
        $form.find("button").prop("disabled", true);
        $.ajax({
        type: "POST",
        url: urled+_VAC_ID_COMPARTIR_VAC,
        data: $form.serialize(),
        success: function(res)
        {   
          switch (res['estado']) {
              case 2:
              swalalert('Éxito',res['mensaje'], "success", 0);
                if(_CALLBACK_REOLAD_TABLE__COMPARTIR_VAC!=0){
                _CALLBACK_REOLAD_TABLE__COMPARTIR_VAC();
                }else{
                window.location.reload();
                }
               $('#compartir_vac_eje-modal').modal('hide');
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

        });
  });
  
</script>



{{  modal.crear("Compartir vacante <span id='compartir_vac_eje-titulo'><span>", "form_compartir_vac_eje","compartir_vac_eje-modal",
[
  {"tamanio":"12","leyenda":"EJECUTIVO PROPIETARIO","id":"vac_eje_id-compartir_vac_eje","name":"","tipo":"text","required":"",'funcion":""',"complemento":' readonly' },
  {"tamanio":"12 mb-3","leyenda":"EJECUTIVOS NUEVO A LOS QUE SE LE COMPARTE LA VACANTE","id":"rve_eje_id-compartir_vac_eje","name":"rve_eje_id[]","tipo":"select","required":"","complemento":' multiple'},
  {"value":"<div class='mr-1 ml-1 row col-12 mt-1 mb-1' id='btn_template-compartir_vac_eje'></div>","name":"","tipo":"html" },
  {"tamanio":"12","leyenda":"LISTA DE EJECUTIVOS QUE COMPARTEN ESTA VACANTE ACTUALMENTE","tipo":"seccion"},

  {"value":"<div class='mr-1 ml-1 row col-12 mt-1 mb-1' id='rve_eje_tabla-listado'></div>","tipo":"html"},
  {"tamanio":"12","leyenda":"","id":"eje_id-compartir_vac_eje","name":"eje_id","tipo":"hidden","required":"",'funcion":""',"complemento":' readonly' }

]
)
}}

