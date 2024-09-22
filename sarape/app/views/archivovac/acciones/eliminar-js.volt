<script>
   function fneliminararchivoVac(arv_id, vac_id) {
  var urleliminarare = "<?php echo $this->url->get('archivovac/eliminar/') ?>";
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
        url: urleliminarare + arv_id,
        success: function (res) {

          if (res[0] == 1) {
            Swal.fire({
              title: 'Eliminado',
              text: "El archivo ha sido eliminado correctamente",
              type: "success"
            }).then((value) => {
              fnCargarTablaArchivoVac(vac_id,VISTA_RELOAD_VAC);
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