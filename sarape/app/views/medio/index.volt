<script type="text/javascript">
  $(function (){
    $("#frm_crearregistro").submit(function(event)
    {
      var $form = $(this);
      var urled="<?php echo $this->url->get('medio/nuevo/') ?>";
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      $.ajax({
        type: "POST",
        url: urled,
        data: $("#frm_crearregistro").serialize(),
        success: function(res)
        {
          if(res[0]<=0)
          {
            swalalert('Error',res[1], "error");
            console.error(res);
          }
          else
          {
            swalalert('Éxito',"Medio de contacto creado correctamente.", "success", 1);
          }
          $form.find("button").prop("disabled", false);
        },
        error: function(res)
        { 
          alert('Error en el servidor...'+res.responseText);
          $form.find("button").prop("disabled", false);
        }
      });
      return false;
    });
  });

  $(document).ready(function()
  {
    divListado = document.getElementById('listado');
    url="<?php echo $this->url->get('medio/tabla/') ?>";
    $.post(url, $(this).serialize() , function(data)
    {
      divListado.innerHTML=data;
      pintartabla("#td_tipopago");
    }).done(function(){
    }).fail(function(){
    })
  });
    
  function fneliregistro(id_registro,nombre_registro)
  {
    var urleliminarempre="<?php echo $this->url->get('medio/eliminar/') ?>";
    mensaje="¿Está seguro que desea eliminar el medio de contacto: "+nombre_registro+" ?";
    alertify.confirm("Eliminar registro",mensaje, function()
    { 
      $.ajax({
        type: "POST",
        url: urleliminarempre+id_registro,
        success: function(res)
        {
          if(res[0]==1)
          {
            swalalert('Éxito',res['mensaje'], "success", 1);
          }
          else
          {
            swalalert('Error',res['mensaje'], "error", 1);
          }
        },
        error: function(res)
          {
        alert('ERROR');
          }
      });
    }, function()
    {
    }).set('labels', {ok:'Eliminar', cancel:'Cancelar'});
  }

  function fneditregistro(id,nombre)
  {
    var urlfned="<?php echo $this->url->get('medio/buseditar/') ?>"; //trabajador
    $edempresa=id;
    $.ajax(
    {
      type: "POST",
      url: urlfned+id,
      success: function(res)
      {
        if(res[0]<=0)
        {
          swalalert('Error',res[1], "error");
        }
        else
        {
          $("#med_ideditar").val(res[1].med_id);
          $("#tpg_nombreeditar").val(res[1].med_nombre);
        }
      }
    });
  }

  $(function (){
    $("#frm_editarregistro").submit(function(event) 
    {
      /* Act on the event */
      var $form = $(this);
      var urledtra="<?php echo $this->url->get('medio/editar/') ?>";
      $form.find("button").prop("disabled", true);
      $.ajax({
        type: "POST",
        url: urledtra+$edempresa,
        data: $("#frm_editarregistro").serialize(),
        success: function(res)
        {
          if(res[0]<=0)
          {
            swalalert('Error',res[1], "error");
          }
          if(res[0]==1)
          {
            swalalert('Éxito',"Tipo pago editado correctamente.", "success", 1);
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
</script>

<div class="row">
  <div class="col-sm-6">
    <h4 class="header-title header-title-crm">Medio de contacto</h4>
  </div>
  <div class="col-sm-5">
    <div class="text-right curso" style="margin-top: 35px; font-weight: 600">
      <a href="#">NUEVO MEDIO DE CONTACTO</a>
    </div>
  </div>
  <div class="col-sm-1">
  <div class="text-left">
    {{ link_to('', 'data-target':'#Modal_registro', 'data-toggle':'modal', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'60'))  }}
  </div>
    </div>
</div>

<div class="mt-3">
    <div class="card card-crm">
        <div id="listado">
        </div>
    </div>
</div>

{{  modal.crear("Crear medio de contacto", "frm_crearregistro","Modal_registro",
    [
      {"tamanio":"5","leyenda":"Nombre del medio ","id":"med_nombre","name":"med_nombre","tipo":"text","required":"required"}
    ]
  )
}}

{{  modal.crear("Editar medio contacto", "frm_editarregistro","editar_registro-modal",
    [
      {"tamanio":"0","id":"med_ideditar","name":"med_ideditar","tipo":"hidden","required":"required"},
      {"tamanio":"5","leyenda":"Nombre del medio","id":"med_nombreeditar","name":"med_nombreeditar","tipo":"text","required":"required"}
    ]
  )
}}