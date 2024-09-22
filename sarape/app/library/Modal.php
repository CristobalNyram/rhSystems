<?php

use Phalcon\Mvc\User\Component;

class Modal extends Component {

    /**
     * Crea un modal con campos de entrada y selección dinámicos.
     *
     * @param string $titulo Título del modal.
     * @param string $idform ID del formulario dentro del modal.
     * @param string $idmodal ID del modal.
     * @param array $campos Array con la información de los campos a generar.
     * @param string $extras clase para personalizar tamaño del modal.
     * @return string Código HTML completo del modal generado.
     */
	public function crear($titulo, $idform, $idmodal, $campos, $extras=[])
    {

        $divinputfor="";
        $divinput='
            <div class="col-lg-#tamanio#">
                <label class="col-form-label title-busq">#leyenda#</label>
                <#tipocampo# id="#id#" name="#name#" value="#value#" type="#tipo#" class="form-control input-rounded #clase#" #complemento# placeholder="#leyenda#" #required# #funcion# #oninput#></#tipocampo#>
            </div>';
        $divtextarea='
            <div class="col-lg-#tamanio#">
                <label class="col-form-label title-busq">#leyenda#</label>
                <#tipocampo# id="#id#" name="#name#" value="#value#" type="#tipo#" class="form-control-textarea text_area_a #clase#" #complemento# placeholder="#leyenda#" #required# #funcion# #oninput#></#tipocampo#>
            </div>';
        $divselect='
            <div class="col-lg-#tamanio#">
                <label class="col-form-label title-busq">#leyenda#</label>
                <select name="#name#" id="#id#" class="form-control select2-single #clase#" #funcion# #complemento# data-toggle="select2" data-placeholder="Seleccionar ...">
                    <option selected value="-1">#nombreprimeroption#</option>
                </select>
            </div>
        ';
        $divseccion='
            <div class="col-lg-#tamanio# mt-4">
                <label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">#leyenda#</label>
                <hr class="mt-1">
            </div>
        ';
        $apartado_titulo='
        <div class="col-lg-12 #clase_extra_en_columna#">
            <label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">#titulo#</label>
            <hr class="mt-1">
        </div>
        ';
        foreach ($campos as $value) {
            if($value['tipo']=="text" || $value['tipo']=="hidden" || 
                $value['tipo']=="textarea" || $value['tipo']=="date" || 
                $value['tipo']=="time" || $value['tipo']=="file" || 
                $value['tipo']=="number"
                )
            {
                $oninput="";
                $tipocampo="";
                if($value['tipo']=="text" || $value['tipo']=="hidden" || 
                    $value['tipo']=="time" || $value['tipo']=="date" || 
                    $value['tipo']=="file" || $value['tipo']=="number"){
                    $tipocampo="input";
                    if($value['tipo']=="time" || $value['tipo']=="date"){

                    }else{
                        $oninput='oninput="handleInput(event)"';
                    }
                }elseif($value['tipo']=="textarea"){
                    $tipocampo="textarea";
                    $oninput='oninput="handleInput(event)"';
                }

                if($value['tipo']=="textarea"){
                    $div=$divtextarea;
                }else{
                    $div=$divinput;
                }
                

                $div=str_replace("#tamanio#",$value['tamanio'],$div);
                $div=str_replace("#oninput#",$oninput,$div);
                if(isset($value['leyenda'])){
                    $div=str_replace("#leyenda#",$value['leyenda'],$div);
                }else{
                    $div=str_replace("#leyenda#","",$div);
                }
                $div=str_replace("#id#",$value['id'],$div);
                $div=str_replace("#name#",$value['name'],$div);
                $div=str_replace("#tipo#",$value['tipo'],$div);
                $div=str_replace("#tipocampo#",$tipocampo,$div);
                if(isset($value['required'])){
                    $div=str_replace("#required#",$value['required'],$div);
                }else{
                    $div=str_replace("#required#","",$div);
                }
                if(isset($value['funcion'])){
                    $div=str_replace("#funcion#",$value['funcion'],$div);
                }else{
                    $div=str_replace("#funcion#","",$div);
                }
                if(isset($value['clase'])){
                    $div=str_replace("#clase#",$value['clase'],$div);
                }else{
                    $div=str_replace("#clase#","",$div);
                }
                if(isset($value['complemento'])){
                    $div=str_replace("#complemento#",$value['complemento'],$div);
                }else{
                    $div=str_replace("#complemento#","",$div);
                }
                if(isset($value['value'])){
                    $div=str_replace("#value#",$value['value'],$div);
                }else{
                    $div=str_replace("#value#","",$div);
                }
                $divinputfor.=$div;
            }
            elseif($value['tipo']=="select"){
                $div=$divselect;
                $div=str_replace("#tamanio#",$value['tamanio'],$div);
                $div=str_replace("#leyenda#",$value['leyenda'],$div);
                $div=str_replace("#id#",$value['id'],$div);
                $div=str_replace("#name#",$value['name'],$div);
                if(isset($value['clase'])){
                    $div=str_replace("#clase#",$value['clase'],$div);
                }else{
                    $div=str_replace("#clase#",'',$div);

                }
                if(isset($value['funcion'])){
                    $div=str_replace("#funcion#",$value['funcion'],$div);
                }else{
                    $div=str_replace("#funcion#",'',$div);

                }
                if(isset($value['complemento'])){
                    $div=str_replace("#complemento#",$value['complemento'],$div);
                }else{
                    $div=str_replace("#complemento#","",$div);
                }
                if(isset($value['nombreprimeroption'])){
                    $div=str_replace("#nombreprimeroption#",$value['nombreprimeroption'],$div);
                }else{
                    $div=str_replace("#nombreprimeroption#",'Seleccionar',$div);

                }

                
                $divinputfor.=$div;
            }elseif($value['tipo']=="seccion"){
                $div=$divseccion;
                $div=str_replace("#tamanio#",$value['tamanio'],$div);
                $div=str_replace("#leyenda#",$value['leyenda'],$div);
                
                $divinputfor.=$div;
            }elseif($value['tipo']=="html"){                
                $divinputfor.=$value['value'];
            }
            
        }

        if(count($extras)>0){
            if(isset($extras[0]["clasemodal"])){
                $clasemodal=$extras[0]["clasemodal"];
            }else{
                $clasemodal="";
            }
            if(isset($extras[0]["complementoform"])){
                $complementoform=$extras[0]["complementoform"];
            }else{
                $complementoform="";
            }
            if(isset($extras[0]["complementomodal"])){
                $complementomodal=$extras[0]["complementomodal"];
            }else{
                $complementomodal="";
            }
        }else{
            $clasemodal="";
            $complementoform="";
            $complementomodal="";
        }
        $modal=
            '<div class="modal fade" id="'.$idmodal.'"  aria-labelledby="exampleModalLabel" '. $complementomodal.'>
                <div class="modal-dialog '.$clasemodal.' modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="" id="exampleModalLabel">'.$titulo.'</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="'.$idform.'" '.$complementoform.' class="form-vertical mt-1"  method="post" enctype="multipart/form-data">
                        <div class="form-group row">'.$divinputfor.
                            '
                            <div class="row col-lg-12">
                                <div class="col-sm-6 col-md-6 text-center mt-5">
                                </div>
                                <div class="col-sm-3 col-md-3 text-center mt-5">
                                    <div class="form-group">
                                        <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3  text-center mt-5 ">
                                    <div class="form-group">
                                        <button class="btn-dark btn-rounded btn btn-buscar" type="submit" >Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>';
        return $modal;
    }
}