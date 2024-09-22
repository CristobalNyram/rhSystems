<script type="text/javascript">
  $(document).ready(function()
  {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('tipovacante/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
        divListado.innerHTML=data;
        pintartabla("#td_vac_general");
        }).done(function(){
        }).fail(function(){
        })
  });
     
</script>
  
  <div class="row">
    <div class="col-sm-6">
      <h4 class="header-title header-title-crm">VACANTES/GENERAL</h4>
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
  
