<script type="text/javascript">
    $(document).ready(function() {
        estatus=0;
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('administrador/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#administrador').DataTable(
            {
              "pageLength": 50
            });
        }).done(function() { 
        }).fail(function() {
        })
    } );
    $(function (){
        $("#frm_creardirector").submit(function(event) 
        {
          /* Act on the event */
          var $form = $(this);
          var urlcreardir="<?php echo $this->url->get('administrador/creardirector/') ?>";
          $form.find("button").prop("disabled", true);
          $.ajax({
            type: "POST",
            url: urlcreardir,
            data: $("#frm_creardirector").serialize(),
            success: function(res)
            {
              if(res[0]<=0)
              {
                alertify.alert("Error",res[1]);
              }
              else
              {
                // cargarlista();
                alertify.alert("Éxito","Director creado correctamente.", function(){ 
                  location.reload(); 
                });

              }
              $form.find("button").prop("disabled", false); 
            },
            error: function(res)
            { 

              $form.find("button").prop("disabled", false); 
            }
          });
          return false;
        });

        $("#frm_editardirector").submit(function(event) 
        {
        /* Act on the event */
            var $form = $(this);
            var urled="<?php echo $this->url->get('administrador/editardirector/') ?>";
            $form.find("button").prop("disabled", true);
                $.ajax({
                  type: "POST",
                  url: urled+$eddir,
                  data: $("#frm_editardirector").serialize(),
                  success: function(res)
                  {
                    if(res[0]<=0)
                    {
                      alertify.alert("Error",res[1]);
                    }
                    else
                    {
                      // cargarlista();
                      alertify.alert("Éxito","Director editado correctamente.", function(){ 
                        location.reload();
                      });

                    }
                    $form.find("button").prop("disabled", false); 
                  },
                  error: function(res)
                  { 

                    $form.find("button").prop("disabled", false); 
                  }
                });
            return false;
        });
    });

    function fncambiarfoto(name,code){
        $("#adm_nombre").text(name);
        document.getElementById("adm_id").value = code;
        // document.getElementById("usu_nombre").value = name;
    } 

    function fncambiarfirma(name,code){
        $("#adm_nombrefirma").text(name);
        document.getElementById("adm_idfirma").value = code;
        // document.getElementById("usu_nombre").value = name;
    }

    function fnelim(are)
    {
        var urleliminarare="<?php echo $this->url->get('administrador/eliminar/') ?>";
        var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el administrador con clave "+are+"?";
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

    function fnelimdir(adm,nombredir)
    {
        var urleliminardir="<?php echo $this->url->get('administrador/eliminardirector/') ?>";
        // var urlindexare="<?php echo $this->url->get('centrotrabajo/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el director "+nombredir+"?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminardir+adm,
            success: function(res)
            {
              if(res[0]=='1')
              {
                location.reload();
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

    function fncreatedir(adm)
    {
      $("#adm_idcrear").val(adm);
    }

    function fnedit(id, nombre)
    {
      var urlfned="<?php echo $this->url->get('administrador/buseditardirector/') ?>";
      
      $("#msae").html("Editar "+nombre); 
      $eddir=id;
      $.ajax(
      {
          type: "POST",
          url: urlfned+id,
          success: function(res)
          {
            $("#adr_nombre.sub").val(res[1])
            $("#adr_primerapellido.sub").val(res[2])
            $("#adr_segundoapellido.sub").val(res[3])
            $("#adr_puesto.sub").val(res[4])
            
            // id_ocu=res[7];
            // $("#minutos.sub").val(res[6])
            // $("#usu_responsablesed").val(res[7])
            // $("#usu_responsablesed").trigger('change');
          }
        });

    }

    function fnliberar()
    {
      document.getElementById("adr_nombre").readOnly = false;
      document.getElementById("adr_primerapellido").readOnly = false;
      document.getElementById("adr_segundoapellido").readOnly = false;
      document.getElementById("adr_puesto").readOnly = false;
      estatus=0;
      
    }

    function bloquear(num)
    {
      
      if(num==1 && estatus==0)
      {
        document.getElementById("adr_primerapellido").readOnly = true;
        document.getElementById("adr_segundoapellido").readOnly = true;
        document.getElementById("adr_puesto").readOnly = true;
        estatus=1;
      }
      if(num==2 && estatus==0)
      {
        document.getElementById("adr_nombre").readOnly = true;
        document.getElementById("adr_segundoapellido").readOnly = true;
        document.getElementById("adr_puesto").readOnly = true;
        estatus=1;
      }
      if(num==3 && estatus==0)
      {
        document.getElementById("adr_primerapellido").readOnly = true;
        document.getElementById("adr_nombre").readOnly = true;
        document.getElementById("adr_puesto").readOnly = true;
        estatus=1;
      }
      if(num==4 && estatus==0)
      {
        document.getElementById("adr_primerapellido").readOnly = true;
        document.getElementById("adr_segundoapellido").readOnly = true;
        document.getElementById("adr_nombre").readOnly = true;
        estatus=1;
      }
    }
</script>
{{ form('administrador/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <h3>Administrador</h3>
    <ul class="list-unstyled">
        <li class="pull-left">
            
            {{ link_to('administrador/formulario', '<i class="glyphicon glyphicon-plus"></i> Nuevo',"class": "btn btn-btnempresa") }}
            
        </li>
    </ul>
</div>
<div id="listado">
</div>
</form>

<div id="mdlcambiarfoto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3><br>Cambiar imagen de <span name='adm_nombre' id='adm_nombre'></span></h3>
            </div>
            <div class="modal-body">
                {{ form('administrador/cambiarfoto', 'method': 'post', 'enctype': 'multipart/form-data') }}
                    <input type='hidden' id='adm_id' name='adm_id'>
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

<div id="mdlcambiarfirma" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3><br>Cambiar firma de <span name='adm_nombrefirma' id='adm_nombrefirma'></span></h3>
            </div>
            <div class="modal-body">
                {{ form('administrador/cambiarfirma', 'method': 'post', 'enctype': 'multipart/form-data') }}
                    <input type='hidden' id='adm_idfirma' name='adm_idfirma'>
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

<div class="modal fade" id="crearDir-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Agregar director</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="dropdown-toggle" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="fa fa-close"></i>
                </a>
              </li>
            </ul>
            <div class="clearfix">

            </div>
          </div>
          <div class="x_content">
            <br />
            <form id="frm_creardirector" data-parsley-validate class="form-horizontal form-label-left captura">
              <input type="hidden" id="adm_idcrear" name="adm_idcrear" />
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Nombre del director
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="dir_nombrec" name="dir_nombrec" required="required" class="sub form-control col-md-10 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Primer apellido
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="dir_primerapellidoc" name="dir_primerapellidoc" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Segundo apellido
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="dir_segundoapellidoc" name="dir_segundoapellidoc" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Puesto
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="dir_puestoc" name="dir_puestoc" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <hr>
              <div class="ln_solid">
              </div>
              <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-6">
                  <button type="submit" class="btn btn-block add btn-btnempresa">Crear</button>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <button class="btn btn-block cancelar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editardirector-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><div id="msae"></div></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <a class="dropdown-toggle" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="fa fa-close"></i>
                </a>
              </li>
            </ul>
            <div class="clearfix">

            </div>
          </div>
          <div class="x_content">
            <br />
            <form id="frm_editardirector" data-parsley-validate class="form-horizontal form-label-left captura">
              <!-- <input type="hidden" id="adr_idedit" name="adr_idedit" /> -->
              <!-- <input type="hidden" id="tipocrear" name="tipocrear" /> -->
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Nombre del director
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="adr_nombre" onblur="bloquear(1);" name="adr_nombre" required="required" class="sub form-control col-md-10 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Primer apellido
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="adr_primerapellido" onblur="bloquear(2);" name="adr_primerapellido" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Segundo apellido
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="adr_segundoapellido" onblur="bloquear(3);" name="adr_segundoapellido" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Puesto
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="adr_puesto" onblur="bloquear(4);" name="adr_puesto" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <hr>
              <div class="ln_solid">
              </div>
              <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-6">
                  <button type="submit" class="btn btn-block add btn-btnempresa">Editar</button>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <button class="btn btn-block cancelar" onclick="fnliberar();" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>