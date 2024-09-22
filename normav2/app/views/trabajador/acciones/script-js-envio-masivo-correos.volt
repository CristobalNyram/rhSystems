<script>
        function GetSelectedEnviarCorreo() {
   //Reference the Table.

   mensaje="¿Está seguro que desea enviar correo de invitación a los folios seleccionados?";
      alertify.confirm("Enviar invitación",mensaje, function()
      { 
        // var seleccionados=get_seleccionados();
        // var grid = document.getElementById("td_datos");
 
        // //Reference the CheckBoxes in Table.
        // var checkBoxes = grid.getElementsByTagName("INPUT");
        // var message = '';
        // var arreglo=[];
        // var longitud=0;
        // var jsondatos = {};

        // //Loop through the CheckBoxes.
        // for (var i = 1; i < checkBoxes.length; i++) {
        //     if (checkBoxes[i].checked) {
        //       longitud++;
        //         var row = checkBoxes[i].parentNode.parentNode;
        //         message += row.cells[1].innerHTML;
        //         arreglo.push({ 
        //             "valor" : row.cells[1].innerHTML
        //         });
        //         message += ",";

        //     }
        // }
        // if(longitud==0){
        //   alert('No se ha seleccionado ningún registro, reintente');
        //   return false;
        // }
        var message = '';
      var arreglo=[];
      // var longitud=0;
      var jsondatos = {};
      //Loop through the CheckBoxes.
      var seleccionados=get_seleccionados();
      
      if(seleccionados[0]==""){
        alert("No se ha seleccionado ningún registro, reintente");
        return false;
      }
      for (var i = 0; i < seleccionados.length; i++) {
      arreglo.push({ 
        "valor" : seleccionados[i]
      });
      }
   
      jsondatos.arreglo=arreglo;
        // jsondatos.arreglo=arreglo;
        // console.log(jsondatos);
        // return;
        var urlmasa="<?php echo $this->url->get('cuestionario/enviarcorreo/') ?>";
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
              alertify.alert("Operación exitosa","Se enviaron "+res[1]+" correos", function(){ 
                location.reload();
              });
              // alertify.alert("Operación exitosa","Se enviaron "+res[1]+' correos');
              // location.reload(); 
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
        alertify.error('No se enviaron las invitaciones')
      }).set('labels', {ok:'Enviar', cancel:'Cancelar'});
    }
</script>