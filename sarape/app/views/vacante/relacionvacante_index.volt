
<script type="text/javascript">
   function load_table_rel_vacOrder(){
    divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('vacante/relacionvacante_tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
        divListado.innerHTML=data;
       let config = {
        as_des: 'desc'
      };

        pintartabla("#td_vac_relacionvacante",0,config);
        fnConvertirDataTable('eje_detalles_dt')        

        }).done(function(){
        }).fail(function(){
        })
   }
  $(document).ready(function()
  {
    load_table_rel_vacOrder();

  });


  
     
</script>
  
  <div class="row">
    <div class="col-sm-6">
      <h4 class="header-title header-title-crm">Relación vacante</h4>
    </div>
    <div class="col-sm-5">
    
    </div>
    <div class="col-sm-1">
   
      </div>
  </div>
  
  <div class="mt-3" style="margin-top:0px!important">
      <div class="card card-crm">
          <div id="listado">
          </div>
      </div>
  </div>
  



{% include "/vacante/complementos/includes_permisos_relacionvacante.volt" %}

