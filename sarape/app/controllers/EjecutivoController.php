<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Application;
use \Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Assets\Manager as AssetsManager;
use Phalcon\Assets\Resource\Css as CssResource;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Di;
use Phalcon\Crypt;

class EjecutivoController extends Controller
{

    public function ajax_get_all_ejecutivosAction($eje_id = 0, $excluir = 0)
    {
        $answer[0] = -1;
        try {
            $result = [];
            $subs = new Builder();
            $subs = $subs
                ->columns([
                    'CONCAT(u.usu_nombre," ", u.usu_primerapellido," ",u.usu_segundoapellido) as usu_nombre',
                    'u.usu_id'
                ])
                ->addFrom('Usuario', 'u')
                ->where("u.usu_estatus = 2");
            // Excluir al usuario con usu_id igual a $eje_id si $excluir es 1
            if ($excluir == 1) {
                $subs->andWhere("u.usu_id <> :eje_id:", ['eje_id' => $eje_id]);
            }
    
            $subs = $subs->getQuery()->execute();
            $result = $subs->toArray();
            $answer['data'] = $result;
            $answer[0] = 1;
            return $this->response->setJsonContent($answer);
        } catch (\Exception $e) {
            error_log('Error en ajax_get_all_ejecutivosAction(): ' . $e->getMessage());
            $answer['mensaje'] = 'Ocurrió un error al procesar la solicitud.';
            // Devolver una respuesta de error
            return $this->response->setJsonContent($answer);
        }
    }

    public function ajax_get_all_ejecutivos_no_compartidos_vacAction($eje_id,$vac_id)
    {
        $answer[0] = -1;
        try {
            $result = [];
            $usuariosNoRelacionados = Usuario::query()
            ->columns([
                'CONCAT(Usuario.usu_nombre, " ", Usuario.usu_primerapellido, " ", Usuario.usu_segundoapellido) as usu_nombre',
                'Usuario.usu_id'
            ])
            ->where("Usuario.usu_estatus = 2")
            ->andWhere("NOT EXISTS (
                SELECT 1
                FROM Relvacanteejecutivo AS rel
                JOIN Vacante AS v ON rel.vac_id = v.vac_id
                WHERE rel.eje_id = Usuario.usu_id
                AND rel.rve_estatus=2
                AND v.vac_id = ".$vac_id."
            )")
            ->execute();
            $result = $usuariosNoRelacionados;
            $answer['data'] = $result;
            $answer[0] = 1;
            return $this->response->setJsonContent($answer);
        } catch (\Exception $e) {
            error_log('Error en ajax_get_all_ejecutivos_no_compartidos_vacAction(): ' . $e->getMessage());
            $answer['mensaje'] = 'Ocurrió un error al procesar la solicitud.';
            // Devolver una respuesta de error
            return $this->response->setJsonContent($answer);
        }
    }
    
}