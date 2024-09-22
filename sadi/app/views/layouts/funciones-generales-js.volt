<script type="text/javascript">
  function fnCopiarPortapapeles(element_id,text_info='Texto'){
  let copyText = document.getElementById(element_id).innerHTML;

  // Select the text field
  //copyText.select();

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText);

    Swal.fire({title:'Copiado',text:'Se ha copiado correctamente: '+text_info,type:'success',
    timer: 1500 // tiempo en milisegundos

    })
     .then((value) => {
                                                    
    });
  }

    function tryParse(value) {
  
    }

  function redirecion_dash(){
      var url="<?php echo $this->url->get('dashboard/index/') ?>";

    let permiso="{{ acceso.verificar(55,rol_id)  }}";

    if(permiso=='1'){
      window.location.href=url;
    }else{
      document.title = "SIPS | SADI";
      
    }
  }
 function swalalert(title, mensaje, tipo, reload=0,callback=0) //título, mensaje en el contenido, tipo (success, error), recargar (1 para si recargar)
  {
 
    Swal.fire({title:title,text:mensaje,type:tipo})
      .then((value) => {
        if(reload!=0){
          location.reload();
        }
        else if(callback!=0){
          callback();
        }
      });
    
  }
  function swalalertErrorSoporte(error) {
    const template = `
      <div>
        <p>${error} 
        <br>
        Por favor, tome una captura de este error y compártala con el equipo de soporte.
        </p>
      </div>

    `;

    Swal.fire({
      type: 'error',
      title: 'Error frontend',
      html: template,
    });
  }

  function swalalertHTML(title, mensaje, tipo, reload=0) //título, mensaje en el contenido, tipo (success, error), recargar (1 para si recargar)
  {
 
    Swal.fire({title:title,html:mensaje,type:tipo})
      .then((value) => {
        if(reload!=0){
          location.reload();
        }
      });
    
  }

  function obtenerFecha(value)
  {

    var fecha = moment(e.value);
    // console.log("Fecha original:" + e.value);
    // console.log("Fecha formateada es: " + fecha.format("DD/MM/YYYY"));
  }

  function convertirMinusculas(inputId) {
    let input = document.getElementById(inputId);
    input.value = input.value.toLowerCase();
  }

  function convertirMinusculasSinEspacios(input) {
 
  input.value = input.value.toLowerCase().replace(/\s/g, '');
  } 
  /*FUNCIÓN PARA VERIFICAR SI UN ARRAY DE NÚMEROS ESTÁ EN EL RANGO 
  @parametros [$array de numeros a evaluar][$min =>valor minimo][$max valor maximo permitido]
  @return [boleano => true si esta en el rango ,false si no esta en el rango ] 
  */


  function calcularEdad(dateString){

      if(dateString!=null){
        let today = new Date();
        var birthDate = new Date(dateString);
        let age = today.getFullYear() - birthDate.getFullYear();
        let m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
      }else{
        return '0';
      }
     
  }

  function establecerFechaCalculada(input_value=0,input_set_value)
  {
     let FechaIngresa=input_value.value;

      let edad_calculada= calcularEdad(FechaIngresa);
      let input_set=document.getElementById(input_set_value);
      input_set.value=edad_calculada;
  }


 

  function Numero_Si_EstaEnElRango(Numbers,Minimo,Maximo)
   { 
           let respuesta;

            let Array= Numbers.map((currentValue)=>{
                  return (currentValue>=Minimo && currentValue<=Maximo)  ;

            });

            if(Array.includes(false))
            {
              respuesta =false;
            }
            else
            {
              respuesta =true;
            }
      return respuesta;
  }

  function formatoEdad(event)
  {
        let ExpRegSoloNumeros="^[0-9]+$";
        if(event.target.value.match(ExpRegSoloNumeros)!=null &&  Math.sign(event.target.value)==true)
        {
            if(event.target.value>=0  && event.target.value<=100 )
            {
            
            }
            else      
            {
              alertify.alert('ERROR','Debes ingresar una edad real.');
              event.target.value='';
            }
        }
        else
        {
          event.target.value='';

        }
     
     
  
  }

  function SelectMostrarOcultarDivDeAcuerdoASiONo(event_current_value,div_trabajado,input_trabajado){
        if(event_current_value=='0'||event_current_value=='-1'|| event_current_value==null || event_current_value== ''){
          $(`#${div_trabajado}`).hide('slow');
          $(`#${input_trabajado}`).val(null);

          

        }
        if(event_current_value=='1'){
          $(`#${div_trabajado}`).show('slow');
        }

  }
  function SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS(event_current_value,div_trabajado,input_trabajado){
    if(event_current_value=='0'||event_current_value=='-1' || event_current_value==null || event_current_value== ''){
          $(`.${div_trabajado}`).hide('slow');
          $(`#${input_trabajado}`).val(null);

          

        }
        if(event_current_value=='1'){
          $(`.${div_trabajado}`).show('slow');
        }
  }
  function SelectMostrarOcultarDivDeAcuerdoASiONo_NoAplicaConClasesCSS(event_current_value,div_trabajado,input_trabajado){
    if(event_current_value=='0'||event_current_value=='-1' || event_current_value==null || event_current_value== '' || event_current_value=='2'){
          $(`.${div_trabajado}`).hide('slow');
          $(`#${input_trabajado}`).val(null);

          

        }
        if(event_current_value=='1'){
          $(`.${div_trabajado}`).show('slow');
        }
  }



  function SelectMostrarOcultarDivDeAcuerdoASiONoConClasesCSS_versionNo(event_current_value,div_trabajado,input_trabajado){
    if(event_current_value=='1'||event_current_value=='-1' || event_current_value==null || event_current_value== ''){
          $(`.${div_trabajado}`).hide('slow');
          $(`#${input_trabajado}`).val(null);

          

        }
        if(event_current_value=='0'){
          $(`.${div_trabajado}`).show('slow');
        }
  }
  


  function handleInput(e) {
   var ss = e.target.selectionStart;
   var se = e.target.selectionEnd;
   e.target.value = e.target.value.toUpperCase();
   e.target.selectionStart = ss;
   e.target.selectionEnd = se;
  }

