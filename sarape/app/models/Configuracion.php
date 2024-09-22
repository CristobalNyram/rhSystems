<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de 
 */
class Configuracion extends Model
{
        public $dafault_color_background='#16345e';
        public $dafault_value_envio_correos=1;
        public $dafault_id_envio_correos=12;
        public $dafault_id_registro_copia_correo_facturacion=13;
        public $default_id_captcha=14;
        public $dafault_value_correo_recepcionista_facturacion="prueba@sips.mx";
        public $dafault_value_correo_destinario_facturacion="prueba@sips.mx";

        public function getFondoBarraSuperior(){
            $valor=$this->dafault_color_background;
            $id=1;

            $background = Configuracion::findFirst($id);
            if($background){
                $valor=$background->cof_valor;

            }
            return $valor;
            
        }

        public function getBorderBarraSuperior(){
            $valor=$this->dafault_color_background;
            $id=2;

            $background = Configuracion::findFirst($id);
            if($background){
                $valor=$background->cof_valor;

            }
            return $valor;
            
        }


        public function getColorHeadDataTable(){
            $valor=$this->dafault_color_background;
            $id=3;

            $background = Configuracion::findFirst($id);
            if($background){
                $valor=$background->cof_valor;

            }
            return $valor;

        }

        public function getBtnConfirmarFondo(){
            $valor=$this->dafault_color_background;
            $id=4;

            $background = Configuracion::findFirst($id);
            if($background){
                $valor=$background->cof_valor;

            }
            return $valor;

        }
        public function getBtnConfirmarFondoHover(){
            $valor=$this->dafault_color_background;
            $id=5;

            $background = Configuracion::findFirst($id);
            if($background){
                $valor=$background->cof_valor;
            }
            return $valor;

        }


        public function getBtnCancelarFondo(){
            $valor=$this->dafault_color_background;
            $id=6;

            $background = Configuracion::findFirst($id);
            if($background){
                $valor=$background->cof_valor;

            }
            return $valor;

        }
        public function getBtnCancelarFondoHover(){
            $valor=$this->dafault_color_background;
            $id=7;

            $background = Configuracion::findFirst($id);
            if($background){
                $valor=$background->cof_valor;

            }
            return $valor;

        }
        public function getIconosOpciones(){
            $valor=$this->dafault_color_background;
            $id=8;

            $background = Configuracion::findFirst($id);
            if($background){
                $valor=$background->cof_valor;

            }
            return $valor;
        }



        public function getFondoSistemaGeneral(){
            $valor=$this->dafault_color_background;
            $id=9;
            $background = Configuracion::findFirst($id);
            if($background){
                $valor=$background->cof_valor;
            }
            return $valor;
        }

