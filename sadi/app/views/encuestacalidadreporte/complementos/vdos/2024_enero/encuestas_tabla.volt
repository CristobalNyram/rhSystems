<h5 class="text-center">Listado de encuestas</h5>
<h6 class="text-center" style="margin-top:0;"></h6>
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>

{% if page is not empty %}
    <div class="mt-1 col-12">
        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="thead-light-crm">
                <tr>
                    <th>ID</th>
                    <th>ESE ID</th>
                    <th>Fecha entrega cliente</th>
                        <th>Fecha realización</th>
                        <th>Estatus</th>
                    <th>Encuestado</th>
                    <th>Investigador</th>
                    <th>Comentario</th>
                    <th>Usuario movimiento</th>
                </tr>
            </thead>
            <tbody>
                {% for enc in page %}
                    <tr>
                        <td>{{enc.enc_id}}</td>
                        <td>{{enc.ese_id}} </td>
                        <td>
                            {% if enc.enc_fechaentregacliente is defined %}
                                <span data-order='{{ date("Y-m-d H:i:s",strtotime(enc.enc_fechaentregacliente)) }}'>
                                    {{ date("d-m-Y H:i:s", strtotime(enc.enc_fechaentregacliente)) }}
                                </span>
                            {% endif %}
                        </td>
                        <td>
                            {% if enc.enc_fecharealizo is defined %}
                            <span data-order='{{ date("Y-m-d H:i:s",strtotime(enc.enc_fecharealizo)) }}'>
                                {{ date("d-m-Y H:i:s", strtotime(enc.enc_fecharealizo)) }}
                            </span>
                                {% endif %}
                        </td>
                   
                        <td>{{ obj_enc.getEstatus(enc.enc_estatus) }}</td>
                        <td class="text-uppercase">{{enc.ese_nombre}}</td>
                        <td class="text-uppercase">{{enc.inv_nombre}}</td>
                        <td class="text-uppercase">{{enc.enc_comentario}}</td>
                        <td class="text-uppercase">{{enc.usu_nombre}}</td>
          

						
                    </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
{% else %}
    <p>No existen registros en este catálogo.</p>
{% endif %}
