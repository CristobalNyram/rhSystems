<script type="text/javascript">
  function fnbuscarsemanas(can_id=0,exc_id=0,vac_id=0,callbackTablaArchivos="0",vista="",config={}){
    var urlbuscarsem="<?php echo $this->url->get('api/getimssinfo/') ?>";
    // var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
    mensaje="¿Está seguro que desea buscar las semanas cotizadas de este candidato?";
    alertify.confirm("Semanas cotizadas",mensaje, function()
    { 
      $.ajax({
        type: "POST",
        url: urlbuscarsem+can_id+"/"+exc_id+"/"+vac_id,
        success: function(res)
        {
          if(res[0]=='1')
          {
            Swal.fire({title:'Éxito',text:res[1],type:"success"})
              .then((value) => {
                if(callbackTablaArchivos!="0" && typeof callbackTablaArchivos == 'function'){
                  callbackTablaArchivos(exc_id,vista,config);
                }
              });
          }
          else 
          {
            if(res[0]=='-1'){
              Swal.fire({title:'Error',text:res[1],type:"error"})
                .then((value) => {
                });
            }
            else
            {
              Swal.fire({title:'Error',text:"Ocurrio un error inesperado, intente de nuevo más tarde o consulte al administrador.",type:"error"})
                .then((value) => {
                });
            }
          }
        }
      });
    }, function()
    { 
    }).set('labels', {ok:'Confirmar', cancel:'Cancelar'});
  }

  function fnbuscarcurp(exc_id){
    var urlbuscarcurp="<?php echo $this->url->get('archivo/getcurpapi/') ?>";
    // var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
    mensaje="¿Está seguro que desea buscar la CURP de este candidato?";
    alertify.confirm("CURP",mensaje, function()
    { 
      $.ajax({
        type: "POST",
        url: urlbuscarcurp+exc_id,
        success: function(res)
        {
          if(res[0]=='1')
          {
            Swal.fire({title:'Éxito',text:'La CURP ha sido consultada correctamente. Revisa los archivos del candidato para consultar el reporte.',type:"success"})
              .then((value) => {
                reloadarchivo(exc_id);
              });
          }
          else 
          {
            if(res[0]=='-1'){
              Swal.fire({title:'Error',text:res[1],type:"error"})
                .then((value) => {
                });
            }
            else
            {
              Swal.fire({title:'Error',text:"Ocurrio un error inesperado, intente de nuevo más tarde o consulte al administrador.",type:"error"})
                .then((value) => {
                });
            }
          }
        }
      });
    }, function()
    { 
    }).set('labels', {ok:'Confirmar', cancel:'Cancelar'});
  }

  function fnbuscarpoderjudicial(exc_id){
    var urlbuscarcurp="<?php echo $this->url->get('archivo/getPoderJudicial/') ?>";
    // var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
    mensaje="¿Está seguro que desea buscar la información de poder judicial de este candidato?";
    alertify.confirm("Visor Judicial",mensaje, function()
    { 
      $.ajax({
        type: "POST",
        url: urlbuscarcurp+exc_id,
        success: function(res)
        {
          if(res[0]=='1')
          {
            Swal.fire({title:'Éxito',text:'La información ha sido consultada correctamente. Revisa los archivos del candidato para consultar el reporte.',type:"success"})
              .then((value) => {
                reloadarchivo(exc_id);
              });
          }
          else 
          {
            if(res[0]=='-1'){
              Swal.fire({title:'Error',text:res[1],type:"error"})
                .then((value) => {
                });
            }
            else
            {
              Swal.fire({title:'Error',text:"Ocurrio un error inesperado, intente de nuevo más tarde o consulte al administrador.",type:"error"})
                .then((value) => {
                });
            }
          }
        }
      });
    }, function()
    { 
    }).set('labels', {ok:'Confirmar', cancel:'Cancelar'});
  }
</script>