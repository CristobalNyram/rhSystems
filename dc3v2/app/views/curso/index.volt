<script type="text/javascript">
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('curso/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#td_curso').DataTable(
            {
            "pageLength": 50
            });
        }).done(function() { 
        }).fail(function() {
        })
    } );
    function fnelim(cur, clave)
    {
        var urleliminarcur="<?php echo $this->url->get('curso/eliminar/') ?>";
        var urlindexcur="<?php echo $this->url->get('curso/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el país con clave "+clave+"?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarcur+cur,
            success: function(res)
            {
              if(res[0]=='1')
              {
                window.location=urlindexcur;
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
{{ form('curso/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <h3>Cursos</h3>
    <ul class="list-unstyled">
        <li class="pull-left">
            
            {{ link_to('curso/formulario', '<i class="glyphicon glyphicon-plus"></i> Nuevo',"class": "btn btn-btnempresa") }}
            
        </li>
    </ul>
</div>
<div id="listado">
</div>
</form>