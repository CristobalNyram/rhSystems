


<div class="col-lg-12 mt-4">
    <label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">DATOS DE REFERENCIAS</label>
    <hr class="mt-1">
</div>
<div class="container col-12 border-top border-bottom mt-2 mb-2" id="content_agregar_ref_personal_alta_estudio">
    <div class="row d-flex ml-2" >
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus','onclick':'fnCrearReferenciasPersonales_alta_estudio()', 'height':'50'),"data-toggle":"modal","data-target":"#agregar-referenciapersonal-alta-estudio-modal","title":"Agregar." ,'id':'' ) }}
        <span class="ml-3 mt-4 h6  text-success">Agregar una referencia personal</span>
        


    </div>
    <div id="aqui_insertar_referencias_personales"></div>
 
</div>

<div class="container col-12 border-top border-bottom mt-5 mb-2" id="content_agregar_ref_laboral_alta_estudio">
    <div class="row d-flex ml-2" >
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus','onclick':'fnCrearReferenciasLaboral_alta_estudio()', 'height':'50'),"data-toggle":"modal","data-target":"#agregar-referencialaboral-alta-estudio-modal","title":"Agregar." ,'id':'' ) }}
        <span class="ml-3 mt-4 h6  text-success">Agregar una referencia laboral</span>

    </div>

    <div class="container  mt-1 mb-1 mt-2 mb-1">
  
        <div id="aqui_insertar_referencias_laborales"></div>

     

    </div>

</div>