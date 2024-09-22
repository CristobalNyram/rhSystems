<!-- <div id="id-1" class="tab-pane fade in active"> -->
  <div class="mt-3">
    <div class="card card-crm">
      <!-- <div class="x_panel  shadow"> -->
        <!-- <div class="x_content"> -->
          <!-- <div class="col-md-9 col-sm-9 col-xs-12"> -->
            <div class="text-center col-md-12">
              <div class="mt-1"><span class="font-16 btn-link-crm">Permisos Asignado a <big><b>{{rol_nombre}}</b></big></span>
              </div>
            </div>
          <hr class="line-down">
            <!-- <div class="x_panel"> -->
              
              <!-- <div class="x_content"> -->
                <form id='form_permisos'  name='form_permisos' class="form-horizontal"> 
                  <div class="actividades">
                    <div class="col-12 row">
                      <!-- <ul class="lista-checkbox"> -->
                        {% for rel in relpuemenu %}
                        <div class="col-md-4">
                        <ul class="lista-checkbox">
                          <li class="padre_menu puntos">
                            {% if loop.first %}
                              <input type='hidden' id='rol' name='rol' value='{{rel.rol_id}}' >
                            {% endif %}
                            <input id='{{rel.rrm_id}}' name='{{rel.rrm_id}}' class='{{rel.men_grupo}}' type="checkbox" {% if rel.rrm_estatus==1 %} checked {% endif %}/><label style="margin-top: 0px; margin-bottom: 0px;" for='{{rel.rrm_id}}'>
                            <b class="title-catalogo">{{ rel.men_titulo }}</b></label>
                            <hr>
                          </li>
                          <ul>
                            {% for rel1 in rel.datos %} 
                              <li class="hijo_menu puntos">
                                <p style="margin-top: 0px; margin-bottom: 0px;">
                                  <input id='{{rel1.rrm_id}}' name='{{rel1.rrm_id}}' class='{{rel1.men_grupo}}' type="checkbox" {% if rel1.rrm_estatus==1 %} checked {% endif %} /> <label for='{{rel1.rrm_id}}'><b>{{rel1.men_titulo}}</b></label>
                                </p>
                              </li>
                              <ul>
                                {% for rel2 in rel1.datos %} 
                                  <li class="sub_hijo_menu puntos">
                                    <p style="margin-top: 0px; margin-bottom: 0px;">
                                      <input id='{{rel2.rrm_id}}' name='{{rel2.rrm_id}}' class='{{rel2.men_grupo}}' type="checkbox" {% if rel2.rrm_estatus==1 %} checked {% endif %}  ><label for='{{rel2.rrm_id}}'>{{rel2.men_titulo}}</label>
                                    </p>
                                  </li>
                                {% endfor %}
                              </ul>
                            {% endfor %}
                          </ul>
                        </ul>
                        </div>
                        {% endfor %}
                      <!-- </ul> -->
                    </div>
                  </div>
                  <div class="col-12 row">

                    <div class="col-lg-3 col-9  text-right mt-5 offset-lg-6">
                      <div class="form-group">
                        <button type='submit' id='cancelar_permisos' name='cancelar_permisos' class="btn-dark btn-rounded btn btn-limpiar">Cancelar</button>
                      </div>
                    </div>
                    <div class="col-lg-3 col-9  text-right mt-5 offset-lg-0">
                      <div class="form-group">
                        <button type='submit' id='actualizar_permisos' name="actualizar_permisos" class="btn-dark btn-rounded btn btn-buscar submit">Guardar</button>
                      </div>
                    </div>
                  </div>
                  {#
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xs-3 pull-right">
                          <button type='submit' id='actualizar_permisos' name="actualizar_permisos" class="btn-block btn-btnempresa submit">Guardar</button>
                        </div>
                        <div class="col-xs-3 pull-right">
                          <button type='submit' id='cancelar_permisos' name='cancelar_permisos' class="btn btn-block btn cancelar ">Cancelar</button>
                        </div>
                      </div>
                    </div>
                  #}
                </form>
              <!-- </div>
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </div>
<!-- </div> -->
<script type="text/javascript">
  

  $('.padre_menu input[type=checkbox]').change(function() {
  $(this).closest('.padre_menu').next('ul').find('.hijo_menu input[type=checkbox]').prop('checked', this.checked); 
  $(this).closest('.padre_menu').next('ul').find('.sub_hijo_menu input[type=checkbox]').prop('checked', this.checked);  
  });

  $('.hijo_menu input[type=checkbox]').change(function() {
  $(this).closest('.hijo_menu').next('ul').find('.sub_hijo_menu input[type=checkbox]').prop('checked', this.checked); 
    
  });

  $('.sub_hijo_menu input[type=checkbox]').change(function() {
  $(this).closest('.sub_hijo_menu').prev('ul').find('.hijo_menu input[type=checkbox]').prev('ul').find('.padre_menu input[type=checkbox]').prop('checked', this.checked); 
    
  });

  $('.hijo_menu input[type=checkbox]').change(function() {
    var closestUl = $(this).closest('ul');
    var checkedParent = true;
    // if(closestUl.find('input[type=checkbox]:checked').length == 0) {
    //   // checkedParent = false;
    // }
    
    closestUl.prev('.padre_menu').find('input[type=checkbox]').prop('checked', checkedParent);
  });


  // $('.sub_hijo_menu input[type=checkbox]').change(function() {
  //   var closestUl = $(this).closest('ul');
  //   var checkedParent = true;
  //   // var closestUl1 = closestUl.closest('ul');
  //   // console.log(closestUl1);
  //   closestUl.prev('.hijo_menu').find('input[type=checkbox]').prop('checked', checkedParent);
  //   var closestUl1 = $('.hijo_menu').closest('ul');
  //   var checkedParent = true;
  //   // if(closestUl.find('input[type=checkbox]:checked').length == 0) {
  //   //   // checkedParent = false;
  //   // }
    
  //   closestUl1.prev('.padre_menu').find('input[type=checkbox]').prop('checked', checkedParent);
    
  // });

$('.sub_hijo_menu input[type=checkbox]').change(function() {
    var closestUl = $(this).closest('ul');
    var checkedParent = true;
    closestUl.prev('.hijo_menu').find('input[type=checkbox]').prop('checked', checkedParent);
    var closestUl1 = $(this).closest('ul');
    var closestUl2 = closestUl.prev('.hijo_menu');
    var closestUl3 = closestUl2.closest('ul');
    closestUl3.prev('.padre_menu').find('input[type=checkbox]').prop('checked', checkedParent);

  });

  $(document).ready(function(){
    $('.1').on('change', function() {
       $('.1').not(this).prop('checked', false);
       
    });
    $('.2').on('change', function() {
     $('.2').not(this).prop('checked', false);
     
    });
  });

  $('#cancelar_permisos').click(function(){
    var url_pue1 = "<?php echo $this->url->get('rol/') ?>";
    alertify.alert("Cancelado","Movimiento cancelado", function(){ window.location=url_pue1; });
    return false;
  });


  $('#actualizar_permisos').click(function() {
    // var datos= new Object();
    var url = "<?php echo $this->url->get('rol/permiso/') ?>";
    var url_pue = "<?php echo $this->url->get('rol/') ?>";
    var rol= document.getElementById("rol").value;;
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
    $.ajax({                        
          type: "POST",                 
          url: url,                     
          data: datos,
          success: function(res)             
          {
            
            
              alertify.alert("Gracias","Información actualizada correctamente.", function(){ window.location=url_pue; });
            
                          
          },
          error: function(res)
          {
            
          }
        });
    return false;
  });

</script>