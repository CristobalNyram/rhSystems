<?php

use Phalcon\Mvc\User\Component,
Phalcon\Mvc\View;

class PdfReporte extends Component
{

	public $diplomahtml='
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<TITLE>Título de la página</TITLE>
			<style>
				body {
					font-family:"Montserrat", sans-serif;
					font-size:16px;
					font-style:normal;
					font-weight:normal;
				}						
				/*.contenido, .header{padding: 20px;float: right!important;}*/
			    .tableContenido{
			    	width: 100%;
			    	margin: auto;
			    	padding: 32% 20px 0px;
			    	font-family:"Montserrat", sans-serif;
			    	font-size:12px;
			    }
				.colQr{width: 20%;vertical-align: middle;}
				.colContent{width: 85%;}
				.center{text-align: center;}
				.tdleft{
					font-family:"Montserrat";
					font-size:28px;
					vertical-align: text-top!important;
				}
				.usuario{
					font-family:"Montserrat Bold";
					font-size:40px;
					font-weight:bold;
					vertical-align: text-top!important;
				}
		        .tableDatos{width: 80%;}
		        .tableFirma{
		        	width: 100%;
		        	padding: #paddingfirma#% 0% 0%;	        
		        }
		        .tableFirma td{
		        	font-family:"Montserrat", sans-serif;
					font-size:18px;
					font-style:normal;
					
		        }
		        .colEspacio{width: 11%;}
		        .colFirma{width: 50%;}
		        .right{text-align: right;vertical-align:middle!important; }

		        
		        .justify{text-align: justify;}
		        .margen{margin-right: 20px;}
			</style>
		</head>
		<body>
			<div class="contenido">
	        	<table class="tableContenido">
	        		<tr>
					    <td class="colQr center"></td>
					    <td class="colEspacio"></td>
					    <td rowspan="3" class="colContent tdleft center">
	        				<p class="usuario">A: #usuario#</p>
	        				<br>
	        				<br>
	        				<p>Por su participación en el Taller</p>
	        				<p>"#curso#"</p>
	        				<p>Que se realizó en #municipio#, #estado#.</p>
	        				<p>#periodo#</p>
	        				<p>Duración: #horas# Horas.</p>
	        			</td>
					</tr>
					<tr>
						<td class="colQr center">
	    					<img class="" src="temp/#qr#" >
	    					<p>Folio: #folio#</p>
	    					<p>#expedicion#</p>
	        			</td>
						<td class="colEspacio"></td>
					</tr>
	        		<tr>
	        			<td class="colQr center"></td>
	        			<td class="colEspacio"></td>
	        		</tr>
	        	</table>
	        	
	        </div>      
		</body>
	</html>
	';
	public $diplomafooter='
		<table class="tableContenido" style="padding: 0 0 50px;">
    		<tr>
			    <td class="colQr center"></td>
			    <td class="colEspacio"></td>
			    <td rowspan="3" class="colContent tdleft center">
    				<table class="tableFirma">
    					<tr>
    						<td class="colFirma">
    							<hr>
    							<p>#instructor#</p>
    							<p>Facilitador</p>
    						</td>
    						<td class="colEspacio"></td>
    						<td class="colFirma">
    							<hr>
    							<p>#nombrefirma#</p>
    							<p>#puestofirma#</p>
    						</td>
    					</tr>
    				</table>
    			</td>
			</tr>
			<tr>
				<td class="colQr center">
    			</td>
				<td class="colEspacio"></td>
			</tr>
    		<tr>
    			<td class="colQr center"></td>
    			<td class="colEspacio"></td>
    		</tr>
    	</table>';

