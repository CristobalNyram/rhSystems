<script type="text/javascript">
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('documento/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#td_documento').DataTable();
        }).done(function() { 
        }).fail(function() {
        })
    } );
</script>
<script type="text/javascript">
function fnelim(doc)
  {
    var urleliminardoc="<?php echo $this->url->get('documento/eliminar/') ?>";
    var urlindexdoc="<?php echo $this->url->get('documento/index/') ?>";
    mensaje="¿Está seguro que desea eliminar el documento con clave "+doc+"?";
    alertify.confirm("Eliminar registro",mensaje, function()
    { 
      $.ajax({
        type: "POST",
        url: urleliminardoc+doc,
        success: function(res)
        {
          if(res[0]=='1')
          {
            // alertify.alert("Ok","Registro eliminado correctamente.",function(){
                window.location=urlindexdoc;
            // });            
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
{{ form('documento/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <h3>Documentos</h3>
    <ul class="list-unstyled">
        <li class="pull-left">
            {{ link_to('documento/nuevo', '<i class="glyphicon glyphicon-plus"></i> Nuevo',"class": "btn btn-btnempresa") }}
        </li>
    </ul>
</div>
<div id="listado">
</div>
</form>