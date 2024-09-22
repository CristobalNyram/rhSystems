<script type="text/javascript">
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('pais/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#td_pais').DataTable();
        }).done(function() { 
        }).fail(function() {
        })
    } );
    function fnelim(pai)
    {
        var urleliminarpai="<?php echo $this->url->get('pais/eliminar/') ?>";
        var urlindexpai="<?php echo $this->url->get('pais/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el país con clave "+pai+"?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarpai+pai,
            success: function(res)
            {
              if(res[0]=='1')
              {
                window.location=urlindexpai;
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
{{ form('pais/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <h3>Países</h3>
    <ul class="list-unstyled">
        <li class="pull-left">
            {% if acceso.verificar(38)==1 %}
            {{ link_to('pais/nuevo', '<i class="glyphicon glyphicon-plus"></i> Nuevo',"class": "btn btn-btnempresa") }}
            {% endif %}
        </li>
    </ul>
</div>
<div id="listado">
</div>
</form>