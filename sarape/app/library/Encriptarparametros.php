<?php

use Phalcon\Mvc\User\Component;
use Phalcon\Crypt;
class Encriptarparametros extends Component {

    public function encriiptarId($data_)
    {
        $crypt = new Crypt();
        $id =$data_;

        $key = "5JSjagDAJIGMNgsowKFQswDAS";
        $encripData = trim($crypt->encryptBase64($id, $key));
        $encripData_2 = trim($crypt->encryptBase64($id, $key));
        $token_value=rand(1,10).'_S_'.rand(885,990).'_I_'.rand(50,60).rand(99,212).'_P_'.rand(256,388).'_S_'.rand(201,789);
        $data=[
            '_token'=>$token_value,
            'id'=>$encripData,
            'extra_key'=>$this->generateRandomString(),
            'nombre'=>'sarape_'.$this->generateRandomString(),
        ];
         // Obtén las claves del arreglo y mézclalas
         $claves = array_keys($data);
         shuffle($claves);

         // Crea un nuevo arreglo con el orden aleatorio
         $dataAleatorio = [];
         foreach ($claves as $clave) {
             $dataAleatorio[$clave] = $data[$clave];
         }

        $data_t=base64_encode(serialize($dataAleatorio));
      
        return $data_t;
        


    }
    function generateRandomString($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        $charLength = strlen($characters);
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }
    
        return $randomString;
    }
    function generateRandomKey($length = 5) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomKey = '';
        $charLength = strlen($characters);
    
        for ($i = 0; $i < $length; $i++) {
            $randomKey .= $characters[rand(0, $charLength - 1)];
        }
    
        return $randomKey;
    }
    
    
}


