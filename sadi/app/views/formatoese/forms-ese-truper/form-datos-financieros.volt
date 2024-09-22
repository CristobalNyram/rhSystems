

  <form id="form_estudio_seccionSituacionEconomica_truper" class="form-vertical mt-1" method="post">
                              

                             
                                  

    <input type="hidden" name="sie_id" id="sie_id-formato_truper">
    <input type="hidden" name="sef_id" id="sef_id-formato_truper">
  

    <div class="form-group row text-uppercase d-flex  d-flex justify-content-center">
      <div class="">
        <h5><span class="text-success">Ingresos </span> mensuales  CANDIDATO</h5>
      </div>
    </div>

    <div class="form-group row ml-5 mr-1">
     

      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="cop_nacimientofecha">Sueldo            </label>
        <input type="number" class="ingreso_candidato-formato_truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sie_sueldoingreso" id="sie_sueldoingreso-formato_truper" maxlength="13"   step="0.01" onblur="getTotalSituacionFinacieraCandidato('ingreso_candidato-formato_truper','sie_totalingresos-formato_truper',$('#ese_id_ese_actual_formato_ese_truper').text())"  />

      </div>

    </div> 
    <div class="row col-lg-12 d-flex  ml-2 ">

      <div class="text-left">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50', 'onclick':'fnCrearSituacionEconomicaIngresosCandidatoFormatoTruper();'),"data-toggle":"modal","data-target":"#agregar-situacioneconomica-candidato-ingreso-truper-modal","title":"Agregar ingreso." ,'id':'' ) }}
        <span class="ml-1 h6  text-success">Agregar ingresos de candidato adicionales al sueldo</span>
       </div>

    </div>
 
    <div class="form-group row m-3" id="dato_situacioneconomicaingresos_candidato_truper_listado">
    </div>

   

    <div class="form-group row d-flex justify-content-end">
      <div class="col-lg-6">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Total de ingresos</label>
        <input type="number" step="0.01" class="form-control input-rounded-disabled" placeholder="$00.00" readonly name="sie_totalingresos" id="sie_totalingresos-formato_truper" maxlength="" />


      </div>
    </div>

    

    <div class="form-group row text-uppercase d-flex  d-flex justify-content-center">
      <div class="">
        <h5> <span class="text-danger">Egresos </span>mensuales  Candidato</h5>
      </div>
    </div>


    <div class="form-group row ml-1 mr-1">
     

      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="cop_nacimientofecha">Alimentación</label>
        <input type="number" class="monto-sie-egresos-truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sie_alimentacion" id="sie_alimentacion-formato_truper" maxlength="13"   step="0.01"/>

      </div>
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Ropa/calzado</label>
        <input type="number" class="monto-sie-egresos-truper form-control input-rounded" placeholder="$00.00" oninput="limitDecimalPlaces(event,2)"  name="sie_ropacalzado" id="sie_ropacalzado-formato_truper" maxlength="13" step="0.01" />


      </div>
      
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_genero">Servicios(Telefono, luz, agua)</label>
        <input type="number" class="monto-sie-egresos-truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_serviciodomestico" id="sie_serviciodomestico-formato_truper" maxlength="13"   step="0.01"/>

      </div>
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Colegiaturas        </label>
        <input type="number" class="monto-sie-egresos-truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_escolares" id="sie_escolares-formato_truper" maxlength="13"   step="0.01"/>


      </div>
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Créditos</label>
        <input type="number" class="monto-sie-egresos-truper form-control input-rounded" placeholder="$00.00"    oninput="limitDecimalPlaces(event,2)" name="sie_creditos" id="sie_creditos-formato_truper" maxlength="13"  step="0.01"/>


      </div>

      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_edad">Seguros</label>
        <input type="number" class="monto-sie-egresos-truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_seguros" id="sie_seguros-formato_truper" nmaxlength="13" step="0.01" />
      </div>

    

   
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_edad">Hipotecas</label>
        <input type="number" class="monto-sie-egresos-truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_hipoteca" id="sie_hipoteca-formato_truper" nmaxlength="13" step="0.01" />
      </div>
      
      

      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Diversiones</label>
        <input type="number" class="monto-sie-egresos-truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_diversiones" id="sie_diversiones-formato_truper" maxlength="13"  step="0.01"/>


      </div>

     
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Mascotas</label>
        <input type="number" class="monto-sie-egresos-truper form-control input-rounded" placeholder="$00.00"   oninput="limitDecimalPlaces(event,2)" name="sie_mascotas" id="sie_mascotas-formato_truper" maxlength="13"   step="0.01"/>


      </div>

      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Ahorros</label>
        <input type="number" class="monto-sie-egresos-truper form-control input-rounded" placeholder="$00.00"   oninput="limitDecimalPlaces(event,2)" name="sie_ahorros" id="sie_ahorros-formato_truper" maxlength="13"   step="0.01"/>


      </div>

      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_edad">Renta</label>
        <input type="number" class="monto-sie-egresos-truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sie_renta" id="sie_renta-formato_truper" nmaxlength="13" step="0.01" />
      </div>
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Concepto de otros</label>
        <input type="text" class=" form-control input-rounded" placeholder="Concepto del otro egreso..."  oninput="handleInput(event)" name="sie_otrosconcepto" id="sie_otrosconcepto-formato_truper" maxlength="55" />

        
      </div>
      <div class="col-lg-3">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Otros</label>
        <input type="number" class="monto-sie-egresos-truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sie_otros" id="sie_otros-formato_truper" maxlength="13" step="0.01" />

        
      </div>


  

      <div class="col-lg-12">
        <label class="col-form-label title-busq" for="estudio_estado_civil">Total de egresos</label>
        <input type="number" class="form-control input-rounded-disabled" placeholder="$00.00" readonly step="0.01"  name="sie_totalegresos" id="sie_totalegresos-formato_truper" maxlength="" />
      </div>

      

    </div>








    <section class="m-3 contorno-del-sistema">



        <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
            <div class="container ">
      
                    <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                      G | SITUACIÓN FINANCIERA FAMILIAR									
								
                        <i class="mdi mdi-cash white"></i>
                    </p>

            </div>
        </div>

        <input type="hidden" id="sie_id" name="sie_id">

        <div class="form-group row text-uppercase d-flex  d-flex justify-content-center">
          <div class="">
            <h5><span class="text-success">Ingresos </span> mensuales  FAMILIARES</h5>
          </div>
        </div>
       

        <div class="form-group row ml-5 mr-5">
     

          <div class="col-lg-3">
            <label class="col-form-label title-busq" for="sie_sueldoingreso">Cónyuge	
            </label>
            <input type="number" class="ingreso_familiar-formato_truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sef_conyugeingreso" id="sef_conyugeingreso-formato_truper" maxlength="13"   step="0.01" onblur="getTotalSituacionFinacieraFamiliar('ingreso_familiar-formato_truper','sef_totalingresosfamiliares-formato_truper',$('#ese_id_ese_actual_formato_ese_truper').text());"/>
    
          </div>

          <div class="col-lg-3">
            <label class="col-form-label title-busq" for="sie_sueldoingreso">Hijos: (Mayores de Edad)	
	
            </label>
            <input type="number" class="ingreso_familiar-formato_truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sef_hijosmenoresingreso" id="sef_hijosmenoresingreso-formato_truper" maxlength="13"   step="0.01" onblur="getTotalSituacionFinacieraFamiliar('ingreso_familiar-formato_truper','sef_totalingresosfamiliares-formato_truper',$('#ese_id_ese_actual_formato_ese_truper').text());"/>
    
          </div>

          <div class="col-lg-3">
            <label class="col-form-label title-busq" for="sie_sueldoingreso">Hijos: (Menores de Edad)	

            </label>
            <input type="number" class="ingreso_familiar-formato_truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sef_hijosadultosingreso" id="sef_hijosadultosingreso-formato_truper" maxlength="13"   step="0.01" onblur="getTotalSituacionFinacieraFamiliar('ingreso_familiar-formato_truper','sef_totalingresosfamiliares-formato_truper',$('#ese_id_ese_actual_formato_ese_truper').text());"/>
    
          </div>
    
          <div class="col-lg-3">
            <label class="col-form-label title-busq" for="sie_sueldoingreso">Padres

            </label>
            <input type="number" class="ingreso_familiar-formato_truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sef_padresingreso" id="sef_padresingreso-formato_truper" maxlength="13"   step="0.01" onblur="getTotalSituacionFinacieraFamiliar('ingreso_familiar-formato_truper','sef_totalingresosfamiliares-formato_truper',$('#ese_id_ese_actual_formato_ese_truper').text());"/>
    
          </div>
    

          <div class="col-lg-3">
            <label class="col-form-label title-busq" for="sie_sueldoingreso">Hermanos

            </label>
            <input type="number" class="ingreso_familiar-formato_truper form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sef_hermanosingreso" id="sef_hermanosingreso-formato_truper" maxlength="13"   step="0.01" onblur="getTotalSituacionFinacieraFamiliar('ingreso_familiar-formato_truper','sef_totalingresosfamiliares-formato_truper',$('#ese_id_ese_actual_formato_ese_truper').text());"/>
    
          </div>
    



        </div>
        <div class="row col-lg-12 d-flex  ml-2 ">
    
          <div class="text-left">
            {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50', 'onclick':'fnCrearSituacionEconomicaIngresosFamiliar_FormatoTruper();'),"data-toggle":"modal","data-target":"#agregar-familiar-truper-situacioneconomica-ingreso-modal","title":"Agregar ingreso." ,'id':'' ) }}
            <span class="ml-1 h6  text-success">Agregar referencias de ingresos familiares adicionales a los listados </span>
           </div>
    
        </div>
        <div class="form-group row m-3" id="dato_situacioneconomicaingresos_familiar_truper_listado">
        </div>

        <div class="form-group row d-flex justify-content-end">
          <div class="col-lg-6">
            <label class="col-form-label title-busq" for="estudio_estado_civil">Total de ingresos</label>
            <input type="number" class="form-control input-rounded-disabled" placeholder="$00.00" readonly name="sef_totalingresos" id="sef_totalingresosfamiliares-formato_truper" maxlength="" />
    
    
          </div>
        </div>
    
        <div class="form-group row text-uppercase d-flex  d-flex justify-content-center">
          <div class="">
            <h5> <span class="text-danger">Egresos </span>mensuales  FAMILIARES</h5>
          </div>
        </div>
        <div class="form-group row ml-1">
         
    
       
    
    
          
    
        </div>
    

      <div class="pt-5">

      </div>

      <div class="form-group row ml-1 mr-1">
     

        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="cop_nacimientofecha">Alimentación</label>
          <input type="number" class="monto-sef-egresos-trupero form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sef_alimentacion" id="sef_alimentacion-formato_truper" maxlength="13"   step="0.01"/>
  
        </div>
        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="estudio_estado_civil">Ropa/calzado</label>
          <input type="number" class="monto-sef-egresos-trupero form-control input-rounded" placeholder="$00.00" oninput="limitDecimalPlaces(event,2)"  name="sef_ropacalzado" id="sef_ropacalzado-formato_truper" maxlength="13" step="0.01" />
  
  
        </div>
        
        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="estudio_genero">Servicios(Telefono, luz, agua)</label>
          <input type="number" class="monto-sef-egresos-trupero form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sef_serviciodomestico" id="sef_serviciodomestico-formato_truper" maxlength="13"   step="0.01"/>
  
        </div>
        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="estudio_estado_civil">Colegiaturas        </label>
          <input type="number" class="monto-sef-egresos-trupero form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sef_escolares" id="sef_escolares-formato_truper" maxlength="13"   step="0.01"/>
  
  
        </div>
        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="estudio_estado_civil">Créditos</label>
          <input type="number" class="monto-sef-egresos-trupero form-control input-rounded" placeholder="$00.00"    oninput="limitDecimalPlaces(event,2)" name="sef_creditos" id="sef_creditos-formato_truper" maxlength="13"  step="0.01"/>
  
  
        </div>
  
        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="estudio_edad">Seguros</label>
          <input type="number" class="monto-sef-egresos-trupero form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sef_seguros" id="sef_seguros-formato_truper" nmaxlength="13" step="0.01" />
        </div>
  
      
  
     
        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="estudio_edad">Hipotecas</label>
          <input type="number" class="monto-sef-egresos-trupero form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sef_hipotecas" id="sef_hipotecas-formato_truper" nmaxlength="13" step="0.01" />
        </div>
        
        
  
        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="estudio_estado_civil">Diversiones</label>
          <input type="number" class="monto-sef-egresos-trupero form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sef_diversiones" id="sef_diversiones-formato_truper" maxlength="13"  step="0.01"/>
  
  
        </div>
  
       
        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="estudio_estado_civil">Mascotas</label>
          <input type="number" class="monto-sef-egresos-trupero form-control input-rounded" placeholder="$00.00"   oninput="limitDecimalPlaces(event,2)" name="sef_mascotas" id="sef_mascotas-formato_truper" maxlength="13"   step="0.01"/>
  
  
        </div>
  
        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="estudio_estado_civil">Ahorros</label>
          <input type="number" class="monto-sef-egresos-trupero form-control input-rounded" placeholder="$00.00"   oninput="limitDecimalPlaces(event,2)" name="sef_ahorro" id="sef_ahorro-formato_truper" maxlength="13"   step="0.01"/>
  
  
        </div>
  
        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="estudio_edad">Renta</label>
          <input type="number" class="monto-sef-egresos-trupero form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)"  name="sef_renta" id="sef_renta-formato_truper" nmaxlength="13" step="0.01" />
        </div>
       
        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="estudio_estado_civil">Concepto de otros</label>
          <input type="text" class=" form-control input-rounded" placeholder="Concepto del otro egreso..."  oninput="handleInput(event)" name="sef_otrosconcepto" id="sef_otrosconcepto-formato_truper" maxlength="55" />
  
          
        </div>

        <div class="col-lg-3">
          <label class="col-form-label title-busq" for="estudio_estado_civil">Otros</label>
          <input type="number" class="monto-sef-egresos-trupero form-control input-rounded" placeholder="$00.00"  oninput="limitDecimalPlaces(event,2)" name="sef_otros" id="sef_otros-formato_truper" maxlength="13" step="0.01" />
  
          
        </div>
  
  
    
  
        <div class="col-lg-12">
          <label class="col-form-label title-busq" for="estudio_estado_civil">Total de egresos</label>
          <input type="number" class="form-control input-rounded-disabled" placeholder="$00.00" readonly step="0.01"  name="sef_totalegresos" id="sef_totalegresos-formato_truper" maxlength="" />
        </div>
  
        
  
      </div>


      <div class="form-group row mr-2 ml-2">
        <div class="col-lg-2">
          <label for="sie_solventa-formato_truper" class="col-form-label title-busq ml-2">¿Cuando los gastos son mayores a los ingresos, ¿Cómo los solventa el Candidato?				
          </label>

        </div>
        <div class="col-lg-10">

          <textarea id="sie_solventa-formato_truper" name="sie_solventa" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="100" onkeyup="actualizaInfo(100,'sie_solventa-formato_truper', 'label-sie_solventa-formato_truper')"></textarea>
          <label  id="label-sie_solventa-formato_truper"  class="col-form-label title-busq ml-2"></label>

        </div>
       </div>  


</section>



    
<div class="row col-lg-12">
<div class="col-sm-3 col-md-3 text-center mt-5">
</div>                          
<div class="col-sm-3 col-md-3 text-center mt-5">
  {% if cuarentayseis==1%}
    <div class="form-group">
      <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_ese_truper').text(),18)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
    </div>
  {% endif %}
</div>
<div class="col-sm-3 col-md-3 text-center mt-5">
    <div class="form-group">
      <button type="button" class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
    </div>
</div>
<div class="col-sm-3 col-md-3  text-center mt-5 ">
    <div class="form-group">
      <button type="submit" class="btn-dark btn-rounded btn btn-buscar" type="submit">Guardar <i class="mdi mdi-content-save white"></i> </button>
    </div>
</div>
</div>

</form> 



<script>
 

 let monto_monto_sie_truper =document.querySelectorAll('.monto-sie-egresos-truper');
 for (let index = 0; index < monto_monto_sie_truper.length; index++) {
    
  monto_monto_sie_truper[index].addEventListener('change',()=>{
    // console.log(monto_monto_sie_truper[2]);
        let sum = 0;
            for (let index2 = 0; index2 <monto_monto_sie_truper.length; index2++) {
                  if(monto_monto_sie_truper[index2].value!='')
                  {
                    if(monto_monto_sie_truper[index2].value>=0)
                    {
                      sum +=parseFloat(monto_monto_sie_truper[index2].value);

                    }
                    else
                    {
                      monto_monto_sie_truper[index2].value=0;
                    }
                  }
            } 
          document.getElementById('sie_totalegresos-formato_truper').value=sum; 
            
        
      }); 

}


let monto_monto_sef_truper =document.querySelectorAll('.monto-sef-egresos-trupero');
 for (let index = 0; index < monto_monto_sef_truper.length; index++) {
    
  monto_monto_sef_truper[index].addEventListener('change',()=>{
    // console.log(monto_monto_sef_truper[2]);
        let sum = 0;
            for (let index2 = 0; index2 <monto_monto_sef_truper.length; index2++) {
                  if(monto_monto_sef_truper[index2].value!='')
                  {
                    if(monto_monto_sef_truper[index2].value>=0)
                    {
                      sum +=parseFloat(monto_monto_sef_truper[index2].value);

                    }
                    else
                    {
                      monto_monto_sef_truper[index2].value=0;
                    }
                  }
            } 
          document.getElementById('sef_totalegresos-formato_truper').value=sum; 
            
        
      }); 

}

function getTotalSituacionFinacieraCandidato(inputs_class_ingresos,input_donde_se_muestra_el_total,ese_id){

  let total_ingresos_individual=0;
  let inputs_ingresos= document.querySelectorAll('.'+inputs_class_ingresos);

         for (let index= 0; index <inputs_ingresos.length; index++) {

                  if(inputs_ingresos[index].value!='')
                  {

                    if(inputs_ingresos[index].value>=0)
                    {
                      total_ingresos_individual +=parseFloat(inputs_ingresos[index].value);

                    }
                    else
                    {
                      inputs_ingresos[index].value=0;
                    }

                  }

                  

           } 

           let url_enviar="<?php echo $this->url->get('situacioneconomica/ajax_get_total_ingresos_candidato_formatotruper/') ?>";
  
            $.ajax({
                type: "POST",
                url: url_enviar+ese_id,
                data:{
                  'total_ingreso_sueldo':total_ingresos_individual
                },
                  
                success: function(res)
                {
              
                  document.getElementById(input_donde_se_muestra_el_total).value=res; 
          
                  
                },
                error: function(res)
                {
                    alertify.alert('ERROR','No se pudieron cargar los dato financieros.'); 
                  
                }
            });


    
}




function getTotalSituacionFinacieraFamiliar(inputs_class_ingresos,input_donde_se_muestra_el_total,ese_id){

let total_ingresos_individual=0;
let inputs_ingresos= document.querySelectorAll('.'+inputs_class_ingresos);

       for (let index= 0; index <inputs_ingresos.length; index++) {

                if(inputs_ingresos[index].value!='')
                {

                  if(inputs_ingresos[index].value>=0)
                  {
                    total_ingresos_individual +=parseFloat(inputs_ingresos[index].value);

                  }
                  else
                  {
                    inputs_ingresos[index].value=0;
                  }

                }

                

         } 

         let url_enviar="<?php echo $this->url->get('situacioneconomica/ajax_get_total_ingresos_familiar_formatotruper/') ?>";

          $.ajax({
              type: "POST",
              url: url_enviar+ese_id,
              data:{
                'total_ingresos_familiar':total_ingresos_individual
              },
                
              success: function(res)
              {
                
            
                // console.log(res,total_ingresos_individual);
                document.getElementById(input_donde_se_muestra_el_total).value=res; 

        
                
              },
              error: function(res)
              {
                  alertify.alert('ERROR','No se pudieron cargar los dato financieros.'); 
                
              }
          });


  
}
    
</script>