function validarValorFormatoLimpio(valor) {
    var valoresInvalidos = ["-1", null, ""];
    if (valoresInvalidos.includes(valor)) {
        return "";
    } else {
        return valor;
    }
}
function validarValorFormatoLimpioOSetearValor(valor,valor_a_setear="") {
    var valoresInvalidos = [undefined,' ', null, ""];
    if (valoresInvalidos.includes(valor)) {
        return valor_a_setear;
    } else {
        return valor;
    }
}
  __ESE_EMPRESA_IDS_RECLUTA_FORMATO_ = ["28"];

  function maxLenghtNumeros(event,limit){
        let numbers = /^[0-9]+$/;
                                                       
              if( event.target.value.match(numbers))
                {
                                                         
                          if((event.target.value.length>limit))
                           {
                            event.target.value='';

                          }
                                                    
               }
                else{
                  event.target.value='';
                     }

  }



  $(window).on('load', function () {
    // $('#hide-me').css('display', 'none');
    $('#hide-me').fadeOut("slow");
    // setTimeout(function () {
      // $(".loader-page").css({visibility:"hidden",opacity:"0"});
    // }, 1000);
       
  });
  $( document ).ajaxStart(function() {
    $('#hide-me').css('display', 'block');
  });

  $(document).ajaxStop(function(){ 
    $('#hide-me').fadeOut("slow");
    // $('#hide-me').css('display', 'none');
  });

  var glateralm=1
    
    
    function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") 
    {
        try {
          decimalCount = Math.abs(decimalCount);
          decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

          const negativeSign = amount < 0 ? "-" : "";

          let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
          let j = (i.length > 3) ? i.length % 3 : 0;

          return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
        } catch (e) {
          console.log(e)
        }
      }

  function limitDecimalPlaces(e, count) {
    if (e.target.value.indexOf('.') == -1) { return; }
    if ((e.target.value.length - e.target.value.indexOf('.')) > count) {
      e.target.value = parseFloat(e.target.value).toFixed(count);
    }
  }



  function soloNumeroPositivos(event)
  {
    let ExpRegSoloNumeros="^[0-9]+$";
    if(event.target.value.match(ExpRegSoloNumeros)!=null)
    {
    }
    else
    {
      event.target.value='';
    }

  }
  function soloNumeroPositivosV2(event) {
    let expRegSoloNumeros = /^[0-9]+$/;
      if (expRegSoloNumeros.test(event.target.value)) {
      } else {
          event.target.value = event.target.value.replace(/[^0-9]/g, ''); // Elimina caracteres no numéricos
      }
    }


  function is_number(value){

    if(value==null || value==''){
      return null;

    }

    let ExpRegSoloNumeros="-?[0-9]\d*(\.\d+)?";

    if(value.match(ExpRegSoloNumeros)!=null)
    {
      return value;
    }
    else
    {
      return null;
    }

  }
 
  function redireccionar(url){
      window.open(url, '_blank');
  }

  function download_file(fileURL, fileName) {
    // for non-IE
    if (!window.ActiveXObject) {
      var save = document.createElement('a');
      save.href = fileURL;
      save.target = '_blank';
      var filename = fileURL.substring(fileURL.lastIndexOf('/')+1);
      save.download = fileName || filename;
      if ( navigator.userAgent.toLowerCase().match(/(ipad|iphone|safari)/) && navigator.userAgent.search("Chrome") < 0) {
        document.location = save.href; 
    // window event not working here
      }else{
        var evt = new MouseEvent('click', {
          'view': window,
          'bubbles': true,
          'cancelable': false
        });
        save.dispatchEvent(evt);
        (window.URL || window.webkitURL).revokeObjectURL(save.href);
      } 
    }
    // for IE < 11
    else if ( !! window.ActiveXObject && document.execCommand){
      var _window = window.open(fileURL, '_blank');
      _window.document.close();
      _window.document.execCommand('SaveAs', true, fileName || fileURL)
      _window.close();
    }
  }

  function negativo(numero){
    var r= Math.abs(numero) * -1;
    return r;
  }
  function positivo(numero){
    var r= Math.abs(numero);
    return r;
  }
  function inicial(){
    var urlinicial="<?php echo $this->url->get('poliza/inicial/') ?>";
    window.location=urlinicial;
  }
  function actualizaInfo(maximoCaracteres,idinput,idfor) {
    var elemento = document.getElementById(idinput);
    var info = document.getElementById(idfor);

    if(elemento.value.length >= maximoCaracteres ) {
      info.innerHTML = "(Máximo "+maximoCaracteres+" caracteres)";
    }
    else {
      info.innerHTML = "(Puedes escribir hasta "+(maximoCaracteres-elemento.value.length)+" caracteres adicionales)";
    }
  }

  function show_input_if(event_value,valor_llave,div_class_padre){


      if(event_value==valor_llave){
        $(`.${div_class_padre}`).show('slow');

      }else{
        $(`.${div_class_padre}`).hide('slow');

      }

  }
  
    function fecha_no_mayor_a_la_actual_MES_ANIO(event_value,input_id=0,buton_id=0){

        if(buton_id!=0){
            let btnbuscar = document.getElementById(buton_id);
           // btnbuscar.disabled=true;
        }
   

       
        let fecha_input= event_value;
        let fecha_input_moment = moment(fecha_input);
        const mesAValidar = fecha_input_moment.month();
        const anioAValidar = fecha_input_moment.year();

        const fechaActual = moment();
        const mesActual = moment().month();
        const anioActual = moment().year();



        

          if (anioAValidar > anioActual || (anioAValidar === anioActual && mesAValidar > mesActual) || (anioAValidar === anioActual && mesAValidar === mesActual)) {
            
            Swal.fire({title:'Aviso',text:'Por favor, ten en cuenta que la fecha que ingreses no puede ser posterior o igual a la fecha actual (mes y año).',
                                         imageUrl:'https://cdn-icons-png.flaticon.com/512/138/138727.png',
                                            imageWidth: 200,
                                            imageHeight: 200,
                                            imageAlt: 'Aviso',
          })
                                                      .then((value) => {
                                                    
                                          });

            //$(`#${input_id}`).val(null);
            setMesAnterior(input_id);
            if(buton_id!=0){
            let btnbuscar = document.getElementById(buton_id);
           // btnbuscar.disabled=true;
            }

          } else {
            if(buton_id!=0){
            let btnbuscar = document.getElementById(buton_id);
            //btnbuscar.disabled=false;
            }
          }
   
    
        

    }

    function setMesAnterior(input_id){
       // crear una instancia de fecha
       let fecha = new Date();
      // restar un mes a la fecha actual
      fecha.setMonth(fecha.getMonth() - 1);
      // obtener el mes y año en formato YYYY-MM
      let mesAnterior = fecha.toISOString().slice(0,7);
      //seteamos la fecha
      $(`#${input_id}`).val(mesAnterior);
    }

