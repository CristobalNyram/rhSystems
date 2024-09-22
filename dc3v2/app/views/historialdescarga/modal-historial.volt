<script type="text/javascript">
	function historialdescarga(id_par,nombre){
		reciboListado = document.getElementById('historialdescargalistado');
        url="<?php echo $this->url->get('historialdescarga/tabla/') ?>";
        url+=id_par;
        $("#rec_idarchivo").val(id_par);
        $("#msae_historial").html("Historial de: "+nombre);
        
        $.post(url, $(this).serialize() , function(data)
        {
            $('#historialdescargalistado').html(data);
            $('#historialtable').DataTable(
            {
              "pageLength": 10
            });
        }).done(function() { 
        }).fail(function() {
        })
    }
</script>

<div class="modal fade" id="historialdescarga-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" id="mdialTamanio">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><div id="msae_historial"></div></h2>
            
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="dropdown-toggle" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="fa fa-close"></i>
                </a>
              </li>
            </ul>
            <div class="clearfix">

            </div>
          </div>
          <div class="x_content">
            <div id="historialdescargalistado">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>