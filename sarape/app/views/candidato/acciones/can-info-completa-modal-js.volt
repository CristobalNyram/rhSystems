<script>
  

    $(document).ready(function() {
              $('body').on('click', '.candidato-funtion-get-info', function() {
                  $("#cand_completa_info-modal").modal("show");
                  $(".text_input-cand_completa_info").empty();
                  let can_id = $(this).data('can-id');
                  let url_enviar="";
                  ///GET DATOS AJAX INI
                  url_enviar="<?php echo $this->url->get('candidato/ajax_get_detalle_completo/') ?>";
                  $.ajax({
                      type: "POST",
                      url: url_enviar+can_id,              
                      success: function(res)
                      {

                            if(res.estado!='2'){
                                swalalert('AVISO','No hay información respecto al candidato con folio '+can_id, "info", 0); 
                                return false;
                            }
                            let data_can=res.data_can;
                            let data_exc=res.data_can_exc;
                            let data_vac=res.data_can_vac;
                            let metricas=res.metricas;
                            $("#can_nombre-cand_completa_info").text(data_can.can_nombre);
                            $("#can_correo-cand_completa_info").text(data_can.can_correo);
                            $("#can_id-cand_completa_info").text('Folio: '+data_can.can_id);
                            $("#can_curp-cand_completa_info").text(data_can.can_curp);
                            $("#can_registro-cand_completa_info").text(data_can.can_registro);
                            $("#can_telefono-cand_completa_info").text(data_can.can_telefono);
                            $("#can_usu_alta_nombre-cand_completa_info").text(data_can.can_usu_alta_nombre);
                            $("#can_celular-cand_completa_info").text(data_can.can_celular);
                            $("#can_validado_badge-cand_completa_info").html(generateBadgeExcEstatusValidoHTML(data_can.can_valido));
                            $("#exc_cancelados-cand_completa_info").text(metricas.exc_cancelados);
                            $("#exc_facturados_garantia-cand_completa_info").text(metricas.exc_facturados_garantia);
                            $("#exc_facturados_normal-cand_completa_info").text(metricas.exc_facturados_normal);
                            $("#exc_proceso-cand_completa_info").text(metricas.exc_proceso);
                            //EXPEDIENTES INI-----------------------------------------------------------------------INICIO
                            $('#expedientes_container-cand_completa_info').empty();
                                if (data_exc.length>0) {
                                        $.each(data_exc, function(index, expediente) {

                                            let encript_id="";
                                            fnDesEncriptId(expediente.exc_id) // El número 123 es solo un ejemplo, puedes pasar el ID que necesites
                                            .then(resultado => {
                                            
                                            encript_id=resultado;
                                            let exc_actualizo=moment(expediente.exc_actualizo).format('DD/MM/YYYY');
                                            let exc_registro=moment(expediente.exc_registro).format('DD/MM/YYYY');
                                            let badgeEstatus_expediente=generateBadgeExcEstatusHTML(expediente.exc_estatus);
                                            let cardHtml = `
                                                    <div class="col-md-4 ">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class='badge-custom-info_emp__folio' title="FOLIO de expediente: ${expediente.exc_id}" >${expediente.exc_id}</div>
                                                                <p class="card-text mt-1" style="margin-bottom: 0rem;">Alta: ${exc_registro}</p>
                                                                <p class="card-text mt-1" style="margin-bottom: 0rem;">Actualización: ${exc_actualizo}</p>
                                                                <p class="card-text mt-1" style="margin-bottom: 0rem;">Calificación citas: 1</p>
                                                                <p class="card-text mt-1" style="margin-bottom: 0rem;">Calificación referencias: 1 </p>

                                                                <div class="row mt-1">
                                                                    <a data-target="#resumen_exc-modal" onclick="fnGetResumeExcIncio('${expediente.exc_id}')" data-toggle="modal" title="Resumen" type="button" class="btn-info-can-card m-1" data-container="body" data-toggle="popover" role="button">
                                                                        <i class="mdi mdi-file-presentation-box  mdi-18px btn-icon text-white" ></i>
                                                                    </a>
                                                                    <a data-target="#comentarioexc-modal" onclick="comentarioexc('${expediente.exc_id}')" data-toggle="modal" title="Comentarios del expediente" type="button" class="btn-info-can-card m-1"  data-container="body" data-toggle="popover" role="button">
                                                                        <i class="mdi mdi-comment-processing  mdi-18px btn-icon text-white" ></i>
                                                                    </a>
                                                                    <a data-toggle="modal" title="Ver archivos de vacante" data-target="#archivos-modal" onclick="fnCargarTablaArchivo('${expediente.exc_id}','general')" type="button" class="btn-info-can-card m-1" data-container="body" data-toggle="popover" role="button">
                                                                        <i class="mdi mdi-folder-open-outline mdi-18px btn-icon text-white"></i>
                                                                    </a>
                                                                </div>
                                                                <p class="card-text mt-1 container-card-badge-can_info" style="margin-bottom: 0rem;">${badgeEstatus_expediente}</p>
                                                            </div>
                                                        </div>
                                                    </div>`;

                                                $('#expedientes_container-cand_completa_info').append(cardHtml);
                                                       
                                            })
                                            .catch(error => {
                                            alert("ERROR ENCRIPT CAN");
                                            });

                                          
                                    });

                                }
                            //EXPEDIENTES FIN-----------------------------------------------------------------------FIN

                            //VACANTES INI-----------------------------------------------------------------------INICIO
                            $('#vacante_container-cand_completa_info').empty();
                                if (data_vac.length>0) {
                                        $.each(data_vac, function(index, vacante) {
                                        let url_reporte_rq_can = "<?php echo $this->url->get('reporte/reporte_requision_personal/') ?>";

                                        let encript_id="";
                                        fnDesEncriptId(vacante.vac_id) // El número 123 es solo un ejemplo, puedes pasar el ID que necesites
                                        .then(resultado => {  
                                        encript_id=resultado;
                                        url_reporte_rq_can+=encript_id;
                                        let vac_actualizacion=moment(vacante.vac_actualizacion).format('DD/MM/YYYY');
                                        let vac_fecharegistro=moment(vacante.vac_fecharegistro).format('DD/MM/YYYY');
                                        let emp_nombre = vacante.emp_nombre.trim();
                                        emp_nombre = emp_nombre.length > 25 ? emp_nombre.substring(0, 25).trim() + '...' : emp_nombre;
                                        let cav_nombre = vacante.cav_nombre !== null ? vacante.cav_nombre.trim() : "---------";
                                        if (cav_nombre !== null) {
                                            cav_nombre = cav_nombre.length > 25 ? cav_nombre.substring(0, 25).trim() + '...' : cav_nombre;
                                        }

                                        let cardHtml = `
                                            <div class="col-md-4 ">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class='badge-custom-info_emp__folio'  title="FOLIO de vacante: ${vacante.vac_id}">${vacante.vac_id}</div>
                                                        <p class="card-text mt-1" style="margin-bottom: 0rem;">${emp_nombre}</p>
                                                        <p class="card-text mt-1" style="margin-bottom: 0rem;">${cav_nombre}</p>
                                                        <p class="card-text mt-1" style="margin-bottom: 0rem;">Alta: ${vac_fecharegistro}</p>
                                                        <p class="card-text mt-1" style="margin-bottom: 0rem;">Actualización: ${vac_actualizacion}</p>
                                                        <div class="row mt-1">
                                                            <a  data-target="#archivos_vac-modal" onclick="fnCargarTablaArchivoVac('${vacante.vac_id}','general')"  data-toggle="modal" title="Ver archivos de vacante" type="button" class="btn-info-can-card m-1" data-container="body" data-toggle="popover" role="button">
                                                                <i class="mdi mdi-folder-open-outline mdi-18px btn-icon text-white"></i>
                                                            </a>

                                                            <a data-toggle="modal" title="REPORTE REQ. PERSONAL" type="button" class="btn-info-can-card m-1"  onclick="window.open('${url_reporte_rq_can}', '_blank')" target="_blanck" data-container="body" data-toggle="popover" role="button">
                                                                <i class="mdi mdi-pdf-box  mdi-18px btn-icon text-white" ></i>
                                                            </a>
                                                            
                                                        </div>
                                                        <p class="card-text mt-1 container-card-badge-can_info" style="margin-bottom: 0rem;">${generateBadgeVacEstatusHTML(vacante.vac_estatus)}</p>
                                                    </div>
                                                </div>
                                            </div>`;
                                        $('#vacante_container-cand_completa_info').append(cardHtml); 
                                                       
                                        })
                                        .catch(error => {
                                        //alert("ERROR ENCRIPT CAN");
                                        console.log(error);
                                        });   
                                    
                                    });
                                }
                            //VACANTES FIN-----------------------------------------------------------------------FIN
                      },
                      error: function(res)
                      {
                          alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                      }
                  });
               
            });
           
    });
  </script>
  <style>
    .badge-estatus-can{
      font-size: .8rem;
      padding: .2rem 1rem .2rem 1rem;
    }
    .btn-info-can-card{
        background: #478cc4;
        padding: 0.2rem;
        border-radius: 17px;
        color: white!important;
    }   

    .container-card-badge-can_info .badge{
        position: absolute;
        bottom: 0px;
        right: 0px;
        font-size: .5rem;
        width: 100%;
        border-radius: 0px 0px .4px .4px;
        padding-top: .2rem;
    }
  
  </style>