    public $diplomadigitalhtml='
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<TITLE>Título de la página</TITLE>
			<style>
				body {
					font-family:"Montserrat", sans-serif;
					font-size:16px;
					font-style:normal;
					font-weight:normal;
				}						
				/*.contenido, .header{padding: 20px;float: right!important;}*/
			    .tableContenido{
			    	width: 100%;
			    	margin: auto;
			    	padding: 40% 140px 0px 0px;
			    	font-family:"Montserrat", sans-serif;
			    	font-size:12px;
			    }
				.colQr{width: 20%;vertical-align: middle;}
				.colContent{width: 100%;}
				.center{text-align: center;}
				.tdleft{
					font-family:"Montserrat";
					font-size:28px;
					vertical-align: text-top!important;
				}
				.usuario{
					font-family:"Montserrat Bold";
					font-size:40px;
					font-weight:bold;
					vertical-align: text-top!important;
				}
		        .tableDatos{width: 80%;}
		        .tableFirma{
		        	width: 100%;
		        	padding: #paddingfirma#% 0% 0%;	        
		        }
		        .tableFirma td{
		        	font-family:"Montserrat", sans-serif;
					font-size:18px;
					font-style:normal;
					
		        }
		        .colEspacio{width: 27%;}
		        .colFirma{width: 50%;}
		        .right{text-align: right;vertical-align:middle!important; }

		        
		        .justify{text-align: justify;}
		        .margen{margin-right: 20px;}
		        .nom{width: 95%; margin: auto;}
		        .txt{width: 85%; padding: 500px;}

		        hr{
				    padding-top: 0px;
				    margin-top: 0px;    
				  }
			</style>
		</head>
		<body>
			<div class="contenido">
	        	<table class="tableContenido">
	        		<tr>
					    <td class="colQr center"></td>
					    <td class="colEspacio"></td>
					    <td rowspan="3" class="colContent tdleft center">
					    	<div class="nom">
	        					<p class="usuario">A: #usuario#</p>
		        				<br>
		        				<br>
	        				</div>
	        				<div class="txt">
		        				<p>Por su participación en el Taller</p>
		        				<p>"#curso#"</p>
		        				<p>Que se realizó en #municipio#, #estado#.</p>
		        				<p>#periodo#</p>
		        				<p>Duración: #horas# Horas.</p>
	        				</div>
	        			</td>
					</tr>
					<tr>
						<td class="colQr center" style="width: 15%;">
	    					<img class="" src="temp/#qr#" >
	    					<p>Folio: #folio#</p>
	    					<p>#expedicion#</p>
	        			</td>
						<td class="colEspacio"></td>
					</tr>
	        		<tr>
	        			<td class="colQr center"></td>
	        			<td class="colEspacio"></td>
	        		</tr>
	        	</table>
	        	
	        </div>      
		</body>
	</html>
	';
	public $diplomadigitalfooter='
		<table class="tableContenido" style="padding: 0 0 50px;">
    		<tr>
			    <td class="colQr center"></td>
			    <td class="colEspacio" style="width: 10%;"></td>
			    <td rowspan="3" class="colContent tdleft center">
    				<table class="tableFirma">
    					<tr>
    						<td class="colFirma">
    							<img class="" src="images/firmas/#firmainstructor#">
    							<hr>
    							<p>#instructor#</p>
    							<p>Facilitador</p>
    						</td>
    						<td class="colEspacio"  style="width: 15%;"></td>
    						<td class="colFirma">
    							<img class="" src="images/firmas/#firmaadmin#">
    							<hr>
    							<p>#nombrefirma#</p>
    							<p>#puestofirma#</p>
    						</td>
    					</tr>
    				</table>
    			</td>
			</tr>
			<tr>
				<td class="colQr center">
    			</td>
				<td class="colEspacio" style="width: 10%;></td>
			</tr>
    		<tr>
    			<td class="colQr center"></td>
    			<td class="colEspacio" style="width: 10%;></td>
    		</tr>
    	</table>';

