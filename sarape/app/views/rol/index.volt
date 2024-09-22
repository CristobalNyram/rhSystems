<script type="text/javascript">
  $(document).ready(function() {
    divListado = document.getElementById('listado');
    url="<?php echo $this->url->get('rol/tabla/') ?>";
    $.post(url, $(this).serialize() , function(data)
    {
        divListado.innerHTML=data;
        pintartabla("#td_rol");
    }).done(function() { 
    }).fail(function() {
    })
  });
    
  function fnelim(pue)
  {
    var urleliminarpue="<?php echo $this->url->get('rol/eliminar/') ?>";
    var urlindexpue="<?php echo $this->url->get('rol/index/') ?>";
    mensaje="¿Está seguro que desea eliminar el rol con clave "+pue+"?";
    alertify.confirm("Eliminar registro",mensaje, function()
    { 
      $.ajax({
        type: "POST",
        url: urleliminarpue+pue,
        success: function(res)
        {
          if(res[0]=='1')
          {
            window.location=urlindexpue;
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
  <div class="col-6">
    <h4 class="header-title header-title-crm">Roles</h4>
  </div>
  <div class="col-6">
    <div class="text-right">
        {{ link_to('rol/nuevo', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'60')) }}
      <!-- <a href="#"><img src="dist/assets/images/small/boton.svg" class="boton-plus" height="60"></a> -->
    </div>
  </div>
</div>
<div class="mt-3">
    <div class="card card-crm">
        <div id="listado">
        </div>
    </div>
</div>