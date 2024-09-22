<?php

use Phalcon\Mvc\User\Component;

class Attachment extends Component {

    /**
     * @param $proId
     * @param bool $multiple Si se establece como TRUE se cargan todos los archivos recibidos
     * @return \Archivo|array
     */
    public function upload($proId, $multiple = false)
    {
        $result = [];
        $auth = $this->session->get('auth');
        $user = Usuario::findFirst($auth['id']);

        if ($this->request->hasFiles()) {
            foreach ($this->request->getUploadedFiles() as $file) {

                $archivo = new \Archivo();
                $archivo->usu_id = $user->usu_id;
                $archivo->pro_id = $proId;
                $archivo->arc_nombre = $file->getName();
                $archivo->arc_extension = $file->getExtension();
                $archivo->arc_tipo = $file->getType();
                $archivo->arc_tipo_real = $file->getRealType();
                $archivo->arc_tamano = $file->getSize();
                $archivo->arc_clave = md5($file->getName() . uniqid('file_'));
                $archivo->arc_estatus = 1; // TODO: What is this?
                $archivo->arc_ruta = Attachment::getFileName($archivo->arc_clave);
                $archivo->arc_tabla = "empty";

                if ($archivo->save()) {
                    $result[] = $archivo;
                    $file->moveTo(Attachment::getFileName($archivo->arc_clave));
                } else {
                    // On Error
                    $multiple = true;
                    $result[] = $file->getError();
                    $result[] = $archivo->getMessages();
                    $result[] = $archivo->toArray();
                    break;
                }

                // Sólo el primer archivo recibido
                if ($multiple == false)
                    break;
            }
        }

        return $multiple ? $result : $result[0]->toArray();
    }

    public function download($arc_id)
    {
        $archivo = \Archivo::findFirst($arc_id);

        if ($archivo) {
            $filename = Attachment::getFileName($archivo->arc_clave);

            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Content-Description: File Transfer');
            header('Content-type: ' . $archivo->arc_tipo);
            header('Content-length: ' . $archivo->arc_tamano);
            header('Content-Disposition: attachment; filename="' . $archivo->arc_nombre . '"');
            readfile($filename);
            die();
        }

        $this->response->setStatusCode(404);
        $this->response->send();
        exit;
    }

    /**
     * Generar el nombre completo de un archivo
     *
     * @param string $hash
     * @return string
     */
    public static function getFileName($hash)
    {
        return APP_PATH . 'storage' . DIRECTORY_SEPARATOR . $hash;
    }
}