<script type="text/javascript">
  $(function (){
      $("#frm_crearnegocio").submit(function(event) 
      {
        
        /* Act on the event */
        var $form = $(this);
        var urled="<?php echo $this->url->get('negocio/nuevo/') ?>";
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
          // cargarlista();

          Swal.fire({title:'Éxito',text:'Negocio creado correctamente.',type:"success"})
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
        url="<?php echo $this->url->get('negocio/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            pintartabla("#td_negocio");
        }).done(function() { 
        }).fail(function() {
        })
    } );
    function fnelinegocio(id_negocio,nombre_negocio)
    {
        var urleliminarempre="<?php echo $this->url->get('negocio/eliminar/') ?>";
        mensaje="¿Está seguro que desea eliminar el negocio "+nombre_negocio+" ?";
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
    
    var urlfned="<?php echo $this->url->get('negocio/buseditar/') ?>"; //trabajador
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
          $("#neg_ideditar").val(res[1].neg_id);
          $("#neg_nombreeditar").val(res[1].neg_nombre);
          $("#neg_notaeditar").val(res[1].neg_nota);
        }
      }
    });

      
  }

  $(function (){
    $("#frm_editarnegocio").submit(function(event) 
    {
      /* Act on the event */
      var $form = $(this);
      var urledtra="<?php echo $this->url->get('negocio/editar/') ?>";
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
            // cargarlista();
            alertify.alert("Éxito","Negocio editado correctamente.", function(){ 
              location.reload();
              
              // principal();
              // $('#editar_trabajador-modal-modal').modal('hide');
            });

          }
          $form.find("button").prop("disabled", false); 
          console.log(res);

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
    <h4 class="header-title header-title-crm">Grupos de negocio</h4>
  </div>
  <div class="col-sm-5">
    <div class="text-right curso" style="margin-top: 35px; font-weight: 600">
      <a href="#">NUEVO GRUPO DE NEGOCIO</a>
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
        <h5 class="" id="exampleModalLabel">Crear Grupo de Negocio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_crearnegocio" class="form-vertical mt-1">
          <div class="form-group row">
            
            <div class="col-lg-5">
              <label class="col-form-label title-busq">Nombre del grupo de negocio</label>
              <input id="neg_nombre" name="neg_nombre" type="text" class="form-control input-rounded data-not-lt-active" minlength="2" placeholder="Nombre" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-7">
              <label class="col-form-label title-busq">Nota</label>
              <input id="neg_nota" name="neg_nota" type="text" class="form-control input-rounded" placeholder="Nota" maxlength="155" minlength="1" required oninput="handleInput(event)"/>
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
        <h5 class="" id="exampleModalLabel">Editar negocio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_editarnegocio" class="form-vertical mt-1">
          <div class="form-group row">
            <input id="neg_ideditar" name="neg_ideditar" type="hidden" required/>
            <div class="col-lg-5">
              <label class="col-form-label title-busq">Nombre del grupo de negocio</label>
              <input id="neg_nombreeditar" name="neg_nombreeditar" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Nombre" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-7">
              <label class="col-form-label title-busq">Nota</label>
              <input id="neg_notaeditar" name="neg_notaeditar" type="text" class="form-control input-rounded" placeholder="Nota" maxlength="155" minlength="1" required oninput="handleInput(event)"/>
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