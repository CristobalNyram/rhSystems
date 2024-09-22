{{ javascript_include("assets/libs/morris-js/morris.min.js") }}
{{ javascript_include("assets/libs/raphael/raphael.min.js") }}
<!-- vue js -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<!-- 
<div class="container-d-flex-and-block mb-3 mt-3 bg-white border-0">

    <div class="col-12 d-flex">

        <div class="input-group" id="">
            <label class="col-form-label  title-busq">Desde</label>
              <input type="date" id="ese_registro_fechainicial" name="ese_registro_fechainicial" class="form-control bar-left" placeholder="Desde" />
              <label class="col-form-label  title-busq">Hasta</label>
              <input type="date" id="ese_registro_fechafinal" name="ese_registro_fechafinal" class="form-control bar-right" placeholder="Hasta" />
          </div>

          <div class="input-group" id="">
            <label class="col-form-label  title-busq">Desde</label>
              <input type="date" id="ese_registro_fechainicial" name="ese_registro_fechainicial" class="form-control bar-left" placeholder="Desde" />
              <label class="col-form-label  title-busq">Hasta</label>
              <input type="date" id="ese_registro_fechafinal" name="ese_registro_fechafinal" class="form-control bar-right" placeholder="Hasta" />
          </div>
    
    </div>

   

    





</div> -->
<div class="container-fluid bg-white border-radius-9px pt-1 pb-1 mb-2 mt-2">
    <form id="form_tablero_informativo" action="" method="POST">

        <div class="row col-12 d-flex justify-content-center">

            <h6>Tablero informativo </h6>
        
            
        </div>

        <div class="row col-12 d-flex justify-content-center">

                <div class="input-group col-sm-12 mr-1 ml-1 col-12" id="">
                    <label class="col-form-label  title-busq">Desde</label>
                    <input type="date" id="ese_registro_fechainicial" name="ese_registro_fechainicial" class="form-control bar-left" placeholder="Desde"   required/>
                    <label class="col-form-label  title-busq">Hasta</label>
                    <input type="date" id="ese_registro_fechafinal" name="ese_registro_fechafinal" class="form-control bar-right" placeholder="Hasta"  required />
                </div>
        
            
                
        </div>
        <div class="row mt-1 col-12 d-flex justify-content-end align-items-center">
            <div class="col-lg-2 col-sm-3 col-12  text-right mt-4">
                <div class="form-group">
                    {{ link_to('dashboard/index', '<i class="mdi mdi-eraser white" title="Limpiar búsqueda"></i>',"class": "btn-dark btn-rounded btn btn-limpiar","style": "margin-top: 0px") }}
                    <!-- <button class="btn-dark btn-rounded btn btn-limpiar"><i class="mdi mdi-eraser white"></i></button> -->
                  </div>
            </div>
            <div class="col-lg-2  col-sm-3 col-12  text-right mt-4">
                <div class="form-group ">
                    <button type="submit" style="margin-top: 0px" id="buscar" name="buscar" onclick="" class="btn-dark btn-rounded btn btn-buscar"><i class=" mdi mdi-magnify white"></i>  Buscar</button>
                </div>
            </div>

           
        </div>
        


    </form>
    

   
</div>

<div class="container-d-flex-and-block mb-2">
    <div name="" id="" class="card card-crm  col-12 col-lg-6 col-sm-6 p-2 m-1">
        <div class="row  d-fle justify-content-center ">
            <h5>Estudios entregados 

                <i class="mdi mdi-truck-delivery  mdi-18px btn-icon"></i>
            </h5>

        </div>
        <div class="mt-1 col-12">
            <table id="tabla_cuenta_estudios" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light-crm">

                    <tr>
                        <th>Formato</th>
                        <th>Total</th>

                    </tr>
                </thead>
                <tbody>
                     </tbody>

            </table>

            <div class="badge badge-pill badge-success mt-2">
                <span class="text-white p-5 mt-2 mb-2" style="font-size:1rem;">Total:
                    <span id="total_cuenta_entregados_tipo_estudios"> </span> </span>

            </div>
        </div>
    </div>
    <div name="" id="" class="card card-crm  col-12 col-lg-6 col-sm-6 p-2 m-1">

        <div class="row  d-fle justify-content-center ">
            <h5>
                Estudios dados de alta
                    <span class="text-info" id="titulo_tra_aprobados"> </span>
                <i class="mdi mdi-upload  mdi-18px btn-icon"></i>

            </h5>

        </div>

        <div class="mt-1 col-12">
            <table id="tabla_cuenta_alta_tipo_estudios" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light-crm">

                    <tr>
                        <th>Formato</th>
                        <th>Total</th>





                    </tr>
                </thead>
                <tbody>

                </tbody>


            </table>

            <div class="badge badge-pill badge-success mt-2">
                <span class="text-white p-5 mt-2 mb-2" style="font-size:1rem;">Total: <span
                        id="total_cuenta_alta_tipo_estudios"> </span> </span>

            </div>
        </div>


    </div>


   


</div>

<div class="container-d-flex-and-block mb-2">
    <div name="" id="" class="card card-crm  col-12 col-lg-12 col-sm-12 p-2 m-1">
        <div class="row  d-fle justify-content-center ">
            <h5>Estudios entregados por analista

                <i class="mdi mdi-worker  mdi-18px btn-icon"></i>
            </h5>

        </div>
        <div class="mt-1 col-12">
            <table id="tabla_cuenta_analista_ese_entregados" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light-crm">

                    <tr>
                        <th>Nombre analista</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                     </tbody>

            </table>

            <div class="badge badge-pill badge-success mt-2">
                <span class="text-white p-5 mt-2 mb-2" style="font-size:1rem;">Total:
                    <span id="total_cuenta_analista_ese_entregados"> </span> </span>

            </div>
        </div>
    </div>



   


</div>
{% include "/dashboard/script.volt" %}








