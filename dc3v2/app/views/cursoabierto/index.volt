<script type="text/javascript">
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('cursoabierto/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#cursoabierto').DataTable(
            {
              "pageLength": 50,
              "order": [[ 2, "desc" ]],
              scrollY:        "300px",
              scrollX:        true,
              scrollCollapse: true,
              fixedColumns:   {
                  leftColumns: 0,
                  rightColumns: 1
              }
            });
        }).done(function() { 
        }).fail(function() {
        })
    } );
    function fnelim(are,clave)
    {
        var urleliminarare="<?php echo $this->url->get('cursoabierto/eliminar/') ?>";
        var urlindexare="<?php echo $this->url->get('cursoabierto/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el curso con clave "+clave+"?";
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
{{ form('cursoabierto/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <h3>Cursos abiertos</h3>
    <ul class="list-unstyled">
        <li class="pull-left">
            {% if acceso.verificar(2)==1 %}
                {{ link_to('cursoabierto/formulario', '<i class="glyphicon glyphicon-plus"></i> Nuevo',"class": "btn btn-btnempresa") }}
            {% endif %}
        </li>
    </ul>
</div>
<div id="listado">
</div>
</form>