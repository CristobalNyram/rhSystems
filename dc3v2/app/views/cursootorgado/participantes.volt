{{ stylesheet_link('plugins/datatables/datatables.min.css') }}
{{ javascript_include('plugins/datatables/datatables.min.js') }}

{{ stylesheet_link('css/datatables/css/dataTables.checkboxes.css') }}
{{ javascript_include('js/datatables/dataTables.checkboxes.min.js') }}
<script type="text/javascript">
function download_file(fileURL, fileName) {
    // for non-IE
    if (!window.ActiveXObject) {
        var save = document.createElement('a');
        save.href = fileURL;
        save.target = '_blank';
        var filename = fileURL.substring(fileURL.lastIndexOf('/')+1);
        save.download = fileName || filename;
         if ( navigator.userAgent.toLowerCase().match(/(ipad|iphone|safari)/) && navigator.userAgent.search("Chrome") < 0) {
        document.location = save.href; 
// window event not working here
      }else{
            var evt = new MouseEvent('click', {
                'view': window,
                'bubbles': true,
                'cancelable': false
            });
            save.dispatchEvent(evt);
            (window.URL || window.webkitURL).revokeObjectURL(save.href);
      } 
    }

    // for IE < 11
    else if ( !! window.ActiveXObject && document.execCommand)     {
        var _window = window.open(fileURL, '_blank');
        _window.document.close();
        _window.document.execCommand('SaveAs', true, fileName || fileURL)
        _window.close();
    }
}
    function GetSelected() {
        //Reference the Table.
        var grid = document.getElementById("participantes");
 
        //Reference the CheckBoxes in Table.
        var checkBoxes = grid.getElementsByTagName("INPUT");
        var message = '';
        var arreglo=[];
        var longitud=0;
        var jsondatos = {};

        //Loop through the CheckBoxes.
        for (var i = 1; i < checkBoxes.length; i++) {
            if (checkBoxes[i].checked) {
              longitud++;
                var row = checkBoxes[i].parentNode.parentNode;
                message += row.cells[1].innerHTML;
                // arreglo["value"]=row.cells[1].innerHTML;
                // arreglo.push(row.cells[1].innerHTML);
                arreglo.push({ 
                    "valor" : row.cells[1].innerHTML
                });
                // message += "   " + row.cells[2].innerHTML;
                // message += "   " + row.cells[3].innerHTML;
                message += ",";

            }
        }
        if(longitud==0){
          alert('No se ha seleccionado ningún registro, reintente');
          return false;
        }
        jsondatos.arreglo=arreglo;
        // console.log(arreglo);
        // var serie=JSON.stringify(arreglo);
        // console.log(jsondatos);
        var urlmasa="<?php echo $this->url->get('cursootorgado/dc3masa/') ?>";
        // $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urlmasa,
          data: jsondatos,
          success: function(res)
          {
            if(res[0]<=0)
            {
              alertify.alert("Error",res[1]);
            }
            else
            {
              // var x = document.baseURI;
              var url="<?php echo $this->url->get('reporte/reporte.pdf') ?>";
              // var url = "https://sipscap.com/dc3/reporte/reporte.pdf";
              var name ="Formatos_DC3.pdf";
              download_file(url, name);
             
              // cargarlista();
              // console.log(res);
              // alertify.alert("Exito","Trabajador editado correctamente.", function(){ 
              // marcar("act_"+res[1]) 
              // });

            }
            // $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          { 

            // $form.find("button").prop("disabled", false); 
          }
        });
        return false;
 
        //Display selected Row data in Alert Box.
        // alert(longitud+','+message);
    }

    function GetSelectedDiploma() {
        //Reference the Table.
        var grid = document.getElementById("participantes");
 
        //Reference the CheckBoxes in Table.
        var checkBoxes = grid.getElementsByTagName("INPUT");
        var message = '';
        var arreglo=[];
        var longitud=0;
        var jsondatos = {};

        //Loop through the CheckBoxes.
        for (var i = 1; i < checkBoxes.length; i++) {
            if (checkBoxes[i].checked) {
              longitud++;
                var row = checkBoxes[i].parentNode.parentNode;
                message += row.cells[1].innerHTML;
                arreglo.push({ 
                    "valor" : row.cells[1].innerHTML
                });
                message += ",";

            }
        }
        if(longitud==0){
          alert('No se ha seleccionado ningún registro, reintente');
          return false;
        }
        jsondatos.arreglo=arreglo;
        // console.log(jsondatos);
        var urlmasa="<?php echo $this->url->get('cursootorgado/diplomamasa/') ?>";
        // $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urlmasa,
          data: jsondatos,
          success: function(res)
          {
            if(res[0]<=0)
            {
              alertify.alert("Error",res[1]);
            }
            else
            {
              var url="<?php echo $this->url->get('reporte/diploma.pdf') ?>";
              // var url = "https://sipscap.com/dc3/reporte/diploma.pdf";
              var name ="Diplomas.pdf";
              download_file(url, name);
            }

          },
          error: function(res)
          { 

          }
        });
        return false;
    }

    function GetSelectedEliminar() {
        //Reference the Table.
      mensaje="¿Está seguro que desea eliminar los participantes seleccionados?";
      alertify.confirm("Eliminar actividad",mensaje, function()
      { 
    
        var grid = document.getElementById("participantes");
 
        //Reference the CheckBoxes in Table.
        var checkBoxes = grid.getElementsByTagName("INPUT");
        var message = '';
        var arreglo=[];
        var longitud=0;
        var jsondatos = {};

        //Loop through the CheckBoxes.
        for (var i = 1; i < checkBoxes.length; i++) {
            if (checkBoxes[i].checked) {
              longitud++;
                var row = checkBoxes[i].parentNode.parentNode;
                message += row.cells[1].innerHTML;
                arreglo.push({ 
                    "valor" : row.cells[1].innerHTML
                });
                message += ",";

            }
        }
        if(longitud==0){
          alert('No se ha seleccionado ningún registro, reintente');
          return false;
        }
        jsondatos.arreglo=arreglo;
        // console.log(jsondatos);
        var urlmasa="<?php echo $this->url->get('cursootorgado/eliminarmasa/') ?>";
        // $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urlmasa,
          data: jsondatos,
          success: function(res)
          {
            if(res[0]<=0)
            {
              alertify.alert("Error",res[1]);
            }
            else
            {
              alertify.alert("Operación exitosa","Se eliminaron "+res[1]+' registros');
              location.reload(); 
              // var url = "http://104.219.41.137/reporte/diploma.pdf";
              // var name ="Diplomas.pdf";
              // download_file(url, name);
            }

          },
          error: function(res)
          { 

          }
        });
        return false;
      }, function()
      { 
        alertify.error('No se eliminaron los participantes')
      }).set('labels', {ok:'Eliminar', cancel:'Cancelar'});
    }


