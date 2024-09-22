
<script type="text/javascript">
  function reload_tabla_autorizacion(){

        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('vacante/autorizacion_tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
        divListado.innerHTML=data;
        pintartabla("#td_autorizacion");
        }).done(function(){
        }).fail(function(){
        })
  }
  $(document).ready(function()
  {
     reload_tabla_autorizacion();
  });

   
     
</script>


{% include "/vacante/complementos/includes_autorizacion.volt" %}


  <div class="row">
    <div class="col-sm-6">
      <h4 class="header-title header-title-crm">Autorización</h4>
    </div>
    <div class="col-sm-5">
    
    </div>
    <div class="col-sm-1">
   
      </div>
  </div>
  
  <div class="mt-3">
      <div class="card card-crm">
          <div id="listado">
          </div>
      </div>
  </div>
  



  </div>
  