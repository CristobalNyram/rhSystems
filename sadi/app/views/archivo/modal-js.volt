{% set cuarentayseis = acceso.verificar(46,rol_id) %}
{% set cincuentayocho = acceso.verificar(58,rol_id) %}
{% set sesentaycinco = acceso.verificar(65,rol_id) %}

<script type="text/javascript">
  function fnbuscarsemanas(id_ese){
    var urlbuscarsem="<?php echo $this->url->get('api/getimssinfo/') ?>";
    // var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
    mensaje="¿Está seguro que desea buscar las semanas cotizadas de este estudio?";
    alertify.confirm("Semanas cotizadas",mensaje, function()
    { 
      $.ajax({
        type: "POST",
        url: urlbuscarsem+id_ese,
        success: function(res)
        {
          if(res[0]=='1')
          {
            Swal.fire({title:'Éxito',text:res[1],type:"success"})
              .then((value) => {
                reloadarchivo(id_ese);
              });
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
              Swal.fire({title:'Error',text:"Ocurrio un error inesperado, intente de nuevo más tarde o consulte al administrador.",type:"error"})
                .then((value) => {
                });
            }
          }
        }
      });
    }, function()
    { 
    }).set('labels', {ok:'Confirmar', cancel:'Cancelar'});
  }

  function fnbuscarcurp(id_ese){
    var urlbuscarcurp="<?php echo $this->url->get('archivo/getcurpapi/') ?>";
    // var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
    mensaje="¿Está seguro que desea buscar la CURP de este estudio?";
    alertify.confirm("CURP",mensaje, function()
    { 
      $.ajax({
        type: "POST",
        url: urlbuscarcurp+id_ese,
        success: function(res)
        {
          if(res[0]=='1')
          {
            Swal.fire({title:'Éxito',text:'La CURP ha sido consultada correctamente. Revisa los archivos del estudio para consultar el reporte.',type:"success"})
              .then((value) => {
                reloadarchivo(id_ese);
              });
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
              Swal.fire({title:'Error',text:"Ocurrio un error inesperado, intente de nuevo más tarde o consulte al administrador.",type:"error"})
                .then((value) => {
                });
            }
          }
        }
      });
    }, function()
    { 
    }).set('labels', {ok:'Confirmar', cancel:'Cancelar'});
  }

  function fnbuscarpoderjudicial(id_ese){
    var urlbuscarcurp="<?php echo $this->url->get('archivo/getPoderJudicial/') ?>";
    // var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
    mensaje="¿Está seguro que desea buscar la información de poder judicial de este estudio?";
    alertify.confirm("Visor Judicial",mensaje, function()
    { 
      $.ajax({
        type: "POST",
        url: urlbuscarcurp+id_ese,
        success: function(res)
        {
          if(res[0]=='1')
          {
            Swal.fire({title:'Éxito',text:'La información ha sido consultada correctamente. Revisa los archivos del estudio para consultar el reporte.',type:"success"})
              .then((value) => {
                reloadarchivo(id_ese);
              });
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
              Swal.fire({title:'Error',text:"Ocurrio un error inesperado, intente de nuevo más tarde o consulte al administrador.",type:"error"})
                .then((value) => {
                });
            }
          }
        }
      });
    }, function()
    { 
    }).set('labels', {ok:'Confirmar', cancel:'Cancelar'});
  }

  function fnarchivoscategoria(){
    /* Para obtener el valor */
    $('#divarchivo').empty();
    $('#divarchivo').html("CARGANDO...");

    var value = document.getElementById("cat_id").value;
    // alert(value);

    if(value==-1)
    {
      alertify.alert("Error","Selecciona una categoría");
      $('#divarchivo').empty();
      return false;
    }else{
      // alert('busco representantes e imprimo');
      // return false;
      var urlcategoria="<?php echo $this->url->get('categoria/ajax_getinfo/') ?>";
      urlcategoria=urlcategoria+value;
      // $form.find("button").prop("disabled", true);
      $.ajax({
        type: "POST",
        url: urlcategoria,
        // data: $("#frm_crearparticipante").serialize(),
        success: function(res)
        {
            $('#divarchivo').empty();

          if(res[0]<=0)
          {
            Swal.fire({title:'Error',text:res[1],type:"error"})
            .then((value) => {
                  });
          }
          else
          {
            $('#divarchivo').empty();
            //var a='<label class="col-form-label title-busq">'+res[3]+'</label><input type="file" id="archivo_categoria" accept="'+res[1]+'" name="archivo_categoria[]" '+res[2]+' required />';
            let a=`
            <input 
                  type="file" 
                  id="archivo_categoria" 
                  data-size-limit="${res["size"]}"
                  data-file-limit="${res["file_limit"]}"
                  onchange="fnValidateSizeFile(event,'preview-container-archivos-arc');"
                  accept="${res[1]}" 
                  name="archivo_categoria[]" 
                  ${res[2]} 
                  required />
                  <div id="preview-container-archivos-arc" class="col-12"></div>
            `;
           
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
      var urleliminarare="<?php echo $this->url->get('archivo/eliminar/') ?>";
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
                .then((value) =>{
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

  function fncategoria(tipo_archivo=0){
    fncategoriaselect(tipo_archivo);
    // console.log(tipo_archivo);
  }

  function fncategoriaselect(tipo_archivo=0){
    $('#divarchivo').empty();
    $('#cat_id_cargando').show();
    $('#cat_id').hide();
    var categoria="<?php echo $this->url->get('categoria/ajax_categorias/') ?>";
    var $subscategoria = $('select[name="cat_id"]');
    $subscategoria.empty();
    $.ajax({
          type: "POST",
          url: categoria+'/'+tipo_archivo,
          
          success: function(data)
          {
            // console.log(data);
              $('#cat_id_cargando').hide();
              $('#cat_id').show();
              // Agregar nuevos sub-departamentos
              if (data.length > 0) {
                  $subscategoria.append(function () {
                      var options = '';
                      options += '<option selected value="-1">Seleccionar</option>';
                      $.each(data, function (key, dat) {
                        options += '<option value="' + dat.cat_id + '">' +dat.cat_nombre+'</option>';
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

    function archivo(id_ese, ocultar=0,categoria_archivos=0, imss=0, curp=0, poderjudicial=0){
        if (categoria_archivos=='0') {
          let btn_categoria=`
          {{ link_to('#', image("assets/images/small/boton.svg", "onclick":"fncategoria()", 'class':'boton-plus', 'height':'50'), "data-toggle":"modal", "data-target":"#archivonuevo-modal", "title":"Agregar archivo") }} 
          `;  
          $('#contenedor_btn_categoria').empty();
          $('#contenedor_btn_categoria').html(btn_categoria);
        }
        if(categoria_archivos=='truper')
        {
          let btn_categoria=`
          {{ link_to('#', image("assets/images/small/boton.svg", "onclick":"fncategoria('truper')", 'class':'boton-plus', 'height':'50'), "data-toggle":"modal", "data-target":"#archivonuevo-modal", "title":"Agregar archivo") }} 
          `;
          $('#contenedor_btn_categoria').empty();
          $('#contenedor_btn_categoria').html(btn_categoria);
        }
        if(categoria_archivos=='truperVentas')
        {
          let btn_categoria=`
          {{ link_to('#', image("assets/images/small/boton.svg", "onclick":"fncategoria('truperVentas')", 'class':'boton-plus', 'height':'50'), "data-toggle":"modal", "data-target":"#archivonuevo-modal", "title":"Agregar archivo") }} 
          `;
          $('#contenedor_btn_categoria').empty();
          $('#contenedor_btn_categoria').html(btn_categoria);
        }
        if(categoria_archivos=='ese')
        {
          let btn_categoria=`
          {{ link_to('#', image("assets/images/small/boton.svg", "onclick":"fncategoria('ese')", 'class':'boton-plus', 'height':'50'), "data-toggle":"modal", "data-target":"#archivonuevo-modal", "title":"Agregar archivo") }} 
          `;
          $('#contenedor_btn_categoria').empty();
          $('#contenedor_btn_categoria').html(btn_categoria);
        }
        if(categoria_archivos=='gabinete')
        {
          let btn_categoria=`
          {{ link_to('#', image("assets/images/small/boton.svg", "onclick":"fncategoria('gabinete')", 'class':'boton-plus', 'height':'50'), "data-toggle":"modal", "data-target":"#archivonuevo-modal", "title":"Agregar archivo") }} 
          `;
          $('#contenedor_btn_categoria').empty();
          $('#contenedor_btn_categoria').html(btn_categoria);
        }
        $('#BotonesDeAPI').empty();
        if(imss!=0)
        {
          inputBotonimss=` 
            <a data-toggle="modal" title="Semanas cotizadas IMSS" data-container="body" data-toggle="popover" role="button" class="bg-custom" onclick="fnbuscarsemanas($('#ese_idarchivo').val())">
              <i class="mdi mdi-medical-bag mdi-36px" ></i>
            </a>
            
          `;
          $('#BotonesDeAPI').append(inputBotonimss);
        }
        if(curp!=0)
        {
          inputBotoncurp=` 
            
            <a data-toggle="modal" title="Descargar CURP" data-container="body" data-toggle="popover" role="button" class="bg-custom" onclick="fnbuscarcurp($('#ese_idarchivo').val())">
              <i class="mdi mdi-account-card-details-outline mdi-36px"></i>
            </a>
          `;
          $('#BotonesDeAPI').append(inputBotoncurp);
        }
        if(poderjudicial!=0)
        {
          inputBotonpoderjudicial=`
            <a data-toggle="modal" title="Descargar datos poder judicial" data-container="body" data-toggle="popover" role="button" class="bg-custom" onclick="fnbuscarpoderjudicial($('#ese_idarchivo').val())">
              <i class="mdi mdi-certificate-outline mdi-36px"></i>
            </a>
          `;
          $('#BotonesDeAPI').append(inputBotonpoderjudicial);
        }
        reciboListado = document.getElementById('archivoslistado');
        url="<?php echo $this->url->get('archivo/tabla/') ?>";
        url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";

        url+=id_ese+'/'+ocultar;

        $("#ese_idarchivo").val(id_ese);
        $.post(url, $(this).serialize() , function(data)
        {
          if(data[0]<=0)
          {
            $('#archivos-modal').modal('hide');
            alertify.alert("Error",data[1]);     
          }
          else
          {
            $('#archivoslistado').html(data);
            // divListado.innerHTML=data;
            $('#archivotable').DataTable(
            {
              "pageLength": 10
            });
          }
        }).done(function() { 
            //obteniendo datos de ese
            $.ajax({
              type: "POST",
              url: url_enviar_ese_data+id_ese,
              success: function(res)
              {
                  if(res.length>0){
                    let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;
                    $("#msae_archivo").html("Archivos de estudio: "+id_ese+mensaje_empresa_candidato);
                  }
              },
              error: function(data)
              {
                  alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                
              }
             });
        }).fail(function() {
        });
    }

    function reloadarchivo(id_ese){
        document.getElementById("archivoslistado").innerHTML="";
        reciboListado = document.getElementById('archivoslistado');
        urlreload="<?php echo $this->url->get('archivo/tabla/') ?>";
        urlreload+=id_ese;
        $("#ese_idarchivo").val(id_ese);
        // $("#msae_archivo").html("Archivos de póliza: "+num_poliza);
        // $("#cliente_recibo").html("Cliente: "+cliente);
        // $("#descripcion_recibo").html("Descripción: "+descripcion);
        $.post(urlreload, $(this).serialize() , function(data)
        {
            $('#archivoslistado').html(data);
            // divListado.innerHTML=data;
            $('#archivotable').DataTable(
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
              Swal.fire({title:'Error',text:"Debe seleccionar la categoría de la evidencia.",type:"error"})
                      .then((value) => {
                      });
          return false;
        }
        /*Ejecutamos la función ajax de jQuery*/   
        var idese = document.getElementById("ese_idarchivo").value;
        var u="<?php echo $this->url->get('archivo/archivo/') ?>";

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
</script>

<div class="modal fade" id="archivos-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5><div id="msae_archivo"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="row col ml-2">
            <div class="">
              {% if ocultaredicionarchivo is defined %}
              {% else %}
              <div id="contenedor_btn_categoria">

              </div>
                <span class="ml-3 h6  text-success">Agregar fotografias y/o documentos</span>
                {% endif %}
            </div>
            <div class="container d-flex justify-content-end" id="BotonesDeAPI">
            </div>
          </div>
          <div class="modal-body">
            <!-- <br /> -->
            <!-- <h2><div id="cliente_recibo"></div></h2> -->
            <!-- <h2><div id="descripcion_recibo"></div></h2> -->
            <div id="archivoslistado">
            </div>
          </div>

          {% if cuarentayseis==1%}
            <div class="modal-footer">
              <div class="col-6">
                <div class="text-left">
                  {% if ocultaredicionarchivo is defined %}
                  {% else %}
                    <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_idarchivo').val(),11)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
                  {% endif %}
                </div>
              </div>
              <div class="col-3">
              </div>
            </div>
          {% endif %}
        <!-- </div>
      </div> -->
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
                <input type="hidden" id="ese_idarchivo" name="ese_idarchivo" />
                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Categoría</label>
                  <select name="cat_id" id="cat_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnarchivoscategoria();">
                  </select>
                  <label class="col-form-label title-busq" id="cat_id_cargando">Cargando...</label>

                </div>
                <div class="col-lg-12 mt-2" id="divarchivo">
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

{% include "/archivo/leer-archivo.volt" %}
{% include "/archivo/agregar-archivoa-reporte-modal-js.volt" %}