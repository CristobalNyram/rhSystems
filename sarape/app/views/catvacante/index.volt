<script type="text/javascript">
  $(function (){
      $("#frm_crearnegocio").submit(function(event) 
      {
        /* Act on the event */
        var $form = $(this);
        var urled="<?php echo $this->url->get('catvacante/nuevo/') ?>";
        a=$form.valid();
        if(a==false){
            return false;
        }
      $form.find("button").prop("disabled", true);
      $.ajax({
      type: "POST",
      url: urled,
      data: $("#frm_crearnegocio").serialize(),
      success: function(res)
      {
        if(res[0]<=0)
          {
            Swal.fire({title:'Error',text:res[1],type:"error"})
            .then((value) => {
  
            });
          }
          else
          {
          Swal.fire({title:'Éxito',text:'Vacante creada correctamente.',type:"success"})
            .then((value) => {
              location.reload();
            });
        }
        $form.find("button").prop("disabled", false); 
      },
      error: function(res)
      { 
        alert('Error en el servidor...');
        $form.find("button").prop("disabled", false); 
      }
      });
      return false;
    });
  }); 

    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('catvacante/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            pintartabla("#td_catvacante");
        }).done(function() { 
        }).fail(function() {
        })
    } );
    function fnelinegocio(id_negocio,nombre_negocio)
    {
        var urleliminarempre="<?php echo $this->url->get('catvacante/eliminar/') ?>";
        mensaje="¿Está seguro que desea eliminar la vacante "+nombre_negocio+" ?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarempre+id_negocio,
            success: function(res)
            {     
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

    function fneditnegocio(id,nombre)
    {
    
      var urlfned="<?php echo $this->url->get('catvacante/buseditar/') ?>"; //trabajador
      $edempresa=id;
      $.ajax(
      {
        type: "POST",
        url: urlfned+id,
        success: function(res)
        {
          if(res[0]<=0)
          {
            alertify.alert("Error",res[1]);
          }
          else
          {
            $("#cav_ideditar").val(res[1].cav_id);
            $("#cav_nombreeditar").val(res[1].cav_nombre);
          }
        }
      });
    }

  $(function (){
    $("#frm_editarnegocio").submit(function(event) 
    {
      /* Act on the event */
      var $form = $(this);
      var urledtra="<?php echo $this->url->get('catvacante/editar/') ?>";
      $form.find("button").prop("disabled", true);
      $.ajax({
        type: "POST",
        url: urledtra+$edempresa,
        data: $("#frm_editarnegocio").serialize(),
        success: function(res)
        {
          if(res[0]<=0)
          {
            alertify.alert("Error",res[1]);
          }
          if(res[0]==1)
          {
            alertify.alert("Éxito","Vacante editada correctamente.", function(){
              location.reload();
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

<div class="row">
  <div class="col-sm-6">
    <h4 class="header-title header-title-crm">Vacantes</h4>
  </div>
  <div class="col-sm-5">
    <div class="text-right curso" style="margin-top: 35px; font-weight: 600">
      <a href="#">NUEVA VACANTE</a>
    </div>
  </div>
  <div class="col-sm-1">
  <div class="text-left">
    {{ link_to('', 'data-target':'#Modal_negocio', 'data-toggle':'modal', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'60'))  }}
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

<div class="modal fade" id="Modal_negocio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel">Crear vacante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_crearnegocio" class="form-vertical mt-1">
          <div class="form-group row">
            <div class="col-lg-5">
              <label class="col-form-label title-busq">Nombre de la vacante</label>
              <input id="cav_nombre" name="cav_nombre" type="text" class="form-control input-rounded data-not-lt-active" minlength="2" placeholder="Nombre" required oninput="handleInput(event)"/>
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

<div class="modal fade" id="editar_negocio-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel">Editar vacante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_editarnegocio" class="form-vertical mt-1">
          <div class="form-group row">
            <input id="cav_ideditar" name="cav_ideditar" type="hidden" required/>
            <div class="col-lg-5">
              <label class="col-form-label title-busq">Nombre de la vacante</label>
              <input id="cav_nombreeditar" name="cav_nombreeditar" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Nombre" required oninput="handleInput(event)"/>
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