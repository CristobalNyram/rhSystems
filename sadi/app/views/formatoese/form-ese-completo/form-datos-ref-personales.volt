<form id="form_estudio_seccionReferenciasPersonales" class="form-vertical mt-1">
                                 

                              
                
    <div class="form-group row mt-3 mb-3 d-flex justify-content-center">
           <p class="text-danger h6 font-weight-bold uppercase">
             QUE NO SEAN PARIENTES, NI JEFES DE EMPLEOS ANTERIORES
           </p>
     </div>

     
<section class="m-3">

<div class="row col-lg-12 d-flex ml-2 ">


<div class="text-left">
{{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearReferenciaPersonal();'),"data-toggle":"modal","data-target":"#agregar-referenciapersonal-modal","title":"Agregar." ,'id':'' ) }}
<span class="ml-3 h6  text-success">Agregar referencias personales</span>

</div>


</div>
<input type="hidden" class="form-control input-rounded" oninput=""  placeholder="" maxlength=""  name="sep_id" id="sep_id"/>


<div class="form-group row m-3" id="dato_referenciapersonal_listado">
</div>



       




</section>





<div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
<div class="container ">

<p class=" text-white text-center font-weight-bold h6 sin-margen" >
I | Referencias vecinales <i class="mdi mdi-home-city-outline white"></i>
</p>

</div>
</div>

<div class="row col-lg-12 d-flex ml-4 ">


<div class="text-left">
{{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearReferenciaVecinal();'),"data-toggle":"modal","data-target":"#agregar-referenciavecinal-modal","title":"Agregar." ,'id':'' ) }}
<span class="ml-3 h6  text-success">Agregar referencias vecinales</span>

</div>


</div>

<div class="form-group row m-3" id="dato_referenciavecinal_listado">
</div>




















{% if cuarenta==1%}

<div class="form-group row d-flex flex-row-reverse">
<div class="col-lg-4">
<label class="col-form-label title-busq text-uppercase ">Calificación</label>
<select  name="sep_calificacion" id="sep_calificacion" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
<optgroup>
<option value="-1">Seleccionar ...</option>
<option value="1">1.-INAPROPIADO</option>
<option value="2">2.-PROMEDIO</option>
<option value="3">3.-APROPIADO</option>
</optgroup>
</select>
</div>
</div>
{% endif %}








<div class="row col-lg-12">
<div class="col-sm-3 col-md-3 text-center mt-5">
</div>                          
<div class="col-sm-3 col-md-3 text-center mt-5">
{% if cuarentayseis==1%}
<div class="form-group">
<button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual').text(),9)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
</div>
{% endif %}
</div>
<div class="col-sm-3 col-md-3 text-center mt-5">
<div class="form-group">
<button type="button"class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
</div>
</div>
<div class="col-sm-3 col-md-3  text-center mt-5 ">
<div class="form-group">
<button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
</div>
</div>
</div>

</form> 