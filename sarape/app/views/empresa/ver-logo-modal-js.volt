<script>
    function fnVerLogo(emp_id)
    {
     $("#emp_nombre_modal_ver_logo").text('');
      readarchivo='';
      readarchivo="<?php echo $this->url->get() ?>";
      tipo='images/logoempresa';
      readarchivo+=tipo+'/';


      let urlfned="<?php echo $this->url->get('empresa/buseditar/') ?>"; //trabajador
     
      $.ajax(
      {
        type: "POST",
        url: urlfned+emp_id,
        success: function(res)
        {
          if(res[0]<=0)
          {
            // $('#detallespoliza-modal').modal('hide');
            alertify.alert("Error",res[1]);
          }
          else
          {
            // $("#emp_ideditar").val(res[1].emp_id);
            // $("#emp_nombre_modal_ver_logo").text(res[1].emp_nombre);

            $("#emp_nombre_modal_ver_logo").text(res[1].emp_alias);
            readarchivo+= unescape(encodeURIComponent(res[1].emp_logo));
            $("#archivoread_empresa").attr('src', readarchivo);

          }
        }
      });

    }
</script>

<div class="modal  fade" id="ver_logo_empresa-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-semi-chico">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="exampleModalLabel">Logo de la empresa <span id="emp_nombre_modal_ver_logo"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
                <iframe id="archivoread_empresa" class="justi" name="archivoread_empresa" src="" frameborder="0" width="100%" height="auto" style="height: 70vh;"></iframe>


        </div>

      </div>
    </div>

  </div>