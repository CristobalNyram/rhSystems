<script>
  $(document).ready(function() {
            $('body').on('click', '.emp-vac-funtion-get-info', function() {
                $("#emp_vac_info-modal").modal("show");
                $(".text_input-emp_vac_info").empty();
                let emp_id = $(this).data('emp-id');
                let url_enviar="";
                ///GET DATOS AJAX INI
                 url_enviar="<?php echo $this->url->get('empresa/ajax_get_detalle_completo/') ?>";
                $.ajax({
                    type: "POST",
                    url: url_enviar+emp_id,              
                    success: function(res)
                    {
                      if(res.estado=="2"){
                        let data_emp=res.data_emp;
                        let data_emp_logo=res.data_emp_logo;

                        $("#emp_alias-emp_vac_info").text(data_emp.emp_alias);
                        $("#emp_rfc-emp_vac_info").text(data_emp.emp_rfc);
                        $("#emp_id-emp_vac_info").text(`Folio: ${data_emp.emp_id}`);
                        $("#emp_nombre-emp_vac_info").text(data_emp.emp_nombre);
                        $("#neg_nombre-emp_vac_info").text(data_emp.neg_nombre);
                        $("#vac_alta_count-emp_vac_info").text(res.vac_alta_count);
                        $("#fat_vac_normal_count-emp_vac_info").text(res.fat_vac_normal_count);
                        $("#fat_vac_gar_count-emp_vac_info").text(res.fat_vac_gar_count);

                        let archivoURL = '';
                        archivoURL = "<?php echo $this->url->get() ?>"+'images/logoempresa/' + encodeURIComponent(data_emp_logo);


                        if (data_emp.emp_logo=="iniciador.jpg") {
                           $("#emp_logo-emp_vac_info").attr('alt','IMAGEN POR DEFECTO PARA LA EMPRESA '+data_emp.emp_alias);
                           $("#emp_logo-emp_vac_info").attr('title','IMAGEN POR DEFECTO PARA LA EMPRESA '+data_emp.emp_alias);


                        }else{
                           $("#emp_logo-emp_vac_info").attr('alt','IMAGEN DE LA EMPRESA '+data_emp.emp_alias);
                           $("#emp_logo-emp_vac_info").attr('title','IMAGEN DE LA EMPRESA '+data_emp.emp_alias);
                        }
                        $("#emp_logo-emp_vac_info").attr('src',archivoURL);

                        //UBICACION INI
                        let ubicacion = "";
                        let primeraParteUbicacion = false; // Variable para controlar si se ha agregado algo a la ubicación

                        if (data_emp.est_nombre && $.trim(data_emp.est_nombre) !== "") {
                            if (primeraParteUbicacion) {
                                ubicacion += ", ";
                            }
                            ubicacion += "Estado: " + data_emp.est_nombre;
                            primeraParteUbicacion = true;
                        }

                        if (data_emp.mun_nombre && $.trim(data_emp.mun_nombre) !== "") {
                            if (primeraParteUbicacion) {
                                ubicacion += ", ";
                            }
                            ubicacion += "Municipio: " + data_emp.mun_nombre;
                        }

                        if (ubicacion !== "") {
                            $("#emp_ubicacion-emp_vac_info").text(ubicacion);
                        } else {
                            // Si la ubicación está vacía, establece un mensaje predeterminado
                            $("#emp_ubicacion-emp_vac_info").text("Ubicación no disponible");
                        }

                        //UBICACION FIN

                        //DIRECION INI
                        let direccion = "";
                        let primeraParte = false; // Variable para controlar si se ha agregado algo a la dirección

                        if (data_emp.emp_calle && $.trim(data_emp.emp_calle) !== "") {
                            if (primeraParte) {
                                direccion += ", ";
                            }
                            direccion += "Calle: " + data_emp.emp_calle;
                            primeraParte = true;
                        }

                        if (data_emp.emp_colonia && $.trim(data_emp.emp_colonia) !== "") {
                            if (primeraParte) {
                                direccion += ", ";
                            }
                            direccion += "Colonia: " + data_emp.emp_colonia;
                            primeraParte = true;
                        }

                        if (data_emp.emp_cp && $.trim(data_emp.emp_cp) !== "") {
                            if (primeraParte) {
                                direccion += ", ";
                            }
                            direccion += "Código postal: " + data_emp.emp_cp;
                        }

                        if (direccion !== "") {
                            $("#emp_direccion-emp_vac_info").text(direccion);
                        } else {
                            // Si la dirección está vacía, establece un mensaje predeterminado
                            $("#emp_direccion-emp_vac_info").text("Dirección no disponible");
                        }
                        //DIRECION FIN

                        $("#emp_registro-emp_vac_info").text(moment(data_emp.emp_registro).format('DD/MM/YYYY'));


                        $('#centro_costos_container-emp_vac_info').empty();
                        let cards_cen="";
                        if (res.data_cen.length>0) {


                            $.each(res.data_cen, function(index, centro) {
                              let cen_nombre = centro.cen_nombre.trim().length > 40 ? centro.cen_nombre.trim().substring(0, 40).trim() + '...' : centro.cen_nombre.trim();

                                let cardHtml = `
                                    <div class="col-md-4 ">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class='badge-custom-info_emp__folio'>${centro.cen_id}</div>
                                                <p class="card-text mt-1" style="margin-bottom: 0rem;">${cen_nombre}</p>
                                                <p class="card-text" style="margin-bottom: 0rem;">
                                                    <strong>Correo:</strong> <a href="mailto:${centro.cen_correo}">${centro.cen_correo}</a>
                                                </p>
                                                <p class="card-text" style="margin-bottom: 0rem;">
                                                    <strong>Clave:</strong> ${centro.cen_clave}
                                                </p>
                                                <p class="card-text" style="margin-bottom: 0rem;">
                                                    <strong>Teléfono:</strong> <a href="tel:${centro.cen_tel}">${centro.cen_tel}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>`;
                                  cards_cen+=cardHtml;

                            });
                        }
                   
                      $('#centro_costos_container-emp_vac_info').html(cards_cen);

                      $('#contactos_container-emp_vac_info').empty();
                      if (res.data_cne.length>0) {
                            $.each(res.data_cne, function(index, contacto) {
                              let  cne_nombre = contacto.cne_nombre.trim().length > 40 ? contacto.cne_nombre.trim().substring(0, 40).trim() + '...' : contacto.cne_nombre.trim();

                              let cardHtml = `
                                  <div class="col-md-4 ">
                                      <div class="card">
                                          <div class="card-body">
                                              <div class='badge-custom-info_emp__folio'>${contacto.cne_id}</div>

                                              <p class="card-text mt-1" style="margin-bottom: 0rem;">${cne_nombre}</p>
                                              <p class="card-text" style="margin-bottom: 0rem;">
                                                  <strong>Correo:</strong> <a href="mailto:${contacto.cne_correo}">${contacto.cne_correo}</a>
                                              </p>
                                            
                                          
                                              <p class="card-text" style="margin-bottom: 0rem;">
                                                  <strong>Celular:</strong> <a href="tel:${ limpiarValorBD(contacto.cne_celular)}">${limpiarValorBD(contacto.cne_celular)}</a>
                                              </p>
                                              <p class="card-text" style="margin-bottom: 0rem;">
                                                  <strong>Teléfono:</strong> <a href="tel:${limpiarValorBD(contacto.cne_tel)}">${limpiarValorBD(contacto.cne_tel)}</a>
                                              </p>
                                          </div>
                                      </div>
                                  </div>`;

                              $('#contactos_container-emp_vac_info').append(cardHtml);
                          });

                        
                      }
                     
                        //   $("#emp_alias-emp_vac_info").text(data_emp.emp_alias);

                      }
                    },
                    error: function(res)
                    {
                        alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                      
                    }
                });
                //GET DATOS AJAX FIN               
          });

  });
