<script type="text/javascript">

  const Calificacion = {
    texto: function(codigo) {
      if (codigo == '3') {
        return 'APROPIADO';
      } else if (codigo == '2') {
        return 'PROMEDIO';
      } 
      else if (codigo == '1') {
        return 'INAPROPIADO';
      }
      else {
        return 'SIN CALIFICACIÓN';
      }
    },
     cambiarBadge: function(codigo, elementoId) {
      var $badge = $('#' + elementoId);

      // Remover todas las clases existentes en el badge
      $badge.removeClass();

      // Agregar clase de badge según el código
     /* 
     antes
     if (codigo == '1') {
        $badge.addClass('badge rounded-pill badge-custom bg-success');
      } else if (codigo == '2') {
        $badge.addClass('badge rounded-pill badge-custom bg-warning ');
      } else if (codigo == '3') {
        $badge.addClass('badge rounded-pill badge-custom bg-danger');
      } else {
        $badge.addClass('badge rounded-pill badge-custom bg-danger');
      }*/
      //despues
     if (codigo == '3') {
        $badge.addClass('badge rounded-pill badge-custom bg-success');
      } else if (codigo == '2') {
        $badge.addClass('badge rounded-pill badge-custom bg-warning ');
      } else if (codigo == '1') {
        $badge.addClass('badge rounded-pill badge-custom bg-danger');
      } else {
        $badge.addClass('badge rounded-pill badge-custom bg-info');
      }

      // Establecer el texto del badge
      $badge.text(Calificacion.texto(codigo));
    }
    ,
     cambiarBadgeTRUPER: function(codigo, elementoId) {
      var $badge = $('#' + elementoId);

      // Remover todas las clases existentes en el badge
      $badge.removeClass();

      // Agregar clase de badge según el código
      if (codigo == '1') {
        $badge.addClass('badge rounded-pill badge-custom bg-danger' );
      } else if (codigo == '2') {
        $badge.addClass('badge rounded-pill badge-custom bg-warning ');
      } else if (codigo == '3') {
        $badge.addClass('badge rounded-pill badge-custom bg-success');
      } else {
        $badge.addClass('badge rounded-pill badge-custom bg-danger');
      }

      // Establecer el texto del badge
      $badge.text(Calificacion.texto(codigo));
    }
   
    ,
    cambiarBadgeGeneral: function(calificacion, ese_array_data,elementoId) {
      switch (ese_array_data.tif_id) {
        case '11':
        case '10':
        case '9':

          return this.cambiarBadgeTRUPER(calificacion,elementoId);
        case '1':
        case '5':
        case '6':
        case '7':
        case '8':

          return this.cambiarBadge(calificacion,elementoId);
        default:
          return '';
      }
    },
    // obtener dinamicamente
    getCalificacionGeneral: function(calificacion, ese_array_data) {
      switch (ese_array_data.tif_id) {
        case '11':
        case '10':
        case '9':
          return this.getCalificacionFormatosTruper(calificacion);
        case '1':
        case '5':
        case '6':
        case '7':
        case '8':
          return this.getCalificacion(calificacion);
        default:
          return '';
      }
    },
    getCalificacion: function(id) {
      switch (id) {
        case '1':
          return 'APTO';
        case '2':
          return 'NO APTO';
        case '3':
          return 'APTO CON RESERVAS';
        default:
          return 'SIN CALIFICACIÓN';
      }
    },
    getCalificacionFormatosTruper: function(id) {
      switch (id) {
        case '1':
          return 'NO-RECOMENDABLE';
        case '2':
          return 'RECOMENDABLE CON RESERVAS';
        case '3':
          return 'RECOMENDABLE';
        default:
          return 'SIN CALIFICACIÓN';
      }
    }
    

  };


  
  function fnGetCalificacionTextoStylesByCalId(cal_id, ese_array_data, elementoId) {
      let url_ = "<?php echo $this->url->get('calificacionfinalgrupo/ajax_get_calificacion_por_id/') ?>";
      $("#"+elementoId).html("");
      $("#"+elementoId).attr('style',"");
      $.ajax({
          type: "POST",
          url: url_ + cal_id,
          success: function(res) {
            let data = res.data;
            $("#"+elementoId).html(limpiarValorBD(data.cal_texto));
            $("#"+elementoId).attr('style',limpiarValorBD(data.cal_estilocss));

          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });


    
    }
    
  function fnOcultarLabelsNoNecesarios(){
    let labels = document.querySelectorAll('.calificacion-input-consulta-cal');
    // Recorrer todos los elementos y ocultarlos
    labels.forEach(function(elemento) {
      elemento.style.display = 'none';
    });

   
      
  }
  function fnConsultaCalificacionESE(ese_id=0)
  {
  
    
    fnOcultarLabelsNoNecesarios();
      
      url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_calificacion/') ?>";

          $.ajax({
              type: "POST",
              url: url_enviar_ese_data+ese_id,
              success: function(res)
              {
            
                if(res.length>0){
                  let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;

                  $('#consultar-calf-ese-titulo').html(`<i class="mdi mdi-playlist-check  mdi-36px btn-icon" style="color:blue;"></i> Detalles de calificaciones del estudio con el Folio: `+ese_id+mensaje_empresa_candidato);


                  
                  if (res[0].inv_nombre == null || res[0].inv_nombre.trim() === '') {
                    $('#inv_nombre-consultar-calf-ese').text('Sin asignación de investigador');
                  } else {
                    $('#inv_nombre-consultar-calf-ese').text(res[0].inv_nombre);
                  }

                  if (res[0].ana_nombre == null || res[0].ana_nombre.trim() === '') {
                    $('#ana_nombre-consultar-calf-ese').text('Sin asignación de analista');
                  } else {
                    $('#ana_nombre-consultar-calf-ese').text(res[0].ana_nombre);
                  }

               

                  if (res[0].sep_calificacion !== undefined && res[0].sep_calificacion !== null && res[0].sep_calificacion !== '-1') {
                    $('#sep_calificacion-consultar-calf-ese').val(Calificacion.texto(res[0].sep_calificacion)); 
                    Calificacion.cambiarBadge(res[0].sep_calificacion, 'sep_calificacion-consultar-calf-ese');
                    $('#sep_calificacion-consultar-calf-ese').closest('div').css('display', 'block');

                  }
                  if (res[0].sel_calificacion !== undefined && res[0].sel_calificacion !== null && res[0].sel_calificacion !== '-1') {
                    $('#sel_calificacion-consultar-calf-ese').text(Calificacion.texto(res[0].sel_calificacion)); 
                    Calificacion.cambiarBadge(res[0].sel_calificacion, 'sel_calificacion-consultar-calf-ese');
                    $('#sel_calificacion-consultar-calf-ese').closest('div').css('display', 'block');

                  }
                  if (res[0].dgf_calificacion !== undefined && res[0].dgf_calificacion !== null && res[0].dgf_calificacion !== '-1') {
                    $('#dgf_calificacion-consultar-calf-ese').text(Calificacion.texto(res[0].dgf_calificacion)); 
                    Calificacion.cambiarBadge(res[0].dgf_calificacion, 'dgf_calificacion-consultar-calf-ese');
                    $('#dgf_calificacion-consultar-calf-ese').closest('div').css('display', 'block');

                  }
                  if (res[0].dae_calificacion !== undefined && res[0].dae_calificacion !== null && res[0].dae_calificacion !== '-1') {
                    $('#dae_calificacion-consultar-calf-ese').text(Calificacion.texto(res[0].dae_calificacion)); 
                    $('#dae_calificacion-consultar-calf-ese').closest('div').css('display', 'block');
                    Calificacion.cambiarBadge(res[0].dae_calificacion, 'dae_calificacion-consultar-calf-ese');


                  }
                  if (res[0].cop_calificacion !== undefined && res[0].cop_calificacion !== null && res[0].cop_calificacion !== '-1') {
                    $('#cop_calificacion-consultar-calf-ese').text(Calificacion.texto(res[0].cop_calificacion)); 
                    $('#cop_calificacion-consultar-calf-ese').closest('div').css('display', 'block');
                    Calificacion.cambiarBadge(res[0].cop_calificacion, 'cop_calificacion-consultar-calf-ese');
                  }

                  if (res[0].ans_calificacion !== undefined && res[0].ans_calificacion !== null  && res[0].ans_calificacion !== '-1') {
                    $('#ans_calificacion-consultar-calf-ese').text(Calificacion.texto(res[0].ans_calificacion)); 
                    $('#ans_calificacion-consultar-calf-ese').closest('div').css('display', 'block');
                    Calificacion.cambiarBadge(res[0].ans_calificacion, 'ans_calificacion-consultar-calf-ese');


                  }
                  if (res[0].ess_calificacion !== undefined && res[0].ess_calificacion !== null  && res[0].ess_calificacion !== '-1') {
                    $('#ess_calificacion-consultar-calf-ese').text(Calificacion.texto(res[0].ess_calificacion)); 
                    Calificacion.cambiarBadge(res[0].ess_calificacion, 'ess_calificacion-consultar-calf-ese');
                    $('#ess_calificacion-consultar-calf-ese').closest('div').css('display', 'block');

                  }

                  if (res[0].bie_calificacion !== undefined && res[0].bie_calificacion !== null && res[0].bie_calificacion !== '-1') {
                    $('#bie_calificacion-consultar-calf-ese').text(Calificacion.texto(res[0].bie_calificacion));
                    Calificacion.cambiarBadgeGeneral(res[0].bie_calificacion,res[0], 'bie_calificacion-consultar-calf-ese');
                    //Calificacion.cambiarBadge();

                    $('#bie_calificacion-consultar-calf-ese').closest('div').css('display', 'block');

                  }
                  
                  if (res[0].agf_calificacion !== undefined && res[0].agf_calificacion !== null && res[0].agf_calificacion !== '-1') {
                    $('#agf_calificacion-consultar-calf-ese').text(Calificacion.texto(res[0].agf_calificacion));
                    Calificacion.cambiarBadge(res[0].agf_calificacion, 'agf_calificacion-consultar-calf-ese');

                    $('#agf_calificacion-consultar-calf-ese').closest('div').css('display', 'block');

                  }


                  if (res[0].sie_calificacion !== undefined && res[0].sie_calificacion !== null && res[0].sie_calificacion !== '-1') {
                    $('#sie_calificacion-consultar-calf-ese').text(Calificacion.texto(res[0].sie_calificacion));
                    Calificacion.cambiarBadge(res[0].agf_calificacion, 'sie_calificacion-consultar-calf-ese');

                    $('#sie_calificacion-consultar-calf-ese').closest('div').css('display', 'block');

                  }

                  if (res[0].usu_valida_nombre !== undefined && res[0].usu_valida_nombre !== null && res[0].usu_valida_nombre !== '-1') {
                    $('#usu_valida_nombre-consultar-calf-ese').text(res[0].usu_valida_nombre);
                  }else{
                    $('#usu_valida_nombre-consultar-calf-ese').text('SIN DATO');
                  }

                  if (res[0].ese_fechaentregacliente !== undefined && res[0].ese_fechaentregacliente !== null && res[0].ese_fechaentregacliente !== '-1') {
                    $('#ese_fechaentregacliente-consultar-calf-ese').text(res[0].ese_fechaentregacliente);
                  }else{
                    $('#ese_fechaentregacliente-consultar-calf-ese').text('SIN FECHA DE ENTREGA');

                  }
                  

                  // calificacion inical 
                  if (res[0].daf_calificacion !== undefined && res[0].daf_calificacion !== null && res[0].daf_calificacion !== '-1') {
                    // Calificacion.cambiarBadgeGeneral(res[0].daf_calificacion,res[0] ,'daf_calificacion-consultar-calf-ese');
                    $('#daf_calificacion-consultar-calf-ese').closest('div').parent().css('display', 'flex');
                    fnGetCalificacionTextoStylesByCalId(res[0].cal_id,res[0] ,'daf_calificacion-consultar-calf-ese');
                    // $('#daf_calificacion-consultar-calf-ese').text(text_cal); 
                  }
                  // calificacion fin
                  

                

                  
                }
              
              },
              error: function(data)
              {
                alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                
              }
            });
 
    }


</script>

<div class="modal fade" id="consultar-calf-ese-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="consultar-calf-ese-titulo"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="" class="form-vertical mt-1">
            <div class="form-group row">
              
        
             
              <!-- <div class="col-lg-10"> -->
                <div class="col-lg-12 mt-2">
                  <label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">Datos del estudio</label>
                </div>
                <div class="col-lg-6 ">
                  <label class="col-form-label title-busq">Investigador</label>
                  <br>
                  <label class="col-form-label title-busq" id="inv_nombre-consultar-calf-ese" style="font-size: 1.5rem;"></label>

                </div>
                <div class="col-lg-6 ">
                  <label class="col-form-label title-busq">Analista</label>
                  <br>
                  <label class="col-form-label title-busq" id="ana_nombre-consultar-calf-ese" style="font-size: 1.5rem;"></label>

                </div>
               

                <div class="col-lg-12 mt-1">
                  <label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">Calificaciones</label>
                </div>

           

                <div class="col-lg-4 calificacion-input-consulta-cal">
                  <label class="col-form-label title-busq">Datos escolares</label>
                  <br>
                  <span class="badge rounded-pill badge-custom bg-primary" id="dae_calificacion-consultar-calf-ese"></span>

                 </div>


                 <div class="col-lg-4 calificacion-input-consulta-cal">
                  <label class="col-form-label title-busq">Datos grupo familiar</label>
                  <br>
                  <span class="badge rounded-pill badge-custom bg-primary" id="dgf_calificacion-consultar-calf-ese"></span>

                 </div>

                 <div class="col-lg-4 calificacion-input-consulta-cal">
                  <label class="col-form-label title-busq">Sección laboral</label>
                  <br>
                  <span class="badge rounded-pill badge-custom bg-primary" id="sel_calificacion-consultar-calf-ese"></span>

                 </div>

                 <div class="col-lg-4 calificacion-input-consulta-cal">
                  <label class="col-form-label title-busq">Sección personal</label>
                  <br>
                  <span class="badge rounded-pill badge-custom bg-primary" id="sep_calificacion-consultar-calf-ese"></span>

                 </div>

                 <div class="col-lg-4 calificacion-input-consulta-cal"  >
                  <label class="col-form-label title-busq">Estado general de salud</label>
                  <br>
                  <span class="badge rounded-pill badge-custom bg-primary" id="ess_calificacion-consultar-calf-ese"></span>

                 </div>

                 <div class="col-lg-4 calificacion-input-consulta-cal"  >
                  <label class="col-form-label title-busq">Situación económica</label>
                  <br>
                  <span class="badge rounded-pill badge-custom bg-primary" id="sie_calificacion-consultar-calf-ese"></span>

                 </div>


                 
                 <div class="col-lg-4 calificacion-input-consulta-cal">
                  <label class="col-form-label title-busq">Antecedentes sociales</label>
                  <br>
                  <span class="badge rounded-pill badge-custom bg-primary"></span>

                 </div>
                 <div class="col-lg-4 calificacion-input-consulta-cal">
                  <label class="col-form-label title-busq">Bienes inmuebles</label>
                  <br>
                  <span class="badge rounded-pill badge-custom bg-primary" id="bie_calificacion-consultar-calf-ese"></span>

                 </div>

                 <div class="col-lg-4 calificacion-input-consulta-cal">
                  <label class="col-form-label title-busq">Antecendentes sociales</label>
                  <br>
                  <span class="badge rounded-pill badge-custom bg-primary" id="ans_calificacion-consultar-calf-ese"></span>

                 </div>

                 <div class="col-lg-4 calificacion-input-consulta-cal">
                  <label class="col-form-label title-busq">Antecendentes lab. de grupo familiar</label>
                  <br>
                  <span class="badge rounded-pill badge-custom bg-primary" id="agf_calificacion-consultar-calf-ese"></span>

                 </div>

                 <div class="col-lg-12 mt-1">
                  <label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">Datos de entrega</label>
                 </div>

                <div class="col-12  mt-1 row  calificacion-input-consulta-cal" >
                    <div class="col-ms-4 col-4">
                      <label class="col-form-label title-busq">Entregó</label>
                      <br>
                      <label class="col-form-label title-busq" id="usu_valida_nombre-consultar-calf-ese" style="font-size: 1rem;"></label>

                    </div>

                    <div class="col-ms-4 col-4">
                      <label class="col-form-label title-busq">Fecha de entrega</label>
                      <br>
                      <label class="col-form-label title-busq" id="ese_fechaentregacliente-consultar-calf-ese" style="font-size: 1rem;"></label>

                    </div>

                    <div class="col-ms-4 col-4">
                      <label class="col-form-label title-busq">Calificación final</label>
                      <br>
                      <span class="badge rounded-pill badge-custom " id="daf_calificacion-consultar-calf-ese"></span>
                    </div>
                  

                </div>

               
  
  
  
              <!-- </div> -->
              
            
            </div>
          </form>      
        </div>
      </div>
    </div>
  </div>