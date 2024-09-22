<script>

function fneditempresa(id,nombre,negocio)
    {
      var negocios="<?php echo $this->url->get('negocio/ajax_negocios/') ?>";
      var urlfned="<?php echo $this->url->get('empresa/buseditar/') ?>"; //trabajador
      
      var $negs = $('select[name="neg_ideditar"]');

      neg_iddetalle=typeof negocio !== typeof null ? negocio : "0";
      $negs.empty();
      // $("#msaedit_empresa").html("Editar "+nombre); 
      $edempresa=id;
      $.ajax(
      {
        type: "POST",
        url: urlfned+id,
        success: function(res)
        {
          if(res[0]<=0)
          {
            // $('#detallespoliza-modal').modal('hide');
            alertify.alert("Error",res[1]);
          }
          else
          {
            $("#emp_ideditar").val(res[1].emp_id);
            $("#emp_nombreeditar").val(res[1].emp_nombre);
            $("#emp_rfceditar").val(res[1].emp_rfc);
            
            $("#emp_aliaseditar").val(res[1].emp_alias);
          }
        }
      });

      $.ajax({
      type: "POST",
      url: negocios,
      success: function(data)
      {
        if (data.length > 0){
          $negs.append(function () {
          var options = '';
          options += '<option selected value="-1">Seleccionar</option>';
          $.each(data, function (key, dat) {
            
            if(dat.neg_id==neg_iddetalle && neg_iddetalle!="0"){
              options += '<option selected value="' + dat.neg_id + '">' +dat.neg_nombre +'</option>';
            }
            else
              options += '<option value="' + dat.neg_id + '">' +dat.neg_nombre + '</option>';
          });
          return options;
          });
        }
      },
      error: function(res)
      {
      }
    });

        
    }

  $(function (){
    $("#frm_editarempresa").submit(function(event) 
    {
      /* Act on the event */
      var $form = $(this);
      var urledtra="<?php echo $this->url->get('empresa/editar/') ?>";
      $form.find("button").prop("disabled", true);
      $.ajax({
        type: "POST",
        url: urledtra+$edempresa,
        data: $("#frm_editarempresa").serialize(),
        success: function(res)
        {
          if(res[0]<=0)
          {
            alertify.alert("Error",res[1]);
          }
          if(res[0]==1)
          {
            // cargarlista();
            alertify.alert("Éxito","Empresa editada correctamente.", function(){ 
              location.reload();
              
              // principal();
              // $('#editar_trabajador-modal-modal').modal('hide');
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

</script>

<div class="modal fade" id="editar_empresa-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="exampleModalLabel">Editar empresa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frm_editarempresa" class="form-vertical mt-1">
            <div class="form-group row">
  
                <input id="emp_ideditar"  style="display:none;" name="emp_ideditar" type="text" class="form-control input-rounded" minlength="2" placeholder="Nombre/Alias" required oninput="handleInput(event)"/>
            
  
              <div class="col-lg-5">
                <label class="col-form-label title-busq">Nombre de la empresa</label>
                <input id="emp_nombreeditar" maxlength="45" name="emp_nombreeditar" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Nombre" required oninput="handleInput(event)"/>
              </div>
             
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Alias</label>
                <input id="emp_aliaseditar" name="emp_aliaseditar" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Alias" maxlength="10" minlength="1" required oninput="handleInput(event)"/>
              </div>
  
              <div class="col-lg-4">
                <label class="col-form-label title-busq">RFC</label>
                <input id="emp_rfceditar" name="emp_rfceditar" type="text" class="form-control input-rounded data-not-lt-active" placeholder="RFC" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
              </div>
      
              <div class="col-lg-4" >
                  <label class="col-form-label title-busq">GRUPO DE NEGOCIO</label>
                  <select name="neg_ideditar" id="neg_ideditar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                    <option selected value="-1">Seleccione</option>
                  </select>
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