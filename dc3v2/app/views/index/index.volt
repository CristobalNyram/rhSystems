
<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
        {{ get_title() }}
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="{{url('images/faviconsips.png')}}" />
		<meta property="og:locale" content="es_MX" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	
        {{ stylesheet_link('jet/recursos/plugins/global/plugins.bundle.css') }}
        {{ stylesheet_link('jet/recursos/css/style.bundle.css') }}
		{{ javascript_include('js/jquery.min.js') }}

		<!-- JS FIN-->
		{{ javascript_include('js/sha256.js') }}
		<!-- JS INI-->
		
		
	</head>
	<script>
			$(function () 
			{
			  $("#formSession").submit(
				function(event)
				{   
				  event.preventDefault();
				  url_session="<?php echo $this->url->get('session/start') ?>";
				  url_index="<?php echo $this->url->get('cursootorgado/index') ?>";
				  encriptada=SHA256($('#password').val());
				  var $form = $(this);
				  $form.find("button").prop("disabled",true);
				  $.ajax({
					type: "POST",
					url: url_session,
					data:{
					  correo: $('#correo').val(),
					  password: encriptada,
					  
					},
					success: function(res)
					{
								  if(res[0]=='0')
								  {
									// grecaptcha.reset(iniciarses);
									Swal.fire({
									icon: "error",
									text:res[1],
									});

								  }
								  else
								  {
									if(res[0]=='1')
									  window.location=url_index;
									//$form.get(0).submit();
								  }
								  
								  $form.find("button").prop("disabled", false);
								},
								error: function(data)
								{
								  $form.find("button").prop("disabled", false);   
								}
							  });
				  return false;
				});
			});
			
		  </script>
		
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="auth-bg">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->

	  <div class="d-flex flex-column flex-root">
		  <!--begin::Authentication - Sign-in -->
		  <div
			class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
	
			<!--begin::Content-->
			<div
			  class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
			  <!--begin::Logo-->
	
			  {{ image("images/recursos/"~logo, "class": "h-60px", "alt":
			  "Logo sistema") }}
			</a>
			<!--end::Logo-->
	
			<!--begin::Wrapper-->
			<div
			  class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto mt-4">
	
			  <!--begin::Form-->
			  <form class="form  w-100 fv-plugins-bootstrap5 fv-plugins-framework"
				method='post' target='_self' id='formSession'>
				<!--begin::Heading-->
				<div class="text-center mb-10">
				  <!--begin::Title-->
	
				  <!--end::Title-->
	
				  <!--begin::Link-->
	
				  <!--end::Link-->
				</div>
				<!--begin::Heading-->
	
				<!--begin::Input group-->
				<div class="fv-row mb-10 fv-plugins-icon-container">
				  <!--begin::Label-->
				  <label class="form-label fs-6 fw-bolder text-dark"
					for="correo">Correo electrónico</label>
				  <!--end::Label-->
	
				  <!--begin::Input-->
	
				  {{ text_field('correo', 'class':
				  "form-control form-control-lg form-control-solid","placeholder":"Correo electrónico",'required':'true')
				  }}
	
				  <!--end::Input-->
				  <div
					class="fv-plugins-message-container invalid-feedback"></div></div>
				<!--end::Input group-->
	
				<!--begin::Input group-->
				<div class="fv-row mb-10 fv-plugins-icon-container">
				  <!--begin::Wrapper-->
				  <div class="d-flex flex-stack mb-2">
					<!--begin::Label-->
					<label
					  class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
					<!--end::Label-->
	
				  </div>
				  <!--end::Wrapper-->
	
				  <!--begin::Input-->
	
				  {{
				  password_field('form-control form-control-lg form-control-solid',"id":"password",'class':"form-control","placeholder":"Contraseña",'required':'true')
				  }}
	
				  <!--end::Input-->
				  <div
					class="fv-plugins-message-container invalid-feedback"></div></div>
				<!--end::Input group-->
	
				<!--begin::Actions-->
				<div class="text-center">
				  <!--begin::Submit button-->
				  {{ tag_html("button", ["type": "submit", "form": "formSession",
				  "id": "kt_sign_in_submit", "class":
				  "btn btn-lg btn-primary w-100 mb-5"]) }}
				  <span class="indicator-label">
					Iniciar Sesión
				  </span>
				  {{ tag_html_close("button") }}
	
				  <!--end::Submit button-->
				</div>
				<!--end::Actions-->
				<div>
				</div>
			  </form>
			  <!--end::Form-->
			</div>
			<!--end::Wrapper-->
		  </div>
		  <!--end::Content-->
	
		  <!--begin::Footer-->
		  <div class="d-flex flex-center flex-column-auto p-10">
			<!--begin::Links-->
			<div class="d-flex align-items-center fw-bold fs-6">
			  <a href="#"
				class="text-muted text-hover-primary px-2">© 2019 SIPS v {{version}} </a>
	
			</div>
			<!--end::Links-->
		  </div>
		  <!--end::Footer-->
		</div>
		<!--end::Authentication - Sign-in-->
	  </div>
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
        {{ javascript_include('jet/recursos/plugins/global/plugins.bundle.js') }}

        {{ javascript_include('jet/recursos/js/scripts.bundle.js') }}

		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
        {{ javascript_include('jet/recursos/js/custom/authentication/sign-in/general.js') }}

		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>