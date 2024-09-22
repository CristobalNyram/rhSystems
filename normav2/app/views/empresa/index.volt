<script type="text/javascript">
    $(document).ready(function() {
      estatus=0;
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('empresa/tabla/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#empresa').DataTable(
            {
              "pageLength": 50
            });
        }).done(function() { 
        }).fail(function() {
        })
    } );
$(function (){
    $("#frm_editarrepresentante").submit(function(event) 
  {
    /* Act on the event */
    var $form = $(this);
    var urlindexare="<?php echo $this->url->get('empresa/index/') ?>";
    var urled="<?php echo $this->url->get('representante/editar/') ?>";
    $form.find("button").prop("disabled", true);
    $.ajax({
      type: "POST",
      url: urled+$edrep,
      data: $("#frm_editarrepresentante").serialize(),
      success: function(res)
      {
        if(res[0]<=0)
        {
          alertify.alert("Error",res[1]);
        }
        else
        {
          // cargarlista();
          alertify.alert("Exito","Representante editado correctamente.", function(){ 
          // marcar("act_"+res[1]) 
            window.location=urlindexare;
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

    $("#frm_crearrepresentante").submit(function(event) 
  {
    /* Act on the event */
    var $form = $(this);
    var urlcrearrep="<?php echo $this->url->get('representante/crear/') ?>";
    $form.find("button").prop("disabled", true);
    $.ajax({
      type: "POST",
      url: urlcrearrep,
      data: $("#frm_crearrepresentante").serialize(),
      success: function(res)
      {
        if(res[0]<=0)
        {
          alertify.alert("Error",res[1]);
        }
        else
        {
          // cargarlista();
          alertify.alert("Exito","Representante creado correctamente.", function(){ 
          // marcar("act_"+res[1]) 
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
    function fncreaterep(emp,tipo)
    {
      $("#emp_idcrear").val(emp);
      $("#tipocrear").val(tipo);
      
    }

    function fnliberar()
    {
      document.getElementById("rep_nombre").readOnly = false;
      document.getElementById("rep_primerapellido").readOnly = false;
      document.getElementById("rep_segundoapellido").readOnly = false;
      estatus=0;
      
    }

    function bloquear(num)
    {
      
      if(num==1 && estatus==0)
      {
        document.getElementById("rep_primerapellido").readOnly = true;
        document.getElementById("rep_segundoapellido").readOnly = true;
        estatus=1;
      }
      if(num==2 && estatus==0)
      {
        document.getElementById("rep_nombre").readOnly = true;
        document.getElementById("rep_segundoapellido").readOnly = true;
        estatus=1;
      }
      if(num==3 && estatus==0)
      {
        document.getElementById("rep_nombre").readOnly = true;
        document.getElementById("rep_primerapellido").readOnly = true;
        estatus=1;
      }
    }

    function fnedit(id, nombre)
    {
      // var ocupacion="<?php echo $this->url->get('ocupacion/ajax_ocupaciones/') ?>";
      var urlfned="<?php echo $this->url->get('representante/buseditar/') ?>";
      // var $subs = $('select[name="ocu_id"]');
      // var id_ocu=0;
      // $subs.empty().append('<option value=-1>Seleccionar...</option>');
      $("#msae").html("Editar "+nombre); 
      $edrep=id;
      $.ajax(
      {
          type: "POST",
          url: urlfned+id,
          success: function(res)
          {
            $("#rep_nombre.sub").val(res[1])
            $("#rep_primerapellido.sub").val(res[2])
            $("#rep_segundoapellido.sub").val(res[3])
            
            // id_ocu=res[7];
            // $("#minutos.sub").val(res[6])
            // $("#usu_responsablesed").val(res[7])
            // $("#usu_responsablesed").trigger('change');
          }
        });

    }

    function fncambiarfoto(name,code){
        $("#emp_razonsocial").text(name);
        document.getElementById("emp_id").value = code;
        // document.getElementById("usu_nombre").value = name;
    } 



    function fnelim(are)
    {
        var urleliminarare="<?php echo $this->url->get('empresa/eliminar/') ?>";
        var urlindexare="<?php echo $this->url->get('empresa/index/') ?>";
        mensaje="¿Está seguro que desea eliminar la empresa con clave "+are+"?";
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

    function fnelimrep(emp,tipo)
    {
        var urleliminarrep="<?php echo $this->url->get('representante/eliminar/') ?>";
        var urlindexare="<?php echo $this->url->get('empresa/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el representante?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarrep+emp+'/'+tipo,
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
{{ form('empresa/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <h3>Empresa</h3>
    <ul class="list-unstyled">
        <li class="pull-left">
            
            {{ link_to('empresa/formulario', '<i class="glyphicon glyphicon-plus"></i> Nuevo',"class": "btn btn-btnempresa") }}
            
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
                <h3><br>Cambiar imagen de <span name='emp_razonsocial' id='emp_razonsocial'></span></h3>
            </div>
            <div class="modal-body">
                {{ form('empresa/cambiarfoto', 'method': 'post', 'enctype': 'multipart/form-data') }}
                    <input type='hidden' id='emp_id' name='emp_id'>
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


<div class="modal fade" id="crearRepTra-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Agregar representante</h2>
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
            <form id="frm_crearrepresentante" data-parsley-validate class="form-horizontal form-label-left captura">
              <input type="hidden" id="emp_idcrear" name="emp_idcrear" />
              <input type="hidden" id="tipocrear" name="tipocrear" />
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Nombre del representante
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="rep_nombrec" name="rep_nombrec" required="required" class="sub form-control col-md-10 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Primer apellido del representante
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="rep_primerapellidoc" name="rep_primerapellidoc" class="sub form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Segundo apellido del representante
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="rep_segundoapellidoc" name="rep_segundoapellidoc" class="sub form-control col-md-7 col-xs-12">
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



<div class="modal fade" id="editarrepresentante-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
            <form id="frm_editarrepresentante" data-parsley-validate class="form-horizontal form-label-left captura">
              <input type="hidden" id="rep_idedit" name="rep_idedit" />
              <!-- <input type="hidden" id="tipocrear" name="tipocrear" /> -->
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Nombre del representante
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="rep_nombre" onblur="bloquear(1);" name="rep_nombre" required="required" class="sub form-control col-md-10 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Primer apellido del representante
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="rep_primerapellido" onblur="bloquear(2);" name="rep_primerapellido" class="sub form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Segundo apellido del representante
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="rep_segundoapellido" onblur="bloquear(3);" name="rep_segundoapellido" class="sub form-control col-md-7 col-xs-12">
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