        public function actualizar_elementos_apariencia($data){
            $answer['estado']=-2;
            $fecha_y_hora = date("Y-m-d H:i:s");

            $barra_superior_color = Configuracion::findFirst(1);
            $border_barra_superior_color = Configuracion::findFirst(2);
            $cabezera_datatable_color = Configuracion::findFirst(3);
            $btn_confirmar_fondo = Configuracion::findFirst(4);
            $btn_confirmar_fondo_hover = Configuracion::findFirst(5);
            $btn_cancelar_fondo = Configuracion::findFirst(6);
            $btn_cancelar_fondo_hover = Configuracion::findFirst(7);
            $iconos_opciones = Configuracion::findFirst(8);
            $fondo_sistema_general = Configuracion::findFirst(9);


            $barra_superior_color->cof_valor=$data['barra_superior_color'];
            $border_barra_superior_color->cof_valor=$data['border_barra_superior_color'];
            $cabezera_datatable_color->cof_valor=$data['cabezera_datatable_color'];
            $btn_confirmar_fondo->cof_valor=$data['btn_confirmar_fondo'];
            $btn_confirmar_fondo_hover->cof_valor=$data['btn_confirmar_fondo_hover'];
            $btn_cancelar_fondo->cof_valor=$data['btn_cancelar_fondo'];
            $btn_cancelar_fondo_hover->cof_valor=$data['btn_cancelar_fondo_hover'];
            $iconos_opciones->cof_valor=$data['iconos_opciones'];
            $fondo_sistema_general->cof_valor=$data['fondo_sistema_general'];
            $barra_superior_color->cof_actualizo= $fecha_y_hora ;
            $border_barra_superior_color->cof_actualizo= $fecha_y_hora ;
            $cabezera_datatable_color->cof_actualizo= $fecha_y_hora ;
            $btn_confirmar_fondo->cof_actualizo= $fecha_y_hora ;
            $btn_confirmar_fondo_hover->cof_actualizo= $fecha_y_hora ;
            $btn_cancelar_fondo->cof_actualizo= $fecha_y_hora ;
            $btn_cancelar_fondo_hover->cof_actualizo= $fecha_y_hora ;
            $iconos_opciones->cof_actualizo= $fecha_y_hora ;
            $fondo_sistema_general->cof_actualizo= $fecha_y_hora ;

            if($barra_superior_color->update() &&
               $border_barra_superior_color->update() &&
               $cabezera_datatable_color->update() && 
               $btn_confirmar_fondo->update() && 
               $btn_confirmar_fondo_hover->update() && 
               $btn_cancelar_fondo_hover->update() && 
               $btn_cancelar_fondo->update() && 
               $iconos_opciones->update() && 
               $fondo_sistema_general->update()
               ){

                $answer['estado']=2;

                
            }

            return $answer;


        }

        public function getEstatusEnvioCorreosSistema(){
            $valor = $this->dafault_value_envio_correos;
    
            $envioCorreosConfiguracion = Configuracion::findFirst($this->dafault_id_envio_correos);
    
            if ($envioCorreosConfiguracion instanceof Configuracion && $envioCorreosConfiguracion->cof_valor !== null && $envioCorreosConfiguracion->cof_valor !== '') {
                $valor = $envioCorreosConfiguracion->cof_valor;
            } elseif ($envioCorreosConfiguracion instanceof Configuracion && ($envioCorreosConfiguracion->cof_valor === null || $envioCorreosConfiguracion->cof_valor === '')) {
                error_log("Advertencia: La configuración de envío de correos tiene un valor nulo o vacío.");
                $valor = $this->dafault_value_envio_correos;
            } elseif ($envioCorreosConfiguracion !== false && !($envioCorreosConfiguracion instanceof Configuracion)) {
                error_log("Advertencia: No se encontró la configuración de envío de correos.");
            } 
            return $valor;
        } 
    
    
        public function actualizar_config_correo($data){
            $answer['estado'] = -2;
            $fecha_y_hora = date("Y-m-d H:i:s");
            
            if (!isset($data['envio_correo']) || !in_array($data['envio_correo'], [0, 1])) {
                $answer['mensaje'] = "El valor de 'envio_correo' no es válido.";
                return $answer;
            }
            
            $config_correo = Configuracion::findFirst($this->dafault_id_envio_correos);
            
            if (!$config_correo) {
                $answer['mensaje'] = "No se encontró la configuración de correo.";
                return $answer;
            }
            
            $config_correo->cof_valor = $data['envio_correo'];
            $config_correo->cof_actualizo = $fecha_y_hora;
            
            if ($config_correo->update()) {
                $answer['estado'] = 2;
                $answer['mensaje'] = "Configuración de correo actualizada correctamente.";
            } else {
                $answer['mensaje'] = "No se pudo actualizar la configuración de correo.";
            }
        
            return $answer;
        }

        public function get_estatuscaptcha(){
            $config_correo = Configuracion::findFirstBycof_id($this->default_id_captcha);
            if($config_correo->cof_valor==1){
                return true;
            }else{
                return false;
            }
        }
        


}