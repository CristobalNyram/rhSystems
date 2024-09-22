<script>
  $(function () 
{
  $("#formedituser").submit(function(event) {
    /* Act on the event */
      var $form = $(this);
    $form.find("button").prop("disabled", true);

    $.ajax({
      type: "POST",
      url: url4,
      data: $("#formedituser").serialize(),
      success: function(res)
      {
        if(res[0]=='0')
        {
          alertify.alert("Error",res[1]);
        }
        if(res[0]=='1')
        {
          alertify.alert("Gracias","Información actualizada correctamente.");

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
<form method="post" target="_self"  id="formedituser">
  <div id="historial" class="col-sm-12">
    <div class="text-right">
      <a onclick="location.reload()" class="btn btn-danger btn-sm">CANCELAR <i class="fa fa-times" aria-hidden="true"></i></a> 
      <button id="btn_guardar" type="submit" class="btn btn-info btn-sm">GUARDAR CAMBIOS <i class="fa fa-check" aria-hidden="true"></i></button> 

    </div>
    <div id="tabla1" class="col-sm-12">
      <div class="row">
        <table class="table table-striped">
          <ul>
            <tr>
              <td><b>Nombre</b></td>
              <td>
                <div class="col-sm-6">
                  {{nombre}}
                </div>
                <div class="col-sm-6">
                  {{apellidop}}
                </div>
                <div class="col-sm-6">
                  {{apellidom}}
                </div>
              </td>
              <td></td>
            </tr>
            <tr>
              <td><b>Calle</b></td>
              <td><div class="col-sm-12">
                <input type="text" class="form-control form-control-sm" id="usu_calle" name="usu_calle" value="{{calle}}" placeholder="Calle" required>
              </div></td>
              <td></td>
            </tr>
            <tr>
              <td><b>Número</b></td>
              <td><div class="col-sm-12">
                <input type="text" class="form-control form-control-sm" id="usu_exterior" name="usu_exterior" value="{{exterior}}" placeholder="Calle" required>
              </div></td>
              <td></td>
            </tr>
            <tr>
              <td><b>Colonia</b></td>
              <td><div class="col-sm-12">
                <input type="text" class="form-control form-control-sm" id="usu_colonia" name="usu_colonia" value="{{colonia}}" placeholder="Calle" required>
              </div></td>
              <td></td>
            </tr>
            <tr>
              <td><b>Estado</b></td>
              <td><div class="col-sm-12">
                <input type="text" class="form-control form-control-sm" id="usu_estado" name="usu_estado" value="{{estado}}" placeholder="Estado" required>
              </div></td>
              <td></td>
            </tr>   
            <tr>
              <td><b>Teléfono</b></td>
              <td><div class="col-sm-12">
                <input type="text" class="form-control form-control-sm" id="usu_telefono" name="usu_telefono" value="{{telefono}}" required>
              </div></td>
              <td></td>
            </tr>
            <tr>
              <td><b>Correo personal</b></td>
              <td><div class="col-sm-12">
                <input name="usu_emailpersonal" type="text" class="form-control" id="usu_emailpersonal" placeholder="Correo personal" value="{{correo_personal}}" required/ >
              </div></td>
              <td></td>
            </tr>        
          </ul>
        </table>   
      </div>
    </div>
  </div>
</form>
