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
<ul>
    <li class="padre_menu">
        <div class="checkbox">
            <label>
                <input  type="checkbox" class="ace ace-checkbox-2"  value="1">
                <span class="lbl"> Inicio</span>
            </label>
        </div>
    </li>
    <li class="padre_menu">
        <div class="checkbox">
            <label>
                <input  type="checkbox" class="ace ace-checkbox-2" value="2">
                <span class="lbl"> Mail</span>
            </label>
        </div>
    </li>
    <ul>
        <li class="hijo_menu">
            <div class="checkbox">
                <label>
                    <input  type="checkbox" class="ace" value="5">
                    <span class="lbl"> Sub Mail</span>
                </label>
            </div>
        </li>
        <ul>
          <li class="sub_hijo_menu">
              <div class="checkbox">
                  <label>
                      <input  type="checkbox" class="ace" value="5">
                      <span class="lbl">  sub Sub Mail</span>
                  </label>
              </div>
          </li>
          <li class="sub_hijo_menu">
              <div class="checkbox">
              <label>
                  <input  type="checkbox" class="ace" value="6">
                  <span class="lbl"> test1</span>
              </label>
              </div>
          </li>
      </ul>
        <li class="hijo_menu">
            <div class="checkbox">
            <label>
                <input  type="checkbox" class="ace" value="6">
                <span class="lbl"> test1</span>
            </label>
            </div>
        </li>
        <ul>
          <li class="sub_hijo_menu">
              <div class="checkbox">
                  <label>
                      <input  type="checkbox" class="ace" value="5">
                      <span class="lbl">  test1.1.1</span>
                  </label>
              </div>
          </li>
          <li class="sub_hijo_menu">
              <div class="checkbox">
              <label>
                  <input  type="checkbox" class="ace" value="6">
                  <span class="lbl"> test1</span>
              </label>
              </div>
          </li>
      </ul>
    </ul>

</ul>


<ul>
    <li class="padre_menu">
      <!-- <div> -->
        <!-- <div> -->
        <input type='checkbox' />4
        <!-- </div> -->
        <ul>
            <li class="hijo_menu">
                <input type='checkbox' />5
            </li>
            <li>
                <input type='checkbox' />6
                <ul>
                    <li>
                        <input type='checkbox' />7
                    </li>
                    <li>
                        <input type='checkbox' />8
                    </li>
                </ul>
            </li>
        </ul>
      <!-- </div> -->
    </li>
</ul>
                <form id='form_permisos'  name='form_permisos' class="captura form-horizontal form-label-left"> 
                  <div class="actividades">
                    <div class="panel-group" id="actividades">
                      <ul>
                        
                        {% for rel in relpuemenu %}
                          <li>
                            {% if loop.first %}
                              <input type='hidden' id='puesto' name='puesto' value='{{rel.pue_id}}' >
                            {% endif %}
                            <div class="panel">
                                          <!-- NIVEL 1-->
                              <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#actividades" data-target="#actividad{{rel.rpm_id}}">
                                <div class="checkbox">
                                  <label>
                                    <input id='{{rel.rpm_id}}' name='{{rel.rpm_id}}' type="checkbox" {% if rel.rpm_estatus==1 %} checked {% endif %} onclick="show_checked({{rel.rpm_id}})"/>
                                  </label>
                                  {{ rel.men_titulo }}
                                </div>
                              </div>
                                            <!-- NIVEL 2 -->
                              <div id="actividad{{rel.rpm_id}}" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">
                                  <ul class="to_do">
                                    {% for rel1 in rel.datos %} 
                                      <li>
                                        <div class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#actividad0" data-target="#sub-actividad{{rel1.rpm_id}}">
                                          <p>
                                            <input id='{{rel1.rpm_id}}' name='{{rel1.rpm_id}}' type="checkbox" {% if rel1.rpm_estatus==1 %} checked {% endif %} class="parent-{{rel.rpm_id}}"/> {{rel1.men_titulo}}
                                          </p>
                                        </div>
                                        <div id="sub-actividad{{rel1.rpm_id}}" class="panel-collapse collapse">
                                          <div class="panel-body">
                                            <ul class="to_do">
                                              {% for rel2 in rel1.datos %} 
                                                <div class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#actividad0" data-target="#sub-actividad-2">
                                                  <li>
                                                    <p>
                                                      <input id='{{rel2.rpm_id}}' class='parent{{rel1.rpm_id}}' name='{{rel2.rpm_id}}' type="checkbox" {% if rel2.rpm_estatus==1 %} checked {% endif %}  >{{rel2.men_titulo}}
                                                    </p>
                                                  </li>
                                                </div>
                                              {% endfor %}
                                            </ul>
                                          </div>
                                        </div>
                                      </li>
                                    {% endfor %}
                                  </ul>
                                </div>
                              </div>                              
                            </div>
                          </li>
                        {% endfor %}

                      </ul>
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
// $(document).ready(
// function show_checked(id) {
//   if($('input[name='+id+']').is(':checked')==true){
//     var children = $('.parent-'+id).attr('checked',true);
//   }else{
//     var children = $('.parent-'+id).attr('checked',false);
//   }
//   // window.alert($('input[name='+id+']').is(':checked'));
//   // var estado=$('input[name='+id+']').is(':checked')
//   // var children = $('.parent-'+id).attr('checked',$('input[name='+id+']').is(':checked'));
//   // estado='';