    public $diplomahtmllinea='
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<TITLE>Título de la página</TITLE>
			<style>
				body {
					font-family:"Montserrat", sans-serif;
					font-size:16px;
					font-style:normal;
					font-weight:normal;
				}						
				/*.contenido, .header{padding: 20px;float: right!important;}*/
			    .tableContenido{
			    	width: 100%;
			    	margin: auto;
			    	padding: 32% 20px 0px;
			    	font-family:"Montserrat", sans-serif;
			    	font-size:12px;
			    }
				.colQr{width: 20%;vertical-align: middle;}
				.colContent{width: 85%;}
				.center{text-align: center;}
				.tdleft{
					font-family:"Montserrat";
					font-size:28px;
					vertical-align: text-top!important;
				}
				.usuario{
					font-family:"Montserrat Bold";
					font-size:40px;
					font-weight:bold;
					vertical-align: text-top!important;
				}
		        .tableDatos{width: 80%;}
		        .tableFirma{
		        	width: 100%;
		        	padding: #paddingfirma#% 0% 0%;	        
		        }
		        .tableFirma td{
		        	font-family:"Montserrat", sans-serif;
					font-size:18px;
					font-style:normal;
					
		        }
		        .colEspacio{width: 11%;}
		        .colFirma{width: 50%;}
		        .right{text-align: right;vertical-align:middle!important; }

		        
		        .justify{text-align: justify;}
		        .margen{margin-right: 20px;}
			</style>
		</head>
		<body>
			<div class="contenido">
	        	<table class="tableContenido">
	        		<tr>
					    <td class="colQr center"></td>
					    <td class="colEspacio"></td>
					    <td rowspan="3" class="colContent tdleft center">
	        				<p class="usuario">A: #usuario#</p>
	        				<br>
	        				<br>
	        				<p>Por su participación en el Taller en línea</p>
	        				<p>"#curso#"</p>
	        				<p>que se completó en el sitio www.cursos.sipscap.com</p>
	        				<p>El día #periodo#</p>
	        				<p>Duración estimada de: #horas# Horas.</p>
	        			</td>
					</tr>
					<tr>
						<td class="colQr center">
	    					<img class="" src="temp/#qr#" >
	    					<p>Folio: #folio#</p>
	    					<p>#expedicion#</p>
	        			</td>
						<td class="colEspacio"></td>
					</tr>
	        		<tr>
	        			<td class="colQr center"></td>
	        			<td class="colEspacio"></td>
	        		</tr>
	        	</table>
	        	
	        </div>      
		</body>
	</html>
	';

	public $diplomadigitalhtmllinea='
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<TITLE>Título de la página</TITLE>
			<style>
				body {
					font-family:"Montserrat", sans-serif;
					font-size:16px;
					font-style:normal;
					font-weight:normal;
				}						
				/*.contenido, .header{padding: 20px;float: right!important;}*/
			    .tableContenido{
			    	width: 100%;
			    	margin: auto;
			    	padding: 40% 140px 0px 0px;
			    	font-family:"Montserrat", sans-serif;
			    	font-size:12px;
			    }
				.colQr{width: 20%;vertical-align: middle;}
				.colContent{width: 100%;}
				.center{text-align: center;}
				.tdleft{
					font-family:"Montserrat";
					font-size:28px;
					vertical-align: text-top!important;
				}
				.usuario{
					font-family:"Montserrat Bold";
					font-size:40px;
					font-weight:bold;
					vertical-align: text-top!important;
				}
		        .tableDatos{width: 80%;}
		        .tableFirma{
		        	width: 100%;
		        	padding: #paddingfirma#% 0% 0%;	        
		        }
		        .tableFirma td{
		        	font-family:"Montserrat", sans-serif;
					font-size:18px;
					font-style:normal;
					
		        }
		        .colEspacio{width: 27%;}
		        .colFirma{width: 50%;}
		        .right{text-align: right;vertical-align:middle!important; }

		        
		        .justify{text-align: justify;}
		        .margen{margin-right: 20px;}
		        .nom{width: 95%; margin: auto;}
		        .txt{width: 85%; padding: 500px;}

