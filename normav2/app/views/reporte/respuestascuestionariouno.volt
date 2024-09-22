<!-- links start  -->
{{ javascript_include('plugins/datatables/datatables.min.js') }}
{{ stylesheet_link('css/datatables/css/dataTables.checkboxes.css') }}
{{ javascript_include('js/datatables/dataTables.checkboxes.min.js') }}

<!-- links end -->

<!-- scripts query start  -->
<script>
  $(document).ready(function() {
    $("#loading-message").hide();

    $(".content-info").show();
  
});

  $(document).ready(function(){
    
  
    $("#from_reporte_calificacion_cuestionario_1").submit(function(event) 
        {
          event.preventDefault();
          let empresaId = $(this).find('#empresa_id').val();
          let folio = $(this).find('#folio').val();

          if (!/^\d+$/.test(empresaId) || parseInt(empresaId) < 0) {
            alertify.alert("AVISO","Ambos campos deben ser números enteros mayores a 0.");
            return;
          }
          if (folio !== "" && folio !== null && !/^([1-9]\d*)$/.test(folio)) {
            alertify.alert("AVISO","El campo Folio debe ser un número entero mayor a 0 o dejarlo vacío.");
            return;
          }

          let url_ = "<?php echo $this->url->get('reporte/respuestascuestionariouno/') ?>";
          url_ += + empresaId + "/" + folio;

          // Redireccionar a la nueva URL
          window.location.href = url_;
          
  
  
          }); 
      
  });      
  
  </script>
<!-- script query end  -->


<div id="loading-message" class="alert alert-info" role="alert">
  Cargando los datos...
</div>

<div class="mb-2 content-info" style="display: none;">

  <div class="card card-crm ">
    
          <div class="text-center col-md-12 ">
                      <div class="mt-1">
                                 <span class="font-16 btn-link-crm">
                                  Reporte de repuestas del cuestionario 1 de NOM-35
                                </span>
                      </div>
            </div>
                 <hr class="line-down">
                 
           <form class="container " method="post" enctype="multipart/form-data" id="from_reporte_calificacion_cuestionario_1">
                 <div class="row">
                   <div class="col-6 col-xs-4 col-sm-4 col-md-4">
                     <label class="col-form-label title-busq font-17 ">Selecciona la empresa:</label>
                   </div>

                   <div class="col-6 col-xs-4 col-sm-4 col-md-4">
                     <label class="col-form-label title-busq font-17 ">Folio:</label>
                   </div>
                 
                 </div>
                 <div class="row">
                       <div class="col-6 col-xs-4 col-sm-4 col-md-4">
                         <select name="emp_id" id="empresa_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                           <optgroup>
                               <option   value="0" >Todas</option>
                               {% for empresa in empresas %}
                                {% set selected = (empresa['emp_id'] == selected_emp_id) ? 'selected' : '' %}
                                <option value="{{ empresa['emp_id'] }}" {{ selected }}>{{ empresa['emp_nombre'] }}</option>
                                {% endfor %}
                                    
                           </optgroup>
                         </select>
                       </div>
                       <div class="col-6 col-xs-4 col-sm-4 col-md-4">
                         <!-- <input type="number" oninput="soloNumeroPositivos(event);" value="{{ selected_fol_id }}"  step="00.00" name="fol_id" id="folio" placeholder="Folio"  class="form-control  input-rounded "> -->
                         <select name="fol_id" id="folio" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                            <optgroup>
                                <option   value="" >Todos</option>
                                {% for fol in folios %}
                                {% set selected = (fol['fol_id'] == selected_fol_id) ? 'selected' : '' %}

                                <option value="{{ fol['fol_id'] }}" {{ selected }}>{{ fol['fol_id'] }}.-{{ fol['fol_nombre'] }}</option>
                                {% endfor %}
                                    
                            </optgroup>
                          </select>
                        </div>

           
                   
                 </div>

                 <div class="d-flex justify-content-end mt-4">
                   <div class="col-lg-3 col-md-3 col-lx-3 col-sm-4  mt-2 padding-responsive">
                     <div class="form-group">                                         
                      <button class="btn-dark btn-rounded btn btn-buscar ">Generar reporte <i class="mdi mdi-chart-areaspline white"></i> </button>
                    </div>
                   </div>

                 </div>
           </form>

   </div>  

