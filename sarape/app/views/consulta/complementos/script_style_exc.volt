<style>
   .grupo-filtro__titulo {
    padding: 0.35rem .8rem;
    font-weight: bold;
   cursor: grab;

    }
    .grupo-filtro__line {
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
    margin: 2px .8rem;
    }
     #draggable {
      width: 150px;
      height: 150px;
      padding: 0.5em;
      background-color: #4286f4;
      color: white;
      text-align: center;
      cursor: move;
    }
    .bg-filtro-recomendado{
    background-color: #f5ff0075;
    border-radius: 0.5rem;
    margin: 0.5rem 0;
    }
    .text-filtro-rec{
    text-align: center;
    margin: 3px;
    font-weight: bold;
    color:#ff0000d1;
    }
</style>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script>
 function cambiarColorFondo(clase, color,text="") {

    // Seleccionar el elemento que deseas mover al principio
    var filltoRecomendado = $('.grupo-filtro.' + clase);

    // Seleccionar el contenedor al que deseas agregar el elemento al principio
    var container = $('#container-menu-options');

    // Verificar si se encontró un elemento y si el contenedor existe
      if (filltoRecomendado.length > 0 && container.length > 0) {
          // Eliminar el elemento original de su ubicación actual con una animación de desvanecimiento
          filltoRecomendado.fadeOut('slow', function () {
              // Obtener el elemento que se va a mover
              var elementToMove = $(this);

              // Agregar clases y atributos al elemento que se va a mover
              elementToMove.addClass('bg-filtro-recomendado');
              elementToMove.attr('title', 'FILTRO RECOMENDADO');

              // Quitar cualquier clase o atributo no deseados del elemento clonado
              elementToMove.removeClass('clase-no-deseada');
              elementToMove.removeAttr('atributo-no-deseado');

              // Agregar el elemento que se va a mover al principio del contenedor con una animación de deslizamiento
              container.prepend(elementToMove);
              elementToMove.hide().slideDown('slow');
          });
      }


       
        $("#texto-filtro-recomendado").html("FILTRO RECOMENDADO "+text);
        $("#texto-filtro-recomendado").show();
    

  }

    document.addEventListener('DOMContentLoaded', function() {
        $('#exc_estatus').change(function() {
              var selectedValue = $(this).val();
              var gruposFiltro = document.querySelectorAll('.grupo-filtro');

              $("#texto-filtro-recomendado").html("");
              $("#texto-filtro-recomendado").hide();

              for (var i = 0; i < gruposFiltro.length; i++) {
              // Verifica si la clase "tu-clase-adicional" está presente
                  var grupo = gruposFiltro[i];
                  if (grupo.classList.contains('bg-filtro-recomendado')) {
                      // Si está presente, quita la clase
                      grupo.classList.remove('bg-filtro-recomendado');
                  }
                      grupo.setAttribute('title', '');

              }
              
              // Cambia el color de fondo según la selección
              switch (selectedValue) {
                  case '1':
                      cambiarColorFondo('cita', 'lightyellow',"CITA"); // Cambia el color a amarillo claro
                      break;
                  case '2':
                      cambiarColorFondo('referencias', 'lightorange',"REFERENCIAS"); // Cambia el color a naranja claro
                      break;
                  case '3':
                      cambiarColorFondo('psicometria', 'lightblue',"PSICOMETRÍA"); // Cambia el color a azul claro
                      break;
                  case '4':
                      cambiarColorFondo('entrevista', 'lightgreen',"ENTREVISTA"); // Cambia el color a verde claro
                      break;
                  //case '5':
                     // cambiarColorFondo('autorizacion', 'lightgreen',"AUTORIZACIÓN"); // Cambia el color a verde claro
                //      break;
                  case '6':
                      cambiarColorFondo('facturacion', 'lightpink',"FACTURACIÓN"); // Cambia el color a rosa claro
                      break;
                  case '7':
                      cambiarColorFondo('garantia', 'lightpink',"GARANTÍA"); // Cambia el color a rosa claro
                      break;
                  default:
                    
                      break;
              }

        });



        //simular evento

    
    });


</script>