</script>
<style>

  .border-custom-profile{
    border: 1px solid rgba(0,0,0,.125);
    border-top-left-radius: .2rem;
    border-top-right-radius: .2rem;

  }
  .btn-close-modal-info-custom{
    background: red!important;
    color: white;
    font-size: 2rem;
  }
  .badge-custom-info_emp {
    font-size: .9rem;
    border-radius: 4rem;
    width: 300px;
    background: transparent;
    border: 1px solid #061832;
    color: black;
  } 
  
  .badge-custom-info_emp__folio {
    position: absolute;
    top: 0;
    left: 0px;
    background: #478cc4;
    border-radius: 0px 0px 20px;
    padding: .5rem;
    color: white;
  }
  @media (max-width: 767px) {
        .badge-custom-info_emp {
            width: 100%; /* Ancho del 100% para móviles */
            margin-bottom: 0.4rem;
        }
    }

</style>
<div style="z-index: 9999;" class="modal fade" id="emp_vac_info-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="text-center" id="exampleModalLabel">DATOS DE LA EMPRESA</h5>
          <button type="button" class="close btn-close-modal-info-custom" data-dismiss="modal" aria-label="Close">
            <div class="container-custom-modal-clode-btn">
              <span aria-hidden="true">&times;</span>

            </div>
          </button>
        </div>
        <div class="modal-body"> 
        <form  class="form-vertical mt-1">
          <div class="card-profile col-12 row">

            <div class="col-sm-4 col-12 card-profile_header ">
              <div class="border-custom-profile">
                <div class="profile_header__img d-flex justify-content-center mt-2">
                  <img id="emp_logo-emp_vac_info" src="" class="profile-pic" alt="IMAGEN DE EMPRESA">

                </div>
                <div class="card-profile_header__breef ">
                  <h5 class="mt-3 text-center" id="emp_alias-emp_vac_info"></h5>
                  <p class="text-center"  id="emp_id-emp_vac_info"></p>
                </div>
            
              </div>
               
            </div>

            <div class="col-sm-8 col-12 card-profile-details">
              <div>
                  <ul class="list-group ">
                      <li class="list-group-item">
                        <i class="mdi mdi-map-marker"></i>
                        <strong>NOMBRE COMPLETO:</strong>
                        <span class="tex_input-emp_vac_info" id="emp_nombre-emp_vac_info">
                        </span>
                      </li>
                      <li class="list-group-item">
                        <i class="mdi mdi-map-marker"></i>
                        <strong>RFC:</strong>
                        <span  class="tex_input-emp_vac_info" id="emp_rfc-emp_vac_info">
                        </span>
                      </li>
                      <li class="list-group-item">
                        <i class="mdi mdi-briefcase"></i>
                        <strong>Grupo de Negocio:</strong>
                        <span  class="tex_input-emp_vac_info" id="neg_nombre-emp_vac_info">
                        </span>
                      </li>
                      <li class="list-group-item">
                        <i class="mdi mdi-home"></i>
                        <strong>Dirección:</strong>
                        <span  class="tex_input-emp_vac_info" id="emp_direccion-emp_vac_info">
                        </span>
                      </li>
                      <li class="list-group-item">
                        <i class="mdi mdi-home"></i>
                        <strong>Ubicación:</strong>
                        <span  class="tex_input-emp_vac_info" id="emp_ubicacion-emp_vac_info">
                        </span>
                      </li>
                      <li class="list-group-item">
                        <i class="mdi mdi-calendar"></i>
                        <strong>Fecha de registro:</strong> 
                        <span  class="tex_input-emp_vac_info" id="emp_registro-emp_vac_info">
                        </span>
                      </li>
                      <li class="list-group-item">
                        <i class="mdi mdi-calendar-clock"></i>
                        <strong>Fecha de última solicitud:</strong>
                        <span  class="tex_input-emp_vac_info" id="emp_ultima_vac_alta-emp_vac_info">
                        </span>
                      </li>

                  </ul>

              </div>

            </div>
            <div class="card-profile_body col-12">
              <div class="col-sm-12 col-12 card-profile-details border-custom-profile">
                <div>
                   <h6>Contactos</h6>
                   <div  class="tex_input-emp_vac_info col-12 row" id="contactos_container-emp_vac_info"></div>
                </div>
              </div>
              <div class="col-sm-12 col-12 card-profile-details border-custom-profile">
                <div>
                   <h6>Centros de costos</h6>
                   <div  class="tex_input-emp_vac_info col-12 row" id="centro_costos_container-emp_vac_info"></div>
                </div>
  
              </div>
              <div class="col-sm-12 col-12 card-profile-details border-custom-profile">
                <div>
                   <h6>Info extra</h6>
             
                  
                   <div class="text-center mb-2"> <!-- Div para centrar solo los badges -->
                    <span class="badge badge-primary p-3 badge-custom-info_emp">
                      <i class="mdi mdi-check-circle"></i> Vacantes alta:
                     
                      <span class="badge-custom-info_emp-count tex_input-emp_vac_info" id="vac_alta_count-emp_vac_info">

                      </span>
                    </span>
                    <span class="badge badge-secondary p-3 badge-custom-info_emp">
                      <i class="mdi mdi-file-document"></i> Expedientes facturados normal:
                      <span class="badge-custom-info_emp-count tex_input-emp_vac_info" id="fat_vac_normal_count-emp_vac_info"></span>
                    </span>
                    <span class="badge badge-success p-3 badge-custom-info_emp">
                      <i class="mdi mdi-file-check"></i> Expedientes facturados garantía:
                      <span class="badge-custom-info_emp-count tex_input-emp_vac_info" id="fat_vac_gar_count-emp_vac_info"></span>
                    </span>

                  
                   </div>

                </div>
  
              </div>

            </div>

       

        </div>
        </div>

        


   
            </div>
              
        </div>
       
      </div>
    </div>
            
  </div>