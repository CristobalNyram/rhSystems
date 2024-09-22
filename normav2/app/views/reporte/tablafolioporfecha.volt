
{% for adm in page %}
{% if loop.first %}
    <!-- <div class="card card-crm" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
        <table id="td_datos" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> esta tabla tiene un color mas claro y tiene un scrool -->


        <div class="mt-3 col-12 ">

                <div class="card card-crm">
                <div id="listado">
                        <table id="td_datos" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-light-crm">
                                        <tr>
                                            <th></th>
                                            <th>Folio</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                            <tbody>
                                            {% endif %}
                                                <tr>
                                                    <td>{{ adm.fol_id }}</td>
                                                    <td>{{ adm.fol_id }}</td>
                                                    <td class="uppercase">{{ adm.fol_nombre }} {{ adm.fol_primerapellido }} {{ adm.fol_segundoapellido }}</td>
                                                    <td> {{ adm.fol_correo }} </td>
                                                    <td data-order='{{ date("Y-m-d",strtotime(adm.fol_fecha)) }}'>{{ date("d-m-Y ", strtotime(adm.fol_fecha)) }}</td>

                                            
                                                                
                                                    
                                                </tr>
                                            {% if loop.last %}
                                            </tbody>

                    </table>

                </div>
                </div>
        </div>
{% endif %}
{% else %}
    No existen registros en este catálogo.
{% endfor %}