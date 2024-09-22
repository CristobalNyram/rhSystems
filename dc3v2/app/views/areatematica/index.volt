<script type="text/javascript">
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('areatematica/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#areatematica').DataTable(
                {
                "pageLength": 50
                }
            );
        }).done(function() { 
        }).fail(function() {
        })
    } );
    function fnelim(are,clave)
    {
        var urleliminarare="<?php echo $this->url->get('areatematica/eliminar/') ?>";
        var urlindexare="<?php echo $this->url->get('areatematica/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el área con clave "+clave+"?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarare+are,
            success: function(res)
            {
              if(res[0]=='1')
              {
                window.location=urlindexare;
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
{{ form('areatematica/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <h3 class="uppercase">Área temática</h3>
    <ul class="list-unstyled">
        <li class="pull-left">
            
            {{ link_to('areatematica/formulario', '<i class="glyphicon glyphicon-plus"></i> Nuevo',"class": "btn btn-btnempresa") }}
            
        </li>
    </ul>
</div>
<div id="listado">
</div>
</form>