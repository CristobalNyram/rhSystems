<div id="id-1" class="tab-pane fade in active">
  <div class="row">
    <div class="col-md-12 margin-top col-sm-12 col-xs-12">
      <div class="x_panel  shadow">
        <div class="x_content">
          <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Permisos Asignados</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <form id='form_permisos'  name='form_permisos' class="captura form-horizontal form-label-left"> 
                  <div class="actividades">
                    <div class="panel-group" id="actividades">
                      
                      {% for rel in relpuemenu %}
                        {% if loop.first %}
                          <input type='hidden' id='puesto' name='puesto' value='{{rel.pue_id}}'>
                          
                        {% endif %}
                          <div class="panel">
                                          <!-- NIVEL 1-->
                            <div class="panel-heading collapsed" data-toggle="" data-parent="#actividades" data-target="#actividad{{rel.rpm_id}}">
                              <div class="checkbox">
                                <label>
                                  {% if rel.rpm_estatus==1 %}
                                    <input id='{{rel.rpm_id}}' name='{{rel.rpm_id}}' type="checkbox" checked/>
                                  {% else %}
                                    <input id='{{rel.rpm_id}}' name='{{rel.rpm_id}}' type="checkbox"/>
                                  {% endif %}
                                </label>
                                {{ rel.men_titulo }}
                              </div>
              							</div>
                          </div>
                      {% endfor %}
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-3 pull-right">
                        <button type='submit' id='cancelar_permisos' name='cancelar_permisos' class="btn btn-block btn cancelar ">Cancelar</button>
                      </div>
                      <div class="col-xs-3 pull-right">
                        <button type='submit' id='actualizar_permisos' name="actualizar_permisos" class="btn-block btn-btnempresa submit">Actualizar</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#cancelar_permisos').click(function(){
    var url_pue1 = "<?php echo $this->url->get('puesto/') ?>";
    alertify.alert("Cancelado","Movimiento cancelado", function(){ window.location=url_pue1; });
    return false;
  });


  $('#actualizar_permisos').click(function() {
    // var datos= new Object();
    var url = "<?php echo $this->url->get('puesto/permiso/') ?>";
    var url_pue = "<?php echo $this->url->get('puesto/') ?>";
    var puesto= document.getElementById("puesto").value;;
    var checkboxes = $('#form_permisos').find('input[type="checkbox"]');
    $.each( checkboxes, function( key, value ) {
        if (value.checked === false) {
            value.value = 0;
        } else {
            value.value = 1;
        }
        $(value).attr('type', 'hidden');
    });
    var datos=$('#form_permisos').serialize();
    console.log(datos);
    // return false;

    $.ajax({                        
          type: "POST",                 
          url: url,                     
          data: datos,
          success: function(res)             
          {
            // alert('adas');
            
              alertify.alert("Gracias","Información actualizada correctamente.", function(){ window.location=url_pue; });
              // window.location=url_pue;
                          
          },
          error: function(res)
          {
            
          }
        });
    return false;
  });

</script>