<script>
  /*funcion para editar un participante-------------------------------------------------------------------------------------------------------------------start funcion para editar*/
  function fneditar(idFolio)
    {
       //show the modall
       $('#frm_editarparticipante').modal('show');
      // console.log(idFolio);
      //fill the all elements in modal
      document.getElementById('folioEdit').value=idFolio;
      var url_="<?php echo $this->url->get('trabajador/get_ajax_detalle/') ?>";
        // $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: url_+"/"+idFolio,
          success: function(res)
          {
            let data=res.data;
            document.getElementById('fol_matriculaEdit').value=data.fol_matricula;
            document.getElementById('fol_nombreEdit').value=data.fol_nombre;
            document.getElementById('fol_primerapellidoEdit').value=data.fol_primerapellido;
            document.getElementById('fol_segundoapellidoEdit').value=data.fol_segundoapellido;
            document.getElementById('fol_correoEdit').value=data.fol_correo;
            document.getElementById('fol_puestoemprEdit').value=data.fol_puesto;
            document.getElementById('fol_areaemprEdit').value=data.fol_area;
            fnempresas_adaptable(data.emp_id,$("#empresaidEdit"));
            let necesita_actualizar=(data.fol_partactualizo<0 )? 1: data.fol_partactualizo;
            $('#folpartactualizoEdit').val(necesita_actualizar);
            $('#folpartactualizoEdit').trigger('change');

          },
          error: function(res)
          { 

          }
        });

    
   

    }
  

 
  $(function (){
        $("#frm_editarparticipante").submit(function(event) 
            {
                //  Act on the event 
                var $form = $(this);
                var urled="<?php echo $this->url->get('trabajador/buseditar/') ?>";
                var idparticipante= document.getElementById('folioEdit').value;
                var matricula= document.getElementById('fol_matriculaEdit').value; 
                var nombre =document.getElementById('fol_nombreEdit').value;
                var primerApellido=document.getElementById('fol_primerapellidoEdit').value;
                var segundoApelli=  document.getElementById('fol_segundoapellidoEdit').value;
                var correo =document.getElementById('fol_correoEdit').value;
                var puesto= document.getElementById('fol_puestoemprEdit').value;
                var area=document.getElementById('fol_areaemprEdit').value;
                
                var actualizo_info=document.getElementById('folpartactualizoEdit').value;

                var empresaId= document.getElementById('empresaidEdit').value;
                if (empresaId == -1) {
                  alertify.alert("AVISO","Debes seleccionar a la empresa a que le corresponde");
                  return false;
                }
                // alert(empresaId);
                $form.find("button").prop("disabled", true);

                $.ajax({
                type: "POST",
                url: urled+idparticipante,
                data:
                {
                'matricula':matricula,
                'nombre':nombre,
                'primerapellido':  primerApellido,
                'segundoapellido':segundoApelli,
                'correo': correo,
                'puesto':puesto,
                'area':area,
                'fol_partactualizo':actualizo_info,

                'empresaId':empresaId
                } 
                ,
                success: function(res)
                {
                    if(res==='1')
                    { 
                    alertify.alert('Éxito','Éxito al actualizar los datos.',function(){ 
                            location.reload();
                        });

                    }
                    else if(res==='-1')
                    {
                    alertify.alert('Error','error al guardar los datos',function(){ 
                            location.reload();
                        });
                    }

                    else if(res==='-1')
                    {
                    alertify.alert('Error','error al guardar los datos',function(){ 
                            location.reload();
                        });
                    }
                    else if(res==='-2')
                    {
                        alertify.error('Error, matrícula repetida.');
                    }


                },
                error: function(res)
                { 
        
                }
                });
                return false;
        });
    });
      
    /*funcion para editar un participante-------------------------------------------------------------------------------------------------------------------end funcion para editar*/

</script>