//   }
// );

// $(document).ready(
//     function() {
//         //clicking the parent checkbox should check or uncheck all child checkboxes
//         $(".parentCheckBox").click(
//             function() {
//               var children = $('.parent-'+1).attr('checked', $(".parentCheckBox").checked);
//                 // $(this).parents('fieldset:eq(0)').find('.childCheckBox').attr('checked', this.checked);
//             }
//         );
//       });



// $(document).ready(function() {
//  $(function() {
//     $("input[type='checkbox']").change(function () {
//       $(this).siblings()
//              .find("input[type='checkbox']")
//              .prop('checked', this.checked);
//     });
//   });
// });
// $(document).ready(function() {
//     $('input.liChild').change(function() {
//         if ($(this).is(':checked')) {
//             $(this).closest('ul').siblings('input:checkbox').attr('checked', true);
//         }
//     });
// });
  // $(function() {
  //   $("input[type='checkbox']").change(function () {
  //     $(this).siblings()
  //            .find("input[type='checkbox']")
  //            .prop('checked', this.checked);
  //   });
  // });

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


  $('.sub_hijo_menu input[type=checkbox]').change(function() {
    var closestUl = $(this).closest('ul');
    var checkedParent = true;
    // var closestUl1 = closestUl.closest('ul');
    // console.log(closestUl1);
    closestUl.prev('.hijo_menu').find('input[type=checkbox]').prop('checked', checkedParent);
    var closestUl1 = $('.hijo_menu').closest('ul');
    var checkedParent = true;
    // if(closestUl.find('input[type=checkbox]:checked').length == 0) {
    //   // checkedParent = false;
    // }
    
    closestUl1.prev('.padre_menu').find('input[type=checkbox]').prop('checked', checkedParent);
    
  });

  // $('.sub_hijo_menu input[type=checkbox]').change(function() {
  //   var closestUl = $(this).closest('.hijo_menu');
  //   var checkedParent = true;
  //   // alert('hola');
  //   closestUl.prev('.padre_menu').find('input[type=checkbox]').prop('checked', checkedParent);
  // });


// $(function() {
//   $(":checkbox").change(function () {
//     $(this).children(':checkbox').attr('checked', this.checked);
//   });
// });
// $(function() {
//   $('input[type="checkbox"]').change(function() {
//       // get id of the current clicked element
//       var id = this.id;
//       // find elements with classname 'parent-<id>' and (un)check them
//       var children = $('.parent' + id).attr('checked', $(this).attr('checked'));
//   });
// });

// $(document).ready(
//     function() {
//         //clicking the parent checkbox should check or uncheck all child checkboxes
//         $(".parentCheckBox").click(
//             function() {
//                 $(this).parents('fieldset:eq(0)').find('.childCheckBox').attr('checked', this.checked);
//             }
//         );
//         //clicking the last unchecked or checked checkbox should check or uncheck the parent checkbox
//         $('.childCheckBox').click(
//             function() {
//                 if ($(this).parents('fieldset:eq(0)').find('.parentCheckBox').attr('checked') == true && this.checked == false)
//                     $(this).parents('fieldset:eq(0)').find('.parentCheckBox').attr('checked', false);
//                 if (this.checked == true) {
//                     var flag = true;
//                     $(this).parents('fieldset:eq(0)').find('.childCheckBox').each(
//                       function() {
//                           if (this.checked == false)
//                               flag = false;
//                       }
//                     );
//                     $(this).parents('fieldset:eq(0)').find('.parentCheckBox').attr('checked', flag);
//                 }
//             }
//         );
//     }
// );
//  $('#check-all').on('ifChanged', function(event){
//     if(!this.changed) {
//         this.changed=true;
//         $('#check-all').iCheck('check');
//     } else {
//         this.changed=false;
//         $('#check-all').iCheck('uncheck');
//     }
//     $('#check-all').iCheck('update');
// });

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