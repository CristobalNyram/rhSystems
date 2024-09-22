{{ javascript_include("assets/libs/morris-js/morris.min.js") }}
{{ javascript_include("assets/libs/raphael/raphael.min.js") }}
<!-- vue js -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
{{ javascript_include('assets/js/vue/vue.global.js') }}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<div class="container-d-flex-and-block mb-2">
    <div name="" id="" class="card card-crm  col-12 col-lg-6 col-sm-6 m-1">
        <div class="">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn pb-3 pl-3 btn-eye-show-info button_ver" title="Ver más información..."
                    onclick="fnShowOrHideTable(event,'content_table_aprobados');"
                    >
                    <i class="mdi mdi-eye-plus  mdi-18px btn-icon" style="color:white ;"></i>

                </button>


            </div>

            <div class="row  d-fle justify-content-center">
                <h5>Estudios <span class="text-success"> aprobados</span> esta semana: <span class="text-info"
                        id="eses_aprobados_titulo"> </span> estudios</h5>
            </div>

        </div>

        <div class=" mt-1 pt-2 pb-2 pr-1 pl-1   col-12" >

            <div style="display: none;" class="col-11" id="content_table_aprobados">
                        <table sty id="table_ese_aprobados" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; overflow: auto;">
                            <thead class="thead-light-crm">

                                <tr>
                                    <th>Folio</th>
                                    <th>Nombre</th>
                                  
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
            </div>

        </div>


    </div>

    <div name="" id="" class="card card-crm  col-lg-6 col-sm-6  m-2">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn pb-3 pl-3 btn-eye-show-info button_ver" title="Ver más información..."
            onclick="fnShowOrHideTable(event,'content_table_cancelados');"

            >
                <i class="mdi mdi-eye-plus  mdi-18px btn-icon" style="color:white ;"></i>
            </button>

        </div>
        <div class="row  d-fle justify-content-center mr-2 ml-2">
            <h5>Estudios <span class="text-danger"> cancelados </span> esta semana: <span class="text-info"
                    id="eses_cancelados_titulo"> </span> estudios</h5>


        </div>





        <div class="mt-1 col-12">
            <div style="display:none ;" class="col-11" id="content_table_cancelados">
                <table id="table_ese_cancelados" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                        <thead class="thead-light-crm">

                            <tr>
                                <th>Folio</th>
                                <th>Nombre</th>
                            
                                <th>Acciones</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                  </table>

            </div>
          
        </div>

    </div>



</div>
<div class="container-d-flex-and-block m-1">
    <div name="" id="" class="card card-crm  col-12 col-lg-4 col-sm-3 p-2 m-1">
        <div class="row  d-fle justify-content-center mr-2 ml-2">
            <h5>Estudios en etapa de <span class="text-success">altas</span> esta semana: <span class="text-info"
                    id="eses_alta_titulo"></span> estudios</h5>


        </div>
        <div class="mt-1 col-12">
            <table id="table_ese_alta" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light-crm">

                    <tr>
                        <th>Folio</th>
                        <th>Nombre</th>

                        <th>Acciones</th>


                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>




    </div>

    <div name="" id="" class="card card-crm  col-12 col-lg-4 col-sm-3 p-2 m-1">

        <div class="row  d-fle justify-content-center mr-2 ml-2">
            <h5>Estudios en etapa de <span class="text-success">tráfico investigador </span> esta semana: <span
                    class="text-info" id="ese_trafico_investigador_titulo"> </span> estudios</span></h5>


        </div>
        <div class="mt-1 col-12">
            <table id="table_ese_trafico_investigador" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light-crm">

                    <tr>
                    <tr>
                        <th>Folio</th>
                        <th>Nombre</th>

                        <th>Acciones</th>


                    </tr>


                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>

    </div>
    <div name="" id="" class="card card-crm  col-12 col-lg-4 col-sm-3 p-2 m-1 ">
        <div class="row  d-fle justify-content-center mr-2 ml-2">
            <h5>Estudios en etapa de <span class="text-success">tráfico analista </span> esta semana: <span
                    class="text-info" id="titulo_ese_trafico_analista"> </span> estudios</span></h5>



        </div>
        <div class="mt-1 col-12">
            <table id="table_ese_trafico_analista" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light-crm">

                    <tr>
                        <th>Folio</th>
                        <th>Nombre</th>
                        <th>Acciones</th>


                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>

    </div>



