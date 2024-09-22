{# HELPERS INICIO -----------------------------HELPERS INICIO #}
{% include "/municipio/script-ajax-todos.volt" %}
{% include "/estado/script-ajax-todos.volt" %}
{# HELPERS FIN --------------------------------HELPER FIN #}


<script type="text/javascript">
  function fneditcentro(id,nombre)
  {
    var urlfned="<?php echo $this->url->get('centrocosto/buseditar/') ?>";
    $("#msae").html("Editar "+nombre); 
    $.ajax(
    {
      type: "POST",
      url: urlfned+id,
      success: function(res)
      {
        $("#cen_ideditar").val(res[1]);
        $("#cen_nombreeditar").val(res[2]);
        $("#cen_claveeditar").val(res[3]);
        $("#cen_correoeditar").val(res[4]);
        $("#cen_teleditar").val(res[5]);
      }
    });
  }

  function centrocosto(id,empresa){
    reciboListado = document.getElementById('centrolistado');
    url="<?php echo $this->url->get('centrocosto/tabla/') ?>";
    document.getElementById("emp_idcrearcentro").value = id;
    url+=id;
    $("#empresa_centrocosto").html("Centros de costo de empresa: "+empresa);
    
    $.post(url, $(this).serialize() , function(data)
    {
        $('#centrolistado').html(data);
        // divListado.innerHTML=data;
        $('#centro').DataTable(
        {
          "pageLength": 25
        });
    }).done(function() { 
    }).fail(function() {
    })
  }

  function reloadcentro(id){
    document.getElementById("centrolistado").innerHTML="";
    // reciboListado = document.getElementById('contactolistado');
    urlreload="<?php echo $this->url->get('centrocosto/tabla/') ?>";
    urlreload+=id;
    $.post(urlreload, $(this).serialize() , function(data)
    {
        $('#centrolistado').html(data);
        // divListado.innerHTML=data;
        $('#centro').DataTable(
        {
          "pageLength": 25
        });
    }).done(function() { 
    }).fail(function() {
    })
  }

  function fneditcontacto(id,nombre)
  {
    $("#frm_editarcontacto")[0].reset();
    let urlfned="<?php echo $this->url->get('contactoemp/buseditar/') ?>";
    $("#msae").html("Editar "+nombre); 
    $.ajax(
    {
        type: "POST",
        url: urlfned+id,
        success: function(res)
        {
          $("#cne_ideditar").val(res[1]);
          $("#cne_nombreeditar").val(res[2]);
          $("#cne_primerapellidoeditar").val(res[3]);
          $("#cne_segundoapellidoeditar").val(res[4]);
          $("#cne_puestoeditar").val(res[5]);
          $("#cne_celulareditar").val(res[6]);
          $("#cne_teleditar").val(res[7]);
          $("#cne_exteditar").val(res[8]);
          $("#cne_correoeditar").val(res[9]);
          $("#cne_copiaenvioeditar").val(res[10]);
          
        }
      });
  }

  function contactos(id,empresa){
    reciboListado = document.getElementById('contactolistado');
    url="<?php echo $this->url->get('contactoemp/tabla/') ?>";
    document.getElementById("emp_idcrear").value = id;
    url+=id;
    $("#msae_recibo").html("Contactos de empresa: "+empresa);
    
    $.post(url, $(this).serialize() , function(data)
    {
        $('#contactolistado').html(data);
        // divListado.innerHTML=data;
        $('#contacto').DataTable(
        {
          "pageLength": 25
        });
    }).done(function() { 
    }).fail(function() {
    })
  }

  function reloadcontactos(id){
    document.getElementById("contactolistado").innerHTML="";
    // reciboListado = document.getElementById('contactolistado');
    urlreload="<?php echo $this->url->get('contactoemp/tabla/') ?>";
    urlreload+=id;
    $.post(urlreload, $(this).serialize() , function(data)
    {
        $('#contactolistado').html(data);
        // divListado.innerHTML=data;
        $('#contacto').DataTable(
        {
          "pageLength": 25
        });
    }).done(function() { 
    }).fail(function() {
    })
  }

  function fnNuevaEmpresa(){
    fnestados_estados_adaptable(select_est_id=-1,$select_input=$("#est_id"),select_municipios=$("#mun_id"),mun_id_cargado=0)
    fnmunicipios_adaptable($(`#mun_id`),-1,-1);

  }

  function fngruponegocio()
  {
      var negocio="<?php echo $this->url->get('negocio/ajax_negocios/') ?>";
      var $subsnegocio = $('select[name="neg_id"]');
      $subsnegocio.empty();
      $.ajax({
          type: "POST",
          url: negocio,
            
          success: function(data)
          {
              // console.log(data);
                // Agregar nuevos sub-departamentos
        if (data.length > 0) {
          $subsnegocio.append(function () {
            var options = '';
            options += '<option selected value="-1">Seleccionar</option>';
            $.each(data, function (key, dat) {
            options += '<option value="' + dat.neg_id + '">' +dat.neg_nombre+'</option>';
            });

              return options;
            });
        }else{
          $subsnegocio.append(function () {
              var options = '';
              options += '<option selected value="-1">No aplica</option>';
              return options;
          });
        }
          },
          error: function(res)
          {
              // $("#btn_aprobar").prop("disabled", false);
          }
      });

      
  }


  

    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('empresa/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            pintartabla("#td_empresa");
        }).done(function() { 
        }).fail(function() {
        })
    } );
    function fneliempresa(id_empresa,nombre_empresa,rfc_empresa)
    {
        var urleliminarempre="<?php echo $this->url->get('empresa/eliminar/') ?>";
        mensaje="¿Está seguro que desea eliminar la empresa "+nombre_empresa+" con RFC "+rfc_empresa+" ?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarempre+id_empresa,
            success: function(res)
            {

              console.log(res);
              debugger;
       
              if(res[0]==1)
              {
              alertify.alert("Éxito",res['mensaje'], function(){
                  location.reload();  
                   });

               }
             else
              {
                alertify.alert("Error",res['mensaje'] ,function(){
                  location.reload();  
                   });
              }

          
            },
            error: function(res)
             {
            alert('ERROR');
              }
          });
        }, function()
        { 
        }).set('labels', {ok:'Eliminar', cancel:'Cancelar'}); 
    }

    
  $(function (){
      $("#frm_crearcontacto").submit(function(event) 
      {
        /* Act on the event */
        var $form = $(this);
        var urlcrear="<?php echo $this->url->get('contactoemp/crear/') ?>";
        $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urlcrear,
          data: $("#frm_crearcontacto").serialize(),
          success: function(res)
          {
            if(res[0]<=0)
            {
              alertify.alert("Error",res[1]);
            }
            else
            {
              // cargarlista();
              alertify.alert("Éxito","Contacto creado correctamente.", function(){ 
                reloadcontactos(res[2]);
                $('#contactonuevo-modal').modal('hide');
                $("#frm_crearcontacto")[0].reset();

              });

            }
            $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          { 

            $form.find("button").prop("disabled", false); 
          }
        });
        return false;
      });

      $("#frm_editarcontacto").submit(function(event) 
      {
        /* Act on the event */
        var $form = $(this);
        var urled="<?php echo $this->url->get('contactoemp/editar/') ?>";
        $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urled+$("#cne_ideditar").val(),
          data: $("#frm_editarcontacto").serialize(),
          success: function(res)
          {
            if(res[0]<=0)
            {
              alertify.alert("Error",res[1]);
            }
            else
            {
              // cargarlista();
                alertify.alert("Éxito","Contacto editado correctamente.", function(){ 
                reloadcontactos(res[2]);
                $('#contactoeditar-modal').modal('hide');
              });

            }
            $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          { 

            $form.find("button").prop("disabled", false); 
          }
        });
        return false;
      });
    });

    $(function (){
      $("#frm_crearcentro").submit(function(event) 
      {
        /* Act on the event */
        var $form = $(this);
        var urlcrear="<?php echo $this->url->get('centrocosto/crear/') ?>";
        $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urlcrear,
          data: $("#frm_crearcentro").serialize(),
          success: function(res)
          {
            if(res[0]<=0)
            {
              alertify.alert("Error",res[1]);
            }
            else
            {
              // cargarlista();
              Swal.fire({title:"Éxito",text:"Centro creado correctamente.",type:"success"})
              .then((value) => {
                reloadcentro(res[2]);
                document.getElementById("frm_crearcentro").reset();
                $('#centronuevo-modal').modal('hide');
                $("#frm_crearcentro")[0].reset();

              });

            }
            $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          { 

            $form.find("button").prop("disabled", false); 
          }
        });
        return false;
      });

      $("#frm_editarcentro").submit(function(event) 
      {
        /* Act on the event */
        var $form = $(this);
        var urled="<?php echo $this->url->get('centrocosto/editar/') ?>";
        $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urled+$("#cen_ideditar").val(),
          data: $("#frm_editarcentro").serialize(),
          success: function(res)
          {
            if(res[0]<=0)
            {
              alertify.alert("Error",res[1]);
            }
            else
            {
              // cargarlista();
                alertify.alert("Éxito","Centro editado correctamente.", function(){ 
                reloadcentro(res[2]);
                $('#centroeditar-modal').modal('hide');
              });

            }
            $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          { 

            $form.find("button").prop("disabled", false); 
          }
        });
        return false;
      });
    });

    function fncambiarfoto(name,code){
      $("#emp_razonsocial").text("Cambiar imagen de "+name);
      document.getElementById("emp_id").value = code;
      // document.getElementById("usu_nombre").value = name;
    } 