</div>


<div class="mb-2 content-info"  style="display: none;"></div>

       <div class="container col-12 bg-white rounded p-2 p-5  content-info" style="display: none;">
         
               <div class="text-center col-md-12 ">
                           <!-- <div class="mt-1">
                                    <span class="font-16 btn-link-crm">
                                    Reporte de repuestas del cuestionario 1 de NOM-35
                                    </span>
                           </div> -->

                           <div class="mt-1">
                            <span class="font-16 btn-link-crm">
                            Total de encuestados  <span class="badge rounded-pill bg-secondary" style="font-size: 1rem;">{{ total_encuestados }}</span>

                            </span>
                   </div>
                 </div>
                      <hr class="line-down">
            
            <div class="row">
                  <div class="col-xs-12 col-sm-6 col-lg-6 ">
                      <h2>
                        I.- Acontecimiento traumático severo - <span class="badge badge-info">Resumen.</span>

                      </h2>
                      <div id="graficaDeRespuestasSiSeccion1" class="col-xs-4 col-sm-6  col-lg-12 "></div>

                      <table class="table">
                        <thead>
                      
                        <tbody>
                          <tr class="bg-danger text-white">
                            <th >Trabajadores que contestaron SI en alguna de las preguntas: </th>
                            <th id="piebarSeccion1RespuestasSi" >{{numDeFoliosQueDijeronQueSiEnAlmenosUnaPregunta}}</th>
                                                   
                          </tr>
                          <tr class="bg-success text-white">
                            <th >Trabajadores que contestaron NO en todas las preguntas: </th>
                            <th  id="piebarSeccion1RespuestasNo">{{numDeFoliosQueDijeronQueNoEnAlmenosUnaPregunta}}</th>
                           
                          
                          </tr>
                        
                        </tbody>
                      </table>

                  </div>
                  <div class="col-xs-12 col-sm-6 col-lg-6 ">
                    <h2>
                      I.- Acontecimiento traumático severo

                    </h2>
                    <div id="bar-Seccion1" class="col-xs-4 col-sm-6  col-lg-12 "></div>

                    <table class="table">
                      <thead>
                    
                      <tbody>
                        <tr class="bg-danger text-white">
                            <th>Si</th>
                            <th id="NumRespuestasSiPregunta1"><?php echo isset($respuestaSiSeccion1[0]) ? $respuestaSiSeccion1[0] : 0; ?></th>
                            <th id="NumRespuestasSiPregunta2"><?php echo isset($respuestaSiSeccion1[1]) ? $respuestaSiSeccion1[1] : 0; ?></th>     
                            <th id="NumRespuestasSiPregunta3"><?php echo isset($respuestaSiSeccion1[2]) ? $respuestaSiSeccion1[2] : 0; ?></th>  
                            <th id="NumRespuestasSiPregunta4"><?php echo isset($respuestaSiSeccion1[3]) ? $respuestaSiSeccion1[3] : 0; ?></th>   
                            <th id="NumRespuestasSiPregunta5"><?php echo isset($respuestaSiSeccion1[4]) ? $respuestaSiSeccion1[4] : 0; ?></th> 
                            <th id="NumRespuestasSiPregunta6"><?php echo isset($respuestaSiSeccion1[5]) ? $respuestaSiSeccion1[5] : 0; ?></th> 
                        </tr>
                      
                        <tr class="bg-success text-white">
                          <th>No</th>
                          <th id="NumRespuestasNoPregunta1"><?php echo isset($respuestaNoSeccion1[0]) ? $respuestaNoSeccion1[0] : 0; ?></th>
                          <th id="NumRespuestasNoPregunta2"><?php echo isset($respuestaNoSeccion1[1]) ? $respuestaNoSeccion1[1] : 0; ?></th>     
                          <th id="NumRespuestasNoPregunta3"><?php echo isset($respuestaNoSeccion1[2]) ? $respuestaNoSeccion1[2] : 0; ?></th>  
                          <th id="NumRespuestasNoPregunta4"><?php echo isset($respuestaNoSeccion1[3]) ? $respuestaNoSeccion1[3] : 0; ?></th>   
                          <th id="NumRespuestasNoPregunta5"><?php echo isset($respuestaNoSeccion1[4]) ? $respuestaNoSeccion1[4] : 0; ?></th> 
                          <th id="NumRespuestasNoPregunta6"><?php echo isset($respuestaNoSeccion1[5]) ? $respuestaNoSeccion1[5] : 0; ?></th> 
                       </tr>
                      
                      
                      </tbody>
                    </table>

                </div>

                  
                 

                  </div>
                  <div class="col-xs-12 col-sm-6  col-lg-6 ">
                                   

                  </div>

                  <div class="row">
                          <div class="col-xs-12 col-sm-6  col-lg-6 ">
                          <h2>II.- Recuerdos persistentes sobre el 
                            acontecimiento.</h2>
                            
                              <div id="bar-Seccion2" class="col-xs-4 col-sm-6  col-lg-12 "></div>

                              <table class="table">
                                <thead>
                              
                                <tbody>
                                  <tr class="bg-danger text-white">
                                    <th >Si</th>
                                    <th id="repuesta7Seccion2Si" >{{respuestasSeccion2['pregunta7']['NumRespuestaSi']}}</th>
                                    <th id="repuesta8Seccion2Si">{{respuestasSeccion2['pregunta8']['NumRespuestaSi']}}</th>                             
                                  </tr>
                                  <tr class="bg-success text-white">
                                    <th >No</th>
                                    <th  id="repuesta7Seccion2No">{{respuestasSeccion2['pregunta7']['NumRespuestaNo']}}</th>
                                    <th  id="repuesta8Seccion2No">{{respuestasSeccion2['pregunta8']['NumRespuestaNo']}}</th>
                                  
                                  </tr>
                                
                                </tbody>
                              </table>
            
                          </div>

                          <div class="col-xs-12 col-sm-6  col-lg-6 ">
                            <h2>III.- Esfuerzo por evitar circunstancias parecidas o 
                              asociadas al acontecimiento (durante el último mes) </h2>
                            <div id="bar-Seccion3" class="col-xs-4 col-sm-6  col-lg-12 "></div>

                            <table class="table">
                              <thead>
                            
                              <tbody>
                                <tr class="bg-success text-white">
                                  <th>Si</th>
                                  <th id="NumRespuestasSiPregunta9"><?php echo isset($respuestaSiSeccion3[0]) ? $respuestaSiSeccion3[0] : 0; ?></th>
                                  <th id="NumRespuestasSiPregunta10"><?php echo isset($respuestaSiSeccion3[1]) ? $respuestaSiSeccion3[1] : 0; ?></th>     
                                  <th id="NumRespuestasSiPregunta11"><?php echo isset($respuestaSiSeccion3[2]) ? $respuestaSiSeccion3[2] : 0; ?></th>  
                                  <th id="NumRespuestasSiPregunta12"><?php echo isset($respuestaSiSeccion3[3]) ? $respuestaSiSeccion3[3] : 0; ?></th>   
                                  <th id="NumRespuestasSiPregunta13"><?php echo isset($respuestaSiSeccion3[4]) ? $respuestaSiSeccion3[4] : 0; ?></th> 
                                  <th id="NumRespuestasSiPregunta14"><?php echo isset($respuestaSiSeccion3[5]) ? $respuestaSiSeccion3[5] : 0; ?></th>  
                                  <th id="NumRespuestasSiPregunta15"><?php echo isset($respuestaSiSeccion3[6]) ? $respuestaSiSeccion3[6] : 0; ?></th>
                              </tr>
                              
                              <tr class="bg-success text-white">
                                  <th>No</th>
                                  <th id="NumRespuestasNoPregunta9"><?php echo isset($respuestaNoSeccion3[0]) ? $respuestaNoSeccion3[0] : 0; ?></th>
                                  <th id="NumRespuestasNoPregunta10"><?php echo isset($respuestaNoSeccion3[1]) ? $respuestaNoSeccion3[1] : 0; ?></th>     
                                  <th id="NumRespuestasNoPregunta11"><?php echo isset($respuestaNoSeccion3[2]) ? $respuestaNoSeccion3[2] : 0; ?></th>  
                                  <th id="NumRespuestasNoPregunta12"><?php echo isset($respuestaNoSeccion3[3]) ? $respuestaNoSeccion3[3] : 0; ?></th>   
                                  <th id="NumRespuestasNoPregunta13"><?php echo isset($respuestaNoSeccion3[4]) ? $respuestaNoSeccion3[4] : 0; ?></th> 
                                  <th id="NumRespuestasNoPregunta14"><?php echo isset($respuestaNoSeccion3[5]) ? $respuestaNoSeccion3[5] : 0; ?></th>  
                                  <th id="NumRespuestasNoPregunta15"><?php echo isset($respuestaNoSeccion3[6]) ? $respuestaNoSeccion3[6] : 0; ?></th>
                              </tr>
                              
                              
                              </tbody>
                            </table>

                          </div>
                  </div>


                  <div class="row mt-5">

                      <div class="col-12">
                        <h2 class="text-center"> 
                          IV Afectación (durante el último mes)

                        </h2>
                        <div id="bar-Seccion4" class="col-xs-4 col-sm-6  col-lg-12 "></div>
                        <table class="table">
                          <thead>
                        
                          <tbody>
                            <tr class="bg-danger text-white">
                              <th >Si</th>
                              <th id="NumRespuestasSiPregunta16"><?php echo isset($respuestaSiSeccion4[0]) ? $respuestaSiSeccion4[0] : 0; ?></th>
                              <th id="NumRespuestasSiPregunta17"><?php echo isset($respuestaSiSeccion4[1]) ? $respuestaSiSeccion4[1] : 0; ?></th>
                              <th id="NumRespuestasSiPregunta18"><?php echo isset($respuestaSiSeccion4[2]) ? $respuestaSiSeccion4[2] : 0; ?></th>
                              <th id="NumRespuestasSiPregunta19"><?php echo isset($respuestaSiSeccion4[3]) ? $respuestaSiSeccion4[3] : 0; ?></th>
                              <th id="NumRespuestasSiPregunta20"><?php echo isset($respuestaSiSeccion4[4]) ? $respuestaSiSeccion4[4] : 0; ?></th>
                                                           
                       
                    
                            </tr>
                            <tr class="bg-success text-white">
                              <th >No</th>
                              <th id="NumRespuestasNoPregunta16"><?php echo isset($respuestaNoSeccion4[0]) ? $respuestaNoSeccion4[0] : 0; ?></th>
                              <th id="NumRespuestasNoPregunta17"><?php echo isset($respuestaNoSeccion4[1]) ? $respuestaNoSeccion4[1] : 0; ?></th>
                              <th id="NumRespuestasNoPregunta18"><?php echo isset($respuestaNoSeccion4[2]) ? $respuestaNoSeccion4[2] : 0; ?></th>
                              <th id="NumRespuestasNoPregunta19"><?php echo isset($respuestaNoSeccion4[3]) ? $respuestaNoSeccion4[3] : 0; ?></th>
                              <th id="NumRespuestasNoPregunta20"><?php echo isset($respuestaNoSeccion4[4]) ? $respuestaNoSeccion4[4] : 0; ?></th>
                              
                                  
                            </tr>
                          
                          </tbody>
                        </table>
                      </div>

                  </div>
                  
                    
              </div>



                  
            </div>
      
              

              
            
              
      </div>
                      
             

        </div>  

