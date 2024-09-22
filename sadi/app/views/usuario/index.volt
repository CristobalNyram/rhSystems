{{ javascript_include('js/seguridad/sha256.js') }}
{{ javascript_include('js/seguridad/usuario.js') }}
{% include "/estado/script-ajax-todos.volt" %}
{% include "/municipio/script-ajax-todos.volt" %}
<script type="text/javascript">
  $(function (){
    $("#frm_crearusuario").submit(function(event) 
    {
      if($("#usu_estatus").val()==-1){
        Swal.fire({title:'ERROR',text:'Debe seleccionar el estatus.',type:"error"})
          .then((value) => {
            // location.reload();  
            });
        return false;
      }
      if($("#rol_id").val()==-1){
        Swal.fire({title:'ERROR',text:'Debe seleccionar el rol.',type:"error"})
          .then((value) => {
          // location.reload();  
          });
        return false;
      }
        /* Act on the event */
      var $form = $(this);
      var urled="<?php echo $this->url->get('usuario/nuevo/') ?>";
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      $.ajax({
      type: "POST",
      url: urled,
      data: $("#frm_crearusuario").serialize(),
      success: function(res)
      {
        if(res[0]<=0)
        {
          Swal.fire({title:'Error',text:res[1],type:"error"})
            .then((value) => {
              location.reload();  
            });  
        }
        if(res[0]=='1')
        {
          Swal.fire({title:'Aviso',text:res[1],type:"warning"})
            .then((value) => {
              // location.reload();
            });
        }
        if(res[0]=='2')
        {
          Swal.fire({title:'Éxito',text:'Usuario creado correctamente.',type:"success"})
            .then((value) => {
              location.reload();  
            });
          }
        $form.find("button").prop("disabled", false); 
      },
      error: function(res)
      { 
        alert('Error en el servidor');
        $form.find("button").prop("disabled", false); 
      }
      });
      return false;
    });
  });

  $(document).ready(function() {
    divListado = document.getElementById('listado');
    url="<?php echo $this->url->get('usuario/tabla/') ?>";
    $.post(url, $(this).serialize() , function(data)
    {
        divListado.innerHTML=data;
        var table=$('#td_usuario').DataTable({
          "pageLength": 50,
          scrollY:        "300px",
          scrollX:        true,
          scrollCollapse: true,
          "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sSearch":         "Buscar:",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Personalizar",
                "excel":"Excel",
                "pdf":"PDF",
                "print":"PDF"
            }
          },
          buttons: ['excel', 
            {
              extend: 'pdfHtml5',
              orientation: 'landscape',
              pageSize: 'LEGAL',
              exportOptions: {
                columns: ":visible"
              },
              title: 'Usuarios'
            },
            'colvis'
          ]
        });

        table.buttons().container()
            .appendTo('#td_usuario_wrapper .col-md-6:eq(0)');
    }).done(function() { 
    }).fail(function() {
    })
  });

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
  } 
  function fncambiarcontra(code){
      contraadmin="<?php echo $this->url->get('usuario/cambiarcontraadmin/') ?>";
      $("#usu_nombre").text(name);
      document.getElementById("usu_id_contra").value = code;
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
              Swal.fire({title:'Ok',text:'Registro eliminado correctamente.',type:"success"})
              .then((value) => {
                window.location=urlindexusu;
              });
            }
            else
            {
              Swal.fire({title:'Error',text:'Ocurrio un error al eliminar el registro.',type:"error"})
              .then((value) => {
                // location.reload();  
              });
            }
          }
        });
      }, function()
      { 
      }).set('labels', {ok:'Eliminar', cancel:'Cancelar'});
    }
    function fncatalogos(){
      fnroles();
      fnempresas();
      fnestados();
      let form_ocupado=document.getElementById("frm_crearusuario");
      form_ocupado.reset();  
      $("#usu_est_id_alta").val("-1").change();
      $("#usu_mun_id_alta").empty();

     //fnestados_estados_adaptable(-1,$('#usu_est_id_alta'));
     // fnmunicipios_adaptable($('#usu_mun_id_alta'),-1,-1,"Selecciona un estado");
    }

    function fnroles()
    {
      var url_ajax="<?php echo $this->url->get('rol/ajax_roles/') ?>";
      var $subs_name = $('select[name="rol_id"]');
      $subs_name.empty();
      $.ajax({
        type: "POST",
        url: url_ajax,
        success: function(data)
        {
          if (data.length > 0) {
            $subs_name.append(function () {
              var options = '';
              options += '<option selected value="-1">Seleccionar</option>';
              $.each(data, function (key, dat) {
                  options += '<option value="' + dat.rol_id + '">' +dat.rol_nombre+'</option>';
              });
              return options;
            });
          }else{
            $subs_name.append(function () {
              var options = '';
              options += '<option selected value="-1">No aplica</option>';
              return options;
            });
          }
        },
        error: function(res)
        {
          alert('Error en el servidor...');
        }
      });
    }

    function fnempresas()
    {
      var url_ajax="<?php echo $this->url->get('empresa/ajax_empresas/') ?>";
      var $subs_name = $('select[name="emp_id"]');
      $subs_name.empty();
      $.ajax({
          type: "POST",
          url: url_ajax,
          success: function(data)
          {
            if (data.length > 0) {
              $subs_name.append(function () {
                var options = '';
                options += '<option selected value="-1">Seleccionar</option>';
                $.each(data, function (key, dat) {
                    options += '<option value="' + dat.emp_id + '">' +dat.emp_nombre+'</option>';
                });
                return options;
              });
            }else{
              $subs_name.append(function () {
                var options = '';
                options += '<option selected value="-1">No aplica</option>';
                return options;
              });
            }
          },
          error: function(res)
          {
          }
      });
    }

    function fnestados()
    {
      var url_ajax="<?php echo $this->url->get('estado/ajax_estados/') ?>";
      var $subs_name = $('select[name="est_id"]');
      $subs_name.empty();
      $.ajax({
          type: "POST",
          url: url_ajax,
          success: function(data)
          {
            if (data.length > 0) {
              $subs_name.append(function () {
                var options = '';
                options += '<option selected value="-1">Seleccionar</option>';
                $.each(data, function (key, dat) {
                    options += '<option value="' + dat.est_id + '">' +dat.est_nombre+'</option>';
                });
                return options;
              });
            }else{
              $subs_name.append(function () {
                var options = '';
                options += '<option selected value="-1">No aplica</option>';
                return options;
              });
            }
          },
          error: function(res)
          {
          }
      });
    }
