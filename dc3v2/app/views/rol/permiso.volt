<div id="id-1" class="tab-pane fade in active">
  <div class="row">
    <div class="col-md-12 margin-top col-sm-12 col-xs-12">
      <div class="x_panel  shadow">
        <div class="x_content">
          <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Permisos Asignado a <big><b>{{rol_nombre}}</b></big></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <form id='form_permisos'  name='form_permisos' class="captura form-horizontal form-label-left"> 
                  <div class="actividades">
                    <ul class="lista-checkbox">
                      {% for rel in relpuemenu %}
                        <li class="padre_menu">
                          {% if loop.first %}
                            <input type='hidden' id='rol' name='rol' value='{{rel.rol_id}}' >
                          {% endif %}
                          <input id='{{rel.rrm_id}}' name='{{rel.rrm_id}}' type="checkbox" {% if rel.rrm_estatus==1 %} checked {% endif %}/>
                          {{ rel.men_titulo }}
                        </li>
                        <ul>
                          {% for rel1 in rel.datos %} 
                            <li class="hijo_menu">
                              <p>
                                <input id='{{rel1.rrm_id}}' name='{{rel1.rrm_id}}' type="checkbox" {% if rel1.rrm_estatus==1 %} checked {% endif %} /> {{rel1.men_titulo}}
                              </p>
                            </li>
                            <ul>
                              {% for rel2 in rel1.datos %} 
                                <li class="sub_hijo_menu">
                                  <p>
                                    <input id='{{rel2.rrm_id}}' name='{{rel2.rrm_id}}' type="checkbox" {% if rel2.rrm_estatus==1 %} checked {% endif %}  >{{rel2.men_titulo}}
                                  </p>
                                </li>
                              {% endfor %}
                            </ul>
                          {% endfor %}
                        </ul>
                      {% endfor %}
                    </ul>
                    
                  </div>
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