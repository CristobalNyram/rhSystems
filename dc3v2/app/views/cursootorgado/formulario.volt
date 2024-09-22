<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();

        divListado2 = document.getElementById('cen_id');

        clave=document.getElementById("clave").value;  
        // GetRepresentantes();

          empresa=document.getElementById("emp_id").value;
          cen=document.getElementById("cen_id").value;
          urlempresa="<?php echo $this->url->get('centrotrabajo/lista/') ?>";
          urlempresa=urlempresa+empresa+'/'+cen;
          $.post(urlempresa, $(this).serialize() , function(data)
          {
              divListado2.innerHTML=data;
              GetRepresentantes();
          }).done(function() { 
          }).fail(function() {
          })

        if(clave=='')
        {
          divListado = document.getElementById('mun_cla');
          pais=document.getElementById("est_id").value;
          urlpais="<?php echo $this->url->get('municipio/lista/') ?>";
          urlpais=urlpais+pais;
          $.post(urlpais, $(this).serialize() , function(data)
          {
              divListado.innerHTML=data;
          }).done(function() { 
          }).fail(function() {
          })
        }
    });
    $(function (){
      $('#cen_id').on('change', function()
      {
        // console.log('hola');
        GetRepresentantes();
      });


    });
  function cambiarestados() {
    divListado = document.getElementById('estado');
    pais=document.getElementById("pai_id").value;
        urlpais="<?php echo $this->url->get('estado/lista/') ?>";
        urlpais=urlpais+pais;
        $.post(urlpais, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
        }).done(function() { 
        }).fail(function() {
        })
    }

    function GetRepresentantes(elem='')
    {
    /* Para obtener el valor */
      var value = document.getElementById("cen_id"+elem).value;
      // alert(value);
      if(value==0)
      {
        $("#rep_leg").val('Sin asignar')
        $("#rep_tra").val('Sin asignar')
        // alert('reinicio representantes');
        return false;
      }else{
        // alert('busco representantes e imprimo');
        // return false;
        var urlcentro="<?php echo $this->url->get('centrotrabajo/ajax_getrepresentantes/') ?>";
        urlcentro=urlcentro+value;
        // $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urlcentro,
          // data: $("#frm_crearparticipante").serialize(),
          success: function(res)
          {
            if(res[0]<=0)
            {
              alertify.alert("Error",res[1]);
            }
            else
            {
              $("#rep_leg"+elem).val(res[1]);
              $("#rep_tra"+elem).val(res[2]);
            }
            // $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          {
            // $form.find("button").prop("disabled", false); 
          }
        });
        return false;
      }
    }
</script>
<div class="tab-content">
  <div id="id-1" class="tab-pane fade in active">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="formulario-largo" class="x_panel margin-top shadow">
          <div class="x_title">
            <h3>Curso realizado</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- Smart Wizard -->
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                <div>
                  {{ form('cursootorgado/formulario/'~clave, 'id': 'registro', 'class': 'captura form-horizontal form-label-left','data-parsley-validate') }}
                  <input type="hidden" name="clave" id="clave" value="{{clave}}">
                    <div class="ln_solid"></div>
                    <div class="row ">
                      <div class="col-sm-4 col-xs-12">
                        <h5>Datos Generales</h5>
                      </div>
                    </div>
                    <div class="row ">
                      {% for el in clases %}
                        {% if loop.last == false%}
                        <div class="{{el[1]}}">
                          <div class="form-group">
                            {{ form.label(el[0], ['class': el[2]]) }}
                            {{ form.render(el[0], ['required': 'true']) }}
                          </div>
                        </div>
                        {% else %}
                    </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-xs-3 pull-right">
                              {{ form.render(el[0]) }}
                            </div>
                            <div class="col-xs-3 pull-right">
                              <a href="{{ url('cursootorgado/index') }}" id="href_cancelar" class="btn btn-block btn cancelar ">
                                <li class="fa fa-times"></li> Cancelar
                              </a>
                              <!--<button type="submit" class="btn btn-block btn cancelar ">Cancelar</button> -->
                            </div>
                          </div>
                        </div>
                        {% endif %}
                      {% endfor%}
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{ javascript_include('js/validaciones/pais/validaciones.js') }}
<script type="text/javascript">
$('#est_id').on('change', function() {
  divListado = document.getElementById('mun_cla');
  pais=this.value;
  urlpais="<?php echo $this->url->get('municipio/lista/') ?>";
  urlpais=urlpais+pais;
  $.post(urlpais, $(this).serialize() , function(data)
  {
      divListado.innerHTML=data;
  }).done(function() { 
  }).fail(function() {
  })
  // alert( this.value );
});

$('#emp_id').on('change', function() {
  divListado = document.getElementById('cen_id');
  empresa=this.value;
  urlempresa="<?php echo $this->url->get('centrotrabajo/lista/') ?>";
  urlempresa=urlempresa+empresa;
  $.post(urlempresa, $(this).serialize() , function(data)
  {
      divListado.innerHTML=data;
      GetRepresentantes();
  }).done(function() { 
  }).fail(function() {
  })
  // alert( this.value );
});

$('#cur_id').on('change', function() {
  // divListado = document.getElementById('cen_id');
  curso=this.value;
  urlcurso="<?php echo $this->url->get('cursootorgado/gethoras/') ?>";
  urlcurso=urlcurso+curso;
  
  $.ajax({
            type: "POST",
            url: urlcurso,
            success: function(res)
            {
              if(res[0]=='1')
              {
                var horas=document.getElementById('cuo_horas');
                 horas.value = res[1];
              }
              else
              {
                alertify.alert("Error","Ocurrio un error al eliminar el registro");
              }
            }
          });
  // alert( this.value );
});





function fnelimasdasdasdafad(are,clave)
    {
        var urleliminarare="<?php echo $this->url->get('cursootorgado/eliminar/') ?>";
        var urlindexare="<?php echo $this->url->get('cursootorgado/index/') ?>";
        mensaje="¿Está seguro que desea eliminar el área con clave "+clave+"?";
        alertify.confirm("Eliminar registro",mensaje, function()
        { 
          $.ajax({
            type: "POST",
            url: urleliminarare+are,
            success: function(res)
            {
              if(res[0]=='1')
              {
                window.location=urlindexare;
              }
              else
              {
                alertify.alert("Error","Ocurrio un error al eliminar el registro");
              }
            }
          });
        }, function()
        { 
        }).set('labels', {ok:'Eliminar', cancel:'Cancelar'}); 
    } 
</script>