</div>


<script type="text/javascript">
   



  $(document).ready(function(){

    var piebarSeccion1RespuestasSi =$('#piebarSeccion1RespuestasSi').text();
    var piebarSeccion1RespuestasNo =$('#piebarSeccion1RespuestasNo').text();
    
    Morris.Donut({
        element: 'graficaDeRespuestasSiSeccion1',
        data: [
          {label: "Personas que contestaron que  SI.", value:piebarSeccion1RespuestasSi},
          {label: "Personas que contestaron que NO", value: piebarSeccion1RespuestasNo},
         
        ],
        colors:['#FF336B','#00B946']
      });


// SECCION 1 INCIO//

//grafica de barras
var NumRespuestasSiPregunta1 =$('#NumRespuestasSiPregunta1').text();
var NumRespuestasSiPregunta2 =$('#NumRespuestasSiPregunta2').text();
var NumRespuestasSiPregunta3 =$('#NumRespuestasSiPregunta3').text();
var NumRespuestasSiPregunta4 =$('#NumRespuestasSiPregunta4').text();
var NumRespuestasSiPregunta5 =$('#NumRespuestasSiPregunta5').text();
var NumRespuestasSiPregunta6 =$('#NumRespuestasSiPregunta6').text();

var NumRespuestasNoPregunta1 =$('#NumRespuestasNoPregunta1').text();
var NumRespuestasNoPregunta2 =$('#NumRespuestasNoPregunta2').text();
var NumRespuestasNoPregunta3 =$('#NumRespuestasNoPregunta3').text();
var NumRespuestasNoPregunta4 =$('#NumRespuestasNoPregunta4').text();
var NumRespuestasNoPregunta5 =$('#NumRespuestasNoPregunta5').text();
var NumRespuestasNoPregunta6 =$('#NumRespuestasNoPregunta6').text();


Morris.Bar({
      element: 'bar-Seccion1',
      data: [
        { y: '¿Accidente que tenga como consecuencia la muerte, la pérdida de un miembro o una lesión grave?', a: NumRespuestasSiPregunta1, b: NumRespuestasNoPregunta1 },
        { y: '¿Asaltos?', a: NumRespuestasSiPregunta2,  b: NumRespuestasNoPregunta2 },
        { y: '¿Actos violentos que derivaron en lesiones graves?', a: NumRespuestasSiPregunta3,  b: NumRespuestasNoPregunta3 },
        { y: '¿Secuestro?', a: NumRespuestasSiPregunta4,  b: NumRespuestasNoPregunta4 },
        //{ y: '¿Secuestro?', a: NumRespuestasSiPregunta4,  b: NumRespuestasNoPregunta4 },
        { y: '¿Amenazas?', a: NumRespuestasSiPregunta5,  b: NumRespuestasNoPregunta5 },
        { y: '¿Cualquier otro que ponga en riesgo su vida o salud, y/o la de otras personas?', a: NumRespuestasSiPregunta6,  b: NumRespuestasNoPregunta6 },
      ],
      barColors: ['#d57171', '#00a65a'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Si', 'No'],

});

// FIN DE SECCION 1//


// SECCION 2 INCIO//
var NumeroDeRepuestasPreg7Si =$('#repuesta7Seccion2Si').text();
var NumeroDeRepuestasPreg7No =$('#repuesta7Seccion2No').text();
var NumeroDeRepuestasPreg8No =$('#repuesta8Seccion2No').text();
var NumeroDeRepuestasPreg8Si =$('#repuesta8Seccion2Si').text();
Morris.Bar({
        element: 'bar-Seccion2',
        data: [
          { y: '¿Ha tenido recuerdos recurrentes sobre el acontecimiento que le provocan malestares?', a: NumeroDeRepuestasPreg7Si, b: NumeroDeRepuestasPreg7No },
          { y: '¿Ha tenido sueños de carácter recurrente sobre el acontecimiento, que le producen malestar?', a: NumeroDeRepuestasPreg8Si,  b: NumeroDeRepuestasPreg8No },

        ],
        barColors: ['#d57171', '#00a65a'],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Si', 'No'],
        grid:true,


});

// FIN DE SECCION 2//

// INICIO DE SECCION 3
var NumRespuestasSiPregunta9 =$('#NumRespuestasSiPregunta9').text();
var NumRespuestasSiPregunta10 =$('#NumRespuestasSiPregunta10').text();
var NumRespuestasSiPregunta11 =$('#NumRespuestasSiPregunta11').text();
var NumRespuestasSiPregunta12 =$('#NumRespuestasSiPregunta12').text();
var NumRespuestasSiPregunta13 =$('#NumRespuestasSiPregunta13').text();
var NumRespuestasSiPregunta14 =$('#NumRespuestasSiPregunta14').text();
var NumRespuestasSiPregunta15 =$('#NumRespuestasSiPregunta15').text();

var NumRespuestasNoPregunta9 =$('#NumRespuestasNoPregunta9').text();
var NumRespuestasNoPregunta10 =$('#NumRespuestasNoPregunta10').text();
var NumRespuestasNoPregunta11 =$('#NumRespuestasNoPregunta11').text();
var NumRespuestasNoPregunta12 =$('#NumRespuestasNoPregunta12').text();
var NumRespuestasNoPregunta13 =$('#NumRespuestasNoPregunta13').text();
var NumRespuestasNoPregunta14 =$('#NumRespuestasNoPregunta14').text();
var NumRespuestasNoPregunta15 =$('#NumRespuestasNoPregunta15').text();

Morris.Bar({
      element: 'bar-Seccion3',
      data: [
        { y: '¿Se ha esforzado por evitar todo tipo de sentimientos, conversaciones o situaciones que le puedan recordar el acontecimiento?', a: NumRespuestasSiPregunta9, b: NumRespuestasNoPregunta9 },
        { y: '¿Se ha esforzado por evitar todo tipo de actividades, lugares o personas que motivan recuerdos del acontecimiento?', a: NumRespuestasSiPregunta10,  b: NumRespuestasNoPregunta10 },
        { y: '¿Ha tenido dificultad para recordar alguna parte importante del evento?', a: NumRespuestasSiPregunta11,  b: NumRespuestasNoPregunta11 },
        { y: '¿Ha disminuido su interés en sus actividades cotidianas?', a: NumRespuestasSiPregunta12,  b: NumRespuestasNoPregunta12 },
        { y: '¿Se ha sentido usted alejado o distante de los demás?', a: NumRespuestasSiPregunta13,  b: NumRespuestasNoPregunta13 },
        { y: '¿Ha notado que tiene dificultad para expresar sus sentimientos?', a: NumRespuestasSiPregunta14,  b: NumRespuestasNoPregunta14 },
        { y: ' ¿Ha tenido la impresión de que su vida se va a acortar, que va a morir antes que otras personas o que tiene un futuro limitado?', a: NumRespuestasSiPregunta15,  b: NumRespuestasNoPregunta15 },
      ],
      barColors: ['#d57171', '#00a65a'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Si', 'No'],

});
// FIN DE SECCION 3

// INICIO DE SESSION 4

var NumRespuestasSiPregunta16 =$('#NumRespuestasSiPregunta16').text();
var NumRespuestasSiPregunta17 =$('#NumRespuestasSiPregunta17').text();
var NumRespuestasSiPregunta18 =$('#NumRespuestasSiPregunta18').text();
var NumRespuestasSiPregunta19 =$('#NumRespuestasSiPregunta19').text();
var NumRespuestasSiPregunta20 =$('#NumRespuestasSiPregunta20').text();

var NumRespuestasNoPregunta16 =$('#NumRespuestasNoPregunta16').text();
var NumRespuestasNoPregunta17 =$('#NumRespuestasNoPregunta17').text();
var NumRespuestasNoPregunta18 =$('#NumRespuestasNoPregunta18').text();
var NumRespuestasNoPregunta19 =$('#NumRespuestasNoPregunta19').text();
var NumRespuestasNoPregunta20 =$('#NumRespuestasNoPregunta20').text();

Morris.Bar({
      element: 'bar-Seccion4',
      data: [
        { y: '¿Ha tenido usted dificultades para dormir?', a: NumRespuestasSiPregunta16, b: NumRespuestasNoPregunta16 },
        { y: '¿Ha estado particularmente irritable o le han dado arranques de coraje?', a: NumRespuestasSiPregunta17,  b: NumRespuestasNoPregunta17 },
        { y: '¿Ha tenido dificultad para concentrarse?', a: NumRespuestasSiPregunta18,  b: NumRespuestasNoPregunta18 },
        { y: '¿Ha estado nervioso o constantemente en alerta?', a: NumRespuestasSiPregunta19,  b: NumRespuestasNoPregunta19 },
        { y: '¿Se ha sobresaltado fácilmente por cualquier cosa?', a: NumRespuestasSiPregunta20,  b: NumRespuestasNoPregunta20 },
      ],
      barColors: ['#d57171', '#00a65a'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Si', 'No'],

});
// FIN DE SECCCION 4


  });      
  
  </script>











