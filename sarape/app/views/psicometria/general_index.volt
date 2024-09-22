
<script type="text/javascript">


  function fnCargarTablaPsicometria(vac_id=0)
  {             
      
         
     divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('psicometria/general_tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
        divListado.innerHTML="";

        divListado.innerHTML=data;
        pintartabla("#td_psicometria_general");
        }).done(function(){
        }).fail(function(){
        })                
               
  }
  
   
  $(document).ready(function()
  {
   fnCargarTablaPsicometria();  
  });
     
</script>


{% include "/psicometria/complementos/includes_general.volt" %}


  <div class="row">
    <div class="col-sm-6">
      <h4 class="header-title header-title-crm">Psicometría</h4>
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
  


