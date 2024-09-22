<div class="mx-auto" style="width: 550px;" id="accordion">
  <div class="card" style="margin-bottom:0px!important"><button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"  >
    <div class="card-header" style="padding:0px!important" id="headingOne">
      <h5 class="mb-0"> 
        Total de vacantes {{ vac_numero is defined ? vac_numero : '-' }}
      </h5>
    </div></button>
    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"  data-parent="#accordion">
      <div class="mt-1 col-12">
        {% for eje in ejecutivos %}
          {% if loop.first %}
            <table id="eje_detalles_dt" class="table table-striped table-bordered dt-responsive " style="width:100%;" >
              <thead class="thead-light-crm">
                  <tr>
                      <th style="text-align: center;">Ejecutivo</th>
                      <th style="text-align: center;">Asignaciones</th>
                      <th style="text-align: center;">Compartido</th>

                  </tr>
              </thead>
              <tbody>
          {% endif %}
                <tr>
                  <td style="text-align: center;" class="text-uppercase">
                    {% if eje.eje_id<=0 %}
                      SIN ASIGNACIÓN
                    {% else %}
                      {{eje.ejecutivo}}
                    {% endif %}
                  </td>
                  <td style="text-align: center;">
                    {{eje.cantidad_vacante}}
                  </td>
                  <td style="text-align: center;">
                    {{eje.cantidad_vac_compartidos}}
                  </td>
                </tr>
            {% if loop.last %}
              </tbody>
            </table>
            {% endif %}
            {% else %}
              <strong>No existen datos el resumen.</strong>
        {% endfor %}
      </div>
    </div>
  </div>
</div>