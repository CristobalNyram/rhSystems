<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla antecedentegrupofamiliar
 */
class Grafico extends Model
{   

    public function getSiNo($id){
        switch ($id){
            case 0:
                return "NO";
            case 1:
                return "SI";
            default:
                return "";
        }
    }

    public function formatoeses($folio,$fecha,$qr)
    {
        $reporte= new PdfReporte();
        $html=$reporte->graficos;

        $archivossubidos=new Builder();
        $archivossubidos=$archivossubidos
        ->addFrom('Archivo','a')
        ->where('arc_estatus=2  and cat_id>=3 and cat_id<=6 and ese_id='.$folio)
        ->getQuery()
        ->execute();

        for ($i=0; $i < count($archivossubidos); $i++) { 
            switch($archivossubidos[$i]->cat_id){
                case 3:
                    $html=str_replace("#interior#",basename('archivos/'.$archivossubidos[$i]->arc_nombre),$html);
                    break;
                case 4:
                    $html=str_replace("#exterior#",basename('archivos/'.$archivossubidos[$i]->arc_nombre),$html);
                    break;
                case 5:
                    $html=str_replace("#calle#",basename('archivos/'.$archivossubidos[$i]->arc_nombre),$html);
                    break;
                case 6:
                    $html=str_replace("#mapa#",basename('archivos/'.$archivossubidos[$i]->arc_nombre),$html);
                    break;
            }
        }
        
        $html=str_replace("#interior#",basename('archivos/iniciador.jpg'),$html);
        $html=str_replace("#exterior#",basename('archivos/iniciador.jpg'),$html);
        $html=str_replace("#calle#",basename('archivos/iniciador.jpg'),$html);
        $html=str_replace("#mapa#",basename('archivos/iniciador.jpg'),$html);

        $html=str_replace("#firma#",basename('images/firmas/firma.jpg'),$html);
        $html=str_replace("#qr#",basename('temp/'.$qr),$html);
        
        $html=str_replace("#folioqr#",trim($folio),$html);
        $html=str_replace("#fechaqr#",trim($fecha),$html);
                
        return $html;
    }
}