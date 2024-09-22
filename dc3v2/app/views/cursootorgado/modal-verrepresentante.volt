<script type="text/javascript">
	function verrepresentante(id_par){
		reciboListado = document.getElementById('verrepresentantelistado');
        url="<?php echo $this->url->get('verrepresentante/tabla/') ?>";
        url+=id_par;
        $("#rec_idarchivo").val(id_par);
        // $("#msae_verrepresentante").html("Historial de: "+nombre);
        
        $.post(url, $(this).serialize() , function(data)
        {
            $('#verrepresentantelistado').html(data);
            $('#verrepresentantetable').DataTable(
            {
              "pageLength": 10
            });
        }).done(function() { 
        }).fail(function() {
        })
    }
</script>

<div class="modal fade" id="verrepresentante-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" id="mdialTamanio">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><div id="msae_verrepresentante"></div></h2>
            
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
            <div id="verrepresentantelistado">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>