<div class="modal fade" id="cand_completa_info-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="text-center" id="exampleModalLabel">DATOS DEL CANDIDATO</h5>
              <button type="button" class="close btn-close-modal-info-custom" data-dismiss="modal" aria-label="Close">
                  <div class="container-custom-modal-clode-btn">
                      <span aria-hidden="true">&times;</span>
                  </div>
              </button>
          </div>
          <div class="modal-body">
              <div class="card-profile col-12 row">
                <div class="card-profile col-12 row">
                  <div class="card-profile_body col-12">
                      <div class="row">
                          <div class="col-12">
                              <div class="list-group col-12">
                                  <div class="list-group-item">
                                      <i class="mdi mdi-account-circle"></i>
                                      <span class="tex_input-cand_completa_info" id="can_id-cand_completa_info"></span>
                                  </div>
                                  <div class="list-group-item">
                                      <div class="d-flex flex-row justify-content-between align-items-center">
                                          <div>
                                              <i class="mdi mdi-account-circle"></i>
                                              <strong>NOMBRE COMPLETO:</strong>
                                              <span class="tex_input-cand_completa_info" id="can_nombre-cand_completa_info"></span>
                                          </div>
                                          <div>
                                              <i class="mdi mdi-account-circle"></i>
                                              <strong>ESTATUS DE VALIDADO</strong>
                                              <span class="tex_input-cand_completa_info" id="can_validado_badge-cand_completa_info"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="list-group-item">
                                      <div class="d-flex flex-row justify-content-between align-items-center">
                                          <div>
                                              <i class="mdi mdi-card-account-details"></i>
                                              <strong>CURP:</strong>
                                              <span class="tex_input-cand_completa_info" id="can_curp-cand_completa_info"></span>
                                          </div>
                                          <div>
                                              <i class="mdi mdi-account-card-details"></i>
                                              <strong>No. seguro social:</strong>
                                              <span class="tex_input-cand_completa_info" id="can_nosegsocial-cand_completa_info"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="list-group-item">
                                      <div class="d-flex flex-row justify-content-between align-items-center">
                                          <div>
                                              <i class="mdi mdi-email"></i>
                                              <strong>Correo:</strong>
                                              <span class="tex_input-cand_completa_info" id="can_correo-cand_completa_info"></span>
                                          </div>
                                          <div>
                                              <i class="mdi mdi-phone"></i>
                                              <strong>Tel:</strong>
                                              <span class="tex_input-cand_completa_info" id="can_telefono-cand_completa_info"></span>
                                          </div>
                                          <div>
                                              <i class="mdi mdi-cellphone"></i>
                                              <strong>Celular:</strong>
                                              <span class="tex_input-cand_completa_info" id="can_celular-cand_completa_info"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="list-group-item">
                                      <div class="d-flex flex-row justify-content-between align-items-center">
                                          <div>
                                              <i class="mdi mdi-account"></i>
                                              <strong>Usuario alta:</strong>
                                              <span class="tex_input-cand_completa_info" id="can_usu_alta_nombre-cand_completa_info"></span>
                                          </div>
                                          <div>
                                              <i class="mdi mdi-calendar"></i>
                                              <strong>Fecha de registro:</strong>
                                              <span class="tex_input-cand_completa_info" id="can_registro-cand_completa_info"></span>
                                          </div>
                                          <div>
                                              <i class="mdi mdi-calendar"></i>
                                              <strong>Fecha de actualización:</strong>
                                              <span class="tex_input-cand_completa_info" id="can_regisstro-cand_completa_info"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="card-profile_body col-12">
                      <div class="col-sm-12 col-12 card-profile-details border-custom-profile">
                          <div>
                              <h6>Expedientes relacionados</h6>
                              <div class="tex_input-cand_completa_info col-12 row" id="expedientes_container-cand_completa_info"></div>
                          </div>
                      </div>
                      <div class="col-sm-12 col-12 card-profile-details border-custom-profile">
                          <div>
                              <h6>Vacantes relacionadas</h6>
                              <div class="tex_input-cand_completa_info col-12 row" id="vacante_container-cand_completa_info"></div>
                          </div>
                      </div>
                      <div class="col-sm-12 col-12 card-profile-details border-custom-profile">
                          <div>
                              <h6>Resumen</h6>
                              <div class="text-center mb-2">
                                  <span class="badge badge-primary p-3 badge-custom-info_emp">
                                      <i class="mdi mdi-cancel"></i>
                                       Expedientes no aceptados:
                                       <br>
                                      <span class="badge-custom-info_emp-count tex_input-cand_completa_info" id="exc_cancelados-cand_completa_info"></span>
                                  </span>
                              
                                  <span class="badge badge-success p-3 badge-custom-info_emp">
                                      <i class="mdi mdi-walk"></i> 
                                      Expedientes en proceso:
                                      <br>
                                      <span class="badge-custom-info_emp-count tex_input-cand_completa_info" id="exc_proceso-cand_completa_info"></span>
                                  </span>
                                  <span class="badge badge-secondary p-3 badge-custom-info_emp">
                                    <i class="mdi mdi-check-circle"></i>
                                     Expedientes facturados en garantía:
                                     <br>
                                    <span class="badge-custom-info_emp-count tex_input-cand_completa_info" id="exc_facturados_normal-cand_completa_info"></span>
                                 </span>
                                 <span class="badge badge-secondary p-3 mt-2 badge-custom-info_emp">
                                    <i class="mdi mdi-check-circle"></i>
                                    Expedientes facturados normal:
                                    <br>

                                    <span class="badge-custom-info_emp-count tex_input-cand_completa_info" id="exc_facturados_garantia-cand_completa_info"></span>
                                 </span>
                                  <hr>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