</div>
<div class="container-d-flex-and-block mb-2">
    <div name="" id="" class="card card-crm  col-12 col-lg-6 col-sm-6 p-2 m-1">
        <div class="row  d-fle justify-content-center ">
            <h5>Honorarios

                <i class="mdi mdi-cash  mdi-18px btn-icon"></i>
            </h5>

        </div>
        <div class="mt-1 col-12">
            <table id="table_ese_cancelados" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light-crm">

                    <tr>
                        <th>ID investigador</th>
                        <th>Investigador</th>
                        <th>Pago honoario</th>
                        <th>Pago viático</th>

                    </tr>
                </thead>
                <tbody>
                    < </tbody>

            </table>

            <div class="badge badge-pill badge-success mt-2">
                <span class="text-white p-5 mt-2 mb-2" style="font-size:1rem;">Total de honorario de está semana: $
                    <span id="total_honorarios_aprobado"> </span> </span>

            </div>
        </div>
    </div>
    <div name="" id="" class="card card-crm  col-12 col-lg-6 col-sm-6 p-2 m-1">

        <div class="row  d-fle justify-content-center ">
            <h5>Transporte aprobados esta semana: <span class="text-info" id="titulo_tra_aprobados"> </span>
                <i class="mdi mdi-car  mdi-18px btn-icon"></i>

            </h5>

        </div>

        <div class="mt-1 col-12">
            <table id="table_tra_aprobados" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light-crm">

                    <tr>
                        <th>Folio</th>
                        <th>Estudio</th>

                        <th>Aprobo</th>
                        <th>Fecha de aprobación</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Acciones</th>




                    </tr>
                </thead>
                <tbody>

                </tbody>


            </table>

            <div class="badge badge-pill badge-success mt-2">
                <span class="text-white p-5 mt-2 mb-2" style="font-size:1rem;">Total de transportes aprobados: $ <span
                        id="total_transporte_aprobado"> </span> </span>

            </div>
        </div>


    </div>


</div>


<div class="row ml-1">
    <div class="container-d-flex-and-block card card-crm   col-12 col-lg-6 col-sm-6 p-2 mt-1 mb-2">

        <div name="" id="" class="row justify-content-center">
            <h5>Estadísticas de estudios<span class="text-info"> alta</span> vs <span class="text-success"> entegrados
                </span></h5>
        </div>


        <div class="row justify-content-center">
            <div id="bar-chart-alta-vs-entregados"></div>


        </div>
    </div>
    <div class="container-d-flex-and-block card card-crm  col-12 col-lg-6 col-sm-6 p-2 mt-1 mb-2">

        <div name="" id="" class="row justify-content-center ml-3 mr-3">
            <h5>Estadística general de estudios<span class="text-info"> registrados estos ultimos 8 dias</span></h5>
        </div>


        <div class="row justify-content-center m-2">
            <div id="pie-chart-reporte-general-de-estudios"></div>


        </div>
        <div class="badge badge-pill badge-info mt-2 ml-4 mr-4 pt-2 pb-2">
            <span class="text-white p-5 mt-2 mb-2" style="font-size:1rem;">Estudios trabajados está semana: <span
                    id="total_eses_trabajados_estos_dias"></span> </span>

        </div>
    </div>
</div>



<div class="modal fade" id="id_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tabla de los estudios en estatus : X </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>



