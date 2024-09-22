{{ javascript_include('js/seguridad/sha256.js') }}
{{ javascript_include('js/seguridad/usuario.js') }}
<script type="text/javascript">
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('usuario/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#td_usuario').DataTable();
        }).done(function() { 
        }).fail(function() {
        })
    } );

    function fndetails(code){
        url="<?php echo $this->url->get('usuario/detalle/') ?>";
        url=url+code;
        $.ajax({
            type: "POST",
            url: url,
            success: function(res)
            {
                $('#contenido').html(res);
            },
            error: function(res)
            {
            }
        });
    }

    function fncambiarfoto(name,code){
        $("#usu_nombre").text(name);
        document.getElementById("usu_id").value = code;
        // document.getElementById("usu_nombre").value = name;
    } 
    function fncambiarcontra(code){
        contraadmin="<?php echo $this->url->get('usuario/cambiarcontraadmin/') ?>";
        $("#usu_nombre").text(name);
        document.getElementById("usu_id_contra").value = code;
        // document.getElementById("usu_nombre").value = name;
    }
    function fnelim(usu)
    {
        var urleliminarusu="<?php echo $this->url->get('usuario/eliminar/') ?>";
        var urlindexusu="<?php echo $this->url->get('usuario/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el usuario con clave "+usu+"?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarusu+usu,
            success: function(res)
            {
              if(res[0]=='1')
              {
                // alertify.alert("Ok","Registro eliminado correctamente.",function(){
                    window.location=urlindexusu;
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
{{ form('usuario/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <h3>Usuarios</h3>
    <ul class="list-unstyled">
        <li class="pull-left">
            {{ link_to('usuario/formulario', '<i class="glyphicon glyphicon-plus"></i> Nuevo',"class": "btn btn-btnempresa") }}
            <!-- {% if acceso.verificar(63)==1 %} -->
            
            <!-- {% endif %} -->
        </li>
    </ul>
</div>
<div id="listado">
</div>
</form>

<div id="cpassword" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form method="post" target="_self" id="formcpasswordadmin">
      <div class="modal-content" id="contentSession">
        <!--lo que esta entre esto cambia con ajax-->
        <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3><br>CAMBIAR CONTRASEÑA</h3>
        </div>
        <div class="modal-body">
          <fieldset class="form-group">
            <input type='hidden' id='usu_id_contra' name='usu_id_contra'>
            <input name="password1" type="password" class="form-control" id="password1" placeholder="Ingrese su nueva contraseña" required/><br>
            <input name="password2" type="password" class="form-control" id="password2" placeholder="Repita la contraseña" required/><br>
            <button type="submit" class="btn btn-btnempresa btn-block" >Cambiar contraseña</button>

          </fieldset>
        </div>
      </div>

    </form>
  </div>
</div>