function getAcceptedExtensions(acceptAttribute) {
  const extensions = acceptAttribute.split(',').map(ext => ext.trim().toLowerCase().replace(/\./g, ''));
  return extensions;
}
function getFileExtension(fileName) {
  const lastDotIndex = fileName.lastIndexOf('.');
  if (lastDotIndex !== -1) {
    return fileName.slice(lastDotIndex + 1).toLowerCase();
  }
  return '';
}

//validar el/los archivos 
/**
 *@param data-set-size-limite=1048576=1MB, data-set-file-limit=cantidad de archivos validos a subir 
*/
function fnValidateSizeFile(event,div_id) {
  $('#' + div_id).empty();
  //alert();
  const inputElement = event.target;
  const sizeLimitWithOutFormat = parseFloat(inputElement.dataset.sizeLimit);
  const fileLimiteCountToUpload = parseFloat(inputElement.dataset.fileLimit);
  const allowedExtensions = getAcceptedExtensions(inputElement.accept);
  // console.log(event);

  const validateSize = () => {
    return new Promise((resolve, reject) => {
      const sizeLimit = parseFloat((sizeLimitWithOutFormat / 1024 / 1024).toFixed(2));
      // console.log(sizeLimit);
      if (inputElement.files.length === 1) {
        const file = inputElement.files[0];
        const size = parseFloat((file.size / 1024 / 1024).toFixed(2)); 
        if (size > sizeLimit || size < 0) {
          const template_msg_size = `
            {{ image("assets/images/sistema/archivo-pesado.png", "alt": "ARCHIVO PESADO ICONO", "class": "", "style": "width: auto;height: 220px; " ) }}
            </br>
            El archivo debe tener un tamaño máximo de </br> ${sizeLimit} MB. 
            </br>
            El tamaño del archivo actual es de </br> ${size} MB.
            </br>
            Puedes utilizar las siguientes plataformas para comprimir tu archivo 
            <ul>
              <li>
                <a href="https://www.adobe.com/mx/acrobat/online/compress-pdf.html" target="_blank">
                  <i class="fas fa-file-pdf"></i> Comprimir PDF - Adobe Acrobat
                </a>
              </li>
              <li>
                <a href="https://tinypng.com/" target="_blank">
                  <i class="fas fa-image"></i> Comprimir Imágenes - TinyPNG
                </a>
              </li>
              <li>
                <a href="https://www.adobe.com/creativecloud/photography/discover/compress-image.html" target="_blank">
                  <i class="fas fa-image"></i> Comprimir Imágenes - Adobe Creative Cloud
                </a>
              </li>
            </ul>
          `;
          swalalertHTML('', template_msg_size, '', 0);
          inputElement.value = '';
          $('#' + div_id).empty();
          reject(new Error('Tamaño de archivo no válido'));
        } else {
          resolve();
        }
      } else if (inputElement.files.length > 1) {
        const oversizedFiles = [];
        for (let i = 0; i < inputElement.files.length; i++) {
          const file = inputElement.files[i];
          const size = parseFloat((file.size / 1024 / 1024).toFixed(2)); 
          if (size > sizeLimit || size < 0) {
            // Agregar el nombre del archivo a la lista de archivos excedidos
            oversizedFiles.push({ name: file.name, size: `${size} MB` });
          }
        }
        if(oversizedFiles.length>0){
           const template_msg_size_multiple = `
          {{ image("assets/images/sistema/archivo-pesado.png", "alt": "ARCHIVO PESADO ICONO", "class": "", "style": "width: auto;height: 220px; " ) }}
          </br>
          Algunos archivos exceden el tamaño máximo permitido </br> de ${sizeLimit} MB. 
          </br>
          Archivos con tamaño excedido:
          <ul>
          ${oversizedFiles.map(file => `<li>${file.name} </br> (${file.size})</li>`).join('')}
          </ul>
          </br>
          Puedes utilizar las siguientes plataformas para comprimir tus archivos.
          <ul>
            <li>
              <a href="https://www.adobe.com/mx/acrobat/online/compress-pdf.html" target="_blank">
                <i class="fas fa-file-pdf"></i> Comprimir PDF - Adobe Acrobat
              </a>
            </li>
            <li>
              <a href="https://tinypng.com/" target="_blank">
                <i class="fas fa-image"></i> Comprimir Imágenes - TinyPNG
              </a>
            </li>
            <li>
              <a href="https://www.adobe.com/creativecloud/photography/discover/compress-image.html" target="_blank">
                <i class="fas fa-image"></i> Comprimir Imágenes - Adobe Creative Cloud
              </a>
            </li>
          </ul>
        `;
        $('#' + div_id).empty();
        swalalertHTML('', template_msg_size_multiple, '', 0);
        
        inputElement.value = '';
        reject(new Error('Tamaño de archivo no válido'));
        $('#' + div_id).empty();
        }else{
          resolve();
        }

       
      } else {
        resolve();
      }
    });
  };

  // validar la extensión
  const validateExtensions = () => {
    return new Promise((resolve, reject) => {
      const invalidFiles = [];
      if (inputElement.files.length > 0) {
        for (let i = 0; i < inputElement.files.length; i++) {
          const file = inputElement.files[i];
          const extension = getFileExtension(file.name);

          if (!allowedExtensions.includes(extension)) {
            invalidFiles.push(file.name);
          }
        }
      }

      if (invalidFiles.length > 0) {
        const invalidFilesMessage = `Los siguientes archivos no cumplen con las características:<br>${invalidFiles.map(file => `- ${file}`).join('<br>')}.`;
        swalalertHTML('', invalidFilesMessage, '', 0);
        inputElement.value = '';
        $('#' + div_id).empty();
        reject(new Error('Archivos con extensiones no válidas'));
      } else {
        resolve();
      }
    });
  };

// validar el límite de archivos
const validateCountOfFiles = () => {
  return new Promise((resolve, reject) => {
    const filesInInput = inputElement.files.length
    // Verificar si el campo de entrada permite múltiples archivos
    const isMultiple = inputElement.hasAttribute('multiple');
    if (isMultiple) {
      // Si es múltiple, verificar el límite de archivos permitidos
      if (fileLimiteCountToUpload < filesInInput) {
        const templateFileCountLimitDontAllow = `
          <div class="alert alert-danger" role="alert">
            El límite de archivos permitidos es solo de ${fileLimiteCountToUpload}.
          </div>
        `;
        inputElement.value = '';
        swalalertHTML('', templateFileCountLimitDontAllow, '', 0);
        reject(new Error('El límite de archivos permitidos es solo de ' + fileLimiteCountToUpload));
        $('#' + div_id).empty();
      } else {
        resolve();
      }
    } else {
      // Si no es múltiple, verificar que solo se haya cargado un archivo
      if (filesInInput !== 1) {
        const templateFileCountLimitDontAllow = `
          <div class="alert alert-danger" role="alert">
            Solo se permite cargar un archivo.
          </div>
        `;
        inputElement.value = '';
        swalalertHTML('', templateFileCountLimitDontAllow, '', 0);
        $('#' + div_id).empty();
        reject(new Error('Solo se permite cargar un archivo.'));
      } else {
        resolve();
      }
    }
  });
};
  validateCountOfFiles()
    .then(() => validateSize())
    .then(() => validateExtensions())
    .then(() => {
      $('#' + div_id).empty(); // Limpiar vistas previas anteriores      
      for (var i = 0; i < inputElement.files.length; i++) {
        var ext = inputElement.files[i].name.substring(inputElement.files[i].name.lastIndexOf('.') + 1).toLowerCase();
        if (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg") {
          handleImagePreview(inputElement.files[i], div_id);
        } else if (ext == "pdf") {
          handlePdfPreview(inputElement.files[i], div_id);
        }
      }
    })
    .catch(error =>{
      $('#' + div_id).empty();
      console.error();("error in something");
    });
}


  function readURLFilesPreView(input, div_id) {
        $('#' + div_id).empty(); // Clear previous previews
        for (var i = 0; i < input.files.length; i++) {
            var ext = input.files[i].name.substring(input.files[i].name.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg") {
              handleImagePreview(input.files[i],div_id);
            }else if(ext == "pdf") {
                 handlePdfPreview(input.files[i],div_id);
            }
        }
  }

  function handleImagePreview(file,div_id) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail');
            var col = $('<div>').addClass('col-md-3 mb-3');
            col.append(img);
            img.click(function () {
                $('#modalImage').attr('src', e.target.result);
                $('#imageModal').modal('show');
            });
            $('#' + div_id).append(col);
        };
        reader.readAsDataURL(file);
  }

  function handlePdfPreview(file,div_id) {
       var reader = new FileReader();
            reader.onload = function (e) {
                var embed = $('<embed>').attr('src', e.target.result).attr('type', 'application/pdf').addClass('pdf-preview');
                var col = $('<div>').addClass('col-md-3 mb-3');
                col.append(embed);
                $('#' + div_id).append(col);
                var viewButton = $('<a>').text('Ver PDF').addClass('btn btn-primary mt-2 text-white');
                col.append(viewButton);
                viewButton.click(function () {
                    // Mostrar el PDF en un modal
                    $('#pdfModal').modal('show');
                    $('#pdfModal').find('.modal-body').html(embed.clone().css({
                      'width': '100%', // Establecer el ancho al 100%
                      'height': '80vh', // Establecer el ancho al 100%
                      'max-width': '100%',
                      'max-height': '80vh'
                  }));

                });
            };
            reader.readAsDataURL(file);
    }
