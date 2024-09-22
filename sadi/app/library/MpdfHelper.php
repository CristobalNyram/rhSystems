<?php

use Phalcon\Mvc\User\Component;
require "mpdf/index.php";


class MpdfHelper extends Component {

    public static function calcularEspacioRestanteHoja($mpdf, $limite_acordado = 10) {
        $altura_actual_pagina = $mpdf->y;
        $altura_maxima_pdf = $mpdf->h;
        $altura_disponible_pagina = $altura_maxima_pdf - $altura_actual_pagina;
        return $altura_disponible_pagina;
    }

    public static function html_cabe_en_pagina($html, $mpdf,$debug=0,$limit_espacio=8,$aplicar_responsive=1) {
        if($aplicar_responsive==0){
            return false; // El contenido no cabe en la página

        }
        $mpdf_clon = new mPDF();
        // Configuraciones de tamaño de página y orientación
        $mpdf_clon->SetImportUse(); // Usar configuración de tamaño de página del PDF original
        $mpdf_clon->SetDisplayMode($mpdf->displayMode);
    
        // Configuraciones de fuente y tamaño de letra
        $posicion_inicial_clone = $mpdf_clon->y;
        $altura_archivo_clone = $mpdf_clon->h;
        $mpdf_clon->SetFont($mpdf->default_font, '', $mpdf->default_font_size);
        $mpdf_clon->SetFontSize($mpdf->default_font_size);
        $mpdf_clon->WriteHTML($html);
        $posicion_final_clone = $mpdf_clon->y;
        #valores del pdf clone fin

        
        #valores del pdf original inicio
        $posicion_inicial = $mpdf->y;
        $altura_maxima_pdf = $mpdf->h;
        $marginLeft = $mpdf->marginLeft;
        $marginRight = $mpdf->marginRight;
        $marginTop = $mpdf->marginTop;
        $marginBottom = $mpdf->marginBottom;
        $posicion_final = $mpdf_clon->y;
        #valores del pdf original fin 

    
    
        #$alto_contenido_agregado = $posicion_final_clone - $altura_inicial_clone;

        $altura_disponible_pagina = $altura_maxima_pdf  - ($posicion_final_clone + $posicion_inicial+ $marginTop  + $marginBottom);
        #error_log("altura_disponible_pagina ".$altura_disponible_pagina);

        if ($debug==1) {
            #error_log("posicion de y inical clone ".$posicion_inicial_clone);
            #error_log("altura de archivo clone ".$altura_archivo_clone);
            #error_log("posicion de y final clone ".$posicion_final_clone);
            #error_log("posicion_final_clone ".$posicion_final_clone);
        //    error_log("altura_disponible_pagina ".$altura_disponible_pagina);
            #error_log("operacion ".  $altura_maxima_pdf." - ".$posicion_final_clone ." - ".$marginTop ." - ". $marginBottom." - ". $posicion_inicial);
            #error_log("posicion de y ".$mpdf->y);
           # error_log("archivo  altura ".$mpdf->h);
          #  error_log("altura estimada contenido agregar ".$alto_contenido_agregado);
            #error_log("altura disponible pagina ".$altura_disponible_pagina);
        }

        unset($mpdf_clon);

        if ($altura_disponible_pagina>=$limit_espacio) {
            return true; // El contenido cabe en la página
        } else {
            return false; // El contenido no cabe en la página
        }
    }
    
}
