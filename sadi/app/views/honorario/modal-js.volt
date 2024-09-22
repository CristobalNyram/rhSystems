<script type="text/javascript">
  $(function (){
      $("#frm_crearhonorario").submit(function(event) 
      {
        
        /* Act on the event */
        var $form = $(this);
        var urled="<?php echo $this->url->get('honorario/nuevo/') ?>";
        a=$form.valid();
        if(a==false){
            return false;
        }
        if($('#tip_id').val()==-1) 
        { 
          alertify.alert("Error","Debe seleccionar el tipo de estudio a asignar."); 
          return false; 
        } 
        let numbersArray=[$('#ute_honorario').val(),$('#ute_honorario2').val(),$('#ute_honorario3').val()];
        if(Numero_Si_EstaEnElRango(numbersArray,Min=0,Max=500)==false)
        {
          alertify.alert("Error","Los honorarios asignados debe estar en el límite establecido."); 
          return false; 

        }
      $form.find("button").prop("disabled", true);
      $.ajax({
      type: "POST",
      url: urled,
      data: $("#frm_crearhonorario").serialize(),
      success: function(res)
      {
        if(res[0]<=0)
          {
            alertify.alert("Error",res[1]);
          }
          else
          {
          // cargarlista();
            alertify.alert("Éxito","Honorario asignado correctamente.", function(){
            
            reloadhonorario(res[2],res[3]);
            document.getElementById("frm_crearhonorario").reset();
            $('#honorarionuevo-modal').modal('hide');
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
  	function fntipoestudio(){
    	fntipoestudioselect();
  	}

  	function fntipoestudioselect()
	{
	    var negocio="<?php echo $this->url->get('honorario/ajax_asigtipo/') ?>";
	    var $usuario = $("#usu_idhonorario").val();
	    var $subsnegocio = $('select[name="tip_id"]');
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio+$usuario,
	          
	        success: function(data)
	        {
				if (data.length > 0) {
					$subsnegocio.append(function () {
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

    function honorario(id_usu, nombre){
        reciboListado = document.getElementById('honorarioslistado');
        
        url="<?php echo $this->url->get('honorario/tabla/') ?>";
        url+=id_usu;
        $("#usu_idhonorario").val(id_usu);
        $("#msae_honorario").html("Honorarios de usuario: "+nombre);
        $.post(url, $(this).serialize() , function(data)
        {
            $('#honorarioslistado').html(data);
            $('#honorariotable').DataTable(
            {
              "pageLength": 10
            });
          // }
        }).done(function() { 
        }).fail(function() {
        })
    }

    function reloadhonorario(id_usu, nombre){
        document.getElementById("honorarioslistado").innerHTML="";
        reciboListado = document.getElementById('honorarioslistado');
        urlreload="<?php echo $this->url->get('honorario/tabla/') ?>";
        urlreload+=id_usu;
        $("#usu_idhonorario").val(id_usu);
        $("#msae_honorario").html("Honorarios de usuario: "+nombre);
        $.post(urlreload, $(this).serialize() , function(data)
        {
            $('#honorarioslistado').html(data);
            // divListado.innerHTML=data;
            $('#honorariotable').DataTable(
            {
              "pageLength": 10
            });
        }).done(function() { 
        }).fail(function() {
        })
    }

    function fndetalleshonorario()
    {
    
	    var urlfned="<?php echo $this->url->get('honorario/detallestipoestudio/') ?>"; //trabajador
	    var id = $("#tip_id").val();

	    if(id==-1){
			$("#ute_honorario").val(0);
            $("#ute_honorario2").val(0);
            $("#ute_honorario3").val(0);
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
	            $("#ute_honorario").val(res[1].tip_honorario);
	            $("#ute_honorario2").val(res[1].tip_honorario2);
	            $("#ute_honorario3").val(res[1].tip_honorario3);
	        }
	      }
	    });
	}

  function fneliminarhonorario(id_honorario,id_usu, nombre){
      var urleliminarare="<?php echo $this->url->get('honorario/eliminar/') ?>";
      // var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
      mensaje="¿Está seguro que desea eliminar el honorario?";
      alertify.confirm("Eliminar honorario",mensaje, function()
      { 
        $.ajax({
          type: "POST",
          url: urleliminarare+id_honorario,
          success: function(res)
          {
            if(res[0]=='1')
            {
              alertify.alert("Eliminado","El honorario ha sido eliminado correctamente");
              reloadhonorario(id_usu,res[1]);
              // window.location=urlindexare;
            }
            else 
            {
              if(res[0]=='-1'){
                alertify.alert("Error",res[1]);
              }
              else
              {
                alertify.alert("Error","Ocurrio un error al cambiar el estatus");
              }
            }
          }
        });
      }, function()
      { 
      }).set('labels', {ok:'Eliminar', cancel:'Cancelar'});
    }
</script>

<div class="modal fade" id="honorarios-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5><div id="msae_honorario"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="col-2">
           
            <div class="text-left">
              {{ link_to('#', image("assets/images/small/boton.svg", "onclick":"fntipoestudio()", 'class':'boton-plus', 'height':'50'), "data-toggle":"modal", "data-target":"#honorarionuevo-modal", "title":"Agregar honorario") }} 
            </div>
          </div>
          
          <div class="modal-body">
            
            <div id="honorarioslistado">
            </div>
          </div>
    </div>
  </div>
</div>

<div class="modal fade" id="honorarionuevo-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="msae_recibo"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_crearhonorario" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
              <div class="form-group row">
                <input type="hidden" id="usu_idhonorario" name="usu_idhonorario" />
                <div class="col-lg-4">
                  <label class="col-form-label title-busq">Tipo de estudio</label>
                  <select name="tip_id" id="tip_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fndetalleshonorario();">
                  </select>
                </div>
                <div class="col-lg-4">
					<label class="col-form-label title-busq">Honorario</label>
                    <input id="ute_honorario" name="ute_honorario" type="number" class="form-control input-rounded" placeholder="Honorario" oninput="limitDecimalPlaces(event, 2)"/>
                </div>
                <div class="col-lg-4">
					<label class="col-form-label title-busq">Honorario 2</label>
                    <input id="ute_honorario2" name="ute_honorario2" type="number" class="form-control input-rounded" placeholder="Honorario 2" oninput="limitDecimalPlaces(event, 2)"/>
                </div>
                <div class="col-lg-4">
					<label class="col-form-label title-busq">Honorario 3</label>
                    <input id="ute_honorario3" name="ute_honorario3" type="number" class="form-control input-rounded" placeholder="Honorario 3" oninput="limitDecimalPlaces(event, 2)"/>
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
                        <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Asignar</button>
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