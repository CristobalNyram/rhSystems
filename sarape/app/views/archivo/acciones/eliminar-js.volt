<script>
   function fneliminararchivo(arc_id, exc_id) {
  var urleliminarare = "<?php echo $this->url->get('archivo/eliminar/') ?>";
  mensaje = "¿Está seguro que desea eliminar el archivo?";
  
  Swal.fire({
    title: "Eliminar archivo",
    text: mensaje,
    type: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
    cancelButtonText: "Cancelar"
  }).then((result) => {

    if (result.value) {

      $.ajax({
        type: "POST",
        url: urleliminarare + arc_id,
        success: function (res) {

          if (res[0] == 1) {
            Swal.fire({
              title: 'Eliminado',
              text: "El archivo ha sido eliminado correctamente",
              type: "success"
            }).then((value) => {
              fnCargarTablaArchivo(exc_id,_VISTA_ARC_EXC);
            });
          }
          else if(res[0] == '-1') {
            Swal.fire({
              title: 'Warning',
              text: res[1],
              type: "error"
            });
          } else {
            Swal.fire({
              title: 'Error',
              text: 'Ocurrió un error al cambiar el estatus',
              type: "error"
            });
          }
        }
      });
    }
  });
}


</script>