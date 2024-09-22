{% set cuarentayseis = acceso.verificar(46,rol_id) %}

<script type="text/javascript">
  function fnarchivosdocumento(){
    /* Para obtener el valor */
    var value = document.getElementById("doc_id").value;
    // alert(value);
    if(value==-1)
    {
      alertify.alert("Error","Selecciona un documento");
      $('#divarchivo').empty();
      return false;
    }else{
      // alert('busco representantes e imprimo');
      // return false;
      var urlcategoria="<?php echo $this->url->get('documento/ajax_getinfo/') ?>";
      urlcategoria=urlcategoria+value;
      // $form.find("button").prop("disabled", true);
      $.ajax({
        type: "POST",
        url: urlcategoria,
        // data: $("#frm_crearparticipante").serialize(),
        success: function(res)
        {
          if(res[0]<=0)
          {
            $('#divarchivo').empty();
            Swal.fire({title:'Error',text:res[1],type:"error"})
                                                                .then((value) => {
                                                                      });  
          }
          else
          {
            $('#divarchivo').empty();
            var a='<label class="col-form-label title-busq">'+res[3]+'</label><input type="file" id="archivo_categoria" accept="'+res[1]+'" name="archivo_categoria[]" '+res[2]+' required />';
            $('#divarchivo').append(a);
          }
          // $form.find("button").prop("disabled", false); 
        },
        error: function(res)
        {
          alert('Error en servidor...');
          // $form.find("button").prop("disabled", false); 
        }
      });
      return false;
    }
  }

    function fneliminarevidencia(id_archpol,id_pol){
      var urleliminarare="<?php echo $this->url->get('documentousuario/eliminar/') ?>";
      // var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
      mensaje="¿Está seguro que desea eliminar la archivo?";
      alertify.confirm("Eliminar archivo",mensaje, function()
      { 
        $.ajax({
          type: "POST",
          url: urleliminarare+id_archpol,
          success: function(res)
          {
            if(res[0]=='1')
            {
              Swal.fire({title:'Eliminado',text:'El archivo ha sido eliminado correctamente',type:"success"})
                                                                 .then((value) => {
                                                                     });
              reloadarchivo(id_pol);
              // window.location=urlindexare;
            }
            else 
            {
              if(res[0]=='-1'){
              
                Swal.fire({title:'Error',text:res[1],type:"error"})
                                                                 .then((value) => {
                                                                     });
              }
              else
              {
                Swal.fire({title:'Error',text:"Ocurrio un error al cambiar el estatus",type:"error"})
                                                                 .then((value) => {
                                                                     });
              }
            }
          }
        });
      }, function()
      { 
      }).set('labels', {ok:'Eliminar', cancel:'Cancelar'});
    }

    function fnautorizardocumento(id_archpol,id_pol){
      var urlaprobarare="<?php echo $this->url->get('documentousuario/aprobar/') ?>";
      // var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
      mensaje="¿Está seguro que desea aprobar el documento?";
      alertify.confirm("Aprobar documento",mensaje, function()
      { 
        $.ajax({
          type: "POST",
          url: urlaprobarare+id_archpol,
          success: function(res)
          {
            if(res[0]=='1')
            {
              Swal.fire({title:'Aprobado',text:'El archivo ha sido aprobado correctamente',type:"success"})
                                                                 .then((value) => {
                                                                     });
              reloadarchivo(id_pol);
              // window.location=urlindexare;
            }
            else 
            {
              if(res[0]=='-1'){
              
                Swal.fire({title:'Error',text:res[1],type:"error"})
                                                                 .then((value) => {
                                                                     });
              }
              else
              {
                Swal.fire({title:'Error',text:"Ocurrio un error al cambiar el estatus",type:"error"})
                                                                 .then((value) => {
                                                                     });
              }
            }
          }
        });
      }, function()
      { 
      }).set('labels', {ok:'Autorizar', cancel:'Cancelar'});
    }

    function fndesactualizadodocumento(id_archpol,id_pol){
      var urlaprobarare="<?php echo $this->url->get('documentousuario/desactualizado/') ?>";
      // var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
      mensaje="¿Está seguro que desea marcar como desactualizado el documento?";
      alertify.confirm("Marcar como desactualizado el documento",mensaje, function()
      { 
        $.ajax({
          type: "POST",
          url: urlaprobarare+id_archpol,
          success: function(res)
          {
            if(res[0]=='1')
            {
              Swal.fire({title:'Aprobado',text:'El archivo ha sido marcado como desactualizado correctamente',type:"success"})
                                                                 .then((value) => {
                                                                     });
              reloadarchivo(id_pol);
              // window.location=urlindexare;
            }
            else 
            {
              if(res[0]=='-1'){
              
                Swal.fire({title:'Error',text:res[1],type:"error"})
                                                                 .then((value) => {
                                                                     });
              }
              else
              {
                Swal.fire({title:'Error',text:"Ocurrio un error al cambiar el estatus",type:"error"})
                                                                 .then((value) => {
                                                                     });
              }
            }
          }
        });
      }, function()
      { 
      }).set('labels', {ok:'Aceptar', cancel:'Cancelar'});
    }

    function fncategoria(){
        fncategoriaselect();
    }

  function fncategoriaselect(){
    $('#divarchivo').empty();
    var categoria="<?php echo $this->url->get('documento/ajax_documentos/') ?>";
    var $subscategoria = $('select[name="doc_id"]');
    $subscategoria.empty();
    $.ajax({
          type: "POST",
          url: categoria,
          
          success: function(data)
          {
            // console.log(data);
              // Agregar nuevos sub-departamentos
              if (data.length > 0) {
                  $subscategoria.append(function () {
                      var options = '';
                      options += '<option selected value="-1">Seleccionar</option>';
                      $.each(data, function (key, dat) {
                        options += '<option value="' + dat.doc_id + '">' +dat.doc_nombre+'</option>';
                      });

                      return options;
                  });
              }else{
                $subscategoria.append(function () {
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

    function documento(id_usu){
        // reciboListado = document.getElementById('documentolistado');
        url2="<?php echo $this->url->get('documentousuario/tabla/') ?>";
        url2+=id_usu;
        $("#usu_idarchivo").val(id_usu);
        $("#msae_archivo").html("Archivos del usuario: "+id_usu);
        $.post(url2, $(this).serialize() , function(data)
        {
        //   if(data[0]<=0)
        //   {
        //     $('#archivos-modal').modal('hide');
        //     alertify.alert("Error",data[1]);
        //   }
        //   else
        //   {
            $('#documentolistado').html(data);
            // divListado.innerHTML=data;
            $('#documentotable').DataTable(
            {
              "pageLength": 10
            });
        //   }
        }).done(function() { 
        }).fail(function() {
        })
    }

    function reloadarchivo(id_ese){
        document.getElementById("documentolistado").innerHTML="";
        reciboListado = document.getElementById('documentolistado');
        urlreload="<?php echo $this->url->get('documentousuario/tabla/') ?>";
        urlreload+=id_ese;
        $("#usu_idarchivo").val(id_ese);
        // $("#msae_archivo").html("Archivos de póliza: "+num_poliza);
        // $("#cliente_recibo").html("Cliente: "+cliente);
        // $("#descripcion_recibo").html("Descripción: "+descripcion);
        $.post(urlreload, $(this).serialize() , function(data)
        {
            $('#documentolistado').html(data);
            // divListado.innerHTML=data;
            $('#documentotable').DataTable(
            {
              "pageLength": 10
            });
        }).done(function() { 
        }).fail(function() {
        })
    }

    function fneliminararchivo(id_archese,id_ese){
      var urleliminarare="<?php echo $this->url->get('evidencia/eliminar/') ?>";
      // var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
      mensaje="¿Está seguro que desea eliminar el archivo?";
      alertify.confirm("Eliminar archivo",mensaje, function()
      { 
        $.ajax({
          type: "POST",
          url: urleliminarare+id_archese,
          success: function(res)
          {
            if(res[0]=='1')
            {
              Swal.fire({title:'Eliminado',text:"El archivo ha sido eliminado correctamente",type:"success"})
                .then((value) => {
                });
              reloadarchivo(id_ese);
              // window.location=urlindexare;
            }
            if(res[0]=='-1'){
              Swal.fire({title:'Error',text:res[1],type:"error"})
                .then((value) => {
              });
            }
            else
            {
              Swal.fire({title:'Error',text:'Ocurrio un error al cambiar el estatus',type:"error"})
              .then((value) => {
              });
            }
          }
        });
      }, function()
      { 
      }).set('labels', {ok:'Eliminar', cancel:'Cancelar'});
    }

    $(function (){
      $("#frm_creararchivo_categoria").submit(function(event) 
      {
        if($('#archivo_categoria').val()=='') 
        { 
              Swal.fire({title:'Error',text:"Debe seleccionar al menos un archivo a subir.",type:"error"})
                      .then((value) => {
                      });
          return false; 
        } 
        if($("#cat_id").val()==-1){
              Swal.fire({title:'Error',text:"Debe seleccionar el tipo de documento.",type:"error"})
                      .then((value) => {
                      });
          return false;
        }
        /*Ejecutamos la función ajax de jQuery*/   
        var idese = document.getElementById("usu_idarchivo").value;
        var u="<?php echo $this->url->get('documentousuario/archivo/') ?>";

        $.ajax({
          url: u+idese,//Url a donde la enviaremos
          type:'POST', //Metodo que usaremos
          // contentType:false, //Debe estar en false para que pase el objeto sin procesar
          // data: $("#frm_creararchivo").serialize(), //Le pasamos el objeto que creamos con los archivos
          // processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
          // cache:false, //Para que el formulario no guarde cache
          data: new FormData(this),
          dataType: 'json',
          contentType: false,
          cache: false,
          processData:false,
          success: function(res)
            {
              if(res[0]!='-2')
              {
                Swal.fire({title:'Éxito',text:'Se ha subido correctamente el archivo.',type:"success"})
                         .then((value) => {

                              reloadarchivo(res[2]);
                              document.getElementById("frm_creararchivo_categoria").reset();
                              $('#archivonuevo-modal').modal('hide');

                          });
                       
              }
              else
              {
                // cargarlista();
      

                Swal.fire({title:'Error',html:res[3],type:"error"})
                        .then((value) => {
                            reloadarchivo(res[2]);
                            document.getElementById("frm_creararchivo_categoria").reset();
                            $('#archivonuevo-modal').modal('hide');

                        });

              }

              // $form.find("button").prop("disabled", false); 
            },
            error: function(res)
            { 
              alert('Error en el servidor...');

              // $form.find("button").prop("disabled", false); 
            }
        
        });
        return false;
      });
    });
  function fnestatusdocumentos()
    {
        var url_ajax="<?php echo $this->url->get('documentousuario/checklist/') ?>";
        $('#divestatus').empty();
        var idusu = document.getElementById("usu_idarchivo").value;
        // var $subs_name = $('select[id="divarchivo"]');
        // $subs_name.empty();
        $.ajax({
            type: "POST",
            url: url_ajax+idusu,
            success: function(data)
            {
                if (data.length > 0) {
                  var options = '';
                  $.each(data, function (key, dat) {
                    switch (dat.estatus) {
                      case '1':
                        options += '<div style="text-align: center;"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-success" id="badge_modal_resument_tipoestudio_2">'+dat.doc_nombre+'</span></div><br><br>'
                        break;
                      case '3':
                        options += '<div style="text-align: center;"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-warning" id="badge_modal_resument_tipoestudio_2">'+dat.doc_nombre+'</span></div><br><br>'
                        break;
                      default:
                        options += '<div style="text-align: center;"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-danger" id="badge_modal_resument_tipoestudio_2">'+dat.doc_nombre+'</span></div><br><br>'
                    }
                  });
                   $("#divestatus").append(options);
                   
                }else{
                    
                }
            },
            error: function(res)
            {
              alert('Error en el servidor...');
            }
        });
    }
</script>

<div class="modal fade" id="documento-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5><div id="msae_archivo"></div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="row ml-2">
        <div class="col-6 ">
            {{ link_to('#', image("assets/images/small/boton.svg", "onclick":"fncategoria()", 'class':'boton-plus', 'height':'50'), "data-toggle":"modal", "data-target":"#archivonuevo-modal", "title":"Agregar archivo") }} 
            <span class="ml-3 h6  text-success">Agregar documentos</span>
        </div>
        <div class="col-6">
          <div class="text-right">
            {{ link_to('', 'data-target':'#estatusdocumentos-modal','<i class="mdi mdi-format-list-checks mdi-48px btn-icon">Ver estatus</i>', "onclick":"fnestatusdocumentos()", 'data-toggle':'modal') }}
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div id="documentolistado">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="archivonuevo-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="msae_recibo"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_creararchivo_categoria" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
              <div class="form-group row">
                <input type="hidden" id="usu_idarchivo" name="usu_idarchivo" />
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Documento</label>
                  <select name="doc_id" id="doc_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnarchivosdocumento();">
                  </select>
                </div>
                <div class="col-lg-7" id="divarchivo">
                  
                </div>
                <div class="row col-lg-12">
                  <div class="col-sm-6 col-md-6 text-center mt-5">
                  </div>
                  <div class="col-sm-3 col-md-3 text-center mt-5">
                      <div class="form-group">
                        <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                      </div>
                  </div>
                  <div class="col-sm-3 col-md-3  text-center mt-5 ">
                      <div class="form-group">
                        <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Subir</button>
                      </div>
                  </div>
                </div>
                

                
              </div>
            </form>
          </div>
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="estatusdocumentos-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5>Relación de documentos entregados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-lg-12" id="divestatus">
                  
            </div>
            <!-- //contenido -->
            
          </div>
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>
{% include "/archivo/leer-archivo.volt" %}