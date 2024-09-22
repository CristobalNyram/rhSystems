<script type="text/javascript">
  $(function (){
    $("#frm_crearregistro").submit(function(event)
    {
      var $form = $(this);
      var urled="<?php echo $this->url->get('prestacion/nuevo/') ?>";
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
          }
          else
          {
            swalalert('Éxito',"Prestacion creada correctamente.", "success", 1);
          }
          $form.find("button").prop("disabled", false);
        },
        error: function(res)
        { 
          alert('Error en el servidor...');
          $form.find("button").prop("disabled", false);
        }
      });
      return false;
    });
  });

  $(document).ready(function()
  {
    divListado = document.getElementById('listado');
    url="<?php echo $this->url->get('prestacion/tabla/') ?>";
    $.post(url, $(this).serialize() , function(data)
    {
      divListado.innerHTML=data;
      pintartabla("#td_prestacion");
    }).done(function(){
    }).fail(function(){
    })
  });
    
  function fneliregistro(id_registro,nombre_registro)
  {
    var urleliminarempre="<?php echo $this->url->get('prestacion/eliminar/') ?>";
    mensaje="¿Está seguro que desea eliminar la prestación : "+nombre_registro+" ?";
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
    var urlfned="<?php echo $this->url->get('prestacion/buseditar/') ?>"; //trabajador
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
          $("#pre_id-editar").val(res[1].pre_id);
          $("#pre_nombre-editar").val(res[1].pre_nombre);
        }
      }
    });
  }

  $(function (){
    $("#frm_editarregistro").submit(function(event) 
    {
      /* Act on the event */
      var $form = $(this);
      var urledtra="<?php echo $this->url->get('prestacion/editar/') ?>";
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
            swalalert('Éxito',"Prestación editada correctamente.", "success", 1);
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
    <h4 class="header-title header-title-crm">Prestación</h4>
  </div>
  <div class="col-sm-5">
    <div class="text-right curso" style="margin-top: 35px; font-weight: 600">
      <a href="#" class="text-uppercase">NUEVA Prestación</a>
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

{{  modal.crear("Crear prestación", "frm_crearregistro","Modal_registro",
    [
      {"tamanio":"5","leyenda":"Nombre de prestación","id":"pre_nombre","name":"pre_nombre","tipo":"text","required":"required"}
    ]
  )
}}

{{  modal.crear("Editar prestación", "frm_editarregistro","editar_registro-modal",
    [
      {"tamanio":"0","id":"pre_id-editar","name":"pre_id","tipo":"hidden","required":"required"},
      {"tamanio":"5","leyenda":"Nombre de prestación","id":"pre_nombre-editar","name":"pre_nombre","tipo":"text","required":"required"}
    ]
  )
}}