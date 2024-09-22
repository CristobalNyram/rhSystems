
<div name="busqueda-filtros" id="busqueda-filtros"  class="busqueda-item card card-crm container-options-menu col-12 col-lg-3 col-sm-3 mr-2">
   <div id="texto-filtro-recomendado" class="text-filtro-rec"></div>
    <label class="title-busq d-flex justify-content-center mt-2 uppercase">Filtros</label>
     <div  id="container-menu-options" class="container-menu-options" aria-labelledby="dropdownMenu2">
        <div class="grupo-filtro">

            <span class="grupo-filtro__titulo">Vacante</span>
            <hr class="grupo-filtro__line">

            <button class="dropdown-item active" type="button" id="filtro_fecha_alta">Fecha alta</button>
  
            {# <button class="dropdown-item" type="button" id="filtro_fecha_cancelación">Fecha cancelación</button> #}
            <button class="dropdown-item" type="button" id="filtro_vac_fechafin">Fecha fin</button>
            <button class="dropdown-item" type="button" id="filtro_vac_actualizacion">Fecha de actualización de vacante</button>
            <button class="dropdown-item" type="button" id="filtro_vac_fechareactivoproceso">Fecha de reactivación de proceso</button>
            <button class="dropdown-item" type="button" id="filtro_sexo">Género</button>
            <button class="dropdown-item" type="button" id="filtro_tpg_id">Tipo pago</button>
            <button class="dropdown-item" type="button" id="filtro_estadocivil">Estado civil</button>
            <button class="dropdown-item" type="button" id="filtro_gra_id">Grado escolar</button>
            <button class="dropdown-item" type="button" id="filtro_tie_id">Tipo empleo</button>
            <button class="dropdown-item" type="button" id="filtro_pre_id">Prestación</button>
            <button class="dropdown-item" type="button" id="filtro_tip_id">Tipo de vacante</button>
            <button class="dropdown-item" type="button" id="filtro_usu_idreactivoproceso">Usuarios que reactivaron proceso</button>
            <button class="dropdown-item" type="button" id="filtro_vac_estatus">Estatus de vacante</button>
            <button class="dropdown-item" type="button" id="filtro_vac_id">Vacandate ID</button>

            
        </div>
        <div class="grupo-filtro">
            <span class="grupo-filtro__titulo ">Expediente</span>
           <hr class="grupo-filtro__line">
            <button class="dropdown-item" type="button" id="filtro_exc_usi_idalta">Usuario alta</button>
            <button class="dropdown-item" type="button" id="filtro_can_valido">Candidato con información validada</button>
            <button class="dropdown-item" type="button" id="filtro_can_correo">Candidato correo</button>

        </div>

        <div class="grupo-filtro psicometria">
            <span class="grupo-filtro__titulo ">Psicometría</span>
            <hr class="grupo-filtro__line">
            <button class="dropdown-item" type="button" id="filtro_psi_calificacion">Calificación</button>
            <button class="dropdown-item" type="button" id="filtro_psi_fecharegistro">Registro de psicometría </button>

        </div>

        <div class="grupo-filtro entrevista">
            <span class="grupo-filtro__titulo ">Entrevista</span>
            <hr class="grupo-filtro__line">
            <button class="dropdown-item" type="button" id="filtro_ent_seleccionado">Seleccionado</button>
            <button class="dropdown-item" type="button" id="filtro_ent_fecharegistro">Fecha registro </button>
        </div>
        <div class="grupo-filtro facturacion">
            <span class="grupo-filtro__titulo ">Facturación</span>
            <hr class="grupo-filtro__line">
            <button class="dropdown-item" type="button" id="filtro_fat_fecharegistro">Fecha registro</button>
        </div>
    

         <div class="grupo-filtro cita">
            <span class="grupo-filtro__titulo ">Cita</span>
            <hr class="grupo-filtro__line">
            
            <button class="dropdown-item" type="button" id="filtro_cit_registro">Fecha registro</button>
            <button class="dropdown-item" type="button" id="filtro_cit_fecha">Fecha cita</button>
            <button class="dropdown-item" type="button" id="filtro_cit_hora">Hora cita</button>
            <button class="dropdown-item" type="button" id="filtro_tic_id">Tipo cita</button>
            <button class="dropdown-item" type="button" id="filtro_med_id">Medio de contacto</button>

        </div>

        <div class="grupo-filtro referencias">
            <span class="grupo-filtro__titulo ">Referencias</span>
            <hr class="grupo-filtro__line">
            
            <button class="dropdown-item" type="button" id="filtro_sel_registro">Fecha registro</button>
            <button class="dropdown-item" type="button" id="filtro_sel_calificacion">Calificación</button>
            <button class="dropdown-item" type="button" id="filtro_sel_necesitoauxiliar">Necesita auxiliar</button>
            <button class="dropdown-item" type="button" id="filtro_sel_empleosocultos">Empleo ocultos</button>

        </div>
          <div class="grupo-filtro garantia">
            <span class="grupo-filtro__titulo ">Garantía</span>
            <hr class="grupo-filtro__line">
            <button class="dropdown-item" type="button" id="filtro_usu_idgarantia">Usuarios que mandaron garantía</button>
            <button class="dropdown-item" type="button" id="filtro_exc_fechagarantia">Registro de garantía </button>

        </div>

    </div>
</div>