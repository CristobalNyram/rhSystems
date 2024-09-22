<script>

    function comentarioeseVisualizar(id_ese){
            reciboListado = document.getElementById('comentariolistadoesedetalles');
            url="<?php echo $this->url->get('comentarioese/tabla/') ?>";
            url+=id_ese;
            // $("#cliente_recibo").html("Cliente: "+cliente);
            // $("#descripcion_recibo").html("Descripción: "+descripcion);
            $.post(url, $(this).serialize() , function(data)
            {
                $('#comentariolistadoesedetalles').html(data);
                // divListado.innerHTML=data;
                $('#comentariotableese_visualizar').DataTable(
                {
                  "pageLength":5,
                  'order': [[2, 'desc']],
                   "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sSearch":         "Buscar:",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Personalizar",
                        "excel":"Excel",
                        "pdf":"PDF",
                        "print":"PDF"
  
                    }
                },
                
                buttons: [{
                      extend: 'excelHtml5',
                      exportOptions: {
                          columns: ':visible'
                      }
                  }, 
                  {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: ":visible"
                    }
                  },
                  'colvis'
                ]
                });
            }).done(function() { 
            }).fail(function() {
            })
    }
    function resumen_estudio(ese_bandera_color_estatus,ese_estatus_id,ese_estatus_nombre,ese_id,folio_verificacion
        )
     {

      let url_enviar="<?php echo $this->url->get('consulta/get_ajax_detalles_ese_uno/') ?>";
            // let $nivel_estudios =ese_id
  
            $.ajax({
                type: "POST",
                url: url_enviar+ese_id,
                  
                success: function(res)
                {
    
                   
                      // Agregar nuevos sub-departamentos
                      if (res['data'].length==0) {
  
                        
  
  
  
                      }else{
                        let data=res['data'][0];
                         //console.log(data)
                      

                        comentarioeseVisualizar(data.ese_id);
                              if(data.ese_tippersona =='2')
                              {
                                $('#ese_tip_persona_modal_resumen_tipoestudio_2').val('MORAL')
                              }else{
                                $('#ese_tip_persona_modal_resumen_tipoestudio_2').val('FISICA')
                              }

                              if(data.tip_id =='2' || data.tip_id =='3' || data.tip_id =='4'){
                                $('.NO_inputs_tipp_estudio_2').hide();
                              }else{
                                $('.NO_inputs_tipp_estudio_2').show();
                              }



                              
                                  $('#badge_modal_resument_tipoestudio_2').removeAttr('class');
                                  $('#badge_modal_resument_tipoestudio_2').addClass(`pl-3 pr-3 pt-2 pb-2  badge  ${ese_bandera_color_estatus}`);
                                  $('#badge_modal_resument_tipoestudio_2').text(ese_estatus_nombre);
                                  $('#ese_id_modal_resument_tipoestudio_2').text(ese_id);
                                  $('#ese_folioverificacion_modal_resumen_tipoestudio_2').val(folio_verificacion);

                                  
                                  $('#ese_fecha_alta_modal_resumen_tipoestudio_2').val(data.ese_registro);
                                  $('#ese_fecha_cancelacion_o_fin_texto_modal_resumen_tipoestudio_2').text('');
                                  
                                  // $('#ese_nombre_candidato_modal_resumen_tipoestudio_2').val(ese_nombre_candidato);

                                  if(data.usu_alta_nombre_completo==null){
                                    $('#ese_nombre_quien_registro_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_nombre_quien_registro_modal_resumen_tipoestudio_2').val(data.usu_alta_nombre_completo);
                                  }

                           

                                  $('#ese_curp_candidato_modal_resumen_tipoestudio_2').val(data.ese_curp);

                                  if(data.ese_nombre_nombre_completo_candidato==null){
                                    $('#ese_nombre_candidato_modal_resumen_tipoestudio_2').val('');
                                  }else{
                                    $('#ese_nombre_candidato_modal_resumen_tipoestudio_2').val(data.ese_nombre_nombre_completo_candidato);

                                  }
                                  if(data.ese_fechaentregainvestigador!=null){
                                    $('#ese_entrega_inv_modal_resumen_tipoestudio_2').val(data.ese_fechaentregainvestigador);
                                  }else{
                                    $('#ese_entrega_inv_modal_resumen_tipoestudio_2').val('');

                                  }

                                  if(data.tra_id==null){
                                    $('#tra_id_visualizar').text('');
                                  }else{
                                    $('#tra_id_visualizar').text(data.tra_id);

                                  }
                              

                                  if(data.ese_fechanacimiento==null)
                                  {
                                    $('#ese_fecha_nacimiento_candidato_modal_resumen_tipoestudio_2').val('');

                                  }else
                                  {
                                    $('#ese_fecha_nacimiento_candidato_modal_resumen_tipoestudio_2').val(data.ese_fechanacimiento);

                                  }
                                  if(data.ese_correo==null){
                                    $('#ese_email_candidato_modal_resumen_tipoestudio_2').val('');
                                  }else{
                                    $('#ese_email_candidato_modal_resumen_tipoestudio_2').val(data.ese_correo);
                                  }
                                  if(data.ese_telefono==null)
                                  {
                                    $('#ese_telefono_candidato_modal_resumen_tipoestudio_2').val(''); 

                                  }else{
                                    $('#ese_telefono_candidato_modal_resumen_tipoestudio_2').val(data.ese_telefono); 

                                  }
                               
                                  if(data.ese_celular==null){
                                    $('#ese_celular_candidato_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_celular_candidato_modal_resumen_tipoestudio_2').val(data.ese_celular);

                                  }
                                    $('#ese_direccion_candidato_modal_resumen_tipoestudio_2').hide();

                              
                                  //direccion inicio
                                  if(data.ese_calle==null){
                                    $('#ese_calle_direccion_candidato_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_calle_direccion_candidato_modal_resumen_tipoestudio_2').val(data.ese_calle);
                                  }

                                  if(data.ese_numext==null){
                                    $('#ese_no_ext_direccion_candidato_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_no_ext_direccion_candidato_modal_resumen_tipoestudio_2').val(data.ese_numext);
                                  }
                                  if(data.ese_numint==null){
                                    $('#ese_no_int_direccion_candidato_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_no_int_direccion_candidato_modal_resumen_tipoestudio_2').val(data.ese_numint);
                                  }

                                  if(data.ese_colonia==null){
                                    $('#ese_colonia_direccion_candidato_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_colonia_direccion_candidato_modal_resumen_tipoestudio_2').val(data.ese_colonia);
                                  }

                                  //direccion fin

                                  

                                  if(data.ese_cp==null){
                                    $('#ese_cp_candidato_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_cp_candidato_modal_resumen_tipoestudio_2').val(data.ese_cp);
                                  }
                                  if(data.est_nombre==null){
                                    $('#ese_estado_candidato_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_estado_candidato_modal_resumen_tipoestudio_2').val(data.est_nombre);

                                  }
                                  if(data.mun_nombre==null){
                                    $('#ese_municipio_candidato_modal_resumen_tipoestudio_2').val(''); 

                                  }else{
                                    $('#ese_municipio_candidato_modal_resumen_tipoestudio_2').val(data.mun_nombre); 

                                  }
                                
                              
                                 // $('#ese_nombre_inv_modal_resumen_tipoestudio_2').val(ese_investigador);
                                 if(data.inv_nombre==null){
                                   $('#ese_nombre_inv_modal_resumen_tipoestudio_2').val('');

                                 }else{
                                  $('#ese_nombre_inv_modal_resumen_tipoestudio_2').val(data.inv_nombre);

                                 }

                                  if(data.ese_fechaasiginvestigador==null){
                                    $('#ese_asig_inv_modal_resumen_tipoestudio_2').val(data.inv_nombre);

                                  }else{
                                    $('#ese_asig_inv_modal_resumen_tipoestudio_2').val(data.ese_fechaasiginvestigador);

                                  }


                                 if(data.tra_asigno_usuario==null){
                                  $('#ese_asigno_usu_transporte_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_asigno_usu_transporte_modal_resumen_tipoestudio_2').val(data.tra_asigno_usuario);

                                  }
                             
                                  if(data.tra_fechainvestigador==null){
                                    $('#ese_asigno_fecha_transporte_modal_resumen_tipoestudio_2').val('');
                                  }else{  
                                    $('#ese_asigno_fecha_transporte_modal_resumen_tipoestudio_2').val(data.tra_fechainvestigador);
                                  }


                                   if(data.usuario_aprobo_transporte==null){
                                    $('#ese_aprobo_usu_transporte_modal_resumen_tipoestudio_2').val('');

                                   }else{
                                    $('#ese_aprobo_usu_transporte_modal_resumen_tipoestudio_2').val(data.usuario_aprobo_transporte);

                                  }
                                  if(data.tra_fechaaprobado==null){
                                      $('#ese_aprobo_fecha_transporte_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_aprobo_fecha_transporte_modal_resumen_tipoestudio_2').val(data.tra_fechaaprobado);

                                  }

                                  if(data.tra_aprobado==null){
                                    $('#ese_aprobo_monto_transporte_modal_resumen_tipoestudio_2').val();

                                  }else{
                                    $('#ese_aprobo_monto_transporte_modal_resumen_tipoestudio_2').val(`$${data.tra_aprobado}`);

                                  }   
                                  
                                  if(data.tra_comentarioadmin==null){
                                    $('#ese_comentario_admin_transporte_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_comentario_admin_transporte_modal_resumen_tipoestudio_2').val(data.tra_comentarioadmin);

                                  }

                                  if(data.tra_comentario==null){
                                    $('#ese_comentario_transporte_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_comentario_transporte_modal_resumen_tipoestudio_2').val(data.tra_comentario);

                                  }

                                  if(data.tra_preaprobado==null){
                                    $('#ese_monto_preaprobado_transporte_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_monto_preaprobado_transporte_modal_resumen_tipoestudio_2').val(`$${data.tra_preaprobado}`);

                                  }
                                  if(data.tra_solicitado==null){
                                              $('#ese_monto_solicitado_transporte_modal_resumen_tipoestudio_2').val(``);

                                  }else{
                                    $('#ese_monto_solicitado_transporte_modal_resumen_tipoestudio_2').val(`$${data.tra_solicitado}`);

                                  }
                                  if(data.tra_origen==null){
                                    $('#ese_origen_transporte_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_origen_transporte_modal_resumen_tipoestudio_2').val(data.tra_origen);

                                  }

                                  if(data.tra_destino==null){
                                    $('#ese_destino_transporte_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_destino_transporte_modal_resumen_tipoestudio_2').val(data.tra_destino);

                                  }
                              
                                  if(data.ana_nombre==null){
                                    $('#ese_analista_nombre_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                  $('#ese_analista_nombre_modal_resumen_tipoestudio_2').val(data.ana_nombre);

                                   }

                                   if(data.ese_fechaasiganalista==null){
                                     $('#ese_analista_fecha_asig_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_analista_fecha_asig_modal_resumen_tipoestudio_2').val(data.ese_fechaasiganalista);

                                  }

                                  if(data.ese_fechaentregaanalista==null){
                                    $('#ese_analista_fecha_entrega_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_analista_fecha_entrega_modal_resumen_tipoestudio_2').val(data.ese_fechaentregaanalista);

                                  }

                        
                            
                              
                                  if(data.usu_valida_nombre_completo==null){
                                    $('#ese_validacion_usuario_valido_entrega_modal_resumen_tipoestudio_2').val('');

                                   }else{
                                    $('#ese_validacion_usuario_valido_entrega_modal_resumen_tipoestudio_2').val(data.usu_valida_nombre_completo);

                                   }

                                  if(data.ese_fechaentregacliente==null){
                                          $('#ese_validacion_fecha_entrega_modal_resumen_tipoestudio_2').val('');


                                  }else{

                                        $('#ese_validacion_fecha_entrega_modal_resumen_tipoestudio_2').val(data.ese_fechaentregacliente);

                                  }

                                  if(data.emp_nombre==null){
                                    $('#ese_empresa_nombre_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_empresa_nombre_modal_resumen_tipoestudio_2').val(data.emp_nombre);

                                  }
                                  //            if(data.==null){

                                  // }else{
                                  //   $('#ese_empresa_centro_costos_modal_resumen_tipoestudio_2').val(data.ese_fechaasiginvestigador);

                                  // }

                                  if(data.cen_id==null){
                                    $('#ese_empresa_centro_costos_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_empresa_centro_costos_modal_resumen_tipoestudio_2').val(data.cen_nombre);
                                  }
                                  if(data.emp_rfc==null){
                                              $('#ese_empresa_rfc_modal_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_empresa_rfc_modal_resumen_tipoestudio_2').val(data.emp_rfc);

                                  }
                                  if(data.cne_nombre_completo==null){
                                    $('#ese_empresa_contacto_resumen_tipoestudio_2').val('');

                                  }else{
                                    $('#ese_empresa_contacto_resumen_tipoestudio_2').val(data.cne_nombre_completo);
                                  }


                                  if(data.usu_cancela_nombre_completo==null){
                                    $('#ese_usuario_cancelo_resumen_tipoestudio_2').val('');
                                  }else{
                                    $('#ese_usuario_cancelo_resumen_tipoestudio_2').val(data.usu_cancela_nombre_completo);

                                  }
                                  if(data.ese_fechacancelacion==null){
                                    $('#ese_usuario_cancelo_fecha_resumen_tipoestudio_2').val('');
                                  }else{
                                    $('#ese_usuario_cancelo_fecha_resumen_tipoestudio_2').val(data.ese_fechacancelacion);
                                  }

                                  
                                  //  $('#ese_empresa_contacto_resumen_tipoestudio_2').val(emp_contacto);
                                  //  $('#ese_empresa_contacto_telefono_resumen_tipoestudio_2').val(emp_telefono);
                              
                                  // $('#ese_empresa_contacto_correo_resumen_tipoestudio_2').val(data.ese_fechaasiginvestigador);
                                  //            if(data.==null){

                                  // }else{

                                  // }
                                  // $('#ese_usuario_cancelo_resumen_tipoestudio_2').val(data.ese_fechaasiginvestigador);
                                  //            if(data.==null){

                                  // }else{

                                  // }
                                  // $('#ese_usuario_cancelo_fecha_resumen_tipoestudio_2').val(data.ese_fechaasiginvestigador);
                                  
                                  // $('#ese_usuario_cancelo_estatus_resumen_tipoestudio_2').val(data.ese_fechaasiginvestigador);
                              
                              
                                  //evaluar que secciones se muestran inicio
                                
                                

                                  if(data.ese_estatus!='-2'){
                                    $('#seccion_cancelacion_modal_resumen_tipoestudio_2').hide();
                                  }else{
                                    $('#seccion_cancelacion_modal_resumen_tipoestudio_2').show();
                                  }
                                  if(data.ese_estatus!='7'){
                                    $('#seccion_validacion_modal_resumen_tipoestudio_2').hide();
                                  }else{
                                    $('#seccion_validacion_modal_resumen_tipoestudio_2').show();
                                  }

                               


                                  /*validar o ocultar seecciones de trnasporte inicio*/
                                  if(data.ese_transporte==='2' && data.tra_id!=null){
                                    inputBoton=` <a data-toggle="modal" title="Ver archivos de este estudio"  data-container="body" data-toggle="popover" role="button" class="btn-dark btn-rounded btn btn-buscar" data-target="#archivos-transporte-modal" onclick="fn_archivo_transporte_tabla_modal(${data.tra_id},${data.ese_id});">
                                                  <i class="mdi mdi-file-eye"></i>
                                                        Ver archivos  transporte
                                                  </a>`;
                              
                                    $('#aqui_boton_archivos_transporte').empty();
                                    $('#aqui_boton_archivos_transporte').html(inputBoton);
                                  
                                    $('#seccion_transporte_modal_resumen_tipoestudio_2').show();

                                          if(data.tra_estatus=='1'){ 
                                              $('#badge_estatus_transporte').text('Preaprobado');
                                              $('#badge_estatus_transporte').removeAttr( "class" )
                                              $('#badge_estatus_transporte').addClass('badge');
                                              $('#badge_estatus_transporte').addClass('badge-primary');
                                              $('#badge_estatus_transporte').addClass('p-2');

                                          }if(data.tra_estatus=='2'){
                                            $('#badge_estatus_transporte').text('Solicitado')
                                            $('#badge_estatus_transporte').removeAttr( "class" )
                                            $('#badge_estatus_transporte').addClass('badge');
                                            $('#badge_estatus_transporte').addClass('badge-warning');
                                            $('#badge_estatus_transporte').addClass('p-2');


                                          }if(data.tra_estatus=='3'){
                                            $('#badge_estatus_transporte').text('Aprobado')
                                            $('#badge_estatus_transporte').removeAttr( "class" )
                                            $('#badge_estatus_transporte').addClass('badge');
                                            $('#badge_estatus_transporte').addClass('badge-success');
                                            $('#badge_estatus_transporte').addClass('p-2');

                                          }
                                          if(data.tra_estatus==null || data.tra_estatus==''){
                                           // console.log('sin estatus');
                                            $('#badge_estatus_transporte').text('Sin estatus...')
                                            $('#badge_estatus_transporte').removeAttr( "class" )
                                            $('#badge_estatus_transporte').addClass('badge');
                                            $('#badge_estatus_transporte').addClass('badge-secondary');
                                            $('#badge_estatus_transporte').addClass('p-2');
                                          }

                                  }else{
                                    $('#seccion_transporte_modal_resumen_tipoestudio_2').hide();
                                    // $('#badge_estatus_transporte').text('Sin estatus...')
                                    // $( '#badge_estatus_transporte').removeClass('active')

                                    $('#badge_estatus_transporte').removeAttr( "class" )
                                    $('#badge_estatus_transporte').addClass('badge');
                                    $('#badge_estatus_transporte').addClass('badge-secondary');
                                    $('#badge_estatus_transporte').addClass('p-2');

                                    



                                  }


                                  if(data.tra_estatus==='1' || data.tra_estatus==='2' || data.tra_estatus==='3'){
                                    $('#seccion_asignar_transporte').show();
                                    $('#seccion_monto_preaprobado_transporte').show();

                                  }else{
                                    $('#seccion_asignar_transporte').hide();
                                   $('#secccion_monto_preaprobado_transporte').hide();


                                  }
                                  if(data.tra_estatus==='2' || data.tra_estatus==='3'){
                                      $('#seccion_monto_solicitado_transporte').show();
                                      $('#seccion_monto_solicitado_transporte').show();

                                  }else{
                                      $('#seccion_monto_solicitado_transporte').hide();
                                      $('#seccion_monto_solicitado_transporte').hide();

                                  }

                                  if(data.tra_estatus==='3'){
                                    $('#sccion_aprobar_transporte').show();
                                    $('#secccion_monto_aprobado_transporte').show();
                                  }else{
                                    $('#seccion_aprobar_transporte').hide();
                                    $('#secccion_monto_aprobado_transporte').hide();

                                  }
                                   /*validar o ocultar seecciones de trnasporte fin*/

                              
                                   if(data.ese_estatus>=2){
                                    $('.seccion_estatus_2').show();

                                  }else{
                                    $('.seccion_estatus_2').hide();

                                   }
                                  
                               
                                   if(data.ese_estatus>=5){
                                    $('.seccion_estatus_5').show();
                                    }else{
                                      $('.seccion_estatus_5').hide();

                                   }
                                   if(data.ese_estatus>=7){
                                    
                                    }else{

                                    }
                                 
                                   if(data.ese_estatus>=8){
                                    
                                    }else{

                                    }
                                  
                                  //evaluar que secciones se muestran fin
                                  // reloadcomentariorecibo(ese_id,'detalles');

                          
                                   

                                  
                                  if((data.ese_estatus=='7' || data.ese_estatus==7 || data.ese_estatus===7))
                                    {
                                      $('#ese_fecha_cancelacion_o_fin_modal_resumen_tipoestudio_2').val(data.ese_fechaentregacliente);
                                      $( "#ese_fecha_cancelacion_o_fin_modal_resumen_tipoestudio_2" ).addClass( 'text-success').removeClass( 'text-danger  text-dark');
                                      $('#ese_fecha_cancelacion_o_fin_texto_modal_resumen_tipoestudio_2').text('Fecha de entrega cliente');
                                      $('#seccion_visitas_modal_resumen').show();
                                      $('#ese_visita_modal_resumen_tipoestudio_2').val(data.ese_visita);
                                      if(data.honorario_asignado!=null || data.honorario_asignado!=''){
                                        $('#ese_honorario_modal_resumen_tipoestudio_2').val(data.honorario_asignado);
                                      }

                                      
                                    }
                                    else{
                                      $('#seccion_visitas_modal_resumen').hide();

                                            if((data.ese_estatus==='-2'))
                                            {
                                              $('#ese_fecha_cancelacion_o_fin_texto_modal_resumen_tipoestudio_2').text('Fecha de cancelación');
                                               $('#ese_fecha_cancelacion_o_fin_modal_resumen_tipoestudio_2').val(data.ese_fechacancelacion);
                                              $( "#ese_fecha_cancelacion_o_fin_modal_resumen_tipoestudio_2" ).addClass( 'text-danger').removeClass( 'text-dark  text-success');
                              
                              
                                            }
                                            else
                                            {
                                              $('#ese_fecha_cancelacion_o_fin_texto_modal_resumen_tipoestudio_2').text('En proceso...');
                              
                                              $('#ese_fecha_cancelacion_o_fin_modal_resumen_tipoestudio_2').val('El estudio sigue en proceso');
                                              $( "#ese_fecha_cancelacion_o_fin_modal_resumen_tipoestudio_2" ).addClass( 'text-dark').removeClass( 'text-danger  text-success');
                              
                              
                                            }
                                        
                                    }
  
                      }
                    
  
                },
                error: function(res)
                {
                    alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                  
                }
            });


     
  

  
    }
  
    
  </script>

<div class="modal fade" id="ver_resumen_estudio-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          
          <h5 class="" id="exampleModalLabel"><span class=" badge " id="badge_modal_resument_tipoestudio_2">Estatus</span>  Estudio No. <span id="ese_id_modal_resument_tipoestudio_2" ></span>   </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="frm_editarempresa" class="form-vertical mt-1">
           

            <div class="form-group row pb-5 border-bottom">
  
          
      
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Folio de verificación o núm. control</label>
                      <input id="ese_folioverificacion_modal_resumen_tipoestudio_2" name="ese_folioverificacion_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Folio de verificación o núm. control" required />
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Tipo de persona</label>
                      <input id="ese_tip_persona_modal_resumen_tipoestudio_2" name="ese_tip_persona_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Tipo de persona" required />
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Fecha de alta </label>
                      <input id="ese_fecha_alta_modal_resumen_tipoestudio_2" name="ese_fecha_alta_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Fecha de alta" required/>
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq" id="ese_fecha_cancelacion_o_fin_texto_modal_resumen_tipoestudio_2" ></label>
                      <input id="ese_fecha_cancelacion_o_fin_modal_resumen_tipoestudio_2" name="ese_fecha_cancelacion_o_fin_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Fecha de fin" required />
                    </div>
             
       
              
             
              </div>


              <h6 class=" " id="exampleModalLabel">Datos de alta de estudio <i class="mdi mdi-database mdi-18px btn-icon"></i> </h6>

              <div class="form-group row pb-5 border-bottom">
    
            
  
                  <div class="col-lg-12">
                    <label class="col-form-label title-busq">Nombre de quien lo dio de alta</label>
                    <input id="ese_nombre_quien_registro_modal_resumen_tipoestudio_2" name="ese_nombre_quien_registro_modal_resumen_tipoestudio_2" type="text"class="form-control input-disabled" readonly placeholder="Persona que registró el estudio" required />
                  </div>
         

              </div>

            <h6 class=" " id="exampleModalLabel">Datos generales del candidato <i class="mdi mdi-nature-people mdi-18px btn-icon"></i> </h6>

            <div class="form-group row pb-5 border-bottom">
  
          

            <div class="col-lg-6">
              <label class="col-form-label title-busq">Nombre candidato</label>
              <input id="ese_nombre_candidato_modal_resumen_tipoestudio_2" name="ese_nombre_candidato_modal_resumen_tipoestudio_2" type="text"class="form-control input-disabled" readonly placeholder="Nombre" required />
            </div>
           
            <div class="col-lg-6 NO_inputs_tipp_estudio_2">
              <label class="col-form-label title-busq">CURP</label>
              <input id="ese_curp_candidato_modal_resumen_tipoestudio_2" name="ese_curp_candidato_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled " readonly placeholder="CURP" maxlength="10" minlength="1" required />
            </div>

            <div class="col-lg-4 NO_inputs_tipp_estudio_2">
              <label class="col-form-label title-busq">Fecha de nacimiento </label>
              <input id="ese_fecha_nacimiento_candidato_modal_resumen_tipoestudio_2" name="ese_fecha_nacimiento_candidato_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled " readonly placeholder="Fecha de nacimiento" maxlength="10" minlength="1" required />
            </div>

            <div class="col-lg-4 NO_inputs_tipp_estudio_2">
              <label class="col-form-label title-busq">Correo</label>
              <input id="ese_email_candidato_modal_resumen_tipoestudio_2" name="ese_email_candidato_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled " readonly placeholder="Correo" minlength="12" maxlength="13" required />
            </div>
            <div class="col-lg-3 NO_inputs_tipp_estudio_2">
              <label class="col-form-label title-busq">Télefono</label>
              <input id="ese_telefono_candidato_modal_resumen_tipoestudio_2" name="ese_telefono_candidato_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled " readonly placeholder="Teléfono" minlength="12" maxlength="13" required />

            </div>
            <div class="col-lg-3 NO_inputs_tipp_estudio_2">
              <label class="col-form-label title-busq">Celular</label>
              <input id="ese_celular_candidato_modal_resumen_tipoestudio_2" name="ese_celular_candidato_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled " readonly placeholder="Celular" minlength="12" maxlength="13" required oninput="handleInput(event)"/>

            </div>

            <div class="col-12 col-lg-9 NO_inputs_tipp_estudio_2" >
              <label class="col-form-label title-busq">Calle</label>
              <input id="ese_calle_direccion_candidato_modal_resumen_tipoestudio_2" name="ese_direccion_candidato_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled " readonly placeholder="Calle" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
            </div>
            <div class="col-12 col-lg-6 NO_inputs_tipp_estudio_2" >
              <label class="col-form-label title-busq">No. interno</label>
              <input id="ese_no_int_direccion_candidato_modal_resumen_tipoestudio_2" name="ese_direccion_candidato_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled " readonly placeholder="No. interno" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
            </div>
            <div class="col-12 col-lg-6 NO_inputs_tipp_estudio_2" >
              <label class="col-form-label title-busq">No. externo</label>
              <input id="ese_no_ext_direccion_candidato_modal_resumen_tipoestudio_2" name="ese_direccion_candidato_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled " readonly placeholder="No. externo" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
            </div>
            <div class="col-12 col-lg-12 NO_inputs_tipp_estudio_2" >
              <label class="col-form-label title-busq">Colonia</label>
              <input id="ese_colonia_direccion_candidato_modal_resumen_tipoestudio_2" name="ese_direccion_candidato_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled " readonly placeholder="No. externo" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-12 NO_inputs_tipp_estudio_2" >
                <label class="col-form-label title-busq">Dirección</label>
                <input id="ese_direccion_candidato_modal_resumen_tipoestudio_2" name="ese_direccion_candidato_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled " readonly placeholder="Dirección" minlength="12" maxlength="13" required oninput="handleInput(event)"/>

            </div>

            <div class="col-lg-3 NO_inputs_tipp_estudio_2" >
              <label class="col-form-label title-busq">Código postal</label>
              <input id="ese_cp_candidato_modal_resumen_tipoestudio_2" name="ese_cp_candidato_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled " readonly placeholder="C.P" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4" >
              <label class="col-form-label title-busq">Estado</label>
              <input id="ese_estado_candidato_modal_resumen_tipoestudio_2" name="ese_estado_candidato_modal_resumen_tipoestudio_2 " type="text" class="form-control input-disabled" readonly placeholder="Estado" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-5" >
              <label class="col-form-label title-busq">Municipio</label>
              <input id="ese_municipio_candidato_modal_resumen_tipoestudio_2" name="ese_municipio_candidato_modal_resumen_tipoestudio_2 " type="text" class="form-control input-disabled" readonly placeholder="Estado" minlength="12" maxlength="13" required oninput="handleInput(event)"/>

            </div>
            
           
            </div>

            <h6 class="seccion_estatus_2" id="exampleModalLabel">Investigador <i class="mdi mdi-worker mdi-18px btn-icon"></i> </h6>

            <div class="form-group row seccion_estatus_2">
  
                    
            <div class="col-lg-5">
              <label class="col-form-label title-busq">Nombre investigador</label>
              <input id="ese_nombre_inv_modal_resumen_tipoestudio_2" name="ese_nombre_inv_modal_resumen_tipoestudio_2" type="text"  class="form-control input-disabled" readonly placeholder="Nombre del investigador" required oninput="handleInput(event)"/>
            </div>
           
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Fecha de asignación</label>
              <input id="ese_asig_inv_modal_resumen_tipoestudio_2" name="ese_asig_inv_modal_resumen_tipoestudio_2" type="text"  class="form-control input-disabled" readonly placeholder="Fecha de asignación" maxlength="10" minlength="1" required oninput="handleInput(event)"/>
            </div>

            <div class="col-lg-4">
              <label class="col-form-label title-busq">Fecha de entrega</label>
              <input id="ese_entrega_inv_modal_resumen_tipoestudio_2" name="ese_entrega_inv_modal_resumen_tipoestudio_2" type="text"  class="form-control input-disabled" readonly placeholder="Fecha de entrega" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
            </div>
            
          

        
            


          
            
           
            </div>

            <div class="seccion_estatus_2" id="seccion_visitas_modal_resumen">

                <h6 class="" id="exampleModalLabel">Número de visitas realizadas<i class="mdi mdi-home mdi-18px btn-icon"></i></h6>

                <div class="form-group row pb-5 border-bottom" id="">
      
                      <div class="col-lg-5">
                        <label class="col-form-label title-busq">Número de visitas</label>
                        <input id="ese_visita_modal_resumen_tipoestudio_2" name="ese_visita_modal_resumen_tipoestudio_2" type="number"  class="form-control input-disabled" readonly placeholder="Número de visitas" required />
                      </div>
                    
                      <div class="col-lg-3">
                        <label class="col-form-label title-busq">Honorario calculado</label>
                        <input id="ese_honorario_modal_resumen_tipoestudio_2" name="ese_honorario_modal_resumen_tipoestudio_2" type="number" class="form-control input-disabled" readonly placeholder="Honorario calculado " minlength="1" required />
                      </div>
              
              
                
              
                </div>
            </div>


            <div  class="form-group row pb-5 border-bottom" id="seccion_transporte_modal_resumen_tipoestudio_2">
                <div class="col-lg-12 d-flex justify-content-between">
                  <h6 class="" id="exampleModalLabel">Transporte del investigador <i class="mdi mdi-car-back mdi-18px btn-icon"></i></h6>
                  <h6 class=" pl-1" id="exampleModalLabel">   Estatus  del transporte No <span id="tra_id_visualizar"> </span>:   <span class="ml-2" id="badge_estatus_transporte"></span></h6>

                </div>
     

                <div id="seccion_asignar_transporte" class="row col-12">
                  <div class="col-lg-6" >
                    <label class="col-form-label title-busq " >Quien asigno  el transporte <i class="mdi mdi-hand-okay mdi-18px btn-icon"></i></label>
                    <input id="ese_asigno_usu_transporte_modal_resumen_tipoestudio_2" name="ese_asigno_usu_transporte_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Nombre de usuario que asignó el transporte" required />
                  </div>
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Fecha de asignación de transporte <i class="mdi mdi-car-back mdi-18px btn-icon"></i> </label>
                    <input id="ese_asigno_fecha_transporte_modal_resumen_tipoestudio_2" name="ese_asigno_fecha_transporte_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Fecha asignación" required />
                  </div>
            
                </div>
            
                <div id="seccion_aprobar_transporte" class="row col-12">
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Quien aprobó el transporte <i class="mdi mdi-check-bold mdi-18px btn-icon"></i> </label>
                    <input id="ese_aprobo_usu_transporte_modal_resumen_tipoestudio_2" name="ese_aprobo_usu_transporte_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Nombre de usuario que aprobó el transporte" required />
                  </div>
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq mt-1">Fecha de aprobación de transporte  <i class="mdi mdi-check-bold mdi-18px btn-icon"></i> </label>
                    <input id="ese_aprobo_fecha_transporte_modal_resumen_tipoestudio_2" name="ese_aprobo_fecha_transporte_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Fecha aprobación" required />
                  </div>
                </div>
      
           
                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Comentario</label>s
                  <textarea id="ese_comentario_transporte_modal_resumen_tipoestudio_2" name="ese_comentario_transporte_modal_resumen_tipoestudio_2" type="text" class="form-control-textarea input-disabled"   rows="4"  rows="2" readonly  placeholder="Comentario" maxlength="" minlength="1"  style="height:8rem ;">
                  </textarea>
                </div>
                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Comentario de administración</label>
                  <textarea id="ese_comentario_admin_transporte_modal_resumen_tipoestudio_2" name="ese_comentario_admin_transporte_modal_resumen_tipoestudio_2" type="text" class="form-control-textarea input-disabled"   rows="4" readonly  placeholder="Comentario administración" maxlength="" minlength="1" style="height:8rem ;" >
                  </textarea>
                </div>

                <div class="col-lg-4" id="seccion_monto_preaprobado_transporte">
                  <label class="col-form-label title-busq">Monto preaprobado</label>
                  <input id="ese_monto_preaprobado_transporte_modal_resumen_tipoestudio_2" name="ese_monto_preaprobado_transporte_modal_resumen_tipoestudio_2" type="text" class="form-control-textarea input-disabled" readonly  placeholder="Monto solicitado" maxlength="10" minlength="1" required oninput="handleInput(event)"/>
                </div>
                <div class="col-lg-4" id="seccion_monto_solicitado_transporte">
                  <label class="col-form-label title-busq">Monto solicitado</label>
                  <input id="ese_monto_solicitado_transporte_modal_resumen_tipoestudio_2" name="ese_monto_solicitado_transporte_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly  placeholder="Monto solicitado" maxlength="10" minlength="1" required oninput="handleInput(event)"/>
                </div>
                <div class="col-lg-4" id="seccion_monto_aprobado_transporte">
                  <label class="col-form-label title-busq">Monto aprobado</label>
                  <input id="ese_aprobo_monto_transporte_modal_resumen_tipoestudio_2" name="ese_aprobo_monto_transporte_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly  placeholder="Monto aprobado" maxlength="10" minlength="1" required oninput="handleInput(event)"/>
                </div>

            
  
                <div class="col-lg-5">
                  <label class="col-form-label title-busq">Origen</label>
                  <input id="ese_origen_transporte_modal_resumen_tipoestudio_2" name="ese_origen_transporte_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly  placeholder="Origen" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
                </div>
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Destino</label>
                  <input id="ese_destino_transporte_modal_resumen_tipoestudio_2" name="ese_destino_transporte_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly  placeholder="Destino" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
                </div>

                  <div class="col-lg-3 d-flex justify-content-e align-items-end" id="aqui_boton_archivos_transporte">

                  </div>


          
            
           
            </div>


            <h6 class="seccion_estatus_5" id="exampleModalLabel">Analista <i class="mdi mdi-tie mdi-18px btn-icon"></i></h6>

            <div class="seccion_estatus_5 form-group row pb-5 border-bottom">
  

            <div class="col-lg-5">
              <label class="col-form-label title-busq">Nombre analista</label>
              <input id="ese_analista_nombre_modal_resumen_tipoestudio_2" name="ese_analista_nombre_modal_resumen_tipoestudio_2" type="text"  class="form-control input-disabled" readonly placeholder="Nombre del analista" required oninput="handleInput(event)"/>
            </div>
           
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Fecha de asignación</label>
              <input id="ese_analista_fecha_asig_modal_resumen_tipoestudio_2" name="ese_analista_fecha_entrega_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Fecha de asignación" maxlength="10" minlength="1" required oninput="handleInput(event)"/>
            </div>

            <div class="col-lg-4">
              <label class="col-form-label title-busq">Fecha de entrega</label>
              <input id="ese_analista_fecha_entrega_modal_resumen_tipoestudio_2" name="ese_analista_fecha_entrega_modal_resumen_tipoestudio_2" type="text"  class="form-control input-disabled" readonly  placeholder="Fecha de entrega" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
            </div>

          
            
           
            </div>



            

            <div class="form-group row pb-5 border-bottom" id="seccion_validacion_modal_resumen_tipoestudio_2">
  
            <div class="col-lg-12">
              <h6 class="" id="exampleModalLabel">Validación <i class="mdi mdi-check-bold mdi-18px btn-icon"></i> </h6>

            </div>

            <div class="col-lg-6">
              <label class="col-form-label title-busq">Nombre del que valido</label>
              <input id="ese_validacion_usuario_valido_entrega_modal_resumen_tipoestudio_2" name="ese_validacion_usuario_valido_entrega_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Nombre" required oninput="handleInput(event)"/>
            </div>
           
            <div class="col-lg-6">
              <label class="col-form-label title-busq">Fecha de  validación</label>
              <input id="ese_validacion_fecha_entrega_modal_resumen_tipoestudio_2" name="ese_validacion_fecha_entrega_modal_resumen_tipoestudio_2" type="text"  class="form-control input-disabled" readonly placeholder="Fecha" maxlength="10" minlength="1" required oninput="handleInput(event)"/>
            </div>


  
            
           
            </div>

            <h6 class="" id="exampleModalLabel">Comentarios <i class="mdi mdi-comment-text mdi-18px btn-icon"></i></h6>

                <div class="form-group row pb-5 border-bottom">

                  <div class="mt-1 col-12" id="comentariolistadoesedetalles">
                  
                  </div>
                
              
                </div>


            

            <h6 class="" id="exampleModalLabel">Datos de la empresa <i class="mdi mdi-office-building mdi-18px btn-icon"></i></h6>


            <div class="form-group row pb-5  border-bottom">
  
            
  
              <div class="col-lg-6">
                <label class="col-form-label title-busq">Nombre de la empresa</label>
                <input id="ese_empresa_nombre_modal_resumen_tipoestudio_2" name="ese_empresa_nombre_modal_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Nombre de la empresa" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-6">
                <label class="col-form-label title-busq">Centro de costo</label>
                <input id="ese_empresa_centro_costos_modal_resumen_tipoestudio_2" name="ese_empresa_centro_costos_modal_resumen_tipoestudio_2" type="text"class="form-control input-disabled" readonly placeholder="Nombre del centro de costos" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-4">
                <label class="col-form-label title-busq">RFC</label>
                <input id="ese_empresa_rfc_modal_resumen_tipoestudio_2" name="ese_empresa_rfc_modal_resumen_tipoestudio_2" type="text"class="form-control input-disabled" readonly placeholder="RFC" required oninput="handleInput(event)"/>
              </div>
             
              
              <div class="col-lg-5">
                <label class="col-form-label title-busq">Contacto de la empresa</label>
                <input id="ese_empresa_contacto_resumen_tipoestudio_2" name="ese_empresa_contacto_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Nombre del contacto" required oninput="handleInput(event)"/>
              </div>
             

              
             
            </div>

            


            <div class="form-group row pb-5  border-bottom" id="seccion_cancelacion_modal_resumen_tipoestudio_2">
              <div class="col-lg-12">
                <h6 class="" id="exampleModalLabel">Cancelación <i class="mdi mdi-cancel mdi-18px btn-icon"></i></h6>

              </div>

              
  
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Nombre de quien cancelo</label>
                <input id="ese_usuario_cancelo_resumen_tipoestudio_2" name="ese_usuario_cancelo_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Nombre completo" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Fecha de cancelación</label>
                <input id="ese_usuario_cancelo_fecha_resumen_tipoestudio_2" name="ese_usuario_cancelo_fecha_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Fecha dec cancelación" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Estatus en que se encontraba el estudio</label>
                <input id="ese_usuario_cancelo_estatus_resumen_tipoestudio_2" name="ese_usuario_cancelo_estatus_resumen_tipoestudio_2" type="text" class="form-control input-disabled" readonly placeholder="Estatus" required oninput="handleInput(event)"/>
              </div>
             
              
            

              
             
            </div>


          </form>      



        
        </div>
      </div>
    </div>
  </div>