		        hr{
				    padding-top: 0px;
				    margin-top: 0px;    
				  }
			</style>
		</head>
		<body>
			<div class="contenido">
	        	<table class="tableContenido">
	        		<tr>
					    <td class="colQr center"></td>
					    <td class="colEspacio"></td>
					    <td rowspan="3" class="colContent tdleft center">
					    	<div class="nom">
	        					<p class="usuario">A: #usuario#</p>
		        				<br>
		        				<br>
	        				</div>
	        				<div class="txt">
		        				<p>Por su participación en el Taller en línea</p>
		        				<p>"#curso#"</p>
		        				<p>que se completó en el sitio www.cursos.sipscap.com</p>
		        				<p>El día #periodo#</p>
		        				<p>Duración estimada de: #horas# Horas.</p>
	        				</div>
	        			</td>
					</tr>
					<tr>
						<td class="colQr center" style="width: 15%;">
	    					<img class="" src="temp/#qr#" >
	    					<p>Folio: #folio#</p>
	    					<p>#expedicion#</p>
	        			</td>
						<td class="colEspacio"></td>
					</tr>
	        		<tr>
	        			<td class="colQr center"></td>
	        			<td class="colEspacio"></td>
	        		</tr>
	        	</table>
	        	
	        </div>      
		</body>
	</html>
	';

	public $diplomainstructorhtml='
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<TITLE>Título de la página</TITLE>
			<style>
				body {
					font-family:"Montserrat", sans-serif;
					font-size:16px;
					font-style:normal;
					font-weight:normal;
				}						
				/*.contenido, .header{padding: 20px;float: right!important;}*/
			    .tableContenido{
			    	width: 100%;
			    	margin: auto;
			    	padding: 32% 20px 0px;
			    	font-family:"Montserrat", sans-serif;
			    	font-size:12px;
			    }
				.colQr{width: 20%;vertical-align: middle;}
				.colContent{width: 85%;}
				.center{text-align: center;}
				.tdleft{
					font-family:"Montserrat";
					font-size:28px;
					vertical-align: text-top!important;
				}
				.usuario{
					font-family:"Montserrat Bold";
					font-size:40px;
					font-weight:bold;
					vertical-align: text-top!important;
				}
		        .tableDatos{width: 80%;}
		        .tableFirma{
		        	width: 100%;
		        	padding: #paddingfirma#% 0% 0%;	        
		        }
		        .tableFirma td{
		        	font-family:"Montserrat", sans-serif;
					font-size:18px;
					font-style:normal;
					
		        }
		        .colEspacio{width: 11%;}
		        .colFirma{width: 50%;}
		        .right{text-align: right;vertical-align:middle!important; }

		        
		        .justify{text-align: justify;}
		        .margen{margin-right: 20px;}
			</style>
		</head>
		<body>
			<div class="contenido">
	        	<table class="tableContenido">
	        		<tr>
					    <td class="colQr center"></td>
					    <td class="colEspacio"></td>
					    <td rowspan="3" class="colContent tdleft center">
	        				<p class="usuario">A: #usuario#</p>
	        				<br>
	        				<br>
	        				<p>Por Haber Impartido Satisfactoriamente El Taller</p>
	        				<p>"#curso#"</p>
	        				<p>Que se realizó en #municipio#, #estado#.</p>
	        				<p>#periodo#</p>
	        				<p>Duración: #horas# Horas.</p>
	        			</td>
					</tr>
					<tr>
						<td class="colQr center">
	    					<img class="" src="temp/#qr#" >
	    					<p>Folio: #folio#</p>
	    					<p>#expedicion#</p>
	        			</td>
						<td class="colEspacio"></td>
					</tr>
	        		<tr>
	        			<td class="colQr center"></td>
	        			<td class="colEspacio"></td>
	        		</tr>
	        	</table>
	        	
	        </div>      
		</body>
	</html>
	';