// funciiones para archivo


 function pintartabla(nombretabla,orden=0,config={})
  {
      const asDes = config.hasOwnProperty('as_des') ? config.as_des : 'asc';
      const tabla_cargando = config.hasOwnProperty('tabla_cargando') ? config.tabla_cargando : '';
   
      if ($.fn.DataTable.isDataTable(nombretabla)) {
        $(nombretabla).DataTable().destroy();
        $(nombretabla).empty();

      }

      $(nombretabla).on('preInit.dt', function() {
        if(tabla_cargando!=""){
        $("#"+tabla_cargando).show();

        }

        
      });
      var table=$(nombretabla).DataTable({
        "pageLength": 100,
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        "initComplete": function( settings, json ) {
           if(tabla_cargando!=""){
              $("#"+tabla_cargando).hide();
              
           }


        },
        order:[orden,`${asDes}`],
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
          .appendTo(nombretabla+'_wrapper .col-md-6:eq(0)');
      
   
}

function reiniciarFormulario(formId,callback=0) {
    let form_ocupado=document.getElementById(formId);
    form_ocupado.reset();
    $('#' + formId + ' input[type="text"]').val('');
    $('#' + formId + ' select').val('-1').trigger('change');
    $('#' + formId + ' input[type="date"]').val('');
    if(callback!="0"){
     callback();
    }
}
function limpiarValorBD(data) {
      const valoresExcluidos = [null, '-2', '-1'];
      const valorPorDefecto = '';
      return valoresExcluidos.includes(data) ? valorPorDefecto : data;
  }


function cargarAPIGoogleMaps() {
  const apiKey = 'AIzaSyBq-hes4CKM-bd4EV-Y60zmUPUa9hlTHFk';
  const script = document.createElement('script');
  script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places`;
  script.async = true;
  script.defer = true;
  document.head.appendChild(script);
}

cargarAPIGoogleMaps();


function validarVariableDeOptionSelect(variable) {
  return variable !== null && variable !== undefined && variable !== "";
}
</script>
 <div style="z-index:999991;" class="modal fade" id="imageModal" tabindex="999991" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
         
            <div class="modal-content">
            <div class="modal-header">
             
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                <img id="modalImage" class="img-fluid panzoom" src="" style="max-width: 100%; max-height: 80vh; cursor: zoom-in;" >
                </div>
            </div>
        </div>
</div>
<div style="z-index:999991;" class="modal fade" id="pdfModal" tabindex="999991" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>


{{ javascript_include('js/validaciones/jquery.validate.js') }}
{{ javascript_include('js/validaciones/additional-methods.js') }}
{{ javascript_include('assets/js/validate_selects/app.js') }}






{{ javascript_include('js/validaciones/pais/validaciones.js') }}

