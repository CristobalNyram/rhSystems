<?php

use Phalcon\Mvc\User\Component;
use Phalcon\Crypt;
class Encriptarparametros extends Component {

    public function encriiptarId($data_){
        $crypt = new Crypt();
        $id = $data_;
    
        $key = "CMSagDAOIESTfsowKFQouADI";
        $encripData = trim($crypt->encryptBase64($id, $key));
        
        // Genera un string aleatorio
        $strng_ramdom = $this->generateRandomString(13);
        $strng_key_ramdom = $this->generateRandomString(5);

        $token_value = rand(1,10).'_S_'.rand(885,990).'_A_'.rand(50,60).rand(99,212).'_D_'.rand(256,388).'_I_'.rand(201,789);
        
        $data = [
            '_token' => $token_value,
            'id' => $encripData,
            'extra_key' => $strng_ramdom,
            'nombre' => 'sadi_'.$strng_ramdom,
        ];
        
        $claves = array_keys($data);
        shuffle($claves);
        
        $dataAleatorio = [];
        foreach ($claves as $clave) {
            $dataAleatorio[$clave] = $data[$clave];
        }
    
        $data_serialized = serialize($dataAleatorio);
        
        $data_t = base64_encode($strng_key_ramdom ."--". $data_serialized."--". $strng_key_ramdom);
        return $data_t;
    }
    function generateRandomString($length = 13) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        $charLength = strlen($characters);
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }
    
        return $randomString;
    }
    function generateRandomKey($length = 8) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomKey = '';
        $charLength = strlen($characters);
    
        for ($i = 0; $i < $length; $i++) {
            $randomKey .= $characters[rand(0, $charLength - 1)];
        }
    
        return $randomKey;
    }
    
    
}


