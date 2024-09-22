
<script type="text/javascript">
  function reload_tabla_ent(){
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('vacante/entrevista_tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
        divListado.innerHTML=data;
        pintartabla("#td_entrevista");
        }).done(function(){
        }).fail(function(){
        })
  }
  $(document).ready(function()
  {
     reload_tabla_ent();
  });
</script>
{% include "/vacante/complementos/includes_entrevista.volt" %}
<div class="row">
    <div class="col-sm-6">
      <h4 class="header-title header-title-crm">Entrevista</h4>
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
  