<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla cuestionario activo
 */
class Cueactivo extends Model
{
    public $cue_id;
    public $cue_uno;
    public $cue_dos;
    public $cue_tres;
    public $cue_cuatro_clima;


    public function EstadoCuestionario()
    {
        $cuestionario=Cueactivo::findFirstBycue_id(1);
         $cuestionario1=$cuestionario->cue_uno;
         $cuestionario2=$cuestionario->cue_dos;
         $cuestionario3=$cuestionario->cue_tres;
         $cuestionario_clima_laboral=$cuestionario->cue_cuatro_clima;
         $cuestionarios=
         [      
                      ['nombre'=>'Cuestionario 1 NOM-035','nombreMinusculas'=>'cuestionario 1 NOM-035', 'estado'=>$cuestionario1,'value'=>'C1','prefijo'=>'uno'],
                      ['nombre'=>'Cuestionario 2 NOM-035','nombreMinusculas'=>'cuestionario 2 NOM-035','estado'=>$cuestionario2,'value'=>'C2','prefijo'=>'dos'],
                      ['nombre'=>'Cuestionario 3 NOM-035','nombreMinusculas'=>'cuestionario 3 NOM-035','estado'=>$cuestionario3,'value'=>'C3','prefijo'=>'tres'],
                      ['nombre'=>'Cuestionario clima laboral','nombreMinusculas'=>'cuestionario clima laboral','estado'=>$cuestionario_clima_laboral,'value'=>'CL','prefijo'=>'clima']
                      
         ];
         return $cuestionarios;
    }
    public function estadoactivoCuestionarioClimaONorma()
    { 
      $cuestionario=Cueactivo::findFirstBycue_id(1);
      $cuestionario1=$cuestionario->cue_uno;
      $cuestionario2=$cuestionario->cue_dos;
      $cuestionario3=$cuestionario->cue_tres;
      $cuestionario_clima_laboral=$cuestionario->cue_cuatro_clima;
      if($cuestionario1==1  || $cuestionario2==1 || $cuestionario3)
      {
        $repuesta='NOM-ACTIVADO';
      }
      else
      {
        $repuesta='CLIMA-ACTIVADO';

      }

      return $repuesta;

    }

    public function ActivarUnCuestionario($cuestionario1)
    {
        $cuestionario=Cueactivo::findFirstBycue_id(1);
        //en caso de de que el cuestiorio 1 sea activado 
        if($cuestionario1==='C1')
        {
          $cuestionario->cue_uno='1';
          $cuestionario->cue_dos='0';
          $cuestionario->cue_tres='0';
          $cuestionario->cue_cuatro_clima='0';

                if ( $cuestionario->save()==false) {
                   
                }
              

        }
        //cuestionario 2 se ha activado
        elseif($cuestionario1==='C2')
        {
            $cuestionario->cue_uno='0';
            $cuestionario->cue_dos='1';
            $cuestionario->cue_tres='0';
            $cuestionario->cue_cuatro_clima='0';
  
          
  
                  if ( $cuestionario->save()==false) {
                    //   return 'error al  actualizar los datos';
                  }
                  else
                  {
                    //   return 'Datos actualizados correctamente';
                  }
            
        }
        //en caso de que el cuestionario 3 sea activado
        elseif ($cuestionario1==='C3') 
        {
            $cuestionario->cue_uno='0';
            $cuestionario->cue_dos='0';
            $cuestionario->cue_tres='1';
            $cuestionario->cue_cuatro_clima='0';
  
          
  
                  if ( $cuestionario->save()==false) {
                    //   return 'error al  actualizar los datos';
                  }
                  else
                  {
                    //   return 'Datos actualizados correctamente';
                  }
        }

        elseif ($cuestionario1==='CL') 
        {
            $cuestionario->cue_uno='0';
            $cuestionario->cue_dos='0';
            $cuestionario->cue_tres='0';
            $cuestionario->cue_cuatro_clima='1';
  
          
  
                  if ( $cuestionario->save()==false) {
                    //   return 'error al  actualizar los datos';
                  }
                  else
                  {
                    //   return 'Datos actualizados correctamente';
                  }
        }
        

    }
    public function ActivarDosCuestionario($cuestionario1,$cuestionario2)
    {
        $cuestionario=Cueactivo::findFirst
        (
           [
                [
               'cue_id'=>'1',
           
                ]
           ]
         );
          //en caso de de que el cuestiorio 1 y 3 sea activado 
          if($cuestionario1==='C1' & $cuestionario2 ==='C3')
          {
            // return 'actualizando el cuestionrio 1 y 3';
            $cuestionario->cue_uno='1';
            $cuestionario->cue_dos='0';
            $cuestionario->cue_tres='1';
            $cuestionario->cue_cuatro_clima='0';
  
          
  
                  if ( $cuestionario->save()==false) {
                    //   return 'error al  actualizar los datos';
                  }
                  else
                  {
                    //   return 'Datos actualizados correctamente';
                  }
  
          }
          //en caso de de que el cuestiorio 2 sea activado
          elseif($cuestionario1==='C1' & $cuestionario2==='C2')
          {
            // return 'actualizando el cuestionrio  1 y 2';
            $cuestionario->cue_uno='1';
            $cuestionario->cue_dos='1';
            $cuestionario->cue_tres='0';
            $cuestionario->cue_cuatro_clima='0';

  
          
  
                  if ( $cuestionario->save()==false) {
                    //   return 'error al  actualizar los datos';
                  }
                  else
                  {
                    //   return 'Datos actualizados correctamente';
                  }
  
          }
        
    }
   

    //esta función nos sirve para saber si un cuestionario esta activo y si aun no asido contestado
   public function estadoDeFormulario($folio,$IdCuestionario)
   {
      $cuestionario=Cueactivo::findFirstBycue_id(1);
      $repuestaEstado=0;

      switch ($IdCuestionario) {
        case 1:
          $folioEstado=Foliocueuno::findFirstByfou_id($folio);//verificamos que el folio usado no alla contestado anteriormente 
          $cuetioarioEstado=$cuestionario->cue_uno;
          if($cuetioarioEstado)
          {
            if($folioEstado==false)
            {
              $repuestaEstado=1;
            }
          }
        break;
         
        case 2:
          $folioEstado=Foliocuedos::findFirstByfod_id($folio);//verificamos que el folio usado no alla contestado anteriormente 
          $cuetioarioEstado=$cuestionario->cue_dos;
          if($cuetioarioEstado)
          {
              if($folioEstado==false)
              {
                $repuestaEstado=1;
              }
          }
                  
        break;

        case 3:
          $folioEstado=Foliocuetres::findFirstByfot_id($folio);//verificamos que el folio usado no alla contestado anteriormente el cuestionario 
          $cuetioarioEstado=$cuestionario->cue_tres;
          if($cuetioarioEstado)
          {
              if($folioEstado==false)
              {
                $repuestaEstado=1;
              }
          }
         
        break;

        case 4:
          $folioEstado=Foliocueclima::findFirstByfolcucli_id($folio);//verificamos que el folio usado no alla contestado
          $cuetioarioEstado=$cuestionario->cue_cuatro_clima;
          if($cuetioarioEstado)
          {
              if($folioEstado==false)
              {
                $repuestaEstado=1;
              }
          }
        break;
  
      }
      return   $repuestaEstado;
   

   }
   
   
   

	

}