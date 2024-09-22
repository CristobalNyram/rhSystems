<script type="text/javascript">
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('ocupacion/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#ocupacion').DataTable(
            {
                "pageLength": 50
            });
        }).done(function() { 
        }).fail(function() {
        })
    } );
    function fnelim(ocu,clave)
    {
        var urleliminarocu="<?php echo $this->url->get('ocupacion/eliminar/') ?>";
        var urlindexocu="<?php echo $this->url->get('ocupacion/index/') ?>";
        mensaje="¿Está seguro que desea eliminar la ocupación con clave "+clave+"?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarocu+ocu,
            success: function(res)
            {
              if(res[0]=='1')
              {
                window.location=urlindexocu;
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
{{ form('ocupacion/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <h3 class="uppercase">Ocupación</h3>
    <ul class="list-unstyled">
        <li class="pull-left">
            
            {{ link_to('ocupacion/formulario', '<i class="glyphicon glyphicon-plus"></i> Nuevo',"class": "btn btn-btnempresa") }}
            
        </li>
    </ul>
</div>
<div id="listado">
</div>
</form>