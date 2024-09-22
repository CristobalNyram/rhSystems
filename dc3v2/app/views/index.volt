
<html lang="es">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		
		<meta property="og:locale" content="es_MX" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Jet HTML Pro - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme - Jet HTML Pro by KeenThemes" />
		<meta property="og:url" content="https://keenthemes.com/products/jet-html-pro" />
		<meta property="og:site_name" content="SADI" />
    {{ get_title() }}
    <!-- LIBRERIAS INICIO  -->
		{{ stylesheet_link('fonts/font-awesome/css/font-awesome.min.css') }}
		{{ stylesheet_link('css/animate.min.css') }}
		<!-- LIBRERIAS FIN  -->
    {{ stylesheet_link('jet/recursos/plugins/global/plugins.bundle.css') }}
		<link rel="icon" type="image/png" href="{{url('images/faviconsips.png')}}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    {{ stylesheet_link('jet/recursos/plugins/custom/datatables/datatables.bundle.css') }}
    {{ stylesheet_link('jet/recursos/plugins/global/plugins.bundle.css') }}
    {{ stylesheet_link('jet/recursos/css/style.bundle.css') }}

    <!-- js inicio sistema -->
    {{ stylesheet_link('css/alertify.min.css') }}
    {{ javascript_include('js/nprogress.js') }}
    {{ javascript_include('js/alertify.min.js') }}
    {{ javascript_include('js/jquery.min.js') }}
    <!-- js fin sistema -->

		<script>
    // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
		
    {{ content() }} 
		<!--end::Modals-->
		<!--begin::Javascript-->
		<script>var hostUrl = "http://127.0.0.1/sips/dc3v2/"+"jet/recursos/";
    </script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
    {{ javascript_include('jet/recursos/plugins/global/plugins.bundle.js') }}
    {{ javascript_include('jet/recursos/js/scripts.bundle.js') }}
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
    {{ javascript_include('jet/recursos/plugins/custom/datatables/datatables.bundle.js') }}

		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
    {{ javascript_include('jet/recursos/js/widgets.bundle.js') }}
    {{ javascript_include('jet/recursos/js/custom/widgets.js') }}
    {{ javascript_include('jet/recursos/js/custom/apps/chat/chat.js') }}
    {{ javascript_include('jet/recursos/js/custom/utilities/modals/upgrade-plan.js') }}
    {{ javascript_include('jet/recursos/js/custom/utilities/modals/create-app.js') }}
    {{ javascript_include('jet/recursos/js/custom/utilities/modals/users-search.js') }}

		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>