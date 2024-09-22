<script>

function fnarchivoscategoria(){
    /* Para obtener el valor */
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

 

  function fncategoria(tipo_archivo=0){
    fncategoriaselect(tipo_archivo);
  }

  function fncategoriaselect(tipo_archivo=0){
    $('#divarchivo').empty();
    var categoria="<?php echo $this->url->get('categoria/ajax_categorias/') ?>";
    var $subscategoria = $('select[name="cat_id"]');
    $subscategoria.empty();
    $.ajax({
          type: "POST",
          url: categoria+'/'+tipo_archivo,
          
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

<div class="modal fade" id="archivonuevo-modal" tabindex="9999999999" aria-labelledby="myModalLabel" aria-hidden="true" >
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
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Categoría:</label>
                  {# <select name="cat_id" id="cat_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnarchivoscategoria();"> #}
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