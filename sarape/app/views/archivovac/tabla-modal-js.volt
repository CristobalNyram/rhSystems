
<script type="text/javascript">
VISTA_RELOAD_VAC=0;
 $(function (){
      $("#frm_creararchivo_categoria_vac").submit(function(event) 
      {
        var $form = $(this);

        if($('#archivo_categoria_vac').val()=='') 
        { 
              Swal.fire({title:'Error',text:"Debe seleccionar al menos un archivo a subir.",type:"error"})
                      .then((value) => {
                      });
          return false; 
        } 
        if($("#ctv_id").val()==-1){
              Swal.fire({title:'Error',text:"Debe seleccionar la categoría de la evidencia.",type:"error"})
                      .then((value) => {
                      });
          return false;
        }
        /*Ejecutamos la función ajax de jQuery*/   
        var vac_id = document.getElementById("vac_id-archivo").value;
        var url="<?php echo $this->url->get('archivovac/archivo/') ?>";
			  //file inciio
        let file = $("#archivo_categoria_vac")[0].files[0]; // Obtener el archivo seleccionado
        let formData = new FormData($form[0]); // Crear objeto FormData con los datos del formulario
        formData.append("arv", file); // Agregar el archivo al objeto FormData
        var $form = $(this);
        $form.find("button").prop("disabled", true);
        $.ajax({
          url: url+vac_id,//Url a donde la enviaremos
          type:'POST', //Metodo que usaremos
          data: formData,
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
                    $('#archivonuevo_vac-modal').modal('hide');
                    fnCargarTablaArchivoVac(res["vac_id"],VISTA_RELOAD_VAC);
                    document.getElementById("frm_creararchivo_categoria_vac").reset();
                });
                       
              }
              else if(res["estado"]==-1){
                 // cargarlista();
                Swal.fire({title:'AVISO',html:res.mensaje,type:"warning"})
                .then((value) => {
                    $('#archivonuevo_vac-modal').modal('hide');
                    fnCargarTablaArchivoVac(res["vac_id"],VISTA_RELOAD_VAC);
                    document.getElementById("frm_creararchivo_categoria_vac").reset();
                });

              }
              else
              {
                // cargarlista();
                Swal.fire({title:'Error',html:res.mensaje,type:"error"})
                .then((value) => {
                    fnCargarTablaArchivoVac(res["vac_id"],VISTA_RELOAD_VAC);
                    document.getElementById("frm_creararchivo_categoria_vac").reset();
                    $('#archivonuevo_vac-modal').modal('hide');
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

    function reloadarchivo(vac_id,vista){
        document.getElementById("archivos_vac_listado").innerHTML="CARGANDO...";
        reciboListado = document.getElementById('archivos_vac_listado');
        urlreload="<?php echo $this->url->get('archivo/tabla/') ?>";
        urlreload+=vac_id;
        let dataToSend={};
        dataToSend.vista=vista;
        $("#vac_id-archivo").val(vac_id);
        $.post(urlreload,dataToSend, function(data)
        {
            document.getElementById("archivos_vac_listado").innerHTML="";
            $('#archivos_vac_listado').html(data);
           
            $('#archivotable').DataTable(
            {
              "pageLength": 10
            });
        }).done(function() { 
        }).fail(function() {
        })
    }

 function fnarchivoscategoriaVac(){
    $('#divarchivo_vac').html("Cargando...");

    /* Para obtener el valor */
    var value = document.getElementById("ctv_id").value;
    // alert(value);

    if(value==-1)
    {
      alertify.alert("Error","Selecciona una categoría");
      $('#divarchivo_vac').empty();
      return false;
    }else{
      // alert('busco representantes e imprimo');
      // return false;
      var urlcategoria="<?php echo $this->url->get('categoriavac/ajax_getinfo/') ?>";
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
            $('#divarchivo_vac').empty();
            Swal.fire({title:'Error',text:res[1],type:"error"})
            .then((value) => {
                  });
          }
          else
          {
            $('#divarchivo_vac').empty();
          var a = 
            `
              <label class="col-form-label title-busq">${res[3]}</label>
              <input 
              type="file" 
              data-size-limit="${res["size"]}"
              data-file-limit="${res["file_limit"]}"
              onchange="fnValidateSizeFile(event,'preview-container-archivos-vac'); "
              id="archivo_categoria_vac" 
              accept="${res[1]}" 
              name="archivo_categoria[]" 
              ${res[2]} 
              required />
              <div id="preview-container-archivos-vac" class="col-12"></div>

            `;
            $('#divarchivo_vac').append(a);
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
   function fncategoriaVac(tipo_archivo=0,vista=""){
    fncategoriaselect_vac(tipo_archivo,vista);
  }
   function fncategoriaselect_vac(tipo_archivo=0,vista=""){
    
      $('#ctv_id_texto').html("Cargando...");
      $('#ctv_id-container').hide();
      VISTA_RELOAD_VAC=vista;
      $('#divarchivo_vac').empty();
      var categoria="<?php echo $this->url->get('categoriavac/ajax_categorias/') ?>";
      var $subscategoria = $('select[name="ctv_id"]');
      $subscategoria.empty();
      $.ajax({
            type: "POST",
            url: categoria+'/'+tipo_archivo,
            data:{
              "vista":vista,
            },
            success: function(data)
            {
        
             if (data.length > 0) {
                $subscategoria.append(function () {
                    var options = '';
                    options += '<option selected value="-1">Seleccionar</option>';
                    $.each(data, function (key, dat) {
                        options += '<option value="' + dat.ctv_id + '">' + dat.ctv_nombre + '</option>';
                    });
                    return options;
                });
                $('#ctv_id_texto').empty();
                $('#ctv_id-container').show();
            } else {
                $subscategoria.append(function () {
                    var options = '';
                    options += '<option selected value="-1">No aplica</option>';
                    return options;
                });
                $('#ctv_id-container').show();
                $('#ctv_id_texto').empty();

              }
            },
            error: function(res)
            {
              alert(res.responseText);
                // $("#btn_aprobar").prop("disabled", false);
            },
            done: function (res){
                $('#ctv_id_texto').empty();
                $('#ctv_id-container').show();
            }
        });
    }
    function fnCargarTablaArchivoVac(vac_id=0,vista="",config={}){
           VISTA_RELOAD_VAC=vista;
           let divListado = document.getElementById('archivos_vac_listado');
           divListado.innerHTML="CARGANDO...";  
           if (config.hasOwnProperty('mostrarCrear')) {
              if( config.mostrarCrear=="1"){
                $('#contenedor_btn_categoria_vac').show();
              }else{
                $('#contenedor_btn_categoria_vac').hide();
              }
          }else{
            $('#btn-agregrar-archivos').show();

          }
            if ($.fn.DataTable.isDataTable('#td_archivos_vac')) {
                $('#td_archivos_vac').DataTable().clear().destroy();
            }
             $('#ctv_id').select2({
              dropdownParent: $('#archivonuevo_vac-modal')
            });
            
                fnGetDetalleVac(vac_id)
                          .then(function(res) {
                              let data=res.data;
                              let onclickArchivos = `fncategoriaVac( ${vac_id},'${vista}')`;

                              $("#agregar-archivos-vac-general").attr("onclick", onclickArchivos);
                              $('#vac_id-archivo').val(vac_id);
                              let mensaje=`Archivos de la vacante con folio  ${vac_id} `;
                     	        $("#msae_archivo_vac").html(mensaje);
                          })
                          .catch(function(error) {
                              alert(error);
                          });

        let url="<?php echo $this->url->get('archivovac/tabla/') ?>";
        let dataToSend={};

        dataToSend.vista=vista;
        url+=vac_id;
        $.post(url,dataToSend, function(data)
            {
            divListado.innerHTML="";  
            divListado.innerHTML=data;
            pintartabla("#td_archivos_vac");
            }).done(function(){
            }).fail(function(res){
              console.log(res.responseText);
        })

        
    }
   

</script>



{# INCIO MODALES ---------------------------------------------------------------------------------------------------------------------INICIO MODALES #}
<div class="modal fade" id="archivos_vac-modal" tabindex="-1" 
{# style="z-index:9041;display: none;" #}
style="z-index:99999;display: none;"
 aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5><div id="msae_archivo_vac"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
         <div class="row col ml-2">
            <div class="">
              
              <div id="contenedor_btn_categoria_vac">
                  {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50'), "data-toggle":"modal", "data-target":"#archivonuevo_vac-modal", "title":"Agregar archivos vacante",'id':'agregar-archivos-vac-general') }} 
              </div>
            </div>
            <div class="container d-flex justify-content-end" >
            </div>
          </div>
          <div class="modal-body">
            
            <div id="archivos_vac_listado">
            </div>
          </div>

         
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>



<div class="modal fade" id="archivonuevo_vac-modal" tabindex="99999999"  style="z-index:99999;display: none;" aria-labelledby="myModalLabel" aria-hidden="true" >
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
            <form id="frm_creararchivo_categoria_vac" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
              <div class="form-group row">
                <input type="hidden" id="vac_id-archivo" name="vac_id" />
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Categoría</label>
                   <div class="col-lg-12" id="ctv_id_texto"></div>
                </div>
                  <div class="col-12 " id="ctv_id-container">
                    <select name="ctv_id" id="ctv_id" class="form-control select2-single "   data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnarchivoscategoriaVac();">
                    </select>
                  </div>
                  
                </div>
               
                <div class="col-lg-12" id="divarchivo_vac">
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
{% include "/archivovac/acciones/leer-archivo.volt" %}
{% include "/archivovac/acciones/eliminar-js.volt" %}

{# fin includes #}

