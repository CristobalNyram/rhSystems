<script type="text/javascript">
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('rol/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#td_rol').DataTable();
        }).done(function() { 
        }).fail(function() {
        })
    } );
    function fnelim(pue)
    {
        var urleliminarpue="<?php echo $this->url->get('rol/eliminar/') ?>";
        var urlindexpue="<?php echo $this->url->get('rol/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el rol con clave "+pue+"?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarpue+pue,
            success: function(res)
            {
              if(res[0]=='1')
              {
                window.location=urlindexpue;
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
{{ form('rol/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <h3>Roles</h3>
    <ul class="list-unstyled">
        <li class="pull-left">
            {{ link_to('rol/nuevo', '<i class="glyphicon glyphicon-plus"></i> Nuevo',"class": "btn btn-btnempresa") }}
            {% if acceso.verificar(42)==1 %}
            
            {% endif %}
        </li>
    </ul>
</div>
<div id="listado">
</div>
</form>