	public $diplomadigitalinstructorhtml='
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<TITLE>Título de la página</TITLE>
			<style>
				body {
					font-family:"Montserrat", sans-serif;
					font-size:16px;
					font-style:normal;
					font-weight:normal;
				}						
				/*.contenido, .header{padding: 20px;float: right!important;}*/
			    .tableContenido{
			    	width: 100%;
			    	margin: auto;
			    	padding: 40% 140px 0px 0px;
			    	font-family:"Montserrat", sans-serif;
			    	font-size:12px;
			    }
				.colQr{width: 20%;vertical-align: middle;}
				.colContent{width: 100%;}
				.center{text-align: center;}
				.tdleft{
					font-family:"Montserrat";
					font-size:28px;
					vertical-align: text-top!important;
				}
				.usuario{
					font-family:"Montserrat Bold";
					font-size:40px;
					font-weight:bold;
					vertical-align: text-top!important;
				}
		        .tableDatos{width: 80%;}
		        .tableFirma{
		        	width: 100%;
		        	padding: #paddingfirma#% 0% 0%;	        
		        }
		        .tableFirma td{
		        	font-family:"Montserrat", sans-serif;
					font-size:18px;
					font-style:normal;
					
		        }
		        .colEspacio{width: 27%;}
		        .colFirma{width: 30%;}
		        .right{text-align: right;vertical-align:middle!important; }

		        
		        .justify{text-align: justify;}
		        .margen{margin-right: 20px;}
		        .nom{width: 95%; margin: auto;}
		        .txt{width: 85%; padding: 500px;}

		        hr{
				    padding-top: 0px;
				    margin-top: 0px;    
				  }
			</style>
		</head>
		<body>
			<div class="contenido">
	        	<table class="tableContenido">
	        		<tr>
					    <td class="colQr center"></td>
					    <td class="colEspacio"></td>
					    <td rowspan="3" class="colContent tdleft center">
					    	<div class="nom">
	        					<p class="usuario">A: #usuario#</p>
		        				<br>
		        				<br>
	        				</div>
	        				<div class="txt">
		        				<p>Por Haber Impartido Satisfactoriamente El Taller</p>
		        				<p>"#curso#"</p>
		        				<p>Que se realizó en #municipio#, #estado#.</p>
		        				<p>#periodo#</p>
		        				<p>Duración: #horas# Horas.</p>
	        				</div>
	        			</td>
					</tr>
					<tr>
						<td class="colQr center" style="width: 15%;">
	    					<img class="" src="temp/#qr#" >
	    					<p>Folio: #folio#</p>
	    					<p>#expedicion#</p>
	        			</td>
						<td class="colEspacio"></td>
					</tr>
	        		<tr>
	        			<td class="colQr center"></td>
	        			<td class="colEspacio"></td>
	        		</tr>
	        	</table>
	        	
	        </div>      
		</body>
	</html>
	';

	public $diplomainstructorfooter='
		<table class="tableContenido" style="padding: 0 0 50px;">
    		<tr>
			    <td class="colQr center"></td>
			    <td class="colEspacio"></td>
			    <td rowspan="3" class="colContent tdleft center">
    				<table class="tableFirma">
    					<tr>
    						<td class="colFirma">
    							<hr>
    							<p>#instructor#</p>
    							<p>Facilitador</p>
    						</td>
    						<td class="colEspacio"></td>
    						<td class="colFirma">
    							<hr>
    							<p>#nombrefirma#</p>
    							<p>#puestofirma#</p>
    						</td>
    					</tr>
    				</table>
    			</td>
			</tr>
			<tr>
				<td class="colQr center">
    			</td>
				<td class="colEspacio"></td>
			</tr>
    		<tr>
    			<td class="colQr center"></td>
    			<td class="colEspacio"></td>
    		</tr>
    	</table>';

  	public $diplomadigitalinstructorfooter='
		<table class="tableContenido" style="padding: 0 0 50px;">
    		<tr>
			    <td class="colQr center"></td>
			    <td class="colEspacio" style="width: 10%;"></td>
			    <td rowspan="3" class="colContent tdleft center">
    				<table class="tableFirma">
    					<tr>
    						<td class="" style="width: 25%;">
    							
    						</td>
    						<td class="colEspacio"  style="width: 40%;">
    						<img class="" src="images/firmas/#firmaadmin#">
    							<hr>
    							<p>#nombrefirma#</p>
    							<p>#puestofirma#</p>
    							</td>
    						<td class="" style="width: 30%;">
    							
    						</td>
    					</tr>
    				</table>
    			</td>
			</tr>
			<tr>
				<td class="colQr center">
    			</td>
				<td class="colEspacio" style="width: 10%;></td>
			</tr>
    		<tr>
    			<td class="colQr center"></td>
    			<td class="colEspacio" style="width: 10%;></td>
    		</tr>
    	</table>';
}