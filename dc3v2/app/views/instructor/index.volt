<script type="text/javascript">
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('instructor/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#instructor').DataTable(
            {
              "pageLength": 50
            });
        }).done(function() { 
        }).fail(function() {
        })
    } );
    
    function fnelim(are,clave)
    {
        var urleliminarare="<?php echo $this->url->get('instructor/eliminar/') ?>";
        var urlindexare="<?php echo $this->url->get('instructor/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el instructor con clave "+clave+"?";
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

    function fncambiarfirma(name,code){
        $("#ins_nombrefirma").text(name);
        document.getElementById("ins_idfirma").value = code;
        // document.getElementById("usu_nombre").value = name;
    }
</script>
{{ form('instructor/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <h3>Instructor</h3>
    <ul class="list-unstyled">
        <li class="pull-left">
            
            {{ link_to('instructor/formulario', '<i class="glyphicon glyphicon-plus"></i> Nuevo',"class": "btn btn-btnempresa") }}
            
        </li>
    </ul>
</div>
<div id="listado">
</div>
</form>

<div id="mdlcambiarfirma" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3><br>Cambiar firma de <span name='ins_nombrefirma' id='ins_nombrefirma'></span></h3>
            </div>
            <div class="modal-body">
                {{ form('instructor/cambiarfirma', 'method': 'post', 'enctype': 'multipart/form-data') }}
                    <input type='hidden' id='ins_idfirma' name='ins_idfirma'>
                    <div class="row ">
                        
                        <div class="col-sm-12 col-xs-12">
                            <center><label>Imagen</label></center>
                            <center><input type='file' name='files' accept="image/png, image/jpg, image/jpeg" required></center>
                        </div>

                    </div>
                    <!-- <input type='text' id='usu_id' name='usu_id'> -->
                     <!-- <input type='file' name='files' accept="image/png, image/jpg, image/jpeg"> -->
                     <div class="row">
                        <div class="col-xs-3 pull-right">
                            <input class="btn-block btn-btnempresa submit " type='submit' value='Aceptar'>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>