</script>

<script>
  var lista_de_tipo_de_estudios=[];
  function fntipoestudio_crearusuario(){
    document.frm_crearhonorario_crearusuario.reset();
    fntipoestudioselect_crearusuario();
  }
 	
  function fntipoestudioselect_crearusuario()
  {
    let url="<?php echo $this->url->get('honorario/ajax_get_lista/') ?>";
    // var $usuario = $("#usu_idhonorario").val();
    let $select = $('select[name="tip_id_crearusuario"]');
    $select.empty();
    $.ajax({
      type: "POST",
      url: url,
      success: function(data)
      {
        if (data.length > 0) {
          $select.append(function () {
            var options = '';
            options += '<option selected value="-1">Seleccionar</option>';
            $.each(data, function (key, dat) {
            options += '<option value="' + dat.tip_id + '">' +dat.tip_nombre+'</option>';
            });
            return options;
          });
        }else{
          $subsnegocio.append(function () {
            var options = '';
            options += '<option selected value="-1">No aplica</option>';
            return options;
          });
        }
      },
      error: function(res)
      {
      }
    });
	}

  function fndetalleshonorario_general()
    {
	    let urlfned="<?php echo $this->url->get('honorario/detallestipoestudio/') ?>"; 
	    let id = $("#tip_id_crearusuario").val();
      let  ute_honorario=$("#ute_honorario_crearusuario");
      let ute_honorario2=   $("#ute_honorario2_crearusuario");
      let ute_honorario3= $("#ute_honorario3_crearusuario");
	    
      if(id==-1){
        ute_honorario.val(0);
        ute_honorario2.val(0);
        ute_honorario3.val(0);
        alert("Seleccione un tipo de estudio");
        return false;
	    }	    
	    $.ajax(
	    {
        type: "POST",
        url: urlfned+id,
        success: function(res)
        {
          if(res[0]<=0)
          {
            alertify.alert("Error",res[1]);
          }
          else
          {
            ute_honorario.val(res[1].tip_honorario);
            ute_honorario2.val(res[1].tip_honorario2);
            ute_honorario3.val(res[1].tip_honorario3);
          }
	      }
	    });
	}

  $(document).ready(()=>{
      let formHonorarioCrearUsuario=document.frm_crearhonorario_crearusuario;
      let btn_asignar_honorario_crear_usuario=document.querySelector('#btn_asignar_honorario_crear_usuario');
      
      formHonorarioCrearUsuario.addEventListener('submit',(e)=>{
        e.preventDefault();
        let tipo_estudio_verificar=formHonorarioCrearUsuario.tip_id_crearusuario.value;
        if(tipo_estudio_verificar>=1)
        { 
          let verificador_de_lista_tp=lista_de_tipo_de_estudios.includes(tipo_estudio_verificar);
          if(verificador_de_lista_tp)
          {
            alertify.alert('ERROR','Este tipo de estudio ya ha sido seleccionado.');
          }
          let honorario=formHonorarioCrearUsuario.ute_honorario_crearusuario.value;
          let honorario2=formHonorarioCrearUsuario.ute_honorario2_crearusuario.value;
          let honorario3=formHonorarioCrearUsuario.ute_honorario3_crearusuario.value;
          let honorarios=[honorario,honorario2,honorario3];

          if(verificador_de_lista_tp===false)
          {
            if(Numero_Si_EstaEnElRango(honorarios,Minimo=0,Maximo=500))
            {
              btn_asignar_honorario_crear_usuario.disabled = true;
              $('#crear_usuario_honorarionuevo-modal').hide(200,()=>{
                alertify.alert('Agregado','Se agregó un honorario a lista ',()=>{
                  fn_inputs_honorario_crear_usuario(formHonorarioCrearUsuario,verificador_de_lista_tp);
                });
              });
            }
            else
            {
              alertify.alert('ERROR','Los honorarios seleccionados no están en límite permitido.');
            }
          }
          else
          {
            alertify.alert('ERROR','Los honorarios seleccionados no están en límite permitido.');
          }
        } 
        else
        {
          alertify.alert('ERROR','Si quieres asignar un honorario, debes seleccionar al menos  una opción.');
        }
      },false)

      function fn_inputs_honorario_crear_usuario(form_object,verificador_de_lista_tp)
      {
        let ute_id =$("#tip_id_crearusuario option:selected").val();
        if (form_object.tip_id_crearusuario.value>=1 && lista_de_tipo_de_estudios.includes(ute_id)==false) {
          let ute_honorario=form_object.ute_honorario_crearusuario.value;
          let ute_honorario2= form_object.ute_honorario2_crearusuario.value;
          let ute_honorario3=form_object.ute_honorario3_crearusuario.value;
          let ute_id_opciones = document.getElementById("tip_id_crearusuario");
          let  ute_nombre_selecionado = ute_id_opciones.options[ute_id_opciones.selectedIndex].text;
          
          lista_de_tipo_de_estudios.push(ute_id);

          let ute_data={};
          ute_data.ute_id=ute_id;
          ute_data.ute_nombre=ute_nombre_selecionado;
          ute_data.ute_honorario=ute_honorario;
          ute_data.ute_honorario2=ute_honorario2;
          ute_data.ute_honorario3=ute_honorario3;

          let ute_data_transformada=JSON.stringify(ute_data);
          

          let inputs=`<div class="honorario-row row">
                      <div class="col-1  d-flex justify-content-end align-items-center"">
                        <button class="btn btn-danger btn-sm rounded-0 btn-delete-row" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="borrar_esta_row_crear_honorario(event,${ute_id})"><i class="mdi mdi-delete"></i></button>
                      </div>
                      <div class="col-lg-3">
                        <input type="hidden" name="ute[${ute_id}][tip_id]"  value="${ute_id}">
                        <label class="col-form-label title-busq">Tipo de estudio</label>
                        <input  type="text" disabled class="form-control input-rounded-disabled" placeholder="" minlength="2" value="${ute_nombre_selecionado}" maxlength="20" />
                      </div>
                      <div class="col-lg-3 ">
                        <label class="col-form-label title-busq">Honorario</label>
                        <input   type="number" name="ute[${ute_id}][ute_honorario]" class="form-control input-rounded" placeholder="honorario " value="${ute_honorario}"  readonly="readonly" />
                      </div>
                      <div class="col-lg-2">
                        <label class="col-form-label title-busq">Honorario 2</label>
                        <input  type="number"  name="ute[${ute_id}][ute_honorario2]" class="form-control input-rounded" placeholder="honorario 2"   value="${ute_honorario2}"  readonly="readonly"/>
                      </div>
                      <div class="col-lg-2">
                        <label class="col-form-label title-busq">Honorario 3</label>
                        <input  type="number"  name="ute[${ute_id}][ute_honorario3]" class="form-control input-rounded" placeholder="honorario 3"  value="${ute_honorario3}" readonly="readonly" />
                      </div> 
                    </div>`;
          $('#honorario_agregar_inputs').append(inputs);
          btn_asignar_honorario_crear_usuario.disabled = false;
          formHonorarioCrearUsuario.reset();
        }
      }
  }
  
  );
  function borrar_esta_row_crear_honorario(event,tip_id)
  { 
    //targetamos el botón =li
    let btn= event.target;
    //esta accede al padre,del padre hasta llegar al row
    let row_del_btn=btn.parentElement.parentElement.parentElement;
    row_del_btn.remove();

    alertify.alert('Borrar','Borraste un honorario de la lista ',
      ()=>{
        // Removing the specified element by value from the array
        for (let i = 0; i < lista_de_tipo_de_estudios.length; i++) 
        {
          if (lista_de_tipo_de_estudios[i] == tip_id) 
          {
            lista_de_tipo_de_estudios.splice(i,1);
          }
        }
      }
    );            
  }