</script>

<div class="row">
  <div class="col-sm-6">
    <h4 class="header-title header-title-crm">Desglose de Empresas</h4>
  </div>
  <div class="col-sm-5">
    <div class="text-right curso" style="margin-top: 35px; font-weight: 600">
      <a href="#">NUEVA EMPRESA</a>
    </div>
  </div>
  <div class="col-sm-1">
  <div class="text-left">
    {{ link_to('', 'data-target':'#Modal_empresa', "onclick":"fngruponegocio();fnNuevaEmpresa();", 'data-toggle':'modal', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'60'))  }}
    <!-- <a href="#"><img src="assets/images/small/boton.svg" class="boton-plus" height="60"></a> -->
  </div>
    </div>
</div>


<div class="mt-3">
    <div class="card card-crm">
        <div id="listado">
        </div>
    </div>
</div>




<div class="modal fade" id="mdlcambiarfoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" name='emp_razonsocial' id='emp_razonsocial'>Editar logo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ form('empresa/cambiarfoto', 'method': 'post', 'enctype': 'multipart/form-data','class' : 'form-vertical mt-1') }}
          <input type='hidden' id='emp_id' name='emp_id'>
          <div class="form-group row">
            <div class="col-lg-12">
              <label class="col-form-label title-busq">Logo nuevo</label>
              <input type='file' name='files' accept="image/png, image/jpg, image/jpeg" class="form-control input-rounded" required>
            </div>
            <div class="row col-lg-12">
              <div class="col-sm-6 col-md-6 text-center mt-5">
              </div>
              <div class="col-sm-3 col-md-3 text-center mt-5">
                  <div class="form-group">
                    <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
                  </div>
              </div>
              <div class="col-sm-3 col-md-3  text-center mt-5 ">
                  <div class="form-group">
                    <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                  </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="contactos-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5><div id="msae_recibo"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="col-2">
            <div class="text-left">
              {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50'),"data-toggle":"modal","data-target":"#contactonuevo-modal","title":"Agregar contacto") }}
            </div>
          </div>
          <div class="modal-body">
            <!-- <br /> -->
            <!-- <h2><div id="cliente_recibo"></div></h2> -->
            <!-- <h2><div id="descripcion_recibo"></div></h2> -->
            
            <div id="contactolistado">
            </div>
          </div>
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="contactonuevo-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel">Crear contacto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_crearcontacto" class="form-vertical mt-1">
          <div class="form-group row">
            <input type="hidden" id="emp_idcrear" name="emp_idcrear" />
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Nombre(s)</label>
              <input id="cne_nombre" name="cne_nombre" type="text" class="form-control input-rounded" minlength="2" placeholder="Nombre(s)" maxlength="45" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Primer apellido</label>
              <input id="cne_primerapellido" name="cne_primerapellido" type="text" class="form-control input-rounded" placeholder="Primer apellido" maxlength="45" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Segundo apellido</label>
              <input id="cne_segundoapellido" name="cne_segundoapellido" type="text" class="form-control input-rounded" placeholder="Segundo apellido"  maxlength="45" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Puesto</label>
              <input id="cne_puesto" name="cne_puesto" type="text" class="form-control input-rounded" placeholder="Puesto" maxlength="45" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Celular</label>
              <input id="cne_celular" name="cne_celular" type="text" class="form-control input-rounded" placeholder="Celular" maxlength="25" oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Teléfono</label>
              <input id="cne_tel" name="cne_tel" type="text" class="form-control input-rounded" placeholder="Teléfono"  maxlength="25" oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Extensión</label>
              <input id="cne_ext" name="cne_ext" type="text" class="form-control input-rounded" placeholder="Extensión" maxlength="20" oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Correo</label>
              <input id="cne_correo" name="cne_correo" type="email" class="form-control input-rounded" placeholder="Correo"   oninput="handleInput(event)" maxlength="90"/>
            </div>
            <div class="col-lg-9">
              <label class="col-form-label title-busq">Correos para enviar copias (separar por punto y coma ";")</label>
              <input id="cne_copiaenvio" name="cne_copiaenvio" type="text" class="form-control input-rounded" placeholder="Copias para envío de correo"  oninput="handleInput(event)" maxlength="300"/>
            </div>
            <div class="row col-lg-12">
              <div class="col-sm-6 col-md-6 text-center mt-5">
              </div>
              <div class="col-sm-3 col-md-3 text-center mt-5">
                  <div class="form-group">
                    <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
                  </div>
              </div>
              <div class="col-sm-3 col-md-3  text-center mt-5 ">
                  <div class="form-group">
                    <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                  </div>
              </div>
            </div>
          </div>
        </form>      
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="contactoeditar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel">Editar contacto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_editarcontacto" class="form-vertical mt-1">
          <div class="form-group row">
            <input type="hidden" id="cne_ideditar" name="cne_ideditar" />
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Nombre(s)</label>
              <input id="cne_nombreeditar" name="cne_nombreeditar" type="text" class="form-control input-rounded" minlength="2" placeholder="Nombre(s)"   maxlength="45" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Primer apellido</label>
              <input id="cne_primerapellidoeditar" name="cne_primerapellidoeditar" type="text" class="form-control input-rounded" placeholder="Primer apellido"  maxlength="45" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Segundo apellido</label>
              <input id="cne_segundoapellidoeditar" name="cne_segundoapellidoeditar" type="text" class="form-control input-rounded" placeholder="Segundo apellido" maxlength="45"  oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Puesto</label>
              <input id="cne_puestoeditar" name="cne_puestoeditar" type="text" class="form-control input-rounded" placeholder="Puesto" maxlength="45" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Celular</label>
              <input id="cne_celulareditar" name="cne_celulareditar" type="text" class="form-control input-rounded" placeholder="Celular" maxlength="25" oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Teléfono</label>
              <input id="cne_teleditar" name="cne_teleditar" type="text" class="form-control input-rounded" placeholder="Teléfono" maxlength="25" oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Extensión</label>
              <input id="cne_exteditar" name="cne_exteditar" type="text" class="form-control input-rounded" placeholder="Extensión" maxlength="20"  oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Correo</label>
              <input id="cne_correoeditar" name="cne_correoeditar" type="email" class="form-control input-rounded" placeholder="Correo"  oninput="handleInput(event)" maxlength="90"/>
            </div>
            <div class="col-lg-9">
              <label class="col-form-label title-busq">Correos para enviar copias (separar por punto y coma ";")</label>
              <input id="cne_copiaenvioeditar" name="cne_copiaenvioeditar" type="text" class="form-control input-rounded" placeholder="Copias para envío de correo"  oninput="handleInput(event)" maxlength="300"/>
            </div>
            <div class="row col-lg-12">
              <div class="col-sm-6 col-md-6 text-center mt-5">
              </div>
              <div class="col-sm-3 col-md-3 text-center mt-5">
                  <div class="form-group">
                    <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
                  </div>
              </div>
              <div class="col-sm-3 col-md-3  text-center mt-5 ">
                  <div class="form-group">
                    <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                  </div>
              </div>
            </div>
          </div>
        </form>      
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="centrocosto-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5><div id="empresa_centrocosto"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="col-2">
            <div class="text-left">
              {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50'),"data-toggle":"modal","data-target":"#centronuevo-modal","title":"Agregar contacto") }}
            </div>
          </div>
          <div class="modal-body">
            <!-- <br /> -->
            <!-- <h2><div id="cliente_recibo"></div></h2> -->
            <!-- <h2><div id="descripcion_recibo"></div></h2> -->
            
            <div id="centrolistado">
            </div>
          </div>
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="centronuevo-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel">Crear centro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_crearcentro" class="form-vertical mt-1">
          <div class="form-group row">
            <input type="hidden" id="emp_idcrearcentro" name="emp_idcrearcentro" />
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Clave</label>
              <input id="cen_clave" name="cen_clave" type="text" class="form-control input-rounded" placeholder="Clave" maxlength="155" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Nombre</label>
              <input id="cen_nombre" name="cen_nombre" type="text" class="form-control input-rounded" placeholder="Nombre"   maxlength="155" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Teléfono</label>
              <input id="cen_tel" name="cen_tel" type="text" class="form-control input-rounded" placeholder="Teléfono"  maxlength="45" oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Correo</label>
              <input id="cen_correo" name="cen_correo" type="email" class="form-control input-rounded" maxlength="45"  placeholder="Correo"/>
            </div>
            <div class="row col-lg-12">
              <div class="col-sm-6 col-md-6 text-center mt-5">
              </div>
              <div class="col-sm-3 col-md-3 text-center mt-5">
                  <div class="form-group">
                    <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
                  </div>
              </div>
              <div class="col-sm-3 col-md-3  text-center mt-5 ">
                  <div class="form-group">
                    <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                  </div>
              </div>
            </div>
          </div>
        </form>      
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="centroeditar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel">Editar centro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_editarcentro" class="form-vertical mt-1">
          <div class="form-group row">
            <input type="hidden" id="cen_ideditar" name="cen_ideditar" />
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Clave</label>
              <input id="cen_claveeditar" name="cen_claveeditar" type="text" class="form-control input-rounded" placeholder="Clave"  maxlength="155" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Nombre</label>
              <input id="cen_nombreeditar" name="cen_nombreeditar" type="text" class="form-control input-rounded" placeholder="Nombre"  maxlength="155" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Teléfono</label>
              <input id="cen_teleditar" name="cen_teleditar" type="text" class="form-control input-rounded" placeholder="Teléfono"  maxlength="45" oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Correo</label>
              <input id="cen_correoeditar" name="cen_correoeditar" type="email" class="form-control input-rounded" maxlength="45"  placeholder="Correo"/>
            </div>
            <div class="row col-lg-12">
              <div class="col-sm-6 col-md-6 text-center mt-5">
              </div>
              <div class="col-sm-3 col-md-3 text-center mt-5">
                  <div class="form-group">
                    <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
                  </div>
              </div>
              <div class="col-sm-3 col-md-3  text-center mt-5 ">
                  <div class="form-group">
                    <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                  </div>
              </div>
            </div>
          </div>
        </form>      
      </div>
    </div>
  </div>
</div>


{# include inicio  #}
{% include "/empresa/ver-logo-modal-js.volt" %}
{% include "/empresa/agregar-modal-js.volt" %}
{% include "/empresa/editar-modal-js.volt" %}
{% include "/empresa/acciones/catvacantes/tabla-catvacantes-modal.volt" %}
{% include "/ocupacion/acciones/script-ajax-get-todos.volt" %}
{# include fin  #}
