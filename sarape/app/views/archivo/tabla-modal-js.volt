{% include "/archivo/acciones/buscar-info-importante-js.volt" %}

<script type="text/javascript">
let VISTA_RELOAD=0;

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
        var exc_id = document.getElementById("exc_id-archivo").value;
        var url="<?php echo $this->url->get('archivo/archivo/') ?>";
        var $form = $(this);
        $form.find("button").prop("disabled", true);
        $.ajax({
          url: url+exc_id,//Url a donde la enviaremos
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

              if(res["estado"]=='2')
              {
                Swal.fire({title:'Éxito',text:'Se ha subido correctamente el archivo.',type:"success"})
                .then((value) => {
                    fnCargarTablaArchivo(res["exc_id"],VISTA_RELOAD);
                    document.getElementById("frm_creararchivo_categoria").reset();
                    $('#archivonuevo-modal').modal('hide');
                });
                       
              }
              else if(res["estado"]=='-1')
              {
                // cargarlista();
                Swal.fire({title:'Error',html:res["mensaje"],type:"warning"})
                .then((value) => {
                    fnCargarTablaArchivo(res["exc_id"],VISTA_RELOAD);
                    document.getElementById("frm_creararchivo_categoria").reset();
                    $('#archivonuevo-modal').modal('hide');
                });
              }else{
                Swal.fire({title:'Error',html:res["mensaje"],type:"error"})
                .then((value) => {
                    fnCargarTablaArchivo(res["exc_id"],VISTA_RELOAD);
                    document.getElementById("frm_creararchivo_categoria").reset();
                    $('#archivonuevo-modal').modal('hide');
                });
              }
               $form.find("button").prop("disabled", false); 
            },
            error: function(res)
            { 
              alert('Error en el servidor...'+res.responseText);
              $form.find("button").prop("disabled", false); 
            }
        });
        return false;
      });
    });

      function reloadarchivo(exc_id,vista){
        document.getElementById("archivoslistado").innerHTML="";
        reciboListado = document.getElementById('archivoslistado');
        urlreload="<?php echo $this->url->get('archivo/tabla/') ?>";
        urlreload+=exc_id;
        let dataToSend={};

        dataToSend.vista=vista;
        $("#exc_id-archivo").val(exc_id);
        // $("#msae_archivo").html("Archivos de póliza: "+num_poliza);
        // $("#cliente_recibo").html("Cliente: "+cliente);
        // $("#descripcion_recibo").html("Descripción: "+descripcion);
        $.post(urlreload,dataToSend, function(data)
        {
            $('#archivoslistado').html(data);
           
            $('#archivotable').DataTable(
            {
              "pageLength": 10
            });
        }).done(function() { 
        }).fail(function() {
        })
    }

 function fnarchivoscategoria(){
    /* Para obtener el valor */
     $('#divarchivo').empty();
    $('#divarchivo').html("Cargando...");
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
            var a=`<label class="col-form-label title-busq">${res[3]} </label>
                  <input 
                  type="file" 
                  id="archivo_categoria" 
                   data-size-limit="${res["size"]}"
                  data-file-limit="${res["file_limit"]}"
                  onchange="fnValidateSizeFile(event,'preview-container-archivos-exc');"
                  accept="${res[1]}" 
                  name="archivo_categoria[]" ${res[2]} 
                  required />
                  <div id="preview-container-archivos-exc" class="col-12"></div>
                  `;
            $('#divarchivo').append(a);
          

          }
          // $form.find("button").prop("disabled", false); 
        },
        error: function(res)
        {
          alert('Error en servidor...'+res.responseText);
          // $form.find("button").prop("disabled", false); 
        }
      });
      return false;
    }
  }
   function fncategoria(tipo_archivo=0,vista=""){
    fncategoriaselect(tipo_archivo,vista);
  }
   function fncategoriaselect(tipo_archivo=0,vista=""){
      VISTA_RELOAD=vista;
        $('#cat_id_container').hide();
      $('#divarchivo_select_cat_id').html("Cargando...");
    
      $('#divarchivo').empty();
      var categoria="<?php echo $this->url->get('categoria/ajax_categorias/') ?>";
      var $subscategoria = $('select[name="cat_id"]');
      $subscategoria.empty();
      $.ajax({
            type: "POST",
            url: categoria+'/'+tipo_archivo,
            data:{
              "vista":vista
            },
            success: function(data)
            {
        
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
                  $('#divarchivo_select_cat_id').empty();
                   $('#cat_id_container').show();
                }else{
                  $subscategoria.append(function () {
                      var options = '';
                      options += '<option selected value="-1">No aplica</option>';
                      return options;
                  });
                  $('#cat_id_container').show();
                  $('#divarchivo_select_cat_id').empty();

                }
            },
            error: function(res)
            {
              alert(res.responseText);
              $('#cat_id_container').hide();
              $('#divarchivo_select_cat_id').empty();
              //$("#btn_aprobar").prop("disabled", false);
            }
        });
    }
    config_arc_exc_={};
    function fnCargarTablaArchivo(exc_id=0,vista="",config={}){
        let imss_api=0;
        config_arc_exc_=config;
        //api immss  config
          if (config.hasOwnProperty('imss_api')) {
              if(config.imss_api=="1" ||config.imss_api==1 ){
                imss_api=1;
              }
          }
        //api immss  config fin

        $('#BotonesDeAPIArchivoExc').empty();

        //mostrar crear config
          if (config.hasOwnProperty('mostrarCrear')) {
              if( config.mostrarCrear=="1"){
                $('.btn-agregrar-archivos').show();
              }else{
                $('.btn-agregrar-archivos').hide();
              }

          }else{
            $('.btn-agregrar-archivos').show();

          }
        //mostrar borrar arc config inicio
          if (config.hasOwnProperty('mostrarBorrar')) {
              if( config.mostrarBorrar=="1"){
                $('.btn-eliminar-archivos-exc').show();
              }else{
                $('.btn-eliminar-archivos-exc').hide();
              }

          }else{
            $('.btn-eliminar-archivos-exc').show();
            config.mostrarBorrar=1;
          }
        //mostrar borrar arc  config fin

       
     
            if ($.fn.DataTable.isDataTable('#td_archivos')) {
                $('#td_archivos').DataTable().clear().destroy();
            }

             $('#cat_id').select2({
              dropdownParent: $('#archivonuevo-modal')
            });
                fnGetDetalleExc(exc_id)
                          .then(function(res) {
                                let data=res.data;
                                let onclickArchivos = `fncategoria( ${exc_id},'${vista}')`;
                                $("#agregar-archivos-general").attr("onclick", onclickArchivos);
                              //  $('#contenedor_btn_categoria').empty();
                               /// $('#contenedor_btn_categoria').html(btn_categoria);
                                $('#exc_id-archivo').val(exc_id);
                                let mensaje=`Archivos del expediente No. ${exc_id} - ${data.can_nombre}- ${data.cav_nombre} - ${data.emp_nombre} - `+generateBadgeExcEstatusHTML(data.exc_estatus);
                     	          $("#msae_archivo").html(mensaje);
                                // console.log(data); 
                                
                                    //mostrar botones api inicio 
                                    // console.log(imss_api);
                                      if(imss_api!=0)
                                      {
                                        let inputBotonimss="";
                                        inputBotonimss=` 
                                          <a data-toggle="modal" title="Semanas cotizadas IMSS" data-container="body" data-toggle="popover" role="button" class="bg-custom" onclick="fnbuscarsemanas(${data.can_id},${exc_id},${data.vac_id},fnCargarTablaArchivo,'${vista}',config_arc_exc_)">
                                            <i class="mdi mdi-medical-bag mdi-36px" ></i>
                                          </a>
                                          
                                        `;
                                        // console.log("insert");
                                        $('#BotonesDeAPIArchivoExc').html(inputBotonimss);
                                      }
                                      
                                    //mostrar botones api fin 


                          })
                          .catch(function(error) {
                              alert(error);
                          });
        let divListado = document.getElementById('archivoslistado');
        let url="<?php echo $this->url->get('archivo/tabla/') ?>";
        let dataToSend={};
        dataToSend.vista=vista;
        dataToSend.mostrar_borrar=config.mostrarBorrar;
        url+=exc_id;
        $.post(url,dataToSend, function(data)
            {
            divListado.innerHTML=data;
            pintartabla("#td_archivos");
            }).done(function(){
            }).fail(function(res){
              console.log(res.responseText);
        })

        
    }
