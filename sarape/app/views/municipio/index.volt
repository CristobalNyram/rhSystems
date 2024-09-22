<script type="text/javascript">

 


  $(function (){
      $("#frm_crear").submit(function(event) 
      {
        
        /* Act on the event */
        var $form = $(this);
        var urled="<?php echo $this->url->get('municipio/nuevo/') ?>";
        a=$form.valid();
        if(a==false){
            return false;
        }
      $form.find("button").prop("disabled", true);
      $.ajax({
      type: "POST",
      url: urled,
      data: $("#frm_crear").serialize(),
      success: function(res)
      {
        if(res[0]<=0)
          {
            alertify.alert("Error",res[1]);
          }
          else
          {
            alertify.alert("Éxito","Registro creado correctamente.", function(){
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


    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('municipio/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            pintartabla("#td_table");
        }).done(function() { 
        }).fail(function() {
        })
    } );
  
  function fneditar(id,nombre)
  {
    var urlfned="<?php echo $this->url->get('municipio/buseditar/') ?>"; //trabajador
    $("#exampleModalLabelregistro").html("Editar "+nombre); 
    $edregistro=id;
    $.ajax(
    {
        type: "POST",
        url: urlfned+id,
        success: function(res)
        {
          if(res[0]<=0)
          {
            $('#editar-modal').modal('hide');
            alertify.alert("Error",res[1]);
          }
          else
          {
            $("#mun_claveeditar").val(res[1].mun_clave);
            $("#mun_nombreeditar").val(res[1].mun_nombre);
          }
          
        }
      });
  }

  $(function (){
    $("#frm_editar").submit(function(event) 
    {
      /* Act on the event */
      var $form = $(this);
      var urledregistro="<?php echo $this->url->get('municipio/editar/') ?>";
      $form.find("button").prop("disabled", true);
      $.ajax({
        type: "POST",
        url: urledregistro+$edregistro,
        data: $("#frm_editar").serialize(),
        success: function(res)
        {
          if(res[0]<=0)
          {
            alertify.alert("Error",res[1]);
          }
          else
          {
            alertify.alert("Éxito","Registro editado correctamente.", function(){ 
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

  function fneliminar(id,nombre)
    {
        var urleliminarest="<?php echo $this->url->get('municipio/eliminar/') ?>";
        mensaje="¿Está seguro que desea eliminar el municipio "+nombre+"?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarest+id,
            success: function(res)
            {
              if(res[0]=='1')
              {
                alertify.alert("Éxito","Registro eliminado correctamente.", function(){ 
                  location.reload();
                });
              }
              else
              {
                alertify.alert("Error","Ocurrio un error al eliminar el registro");
              }
            }
          });
        }, function()
        { 
        }).set('labels', {ok:'Eliminar', cancel:'Cancelar'}); 
    } 
</script>

<div class="row">
  <div class="col-sm-6">
    <h4 class="header-title header-title-crm">Municipios</h4>
  </div>
  <div class="col-sm-5">
    <div class="text-right curso" style="margin-top: 35px; font-weight: 600">
      <a href="#">NUEVO</a>
    </div>
  </div>
  <div class="col-sm-1">
  <div class="text-left">
    {{ link_to('', 'data-target':'#modal_nuevo', 'data-toggle':'modal', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'60'))  }}
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

<div class="modal fade" id="modal_nuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel">Crear</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_crear" class="form-vertical mt-1">
          <div class="form-group row">
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Clave</label>
              <input id="mun_clave" name="mun_clave" type="text" class="form-control input-rounded" placeholder="Clave" maxlength="10" oninput="handleInput(event)" placeholder="" required />
            </div>
            <div class="col-lg-9">
              <label class="col-form-label title-busq">Nombre</label>
              <input id="mun_nombre" name="mun_nombre" type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre" required maxlength="75"/>
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

<div class="modal fade" id="editar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabelregistro">Editar Municipio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_editar" class="form-vertical mt-1">
          <div class="form-group row">
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Clave</label>
              <input id="mun_claveeditar" name="mun_claveeditar" type="text" class="form-control input-rounded" maxlength="10" oninput="handleInput(event)" placeholder="" required />
            </div>
            <div class="col-lg-9">
              <label class="col-form-label title-busq">Nombre</label>
              <input id="mun_nombreeditar" name="mun_nombreeditar" type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Nombre(s)" required maxlength="75"/>
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