<!-- EDITAR PARATIPANTE START ------------------------------------------------------------------------------------------------------------------------START EDITAR PARTICIPANTE-->
<div class="modal fade" id="frm_editarparticipante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <form method="post" target="_self" id="frm_editarparticipante"  onsubmit="return false" class="form-vertical mt-1">
            <div class="modal-content" id="contentSession">
              <!--lo que esta entre esto cambia con ajax-->
             
             
              <div class="modal-header text-center">
                <h4 class="" id="exampleModalLabel"><br>Editar participante</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        
              <div class="modal-body">
                <form class="form-vertical mt-1">
                  <div class="form-group row">
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Folio</label>
                      <input type="text" class="form-control input-rounded   input-rounded-disabled" disabled value="" id="folioEdit" />
                    </div>
        
        
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Matrícula</label>
                      <input type="num" name="fol_matricula" class="form-control input-rounded   input-rounded"   id="fol_matriculaEdit"  oninput="handleInput(event)"/>
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Nombre(s)</label>
                      <input type="text" name="fol_nombre" id="fol_nombreEdit" class="form-control input-rounded" placeholder="Nombre(s)" required oninput="handleInput(event)"/>
                    </div>
        
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Primer apellido</label>
                      <input type="text" name="fol_primerapellido"  id="fol_primerapellidoEdit" class="form-control input-rounded" placeholder="Primer apellido" required oninput="handleInput(event)"/>
                    </div>
        
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Segundo apellido</label>
                      <input type="text" name="fol_segundoapellido"   id="fol_segundoapellidoEdit" class="form-control input-rounded" placeholder="Segundo apellido" oninput="handleInput(event)" required/>
                    </div>
        
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Correo</label>
                      <input type="email" name="fol_correo" id="fol_correoEdit" class="form-control input-rounded" placeholder="correo@ejemplo.com" oninput="handleInput(event)" />
                    </div>
        
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Puesto</label>
                      <input type="text" name="fol_puestoempr"   id="fol_puestoemprEdit"class="form-control input-rounded"  placeholder="Puesto" oninput="handleInput(event)" />
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Área</label>
                      <input type="text" name="fol_areaempr"  id="fol_areaemprEdit"  class="form-control input-rounded" required placeholder="Área" oninput="handleInput(event)" />
                    </div>
        
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Empresa</label>
                      <select name="empr_idEdit" id="empresaidEdit" class="form-control select2-single " required data-toggle="select2" data-placeholder="Seleccionar ...">
                   
                        <optgroup >
                        <option value="-1" >Seleccionar..</option>
                      
                        </optgroup>
                       
                      </select>
                    </div>
  
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Requiere actualizacion de datos</label>
                      <select name="fol_partactualizoEdit" id="folpartactualizoEdit" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                   
                        <optgroup >
                         <option disabled >Seleccionar..</option>
                          <option value="1">NO</option>
                          <option value="0">SI</option>
  
                        </optgroup>
                       
                      </select>
                    </div>
        
        
                 
                 
              
                 
                    
              
                    <div class="col-lg-12    text-center d-flex justify-content-end ">
        
        
                      <div class="col-sm-3 col-md-3 text-center mt-5">
                          <div class="form-group">
                            <button  class="btn-dark btn-rounded btn btn-limpiar"  data-dismiss="modal"  ><i class=" mdi mdi-close white"></i>  Cancelar</button>
                          </div>
                      </div>
                      <div class="col-sm-3 col-md-3  text-center mt-5 ">
                          <div class="form-group">
                            <button type="submit" class="btn-dark btn-rounded btn btn-buscar" >Editar <i class="mdi mdi-chevron-right white"></i> </button>
                          </div>
                      </div>
                    </div>
                  </div>
                </form>      
              </div>
        
          
            </div>
        
          </form>
        
     
      </div>
    </div>
            
  </div>
  
  <!-- ---------------------------------------------------------------------------------------------------------------------------------------------EDITAR PARTICANTE END -->
  
  