</script>
{# INCIO MODALES ---------------------------------------------------------------------------------------------------------------------INICIO MODALES #}
<div class="modal fade" id="archivos-modal" tabindex="-1" style="z-index:9041;display: none;" aria-labelledby="myModalLabel" aria-hidden="true" >
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
              
              <div id="contenedor_btn_categoria">
                                {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus btn-agregrar-archivos', 'height':'50'), "data-toggle":"modal", "data-target":"#archivonuevo-modal", "title":"Agregar archivo",'id':'agregar-archivos-general') }} 
              </div>
            </div>
            
            {# botones  para apis inicio #}
            <div class="container d-flex justify-content-end" id="BotonesDeAPIArchivoExc">
            </div>

            {# botones para apis fin  #}
          </div>
          <div class="modal-body">
            
            <div id="archivoslistado">
            </div>
          </div>

         
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>



<div class="modal fade" id="archivonuevo-modal" tabindex="999"  style="z-index:9999;display: none;" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="msae_recibo">Subir archivo</div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_creararchivo_categoria" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
              <div class="form-group row">
                <input type="hidden" id="exc_id-archivo" name="exc_id" />
                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Categoría</label>
                  <div id="cat_id_container">
                    <select name="cat_id" id="cat_id" class="form-control select2-single "   data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnarchivoscategoria();">
                    </select>
                  </div>
                  
                </div>
                <div id="divarchivo_select_cat_id">

                </div>
                <div class="col-lg-12" id="divarchivo">
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
{# FIN MODALES-------------------------------------------------------------------------------------------------------------------------------------------FIN MODALES #}


{# incio includes #}
{% include "/archivo/acciones/leer-archivo.volt" %}
{% include "/archivo/acciones/eliminar-js.volt" %}

{# fin includes #}