</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();


    });
    $(document).ready(function() {
        divListado = document.getElementById('listado');
        var id_curso = $('#id_curso').val();
        url="<?php echo $this->url->get('cursootorgado/tablaparticipantes/"+id_curso+"') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            $('#participantes').DataTable(
              {
                "pageLength": 50,
                'columnDefs': [
                    {
                       'targets': 0,
                       'checkboxes': {
                          'selectRow': true
                       }
                    }
                 ],
                 'select': {
                    'style': 'multi'
                 },
                 'order': [[1, 'asc']],
                 scrollY:        "300px",
                  scrollX:        true,
                  scrollCollapse: true,
                  fixedColumns:   {
                      leftColumns: 0,
                      rightColumns: 1
                  }
              }
            );
        }).done(function() { 
        }).fail(function() {
        })
    } );

    function fncreate(cuo_id)
    {
      var ocupacion="<?php echo $this->url->get('ocupacion/ajax_ocupaciones/') ?>";
      // var urlfned="<?php echo $this->url->get('trabajador/buseditar/') ?>";
      var $subs = $('select[name="ocu_idcreate"]');
      var id_ocu=0;
      $("#cuo_idcrear").val(cuo_id);
      

      $.ajax({
            type: "POST",
            url: ocupacion,
            
            success: function(data)
            {
              // console.log(data);
                
                if (data.length > 0) {
                    $subs.append(function () {
                        var options = '';

                        $.each(data, function (key, ocu) {
                              options += '<option value="' + ocu.ocu_id + '">' +ocu.ocu_clave + '-' + ocu.ocu_denominacion+'</option>';
                        });

                        return options;
                    });
                }
            },
            error: function(res)
            {
                // $("#btn_aprobar").prop("disabled", false);
            }
        });
    }

    function fnedit(act,nombre,idparticipante)
    {
      var ocupacion="<?php echo $this->url->get('ocupacion/ajax_ocupaciones/') ?>";
      var urlfned="<?php echo $this->url->get('trabajador/buseditar/') ?>";
      var $subs = $('select[name="ocu_id"]');
      var id_ocu=0;
      // $subs.empty().append('<option value=-1>Seleccionar...</option>');
      $("#msae").html("Editar "+nombre); 
      $edtrabajador=act;
      $edparticipa=idparticipante;
      $.ajax(
      {
          type: "POST",
          url: urlfned+act+'/'+idparticipante,
          success: function(res)
          {
            $("#tra_nombre.sub").val(res[1])
            $("#tra_primerapellido.sub").val(res[2])
            $("#tra_segundoapellido.sub").val(res[3])
            $("#tra_curp.sub").val(res[4])
            $("#tra_puesto.sub").val(res[5])
            $("#tra_id").val(res[6])
            id_ocu=res[7];
            // $("#minutos.sub").val(res[6])
            // $("#usu_responsablesed").val(res[7])
            // $("#usu_responsablesed").trigger('change');
          }
        });

      $.ajax({
            type: "POST",
            url: ocupacion,
            
            success: function(data)
            {
              // console.log(data);
                // Agregar nuevos sub-departamentos
                if (data.length > 0) {
                    $subs.append(function () {
                        var options = '';

                        $.each(data, function (key, ocu) {
                            if(ocu.ocu_id==id_ocu){
                              options += '<option selected value="' + ocu.ocu_id + '">' +ocu.ocu_clave + '-' + ocu.ocu_denominacion+'</option>';
                            }
                            else
                              options += '<option value="' + ocu.ocu_id + '">' +ocu.ocu_clave + '-' + ocu.ocu_denominacion+'</option>';
                        });

                        return options;
                    });
                }
            },
            error: function(res)
            {
                // $("#btn_aprobar").prop("disabled", false);
            }
        });
    }
