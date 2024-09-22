<!DOCTYPE html>
<html lang="en">
<head>
  
    
	{% include "/autoestudio/layouts/head_principal.volt" %}


</head>

<style>
h3 {
  color: rgba(255, 255, 255, 0.5);
  font-family: "Courier New", Courier, monospace;
}

.submit{
  cursor: pointer;
  position: relative;
  padding: 10px 20px;
  /* font-size: 36px; */
  width:250px;
  border-radius:4px;
  background: #16345e;
  color: white;
  border: 2px solid;
  transition: width 0.5s;
}

.process{
  width:300px;
  /* box-shadow: 
     0px 1px 10px #0a990a,
    0px 2px 15px #990a0a,
    0px 3px 20px #0a0a99,
    -1px 1px 25px #0a990a,
    -1px 2px 30px #990a0a,
    -1px 3px 35px #0a0a99; */
}
.bg-blue-ligh{
	background: #008C9E;
}

.process::before {
    content: ' ';
    position: absolute;
    background-color: #3bb78f;
	background-image: linear-gradient(315deg, #3bb78f 0%, #0bab64 74%);
    height: 100%;
    top: 0;
    left: 0;
    width: 0%;
    animation: processing 5s;
    border-radius: 4px;
    z-index: -1;
}

.tick{
  position: absolute;
  left:10px;
  top: 10px;
  opacity: 1;
  transition: left 2s;
}

.submitted{
  padding-left: 40px;
  animation: tick 0.6s;
  background-image: linear-gradient(315deg, #3bb78f 0%, #0bab64 74%);
   /* box-shadow: 
    0px 1px 10px #0a990a,
    0px 2px 15px #990a0a,
    0px 3px 20px #0a0a99,
    -1px 1px 25px #0a990a,
    -1px 2px 30px #990a0a,
    -1px 3px 35px #0a0a99; */
}


@keyframes processing{
  from{
    width: 0%;
  }
  to{
    width: 100%;
  }
}

@keyframes tick{
  0%{
    transform: scale(0.1);
  }
  
  75%{
    transform: scale(1.2);
  }
  
  100%{
    transform: scale(1);
  }
}

</style>
<body>

	{% include "/autoestudio/layouts/navbar_principal.volt" %}
	<div class="container bg-white border-radius-9px pt-2 pb-2 mb-2 mt-2" id="seccion-ese">

		<div class="row d-flex justify-content-center mb-4">
			<h2 class="text-uppercase text-center">autoestudio socioeconómico</h2>
		</div>
		<div class="progress" hidden>
			<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
		  </div>
		<div class="row ">

			<div class="col-12 col-md-6 d-flex justify-content-center mt-2 mb-2">
				<div class="btn-group   col-8 col-md-8 btn" style="margin: 0; padding: 0;"  onclick="fnCargarESE_AES('{{ese_id }}')" id="btn-formulario-ese"> 
					<button type="button" class="btn btn-default bg-secundario-sistema"> <span class="h3 text-white">  Formulario</span></button>
					<button type="button" class="btn btn-default bg-white border-secundaria-sistema" ><i class="mdi mdi-file h2 text-color-secundario-sistema"></i> </span></button>
				</div>
			</div>

			<div class="col-12 col-md-6 d-flex justify-content-center mt-2 mb-2">
				<div class="btn-group   col-8 col-md-8 btn" style="margin: 0; padding: 0;" onclick="fnCargarArchivos('{{ ese_id }}');" id="btn-archivos-ese" >
					<button type="button" class="btn btn-default bg-secundario-sistema"> <span class="h3 text-white">Archivos</span></button>
					<button type="button" class="btn btn-default bg-white border-secundaria-sistema" ><i class="mdi mdi-folder-open-outline h2 text-color-secundario-sistema"></i> </span></button>
				</div>
			</div>



  

		</div>

	


		
		  <div class="col-12 col-md-12 d-flex justify-content-center mt-4 mb-2">
			
			<button id="btn-enviar-ese" class="submit col-7 col-md-2 d-flex justify-content-center"  onclick="fnEnviarAES('{{ aes_id }}','{{ ese_id }}')" >
				Enviar
			</button>
		
			</div>
	
		 

	</div>


  <a  
    
    onclick="inciarTutorialAES();" 
     style="
    padding-top: 8px;
    position: fixed;
      bottom: 20px;
      right: 20px;
      cursor: pointer;
      animation: palpitar 1s ease-in-out infinite;
      " data-toggle="modal" title="INICIAR TUTORIAL" data-container="body" data-toggle="popover" role="button" class="bg-custom">
    <i class="mdi mdi-play-circle mdi-36px" style="    font-size: 30px;"></i>
  </a>




{% include "/autoestudio/ese_principal-js.volt" %}

{% include "/autoestudio/layouts/scripts-modal-includes.volt" %}




    
</body>
</html>