</script>
<div class="row">
  <div class="col-6">
      <h4 class="header-title header-title-crm">Usuarios</h4>
  </div>
  <div class="col-6">
      <div class="text-right">
          {{ link_to('', 'data-target':'#modal_usuario', "onclick":"fncatalogos()", 'data-toggle':'modal', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'60'))  }}
      </div>
  </div>
</div>
<div class="mt-3">
    <div class="card card-crm">
        <div id="listado">
        </div>
    </div>
</div>

<div class="modal fade" id="cpassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content" id="contentSession"> 
      <div class="modal-header text-center">
        <h5 class="" id="exampleModalLabel"><br>CAMBIAR CONTRASEÑA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" target="_self" id="formcpasswordadmin" class="form-vertical mt-1">
          <div class="col-lg-12">
            <label class="col-form-label title-busq">Ingrese su nueva contraseña</label>
            <input   name="password1" type="password" class="form-control input-rounded" id="password1" autocomplete="off" placeholder="Ingrese su nueva contraseña" required />
            <input type='hidden' id='usu_id_contra' name='usu_id_contra'>
          </div>
          <div class="col-lg-12">
            <label class="col-form-label title-busq">Repita la contraseña</label>
            <input   name="password2" type="password" class="form-control input-rounded" id="password2" autocomplete="off" placeholder="Ingrese su nueva contraseña" required />
          </div>
          <div class="col-lg-12 m-5">
          </div>
          <div class="col-lg-12    text-center d-flex justify-content-end ">
            <div class="form-group col-lg-3 ">
              <button class="btn-dark btn-rounded btn btn-limpiar"  data-dismiss="modal"  ><i class=" mdi mdi-close white"></i>  Cancelar</button>
            </div> 
            <div class="form-group col-lg-3">
              <button class="btn-dark btn-rounded btn btn-buscar">Cambiar  <i class="mdi mdi-key-change white"></i> </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel">Crear Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_crearusuario" class="form-vertical mt-1">
          <div class="form-group row">
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Nombre</label>
              <input id="usu_nombre" name="usu_nombre" maxlength="155" type="text" class="form-control input-rounded data-not-lt-active" minlength="2" placeholder="Nombre(s)" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Primer apellido</label>
              <input id="usu_primerapellido" name="usu_primerapellido"  type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido" maxlength="255" minlength="1" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Segundo apellido</label>
              <input id="usu_segundoapellido" name="usu_segundoapellido" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido" maxlength="255" oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Correo</label>
              <input id="usu_correo" name="usu_correo" type="email" class="form-control input-rounded" maxlength="255" placeholder="Correo" required />
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Contraseña</label>
              <input id="usu_contrasena" name="usu_contrasena" type="password" class="form-control input-rounded" minlength="2"  maxlength="255" autocomplete="off" placeholder="Contraseña" required/>
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq">Estatus</label>
              <select name="usu_estatus" id="usu_estatus" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option selected value="-1">Seleccione</option>
                <option value="1">Baja</option>
                <option value="2">Alta</option>
              </select>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Rol</label>
              <select name="rol_id" id="rol_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option selected value="-1">Seleccione un Rol</option>
              </select>
            </div>
            
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Teléfono</label>
              <input id="usu_telefono" name="usu_telefono" type="text" class="form-control input-rounded" placeholder="Teléfono" minlength="2" maxlength="20"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Celular</label>
              <input id="usu_celular" name="usu_celular" type="text" class="form-control input-rounded" placeholder="Celular" minlength="2" maxlength="20" />
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Contacto adicional</label>
              <input id="usu_adicional" name="usu_adicional" type="text" class="form-control input-rounded" placeholder="Contacto adicional" maxlength="155"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">RFC</label>
              <input id="usu_rfc" name="usu_rfc" type="text" class="form-control input-rounded"  required placeholder="RFC" minlength="12" maxlength="13" oninput="handleInput(event)" />
            </div>
            
            <div class="col-lg-6">
              <label class="col-form-label title-busq">Estado</label>
              <select name="est_id" id="usu_est_id_alta" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange='fnmunicipios_adaptable($("#usu_mun_id_alta"),$("#usu_est_id_alta").val(),-1,"Selecciona un estado")'>
                <option selected value="-1">Seleccione un estado</option>
              </select>
            </div>
            <div class="col-lg-6">
              <label class="col-form-label title-busq">Municipio</label>
              <select name="mun_id" id="usu_mun_id_alta" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option selected value="-1">Seleccione un estado</option>
              </select>
            </div>


            <!-- input para mandar al back los tipos de estudios -->
            <input type="hidden" name="ute"  value="">
            <div class="col-12">
              <div class="d-flex justify-content-end align-items-center">
                <div class=""> 
                  <span class="font-weight-bold">Agregar honorarios </span>
                  {{ link_to('#', image("assets/images/small/boton-money2.svg", "onclick":"fntipoestudio_crearusuario()", 'class':'boton-plus', 'height':'50'), "data-toggle":"modal", "data-target":"#crear_usuario_honorarionuevo-modal", "title":"Agregar honorario") }}
                </div>
              </div>
              <!--Esta seccció exclusivamente para las rows de honorario creados para usuarios
              incio  -->
                <div class="col-12 row" id="honorario_agregar_inputs">
                </div>
              <!--Esta seccció exclusivamente para las rows de honorario creados para usuarios
              fin  -->
             </div>          
            <div class="row col-lg-12">
              <div class="col-sm-6 col-md-6 text-center mt-5">
              </div>
              <div class="col-sm-3 col-md-3 text-center mt-5">
                <div class="form-group">
                  <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
                </div>
              </div>
              <div class="col-sm-3 col-md-3  text-center mt-5 ">
                <div class="form-group">
                  <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                </div>
              </div>
            </div>
          </div>
        </form>      
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="crear_usuario_honorarionuevo-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="">Honorarios</div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_crearhonorario_crearusuario" name="frm_crearhonorario_crearusuario" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
              <div class="form-group row">
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Tipo de estudio</label>
                  <select name="tip_id_crearusuario" id="tip_id_crearusuario" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fndetalleshonorario_general();">
                  </select>
                </div>
                <div class="col-lg-4">
					        <label class="col-form-label title-busq">Honorario</label>
                  <input id="ute_honorario_crearusuario" name="ute_honorario_crearusuario"     type="number"  min="0" max="500"  class="form-control input-rounded" placeholder="Honorario" oninput="limitDecimalPlaces(event, 2)"/>
                </div>
                <div class="col-lg-4">
					        <label class="col-form-label title-busq">Honorario 2</label>
                  <input id="ute_honorario2_crearusuario" name="ute_honorario2_crearusuario"  type="number"    min="0." max="500" class="form-control input-rounded" placeholder="Honorario 2" oninput="limitDecimalPlaces(event, 2)"/>
                </div>
                <div class="col-lg-4">
				        	<label class="col-form-label title-busq">Honorario 3</label>
                  <input id="ute_honorario3_crearusuario" name="ute_honorario3_crearusuario"    type="number" min="0" max="500" class="form-control input-rounded" placeholder="Honorario 3" oninput="limitDecimalPlaces(event, 2)"/>
                </div>
                <div class="row col-lg-12">
                  <div class="col-sm-6 col-md-6 text-center mt-5">
                  </div>
                  <div class="col-sm-3 col-md-3 text-center mt-5">
                    <div class="form-group">
                      <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3  text-center mt-5 ">
                    <div class="form-group">
                      <button type="submit" id="btn_asignar_honorario_crear_usuario" class="btn-dark btn-rounded btn btn-buscar">Asignar</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>
{% include "/usuario/ajax-get-roles.volt" %}
{% include "/usuario/ajax-get-empresas.volt" %}
{% include "/usuario/ajax-get-estatus.volt" %}
{% include "/usuario/editar_modal-js.volt" %}
{% include "/honorario/modal-js.volt" %}
{% include "/documentousuario/modal-js.volt" %}