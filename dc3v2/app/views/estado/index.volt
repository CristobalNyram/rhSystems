<script type="text/javascript">
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('estado/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#td_estado').DataTable();
        }).done(function() { 
        }).fail(function() {
        })
    } );
    function fnelim(est)
    {
        var urleliminarest="<?php echo $this->url->get('estado/eliminar/') ?>";
        var urlindexest="<?php echo $this->url->get('estado/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el estado con clave "+est+"?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarest+est,
            success: function(res)
            {
              if(res[0]=='1')
              {
                window.location=urlindexest;
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
{{ form('estado/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <h3>Estados</h3>
    <ul class="list-unstyled">
        <li class="pull-left">
            {% if acceso.verificar(11)==1 %}
            {{ link_to('estado/nuevo', '<i class="glyphicon glyphicon-plus"></i> Nuevo',"class": "btn btn-btnempresa") }}
            {%endif%}
        </li>
    </ul>
</div>
<div id="listado">
</div>
</form>