$(function (){
  $("#frm_editarparticipante").submit(function(event) 
  {
    /* Act on the event */
    var $form = $(this);
    var urled="<?php echo $this->url->get('trabajador/editar/') ?>";
    $form.find("button").prop("disabled", true);
    $.ajax({
      type: "POST",
      url: urled+$edtrabajador+'/'+$edparticipa,
      data: $("#frm_editarparticipante").serialize(),
      success: function(res)
      {
        if(res[0]<=0)
        {
          alertify.alert("Error",res[1]);
        }
        else
        {
          // cargarlista();
          alertify.alert("Exito","Trabajador editado correctamente.", function(){ 
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

  $("#frm_crearparticipante").submit(function(event) 
  {
    /* Act on the event */
    var $form = $(this);
    var urlcrear="<?php echo $this->url->get('trabajador/crear/') ?>";
    $form.find("button").prop("disabled", true);
    $.ajax({
      type: "POST",
      url: urlcrear,
      data: $("#frm_crearparticipante").serialize(),
      success: function(res)
      {
        if(res[0]<=0)
        {
          alertify.alert("Error",res[1]);
        }
        else
        {
          // cargarlista();
          alertify.alert("Exito","Trabajador creado correctamente.", function(){ 
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

    function fnelim(are,clave)
    {
        var urleliminarare="<?php echo $this->url->get('trabajador/eliminar/') ?>";
        var urlindexare="<?php echo $this->url->get('cursootorgado/participantes/') ?>";
        mensaje="¿Está seguro que desea eliminar el participante "+clave+"?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarare+are,
            success: function(res)
            {
              if(res[0]=='1')
              {
                // window.location=urlindexare+;
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

    function fncargar(id_curso,id_empresa){
        var field = document.getElementById('id_cuo');
        var field2 = document.getElementById('id_emp');
        field.value = id_curso;
        field2.value = id_empresa;
    }

</script>
{{ form('participantes/index#', 'id': 'userForm', 'onbeforesubmit': 'return false') }}
<div class="container">
    <center><h3>Participantes del curso "{{ curso }}" realizado a la empresa "{{ empresa }}"</h3></center>
    {% if id_admindirector==null %}
      <h1>No hay asignado ningún director para firmar los documentos</h1>
    {% endif %}
    <ul class="list-unstyled">
        <input id="id_curso" name="id_curso" type="hidden" value="{{id_curso}}">
        <input id="id_empresa" name="id_empresa" type="hidden" value="{{id_empresa}}">
        <li class="pull-left">
            {% if acceso.verificar(4)==1 %}
              <a onclick="fncargar({{id_curso}},{{id_empresa}});" data-toggle="modal" type="button" data-container="body" data-toggle="popover" role="button" data-target="#cargarparticipante"><i class="btn btn-btnempresa">Carga masiva de participantes</i></a>

              <a onclick="fncreate({{id_curso}});" data-toggle="modal" type="button" data-container="body" data-toggle="popover" role="button" data-target="#crearparticipante-modal"><i class="btn btn-btnempresa">Agregar participante</i></a>
            {% endif %}
            
        </li> 
    </ul>
</div>
<div id="listado">
</div>
</form>

<div id="cargarparticipante" class="modal fade" role="dialog">
  <div class="modal-dialog">
    {{ form('cursootorgado/participantenuevo', 'id': 'participantesform', 'enctype': 'multipart/form-data') }}
    <!-- <form enctype="multipart/form-data" action="cursootorgado/participantenuevo" method="POST" target="_self" id="participantesform"> -->
      <div class="modal-content" id="contentSession">
        <!--lo que esta entre esto cambia con ajax-->
        <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3><br>Cargar archivo de participantes</h3>
        </div>
        <div class="modal-body">
          <fieldset class="form-group">
            <div class="col-sm-4">
              <div class="form-group">
                <label for="sel1">Cargar archivo </label>
                <input type='hidden' id='id_cuo' name='id_cuo' value="">
                <input type='hidden' id='id_emp' name='id_emp' value="">
                <input type="file" id="participan" name='participan' accept=".xlsx">
              </div>
              
            </div>
            
            <button type="submit" class="btn btn-btnempresa btn-block" >Enviar</button>

          </fieldset>
        </div>
      </div>

    </form>
  </div>
</div>

<div class="modal fade" id="editarparticipante-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
            <form id="frm_editarparticipante" data-parsley-validate class="form-horizontal form-label-left captura">
              <input type="hidden" id="tra_id" name="tra_id" />
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Nombre del trabajador
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="tra_nombre" name="tra_nombre" required="required" class="sub form-control col-md-10 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Primer apellido del trabajador
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="tra_primerapellido" name="tra_primerapellido" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Segundo apellido del trabajador
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="tra_segundoapellido" name="tra_segundoapellido" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">CURP
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="tra_curp" name="tra_curp" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Puesto
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="tra_puesto" name="tra_puesto" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              

              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Ocupación
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <select id="ocu_id" name="ocu_id" class="js-example-placeholder-single form-control" style="width:100%">
                    <!-- <option>Seleccionar...</option> -->
                  </select>
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

<div class="modal fade" id="crearparticipante-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Agregar participante</h2>
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
            <form id="frm_crearparticipante" data-parsley-validate class="form-horizontal form-label-left captura">
              <input type="hidden" id="cuo_idcrear" name="cuo_idcrear" />
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Nombre del trabajador
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="tra_nombrec" onkeyup="javascript:this.value=this.value.toUpperCase();" name="tra_nombrec" required="required" class="sub form-control col-md-10 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Primer apellido del trabajador
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="tra_primerapellidoc" name="tra_primerapellidoc" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Segundo apellido del trabajador
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="tra_segundoapellidoc" name="tra_segundoapellidoc" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">CURP
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" id="tra_curpc" name="tra_curpc" required="required" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Puesto
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" required="required" id="tra_puestoc" name="tra_puestoc" class="sub form-control col-md-7 col-xs-12" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Ocupación
                </label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <select id="ocu_idcreate" name="ocu_idcreate" class="js-example-placeholder-single form-control" style="width:100%">
                    <!-- <option>Seleccionar...</option> -->
                  </select>
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

{% include "/historialdescarga/modal-historial.volt" %}