<script>

    const  fnGetDataTableOfEsesAprobados = new Promise(function(resolve,reject){
     
                     
    });


    function fnShowOrHideTable(event, contenedor_tabla, callbackPromisekGetCurrentDataTable) {
        // $('#content_table_aprobados').hide();
        let btn = event.currentTarget;
        let elemento_contenedor = event.currentTarget.parentElement.parentElement.parentElement;
        btn.innerHTML = `<i class="fa fa-spinner fa-spin fa-lg" style="color:white ;"></i>`;
        btn.disabled = true;
       //  $('#content_table_aprobados').DataTable().clear();      
           
            if (btn.classList.contains('btn-eye-show-info-active')) {
                
                btn.classList.remove('btn-eye-show-info-active');
                btn.innerHTML = `<i class="mdi mdi-eye-plus  mdi-18px btn-icon" style="color:white ;"></i>`;
                $(`#${contenedor_tabla}`).hide('show');
                btn.disabled = false;


            } else {

          
            
                        btn.classList.add('btn-eye-show-info-active');
                        btn.innerHTML = `<i class="mdi mdi-eye-minus  mdi-18px btn-icon" style="color:white ;"></i>`;
                        btn.disabled = false;
                        $(`#${contenedor_tabla}`).show('show');
                        $( `#${contenedor_tabla}` ).addClass( 'col-10');
                 
               

            }



    }
</script>

<script>
    //graficas inicio
    let data = [
        { y: '2014', altas: 50, aprobados: 90, cancelados: 10 },
    ],
        config = {
            data: data,
            xkey: 'y',
            ykeys: ['altas', 'aprobados', 'cancelados'],
            labels: ['Total de estudios dados de alta', 'Total de estudios aprobados', 'Total de estudios cancelados'],
            fillOpacity: 0.6,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors: ['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors: ['gray', 'yellow', 'blue'],
            barColors: ['blue', 'green', 'red']
        };



    ///graficas fin

    let urlGetDatallesEses = "<?php echo $this->url->get('dashboard/ajax_get_detalle_general_eses/') ?>";
    let urlGetDetalleAltaAprobadoCancelado = "<?php echo $this->url->get('dashboard/ajax_get_reporte_alta_aprobado_cancelados_eses/') ?>";
    let configAjaxFetch = {
        method: 'POST', // or 'PUT'
        headers: new Headers({
            'Content-Type': 'text/plain',
            'X-Requested-With': 'XMLHttpRequest'
        })
    };

    let get_total_alta_aprobados_cancelados = fetch(urlGetDetalleAltaAprobadoCancelado, configAjaxFetch);


    get_total_alta_aprobados_cancelados
        .then(res => {
            return res.json();
        })
        .then(response => {
            console.log(response);
        })
        .catch();

    let get_total_ese_detalle_general = fetch(urlGetDatallesEses, configAjaxFetch);
    get_total_ese_detalle_general
        .then(
            (response) => {
                return response.json()
            }
        )
        .then((data) => {
            let ese_registro_cancelados = data['ese_cancelados']['no_registros'];
            let ese_registro_asignar_investigador = data['ese_asig_inv']['no_registros'];
            let ese_registro_trafico_investigador = data['ese_tra_inv']['no_registros'];
            let ese_registro_asignar_analista = data['ese_asig_ana']['no_registros'];
            let ese_registro_trafico_analista = data['ese_tra_ana']['no_registros'];
            let ese_registro_autorizar = data['ese_validacion']['no_registros'];
            let ese_registro_autorizados = data['ese_aprobados']['no_registros'];

            let total_estudios_corriendo_estos_dias = data['eses_total']['no_registros'];

            document.getElementById('total_eses_trabajados_estos_dias').innerText = total_estudios_corriendo_estos_dias;


            config.element = 'bar-chart-alta-vs-entregados';
            Morris.Bar(config);
            config.element = 'stacked';
            config.stacked = true;
            Morris.Donut({
                element: 'pie-chart-reporte-general-de-estudios',
                data: [
                    { label: "Asignar investigador", value: ese_registro_asignar_investigador },
                    { label: "Trafico investigador", value: ese_registro_trafico_investigador },
                    { label: "Asignar analista", value: ese_registro_asignar_analista },
                    { label: "Trafico analista", value: ese_registro_trafico_analista },
                    { label: "Autorizar ESE", value: ese_registro_autorizar },
                    { label: "Autorizados", value: ese_registro_autorizados },
                    { label: "Cancelados", value: ese_registro_cancelados }

                ], colors: ['blue', 'yellow', 'rgb(255, 152, 0)', 'rgb(245,245,245)', 'gray', 'green', 'red']
            }).on('click', function (i, row) {
                $('#id_modal').modal({ show: true });

            });

        });





    function mostrarDatosModalPorEstatus(row_data) {


    }

</script>

{% include "/dashboard/scripts-js.volt" %}