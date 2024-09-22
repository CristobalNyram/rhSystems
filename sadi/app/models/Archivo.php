<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Archivo extends Model
{
	public $arc_id;
	public $arc_nombre;

	protected function upper($str)
    {
        $upp=mb_convert_encoding(mb_convert_case(mb_strtoupper($str), MB_CASE_UPPER),"UTF-8");
        return $upp;
    }

	/**
	 * getEstatusDetail - OBTENER EL NOMBRE DEL ESTATUS DEL ARCHIVO
	 *@param  $this [archivo]
	 * @return string
	 */
	public function getEstatusDetail()
	{
		if ($this->arc_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->arc_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->arc_estatus < 1) 
		{
			return 'Eliminado';
		}
	}

	public function NuevoRegistro($data)
	{
		
		$archivo= new Archivo();
		$archivo->arc_nombre=$data['arc_nombre'];
		$archivo->arc_estatus=$data['arc_estatus'];
		$archivo->ese_id=$data['ese_id'];
		$archivo->cat_id=$data['cat_id'];
		
		if ($archivo->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $archivo->arc_id;
		}	

	}

	public function formatoEseTruperAnexosFinales($ese_id,$aviso_priv){
		$reporte= new PdfReporteTruper();
        $html=$reporte->anexos_pagina_15;
		$formato_pdf=new FormatotruperPDF();
		    //aviso privacidad 
			
	
			if(count($aviso_priv)>0){
	
				$html=str_replace("#aviso_privacidad-img#",trim(basename('archivos/'.$aviso_priv[0]->arc_nombre)),$html);
	
				$html=str_replace("#aviso_privacidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);


			}else{
				$html=str_replace("#aviso_privacidad-style#","display:none;",$html);
				$html=str_replace("#aviso_privacidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

			}
		    //aviso privacidad 

        
        return $html;
	}

	public function formatoEseTruperAnexosFinalesPagina16($ese_id,$comprobantedomicilio,$selfie){

		$reporte= new PdfReporteTruper();
        $html=$reporte->anexos_pagina_16;
		$formato_pdf=new FormatotruperPDF();



		  //comprobantedomicilio 
		 
  
		  if(count($comprobantedomicilio)>0){
  
			  $html=str_replace("#comprobantedomicilio-img#",trim(basename('archivos/'.$comprobantedomicilio[0]->arc_nombre)),$html);
			  $html=str_replace("#comprobantedomicilio-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#comprobantedomicilio-style#","display:none;",$html);
			  $html=str_replace("#comprobantedomicilio-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

		  }
		  //comprobantedomicilio 

		 //selfie 
	
  
		  if(count($selfie)>0){
  
			  $html=str_replace("#selfie-img#",trim(basename('archivos/'.$selfie[0]->arc_nombre)),$html);
			  $html=str_replace("#selfie-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#selfie-style#","display:none;",$html);
			  $html=str_replace("#selfie-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

		  }
		  //selfie 
        
        return $html;

	}
	

	public function formatoEseTruperVentas_semanas_cotizadas_imss($ese_id,$data){
		$reporte= new PdfReporteTruper();
        $html=$reporte->anexos_pagina_15_SEMANASCOTIZADASIMMS_ventas;
		$formato_pdf=new FormatotruperPDF();

		  $semanas_cotizadas=$data;

  
		  if(count($semanas_cotizadas)>0){
  
			  $html=str_replace("#semanascotizadas-img#",trim(basename('archivos/'.$semanas_cotizadas[0]->arc_nombre)),$html);
			  $html=str_replace("#semanascotizadas-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#semanascotizadas-style#","display:none;",$html);
			  $html=str_replace("#semanascotizadas-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

		  }

        
        return $html;
	}
	public function formatoEseTruperVentas_situacion_legal($ese_id,$data){
		$reporte= new PdfReporteTruper();
        $html=$reporte->anexos_pagina_16_SITUACIONLEGAL_ventas;
		$formato_pdf=new FormatotruperPDF();


		  //situacionlegal 
		  $situacionlegal=$data;
  
		  if(count($situacionlegal)>0){
  
			  $html=str_replace("#situacionlegal-img#",trim(basename('archivos/'.$situacionlegal[0]->arc_nombre)),$html);
			  $html=str_replace("#situacionlegal-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#situacionlegal-style#","display:none;",$html);
			  $html=str_replace("#situacionlegal-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

		  }
        
        return $html;
	}


	public function formatoEseTruperVentas_identificacion_curp($ese_id,$data_ine,$data_curp){
		$reporte= new PdfReporteTruper();
        $html=$reporte->anexos_pagina_17_IDENTIFICACIONCURP_ventas;
		$formato_pdf=new FormatotruperPDF();

		//identificacion_oficial 
		  $identificacion_oficial=$data_ine;
  
		  if(count($identificacion_oficial)>0){
  
			  $html=str_replace("#identificacion_oficial-img#",trim(basename('archivos/'.$identificacion_oficial[0]->arc_nombre)),$html);
			  $html=str_replace("#identificacion_oficial-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#identificacion_oficial-style#","display:none;",$html);
			  $html=str_replace("#identificacion_oficial-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

		  }

		  //curp 
		  $curp=$data_curp;
  
		  if(count($curp)>0){
  
			  $html=str_replace("#curp-img#",trim(basename('archivos/'.$curp[0]->arc_nombre)),$html);
			  $html=str_replace("#curp-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#curp-style#","display:none;",$html);
			  $html=str_replace("#curp-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

		  }

        
        return $html;
	}

	public function formatoEseTruperVentas_actanacimiento($ese_id,$data){
		$reporte= new PdfReporteTruper();
        $html=$reporte->anexos_pagina_18_ACTANACIMIENTO_ventas;
		$formato_pdf=new FormatotruperPDF();

		  //actanacimiento 
		  $actanacimiento=$data;
  
		  if(count($actanacimiento)>0){
  
			  $html=str_replace("#actanacimiento-img#",trim(basename('archivos/'.$actanacimiento[0]->arc_nombre)),$html);
			  $html=str_replace("#actanacimiento-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#actanacimiento-style#","display:none;",$html);
			  $html=str_replace("#actanacimiento-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);
		  }

        
        return $html;
	}


	public function formatoEseTruperVentas_cartilla_domicilio($ese_id,$data_comprobantedomicilio,$data_cartillamilitar){
		$reporte= new PdfReporteTruper();
        $html=$reporte->anexos_pagina_19_COMPROBANTEDOMICILIOCARTILLAMILITAR_ventas;
		$formato_pdf=new FormatotruperPDF();
		
			//comprobantedomicilio 
		  $comprobantedomicilio=$data_comprobantedomicilio;
  
		  if(count($comprobantedomicilio)>0){
  
			  $html=str_replace("#comprobantedomicilio-img#",trim(basename('archivos/'.$comprobantedomicilio[0]->arc_nombre)),$html);
			  $html=str_replace("#comprobantedomicilio-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#comprobantedomicilio-style#","display:none;",$html);
			  $html=str_replace("#comprobantedomicilio-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

		  }

		  //cartillamilitar 
		  $cartillamilitar=$data_cartillamilitar;
  
		  if(count($cartillamilitar)>0){
  
			  $html=str_replace("#cartillamilitar-img#",trim(basename('archivos/'.$cartillamilitar[0]->arc_nombre)),$html);
			  $html=str_replace("#cartillamilitar-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#cartillamilitar-style#","display:none;",$html);
			  $html=str_replace("#cartillamilitar-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

		  }
        
        return $html;
	}

	public function formatoEseTruperVentas_constanciaestudios($ese_id,$data){
		$reporte= new PdfReporteTruper();
        $html=$reporte->anexos_pagina_20_CONSTANCIAESTUDIOS_ventas;
		$formato_pdf=new FormatotruperPDF();
 		//constanciadeestudios 
		  $constanciadeestudios=$data;
		  if(count($constanciadeestudios)>0){
  
			  $html=str_replace("#constanciadeestudios-img#",trim(basename('archivos/'.$constanciadeestudios[0]->arc_nombre)),$html);
			  $html=str_replace("#constanciadeestudios-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#constanciadeestudios-style#","display:none;",$html);
			  $html=str_replace("#constanciadeestudios-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);
		  }
        
        return $html;
	}
	public function formatoEseTruperVentas_constancialaborales($ese_id,$data){
		$reporte= new PdfReporteTruper();
        $html=$reporte->anexos_pagina_21_CONSTANCIALABORALES_ventas;
		$formato_pdf=new FormatotruperPDF();

		//constanciaslaborales 
		  $constanciaslaborales=$data;
		  if(count($constanciaslaborales)>0){
  
			  $html=str_replace("#constanciaslaborales-img#",trim(basename('archivos/'.$constanciaslaborales[0]->arc_nombre)),$html);
			  $html=str_replace("#constanciaslaborales-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#constanciaslaborales-style#","display:none;",$html);
			  $html=str_replace("#constanciaslaborales-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);
		  }
        
        return $html;
	}

	public function formatoEseTruperVentas_rfc_afore($ese_id,$data_rfc,$data_afore){
		$reporte= new PdfReporteTruper();
        $html=$reporte->anexos_pagina_22_RFC_AFORE_ventas;
		$formato_pdf=new FormatotruperPDF();

			//rfc 
		  $rfc=$data_rfc;
  
		  if(count($rfc)>0){
  
			  $html=str_replace("#rfc-img#",trim(basename('archivos/'.$rfc[0]->arc_nombre)),$html);
			  $html=str_replace("#rfc-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#rfc-style#","display:none;",$html);
			  $html=str_replace("#rfc-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

		  }

		  //afore 
		  $afore=$data_afore;
  
		  if(count($afore)>0){
  
			  $html=str_replace("#afore-img#",trim(basename('archivos/'.$afore[0]->arc_nombre)),$html);
			  $html=str_replace("#afore-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#afore-style#","display:none;",$html);
			  $html=str_replace("#afore-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);

		  }
        
        return $html;
	}


	public function formatoEseTruperVentas_aviso_privacidad($ese_id,$data){
		$reporte= new PdfReporteTruper();
        $html=$reporte->anexos_pagina_23_AVISO_PRIVACIDAD_ventas;
		$formato_pdf=new FormatotruperPDF();

		//aviso_privacidad 
		  $aviso_privacidad=$data;
  
		  if(count($aviso_privacidad)>0){
			  $html=str_replace("#aviso_privacidad-img#",trim(basename('archivos/'.$aviso_privacidad[0]->arc_nombre)),$html);
			  $html=str_replace("#aviso_privacidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td(1), $html);

		  }else{
			  $html=str_replace("#aviso_privacidad-style#","display:none;",$html);
			  $html=str_replace("#aviso_privacidad-style_bg#",$formato_pdf->verificar_si_es_vacio_td(null), $html);
		  }
        
        return $html;
	}

	/**
	 * getValidacionAdjuntar - VALIDA QUE SEA UN TIPO DE FORMATO CORRECTO para adjuntar de acuerdo al tipo de formato
	 *
	 * @param int $tif_id
	 * @param array $array_archivo
	 * @return boolean
	 */
	public function getValidacionAdjuntar($tif_id = 0, $array_archivo)
	{
		$validacion = 0;

		switch ($tif_id) {
			case 9:
			case 11:
				$validacion = ($array_archivo['cat_truperadjunto'] == 1);
				break;
			case 1:
				$validacion = ($array_archivo['cat_eseadjunto'] == 1);
				break;
			case 6:
				$validacion = ($array_archivo['cat_gabineteadjunto'] == 1);
				break;
			default:
				$validacion = 0;
		}

		return $validacion;
	}

	/**
	 * getValidacionEstatusAdjuntar -VALIDA EL ESTATUS QUE TIENE UN ESTUDIO
	 *
	 * @param [int] $ese_estatus
	 * @return boolean
	 */
	public function getValidacionEstatusAdjuntar($ese_estatus = 0)
	{
		$estatusNoPermitidos = [7];
		$answer = 0;
		if (!in_array($ese_estatus, $estatusNoPermitidos)) {
			$answer = 1;
		}
		return $answer;
	}
	

	public function registrosDinamicosAdjuntadosReporte($data,$obj_mpdf){
		
		$reporte= new PdfReporteTruper();
	
		//este html es para mostrar 4 imgs
        $html=$reporte->anexos_adjuntados_reporte;

		//para mostrar 3 imgs
		$html_3=$reporte->anexos_adjuntados_reporte_3_img;

		//para mostrar 2 imgs
		$html_2=$reporte->anexos_adjuntados_reporte_2_img;

		//para mostrar 1 imgs
		$html_1=$reporte->anexos_adjuntados_reporte_1_img;

		$archivos_por_categoria_arreglo = array();

		//dividimos los archivos por categorias para mostrarlos facilmente
		for ($i=0; $i <count($data) ; $i++) { 
			//creamos la categoria dentro del arreglo
			if (!isset($archivos_por_categoria_arreglo[$data[$i]->cat_nombre])) {
				$archivos_por_categoria_arreglo[$data[$i]->cat_nombre] = array();
			}
			$archivos_por_categoria_arreglo[$data[$i]->cat_nombre][] = $data[$i];
		}

	
		$ultima_categoria_agregada=key(array_slice($archivos_por_categoria_arreglo, -1, 1, true));

		//agregamos una hoja para que no este junto 
		$obj_mpdf->AddPage();

		

		foreach ($archivos_por_categoria_arreglo as $categoria_key=>$caja_categoria_items) {
			$contador=0;
			$html_renovado='';
			$html_renovado=$html;
			$indice_ultimo_elemento='';
			$posicion_ultimo_elemento_caja='';
			//creamos la hoja dedicada especialmente para esa categoria por categoria
			$cantidad_elementos_a_agregar = count($caja_categoria_items);
			$resto_division = $cantidad_elementos_a_agregar % 4;
			if($resto_division!=0){
				$indice_ultimo_elemento = $cantidad_elementos_a_agregar - 1;
				$posicion_ultimo_elemento_caja = $indice_ultimo_elemento - $resto_division + 1;

			}
			
			$titulos_seccion=$this->upper($categoria_key);



			if($resto_division==0){//validamos que  si hay de 4 en 4 elementos

				$html_renovado=str_replace("#nombre_categoria_archivo#",trim($titulos_seccion),$html_renovado);
				for ($k=0,$contador_img_agregadas=0; $k <= count($caja_categoria_items) ; $k++,$contador_img_agregadas++) { 

					$html_renovado=str_replace("#archivo_$contador_img_agregadas#",trim(basename('archivos/'.$caja_categoria_items[$k]->arc_nombre)),$html_renovado);
	
					if($contador_img_agregadas==3 && isset($caja_categoria_items[$k+1]) ){//validamos que exista un proximo registro para agregar la hoja y si ya van 4 img agregadas
						$obj_mpdf->WriteHTML($html_renovado);//inserto la pagina
						$obj_mpdf->AddPage();
						$contador_img_agregadas=-1;//lo arrancamo en -1 por que el loop le va agregar uno
						$html_renovado='';//limpiamos el html agregado
						$html_renovado=$html;
						$html_renovado=str_replace("#nombre_categoria_archivo#",trim($titulos_seccion),$html_renovado);//colocamos un titulo en la hoja agregada
	
					}	
					
	
				}
			}

			if($cantidad_elementos_a_agregar<4){//validamos que sea a menor a 4

				switch ($cantidad_elementos_a_agregar) {
					case '1':
						$html_renovado='';
						$html_renovado=$html_1;
						break;

					case '2':
						$html_renovado='';
						$html_renovado=$html_2;
						break;
					
					case '3':
						$html_renovado='';
						$html_renovado=$html_3;
						break;
				}

				$html_renovado=str_replace("#nombre_categoria_archivo#",trim($titulos_seccion),$html_renovado);
				for ($k=0,$contador_img_agregadas=0; $k <= count($caja_categoria_items) ; $k++,$contador_img_agregadas++) { 
					$html_renovado=str_replace("#archivo_$contador_img_agregadas#",trim(basename('archivos/'.$caja_categoria_items[$k]->arc_nombre)),$html_renovado);					
	
				}
				
			}
			if($cantidad_elementos_a_agregar>4 && $resto_division!=0){
			

				$html_renovado=str_replace("#nombre_categoria_archivo#",trim($titulos_seccion),$html_renovado);
				for ($k=0,$contador_img_agregadas=0; $k <= count($caja_categoria_items) ; $k++,$contador_img_agregadas++) { 

					$html_renovado=str_replace("#archivo_$contador_img_agregadas#",trim(basename('archivos/'.$caja_categoria_items[$k]->arc_nombre)),$html_renovado);
	
					if($contador_img_agregadas==3 && isset($caja_categoria_items[$k+1]) ){//validamos que exista un proximo registro para agregar la hoja y si ya van 4 img agregadas
						
						if($k==($posicion_ultimo_elemento_caja-1)){

							
							$obj_mpdf->WriteHTML($html_renovado);//inserto la pagina
							$obj_mpdf->AddPage();
							$contador_img_agregadas=-1;//lo arrancamo en -1 por que el loop le va agregar uno
							switch ($resto_division) {
								case '1':
									$html_renovado='';
									$html_renovado=$html_1;
									break;
			
								case '2':
									$html_renovado='';
									$html_renovado=$html_2;

								
										
									break;
								
								case '3':
									$html_renovado='';
									$html_renovado=$html_3;
									break;
							}
							$html_renovado=str_replace("#nombre_categoria_archivo#",trim($titulos_seccion),$html_renovado);//co
						}else{
							$obj_mpdf->WriteHTML($html_renovado);//inserto la pagina
							$obj_mpdf->AddPage();
							$contador_img_agregadas=-1;//lo arrancamo en -1 por que el loop le va agregar uno
							$html_renovado='';//limpiamos el html agregado
							$html_renovado=$html;
							$html_renovado=str_replace("#nombre_categoria_archivo#",trim($titulos_seccion),$html_renovado);//colocamos un titulo en la hoja agregada
	
						}
						
					}	
					
	
				}
				
			}
			

			

			$obj_mpdf->WriteHTML($html_renovado);
			if($categoria_key!=$ultima_categoria_agregada){//validamos de no agregar una hoja en blanco al final 
				$obj_mpdf->AddPage();

			}
			

		}
		

		


	
	}


	public function registrosDinamicosAdjuntadosReporte_formatogabinete($data,$obj_mpdf){
		
		$reporte= new PdfReporteGabineteEncognv();
	
		//este html es para mostrar 4 imgs
        $html=$reporte->anexos_adjuntados_reporte;

		//para mostrar 3 imgs
		$html_3=$reporte->anexos_adjuntados_reporte_3_img;

		//para mostrar 2 imgs
		$html_2=$reporte->anexos_adjuntados_reporte_2_img;

		//para mostrar 1 imgs
		$html_1=$reporte->anexos_adjuntados_reporte_1_img;

		$archivos_por_categoria_arreglo = array();

		//dividimos los archivos por categorias para mostrarlos facilmente
		for ($i=0; $i <count($data) ; $i++) { 
			//creamos la categoria dentro del arreglo
			if (!isset($archivos_por_categoria_arreglo[$data[$i]->cat_nombre])) {
				$archivos_por_categoria_arreglo[$data[$i]->cat_nombre] = array();
			}
			$archivos_por_categoria_arreglo[$data[$i]->cat_nombre][] = $data[$i];
		}

	
		$ultima_categoria_agregada=key(array_slice($archivos_por_categoria_arreglo, -1, 1, true));

		//agregamos una hoja para que no este junto 
		$obj_mpdf->AddPage();

		

		foreach ($archivos_por_categoria_arreglo as $categoria_key=>$caja_categoria_items) {
			$contador=0;
			$html_renovado='';
			$html_renovado=$html;
			$indice_ultimo_elemento='';
			$posicion_ultimo_elemento_caja='';
			//creamos la hoja dedicada especialmente para esa categoria por categoria
			$cantidad_elementos_a_agregar = count($caja_categoria_items);
			$resto_division = $cantidad_elementos_a_agregar % 4;
			if($resto_division!=0){
				$indice_ultimo_elemento = $cantidad_elementos_a_agregar - 1;
				$posicion_ultimo_elemento_caja = $indice_ultimo_elemento - $resto_division + 1;

			}
			
			$titulos_seccion=$this->upper($categoria_key);



			if($resto_division==0){//validamos que  si hay de 4 en 4 elementos

				$html_renovado=str_replace("#nombre_categoria_archivo#",trim($titulos_seccion),$html_renovado);
				for ($k=0,$contador_img_agregadas=0; $k <= count($caja_categoria_items) ; $k++,$contador_img_agregadas++) { 

					$html_renovado=str_replace("#archivo_$contador_img_agregadas#",trim(basename('archivos/'.$caja_categoria_items[$k]->arc_nombre)),$html_renovado);
	
					if($contador_img_agregadas==3 && isset($caja_categoria_items[$k+1]) ){//validamos que exista un proximo registro para agregar la hoja y si ya van 4 img agregadas
						$obj_mpdf->WriteHTML($html_renovado);//inserto la pagina
						$obj_mpdf->AddPage();
						$contador_img_agregadas=-1;//lo arrancamo en -1 por que el loop le va agregar uno
						$html_renovado='';//limpiamos el html agregado
						$html_renovado=$html;
						$html_renovado=str_replace("#nombre_categoria_archivo#",trim($titulos_seccion),$html_renovado);//colocamos un titulo en la hoja agregada
	
					}	
					
	
				}
			}

			if($cantidad_elementos_a_agregar<4){//validamos que sea a menor a 4

				switch ($cantidad_elementos_a_agregar) {
					case '1':
						$html_renovado='';
						$html_renovado=$html_1;
						break;

					case '2':
						$html_renovado='';
						$html_renovado=$html_2;
						break;
					
					case '3':
						$html_renovado='';
						$html_renovado=$html_3;
						break;
				}

				$html_renovado=str_replace("#nombre_categoria_archivo#",trim($titulos_seccion),$html_renovado);
				for ($k=0,$contador_img_agregadas=0; $k <= count($caja_categoria_items) ; $k++,$contador_img_agregadas++) { 
					$html_renovado=str_replace("#archivo_$contador_img_agregadas#",trim(basename('archivos/'.$caja_categoria_items[$k]->arc_nombre)),$html_renovado);					
	
				}
				
			}
			if($cantidad_elementos_a_agregar>4 && $resto_division!=0){
			

				$html_renovado=str_replace("#nombre_categoria_archivo#",trim($titulos_seccion),$html_renovado);
				for ($k=0,$contador_img_agregadas=0; $k <= count($caja_categoria_items) ; $k++,$contador_img_agregadas++) { 

					$html_renovado=str_replace("#archivo_$contador_img_agregadas#",trim(basename('archivos/'.$caja_categoria_items[$k]->arc_nombre)),$html_renovado);
	
					if($contador_img_agregadas==3 && isset($caja_categoria_items[$k+1]) ){//validamos que exista un proximo registro para agregar la hoja y si ya van 4 img agregadas
						
						if($k==($posicion_ultimo_elemento_caja-1)){

							
							$obj_mpdf->WriteHTML($html_renovado);//inserto la pagina
							$obj_mpdf->AddPage();
							$contador_img_agregadas=-1;//lo arrancamo en -1 por que el loop le va agregar uno
							switch ($resto_division) {
								case '1':
									$html_renovado='';
									$html_renovado=$html_1;
									break;
			
								case '2':
									$html_renovado='';
									$html_renovado=$html_2;

								
										
									break;
								
								case '3':
									$html_renovado='';
									$html_renovado=$html_3;
									break;
							}
							$html_renovado=str_replace("#nombre_categoria_archivo#",trim($titulos_seccion),$html_renovado);//co
						}else{
							$obj_mpdf->WriteHTML($html_renovado);//inserto la pagina
							$obj_mpdf->AddPage();
							$contador_img_agregadas=-1;//lo arrancamo en -1 por que el loop le va agregar uno
							$html_renovado='';//limpiamos el html agregado
							$html_renovado=$html;
							$html_renovado=str_replace("#nombre_categoria_archivo#",trim($titulos_seccion),$html_renovado);//colocamos un titulo en la hoja agregada
	
						}
						
					}	
					
	
				}
				
			}
			

			

			$obj_mpdf->WriteHTML($html_renovado);
			if($categoria_key!=$ultima_categoria_agregada){//validamos de no agregar una hoja en blanco al final 
				$obj_mpdf->AddPage();

			}
			

		}
		

		


	
	}

	public function anexos_pagina_referencias(){
		$reporte= new PdfReporteTruper();
	
		//este html es para mostrar 4 imgs
        $html=$reporte->anexos_pagina_referencias;
		return $html;
	}
	/**
	 * Genera el formato dinámico para la sección de anexos finales en un reporte PDF de Truper.|AGREGA UNA HOJA COMPLETA POR ARCHIVO
	 * @param int $ese_id - Identificador de la entidad sin ánimo de lucro (ESE).
	 * @param object|null $aviso_priv - Objeto que representa el aviso de privacidad. Debe tener la propiedad 'arc_nombre'.Puede ser nulo si no hay aviso de privacidad.
	 * @return string - El formato HTML generado para la sección de anexos finales.
	 */
	public function formatoEseTruperAnexosFinales_DINAMICO($ese_id, $aviso_priv){
		$reporte = new PdfReporteTruper();
		$html = $reporte->anexos_pagina_15;
		$formato_pdf = new FormatotruperPDF();
	
		if (isset($aviso_priv) && is_object($aviso_priv) && property_exists($aviso_priv, 'arc_nombre')) {
			//aviso privacidad 
			$html = str_replace("#aviso_privacidad-img#", trim(basename('archivos/' . $aviso_priv->arc_nombre)), $html);
			$html = str_replace("#aviso_privacidad-style_bg#", $formato_pdf->verificar_si_es_vacio_td(1), $html);
			//aviso privacidad 
		} else {
			$html = "";
		}
	
		return $html;
	}

}