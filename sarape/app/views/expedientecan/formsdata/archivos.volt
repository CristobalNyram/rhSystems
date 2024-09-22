

    <section>
        {#LIBRERIA PARA VISUALIZAR MEJOR UNA IMAGEN#}
        {{ stylesheet_link('assets/libs/magnific-popup/magnific-popup.css') }}
        {{ stylesheet_link('assets/libs//magnific-popup/magnific-popup.min.css') }}
        {{ javascript_include('assets/libs//magnific-popup/jquery.magnific-popup.js') }}
        {{ javascript_include('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js" integrity="sha512-C1zvdb9R55RAkl6xCLTPt+Wmcz6s+ccOvcr6G57lbm8M2fbgn2SUjUJbQ13fEyjuLViwe97uJvwa1EUf4F1Akw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" integrity="sha512-WEQNv9d3+sqyHjrqUZobDhFARZDko2wpWdfcpv44lsypsSuMO0kHGd3MQ8rrsBn/Qa39VojphdU6CMkpJUmDVw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .card-body-title-custom {
                -webkit-box-flex: 1;
                -ms-flex: 1 1 auto;
                min-height: 1px;
                padding: .5rem;
                display: flex;
                justify-content: center;
                
            }
            .card-body-extra-text-custom{
                -webkit-box-flex: 1;
                -ms-flex: 1 1 auto;
                min-height: 1px;
                padding: 0px;
                display: flex;
                justify-content: center;
            }
            .card-title-main{
                font-size: 1rem;
                font-weight: bold;
            }

            .card-body-buttons {
                padding: .5rem!important;
                display: flex;
                justify-content: center;
            }
          
        </style>
         <div class="row col-12 m-1 d-flex justify-content-center" id="visualizador_archivos_resumen_div"></div>
       
        <div class="row col-lg-12" style="display:flex; justify-content:space-between;">
                                
            <div class="col-sm-3 col-md-3  text-center mt-5 ">
                <div class="form-group">
                    <button type="button" id="btnAnteriorSeccion_Archivos"  class="btn-dark btn-rounded btn btn-buscar"> <i class="mdi mdi-arrow-collapse-left white"></i>  Anterior sección</button>
                  
                </div>
            </div>
       
          <div class="col-sm-5 col-md-5  text-center mt-5 ">
              <div class="form-group">
               <button type="button"  id="btnSiguienteSeccion_Archivos" class="btn-dark btn-rounded btn btn-buscar"> Regresar al principio<i class="mdi mdi-backburger white"></i> </button>
              </div>
          </div>
        </div>
        
    </section>