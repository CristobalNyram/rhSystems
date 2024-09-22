<!DOCTYPE html>

<html lang="es">
	<head>
		<!-- base INI -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />

		<link rel="icon" type="image/png" href="{{url('images/faviconsips.png')}}" />
		<!-- base FIN -->
		{{ get_title() }}

		<meta charset="utf-8" />
		<!-- LIBRERIAS INICIO  -->
		{{ stylesheet_link('fonts/font-awesome/css/font-awesome.min.css') }}
		{{ stylesheet_link('css/animate.min.css') }}
		<!-- LIBRERIAS FIN  -->



		<!-- CSSS FIN-->
		{{stylesheet_link('jet/recursos/plugins/custom/prismjs/prismjs.bundle.css')}}

		{# stylesheet_link('jet/recursos/plugins/global/plugins.bundle.css') #}

		{{ stylesheet_link('jet/recursos/css/style.bundle.css') }}
		<!-- CSSS INI-->


		{{ stylesheet_link('plugins/datatables/dataTables.bootstrap.css') }}
		{# {{ stylesheet_link('plugins/datatables/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }} #}
	    {{ stylesheet_link("https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.dataTables.min.css") }}

		<!-- JS INICIO -->
		 {{ javascript_include('js/jquery.min.js') }}
		{{ javascript_include('js/nprogress.js') }}
		{{ javascript_include('js/alertify.min.js') }}
		<!-- JS FIN -->
			

	</head>
	<body id="kt_body"
		class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				<div id="kt_aside" class="aside aside-extended bg-white"
					data-kt-drawer="true" data-kt-drawer-name="aside"
					data-kt-drawer-activate="{default: true, lg: false}"
					data-kt-drawer-overlay="true" data-kt-drawer-width="auto"
					data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
					<!--begin::Primary-->
					<div
						class="aside-primary d-flex flex-column align-items-lg-center flex-row-auto">
						<!--begin::Logo-->
						<div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto pt-10" id="kt_aside_logo">
							<a href="index.html">

								{{ image("images/recursos/"~logo, "class": "h-30px", "alt":
								"Logo sistema") }}
							</a>

						</div>

						<!--end::Logo-->
						<!--begin::Nav-->
						<div
							class="aside-nav d-flex flex-column flex-lg-center flex-column-fluid w-100 pt-5 pt-lg-0"
							id="kt_aside_nav">
							<!--begin::Primary menu-->
							<div id="kt_aside_menu"
								class="menu menu-column menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5"
								data-kt-menu="true">
								<div class="menu-item py-2">
									<a class="menu-link active menu-center" title="Dashboard"
										data-bs-toggle="tooltip" data-bs-trigger="hover"
										data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<!--begin::Svg Icon | path: icons/duotone/Home/Home2.svg-->
											<span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none">
													<path
														d="M21.4622 10.699C21.4618 10.6986 21.4613 10.6981 21.4609 10.6977L13.3016 2.53955C12.9538 2.19165 12.4914 2 11.9996 2C11.5078 2 11.0454 2.1915 10.6974 2.5394L2.54246 10.6934C2.53971 10.6961 2.53696 10.699 2.53422 10.7018C1.82003 11.42 1.82125 12.5853 2.53773 13.3017C2.86506 13.6292 3.29739 13.8188 3.75962 13.8387C3.77839 13.8405 3.79732 13.8414 3.81639 13.8414H4.14159V19.8453C4.14159 21.0334 5.10833 22 6.29681 22H9.48897C9.81249 22 10.075 21.7377 10.075 21.4141V16.707C10.075 16.1649 10.516 15.7239 11.0582 15.7239H12.941C13.4832 15.7239 13.9242 16.1649 13.9242 16.707V21.4141C13.9242 21.7377 14.1866 22 14.5102 22H17.7024C18.8909 22 19.8576 21.0334 19.8576 19.8453V13.8414H20.1592C20.6508 13.8414 21.1132 13.6499 21.4613 13.302C22.1786 12.5844 22.1789 11.4171 21.4622 10.699V10.699Z"
														fill="#00B2FF" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
									</a>
								</div>
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start"
									data-kt-menu-flip="bottom" class="menu-item py-2">
									<span class="menu-link menu-center" title="Authentication Pages"
										data-bs-toggle="tooltip" data-bs-trigger="hover"
										data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<!--begin::Svg Icon | path: icons/duotone/General/User.svg-->
											<span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg"
													xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
													height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<polygon points="0 0 24 0 24 24 0 24" />
														<path
															d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
															fill="#000000" fill-rule="nonzero" opacity="0.3" />
														<path
															d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
															fill="#000000" fill-rule="nonzero" />
													</g>
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
									</span>

								</div>
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start"
									data-kt-menu-flip="bottom" class="menu-item py-2">
									<span class="menu-link menu-center" title="Account Pages"
										data-bs-toggle="tooltip" data-bs-trigger="hover"
										data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<!--begin::Svg Icon | path: icons/duotone/Shopping/Chart.svg-->
											<span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none">
													<path
														d="M15.7632 15.2206C15.4599 14.9148 14.9749 14.8913 14.6449 15.166C13.1591 16.3965 10.8415 16.3965 9.35567 15.166C9.02566 14.8913 8.54066 14.9148 8.23733 15.2206L5.29062 18.1907C5.12812 18.3537 5.04062 18.5763 5.04644 18.8073C5.05226 19.0374 5.15226 19.255 5.32226 19.4095C7.16478 21.0802 9.53649 22 11.9998 22C14.4632 22 16.8357 21.0802 18.6782 19.4095C18.8482 19.255 18.9474 19.0374 18.9541 18.8073C18.9599 18.5763 18.8716 18.3537 18.7099 18.1907L15.7632 15.2206Z"
														fill="#E4E6EF" />
													<path
														d="M7.90424 12.672C7.85592 12.4048 7.83342 12.1587 7.83342 11.9202C7.83342 10.1479 8.95012 8.55864 10.6118 7.96563C10.9443 7.84637 11.1668 7.52969 11.1668 7.17355V2.84096C11.1668 2.59149 11.0568 2.35461 10.8668 2.19503C10.6768 2.03545 10.4226 1.96907 10.1826 2.01443C5.44172 2.89388 2 7.06012 2 11.9202C2 13.5136 2.36582 15.0474 3.08919 16.4795C3.21001 16.7189 3.43838 16.8861 3.7017 16.9281C3.74502 16.9348 3.7892 16.9382 3.8317 16.9382C4.05088 16.9382 4.2642 16.8508 4.42089 16.692L7.67342 13.4145C7.86589 13.2196 7.95257 12.9424 7.90424 12.672Z"
														fill="#E4E6EF" />
													<path
														d="M13.8174 2.01438C13.5774 1.96819 13.3232 2.03454 13.1341 2.19499C12.9432 2.35457 12.8332 2.59144 12.8332 2.84008V7.17351C12.8332 7.52882 13.0557 7.84632 13.3882 7.96476C15.0499 8.55863 16.1666 10.1478 16.1666 11.9202C16.1666 12.1588 16.1441 12.4048 16.0958 12.672C16.0483 12.9424 16.1341 13.2196 16.3275 13.4136L19.5792 16.692C19.7367 16.8508 19.9492 16.9382 20.1683 16.9382C20.2117 16.9382 20.2558 16.9348 20.2983 16.9273C20.5625 16.8853 20.79 16.7181 20.9117 16.4787C21.6342 15.0474 22 13.5136 22 11.9202C22 7.05925 18.5583 2.89383 13.8174 2.01438Z"
														fill="#E4E6EF" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
									</span>

								</div>
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start"
									data-kt-menu-flip="bottom" class="menu-item py-2">
									<span class="menu-link menu-center" title="Chat App"
										data-bs-toggle="tooltip" data-bs-trigger="hover"
										data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<!--begin::Svg Icon | path: icons/duotone/Communication/Group-chat.svg-->
											<span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
													viewBox="0 0 24 24" version="1.1">
													<path
														d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z"
														fill="#000000" />
													<path
														d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z"
														fill="#000000" opacity="0.3" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
									</span>

								</div>
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start"
									data-kt-menu-flip="bottom" class="menu-item py-2">
									<span class="menu-link menu-center" title="Customers App"
										data-bs-toggle="tooltip" data-bs-trigger="hover"
										data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<!--begin::Svg Icon | path: icons/duotone/Communication/Group.svg-->
											<span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
													viewBox="0 0 24 24" version="1.1">
													<path
														d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
														fill="#000000" fill-rule="nonzero" opacity="0.3" />
													<path
														d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
														fill="#000000" fill-rule="nonzero" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
									</span>

								</div>
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start"
									data-kt-menu-flip="bottom" class="menu-item py-2">
									<span class="menu-link menu-center" title="General Pages"
										data-bs-toggle="tooltip" data-bs-trigger="hover"
										data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<!--begin::Svg Icon | path: icons/duotone/Shopping/Cart6.svg-->
											<span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none">
													<path
														d="M16.0546 7.08943H17.8078L15.2088 2.39571C14.9994 2.01537 14.5354 1.88571 14.1741 2.11045C13.8128 2.33088 13.6896 2.81927 13.9031 3.1996L16.0546 7.08943Z"
														fill="#E4E6EF" />
													<path
														d="M10.1051 3.19921C10.3145 2.81887 10.1954 2.33048 9.83411 2.11006C9.47279 1.88963 9.00882 2.01497 8.79942 2.39531L6.20037 7.09336H7.9536L10.1051 3.19921Z"
														fill="#E4E6EF" />
													<path
														d="M20.7107 8.52869H3.28516C2.57483 8.52869 2 9.13377 2 9.88148V11.3812C2 12.1289 2.57483 12.734 3.28516 12.734H3.68754L4.92753 19.8092C5.08356 20.6433 5.8062 21.3046 6.55759 21.3046H7.0503H10.2858C10.6142 21.3046 11.0413 21.3046 11.4765 21.3046H11.8707H12.2648C12.7001 21.3046 13.1271 21.3046 13.4556 21.3046H16.691H17.1837C17.9351 21.3046 18.6578 20.6433 18.8138 19.8092L20.062 12.7297H20.7148C21.4252 12.7297 22 12.1246 22 11.3769V9.87716C21.9959 9.13377 21.4211 8.52869 20.7107 8.52869ZM9.09505 15.5995V18.6509C9.09505 19.0874 8.75837 19.4159 8.3683 19.4159C7.9536 19.4159 7.64155 19.0615 7.64155 18.6509V17.3716V14.3721C7.64155 13.9356 7.97824 13.6071 8.3683 13.6071C8.783 13.6071 9.09505 13.9615 9.09505 14.3721V15.5995ZM11.4272 15.5995V18.6509C11.4272 19.0874 11.0905 19.4159 10.7005 19.4159C10.2858 19.4159 9.97372 19.0615 9.97372 18.6509V17.3716V14.3721C9.97372 13.9356 10.3104 13.6071 10.7005 13.6071C11.0905 13.6071 11.4272 13.9615 11.4272 14.3721V15.5995ZM13.7717 17.3716V18.6509C13.7717 19.0615 13.4597 19.4159 13.045 19.4159C12.6549 19.4159 12.3182 19.0874 12.3182 18.6509V15.5995V14.3721C12.3182 13.9615 12.6549 13.6071 13.045 13.6071C13.435 13.6071 13.7717 13.9356 13.7717 14.3721V17.3716ZM16.1039 17.3716V18.6509C16.1039 19.0615 15.7918 19.4159 15.3771 19.4159C14.9871 19.4159 14.6504 19.0874 14.6504 18.6509V15.5995V14.3721C14.6504 13.9615 14.9624 13.6071 15.3771 13.6071C15.7672 13.6071 16.1039 13.9356 16.1039 14.3721V17.3716Z"
														fill="#E4E6EF" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
									</span>

								</div>
								<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start"
									data-kt-menu-flip="bottom" class="menu-item py-2">
									<span class="menu-link menu-center" title="Resources"
										data-bs-toggle="tooltip" data-bs-trigger="hover"
										data-bs-dismiss="click" data-bs-placement="right">
										<span class="menu-icon me-0">
											<!--begin::Svg Icon | path: icons/duotone/Communication/More.svg-->
											<span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none">
													<path
														d="M12 2C6.47714 2 2 6.47714 2 12C2 17.5229 6.47714 22 12 22C17.5229 22 22 17.5229 22 12C22 6.47714 17.5229 2 12 2ZM7.16484 13.5385C6.31653 13.5385 5.62637 12.8483 5.62637 12C5.62637 11.1517 6.31653 10.4615 7.16484 10.4615C8.01314 10.4615 8.7033 11.1517 8.7033 12C8.7033 12.8483 8.01314 13.5385 7.16484 13.5385ZM12 13.5385C11.1517 13.5385 10.4615 12.8483 10.4615 12C10.4615 11.1517 11.1517 10.4615 12 10.4615C12.8483 10.4615 13.5385 11.1517 13.5385 12C13.5385 12.8483 12.8483 13.5385 12 13.5385ZM16.8352 13.5385C15.9869 13.5385 15.2967 12.8483 15.2967 12C15.2967 11.1517 15.9869 10.4615 16.8352 10.4615C17.6835 10.4615 18.3736 11.1517 18.3736 12C18.3736 12.8483 17.6835 13.5385 16.8352 13.5385Z"
														fill="#E4E6EF" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
									</span>

								</div>
							</div>
							<!--end::Primary menu-->
						</div>
						<!--end::Nav-->
						<!--begin::Footer-->
						<div
							class="aside-footer d-flex flex-column align-items-center flex-column-auto"
							id="kt_aside_footer">
							<!--begin::Menu-->
							<div class="mb-7">
								<button type="button"
									class="btn btm-sm btn-icon btn-color-gray-400 btn-active-color-primary btn-active-light"
									data-kt-menu-trigger="click" data-kt-menu-overflow="true"
									data-kt-menu-placement="top-start" data-kt-menu-flip="top-end"
									data-bs-toggle="tooltip" data-bs-placement="right"
									data-bs-dismiss="click" title="Quick actions">
									<!--begin::Svg Icon | path: icons/duotone/Communication/Dial-numbers.svg-->
									<span class="svg-icon svg-icon-2 svg-icon-lg-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
											viewBox="0 0 24 24" version="1.1">
											<rect fill="#000000" opacity="0.3" x="4" y="4" width="4" height="4"
												rx="2" />
											<rect fill="#000000" x="4" y="10" width="4" height="4" rx="2" />
											<rect fill="#000000" x="10" y="4" width="4" height="4" rx="2" />
											<rect fill="#000000" x="10" y="10" width="4" height="4" rx="2" />
											<rect fill="#000000" x="16" y="4" width="4" height="4" rx="2" />
											<rect fill="#000000" x="16" y="10" width="4" height="4" rx="2" />
											<rect fill="#000000" x="4" y="16" width="4" height="4" rx="2" />
											<rect fill="#000000" x="10" y="16" width="4" height="4" rx="2" />
											<rect fill="#000000" x="16" y="16" width="4" height="4" rx="2" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</button>

							</div>
							<!--end::Menu-->
						</div>
						<!--end::Footer-->
					</div>
					<!--end::Primary-->
					<!--begin::Action-->
					<!--end::Action-->
				</div>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header" data-kt-sticky="true"
						data-kt-sticky-name="header"
						data-kt-sticky-offset="{default: '200px', lg: '300px'}">
						<!--begin::Container-->
						<div
							class="container-fluid d-flex align-items-stretch justify-content-between"
							id="kt_header_container">
							<!--begin::Page title-->
							<div
								class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0"
								data-kt-swapper="true" data-kt-swapper-mode="prepend"
								data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
								<!--begin::Heading-->
								<h1 class="text-dark fw-bolder my-1 fs-2">Bienvenido
									<small class="text-muted fs-6 fw-normal ms-1"></small></h1>
								<!--end::Heading-->
								<!--begin::Breadcrumb-->
								<ul class="breadcrumb fw-bold fs-base my-1">
									<!-- <li class="breadcrumb-item text-muted">
										<a class="text-muted">Home</a>
									</li> -->
									<!-- <li class="breadcrumb-item text-dark">Dashboard</li> -->
								</ul>
								<!--end::Breadcrumb-->
							</div>
							<!--end::Page title=-->
							<!--begin::Wrapper-->
							<div class="d-flex d-lg-none align-items-center ms-n2 me-2">
								<!--begin::Aside mobile toggle-->
								<div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
									<!--begin::Svg Icon | path: icons/duotone/Text/Menu.svg-->
									<span class="svg-icon svg-icon-2x">
										<svg xmlns="http://www.w3.org/2000/svg"
											xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
											viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
												<path
													d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
													fill="#000000" opacity="0.3" />
											</g>
										</svg>
									</span>
									<!--end::Svg Icon-->
								</div>
								<!--end::Aside mobile toggle-->
								<!--begin::Logo-->
								<a class="d-flex align-items-center">
								</a>
								<!--end::Logo-->
							</div>
							<!--end::Wrapper-->
							<!--begin::Toolbar wrapper-->
							<div class="d-flex align-items-stretch flex-shrink-0">
								<!--begin::Search-->
								<div class="d-flex align-items-stretch ms-1 ms-lg-3">
									<!--begin::Search-->
									<div id="kt_header_search" class="d-flex align-items-stretch"
										data-kt-search-keypress="true" data-kt-search-min-length="2"
										data-kt-search-enter="enter" data-kt-search-layout="menu"
										data-kt-menu-trigger="auto" data-kt-menu-overflow="false"
										data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end"
										data-kt-menu-flip="bottom">

										<!--begin::Menu-->
										<div data-kt-search-element="content"
											class="menu menu-sub menu-sub-dropdown p-7 w-325px w-md-375px">
											<!--begin::Wrapper-->
											<div data-kt-search-element="wrapper">
												<!--begin::Form-->
												<form data-kt-search-element="form"
													class="w-100 position-relative mb-3" autocomplete="off">
													<!--begin::Icon-->
													<!--begin::Svg Icon | path: icons/duotone/General/Search.svg-->
													<span
														class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 translate-middle-y ms-0">
														<svg xmlns="http://www.w3.org/2000/svg"
															xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
															height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none"
																fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24" />
																<path
																	d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
																	fill="#000000" fill-rule="nonzero" opacity="0.3" />
																<path
																	d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
																	fill="#000000" fill-rule="nonzero" />
															</g>
														</svg>
													</span>
													<!--end::Svg Icon-->
													<!--end::Icon-->
													<!--begin::Input-->
													<input type="text" class="form-control form-control-flush ps-10"
														name="search" value placeholder="Search..."
														data-kt-search-element="input" />
													<!--end::Input-->
													<!--begin::Spinner-->
													<span
														class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-1"
														data-kt-search-element="spinner">
														<span
															class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
													</span>
													<!--end::Spinner-->

												</form>
												<!--end::Form-->
												<!--begin::Separator-->
												<div class="separator border-gray-200 mb-6"></div>
												<!--end::Separator-->

												<!--begin::Recently viewed-->
												<div class="mb-4" data-kt-search-element="main">
													<!--begin::Heading-->
													<div class="d-flex flex-stack fw-bold mb-4">
														<!--begin::Label-->
														<span class="text-muted fs-6 me-2">Recently Searched:</span>
														<!--end::Label-->
													</div>
													<!--end::Heading-->
													<!--begin::Items-->
													<div class="scroll-y mh-200px mh-lg-325px">
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<!--begin::Symbol-->
															<div class="symbol symbol-40px me-4">
																<span class="symbol-label bg-light">
																	<!--begin::Svg Icon | path: icons/duotone/Interface/Monitor.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																			viewBox="0 0 24 24" fill="none">
																			<g opacity="0.25">
																				<path
																					d="M2 15C2 16.6569 3.34315 18 5 18L19 18C20.6569 18 22 16.6569 22 15V5C22 3.34315 20.6569 2 19 2H5C3.34315 2 2 3.34315 2 5V15Z"
																					fill="#12131A" />
																				<path
																					d="M8 20C7.44772 20 7 20.4477 7 21C7 21.5523 7.44772 22 8 22H16C16.5523 22 17 21.5523 17 21C17 20.4477 16.5523 20 16 20H8Z"
																					fill="#12131A" />
																			</g>
																			<path
																				d="M7 6C6.44772 6 6 6.44772 6 7C6 7.55228 6.44772 8 7 8H14C14.5523 8 15 7.55228 15 7C15 6.44772 14.5523 6 14 6H7Z"
																				fill="#12131A" />
																			<path
																				d="M7 10C6.44772 10 6 10.4477 6 11C6 11.5523 6.44772 12 7 12H9C9.55229 12 10 11.5523 10 11C10 10.4477 9.55229 10 9 10H7Z"
																				fill="#12131A" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="d-flex flex-column">
																<a class="fs-6 text-gray-800 text-hover-primary fw-bold">BoomApp
																	by Keenthemes</a>
																<span class="fs-7 text-muted fw-bold">#45789</span>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<!--begin::Symbol-->
															<div class="symbol symbol-40px me-4">
																<span class="symbol-label bg-light">
																	<!--begin::Svg Icon | path: icons/duotone/Interface/Scatter-Up.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																			viewBox="0 0 24 24" fill="none">
																			<g opacity="0.25">
																				<path
																					d="M20 13C20.5523 13 21 12.5523 21 12C21 11.4477 20.5523 11 20 11C19.4477 11 19 11.4477 19 12C19 12.5523 19.4477 13 20 13Z"
																					fill="#12131A" />
																				<path
																					d="M20 17C20.5523 17 21 16.5523 21 16C21 15.4477 20.5523 15 20 15C19.4477 15 19 15.4477 19 16C19 16.5523 19.4477 17 20 17Z"
																					fill="#12131A" />
																				<path
																					d="M20 21C20.5523 21 21 20.5523 21 20C21 19.4477 20.5523 19 20 19C19.4477 19 19 19.4477 19 20C19 20.5523 19.4477 21 20 21Z"
																					fill="#12131A" />
																				<path
																					d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z"
																					fill="#12131A" />
																				<path
																					d="M12 21C12.5523 21 13 20.5523 13 20C13 19.4477 12.5523 19 12 19C11.4477 19 11 19.4477 11 20C11 20.5523 11.4477 21 12 21Z"
																					fill="#12131A" />
																				<path
																					d="M4 21C4.55228 21 5 20.5523 5 20C5 19.4477 4.55228 19 4 19C3.44772 19 3 19.4477 3 20C3 20.5523 3.44772 21 4 21Z"
																					fill="#12131A" />
																			</g>
																			<path
																				d="M17 6C17 7.65685 18.3431 9 20 9C21.6569 9 23 7.65685 23 6C23 4.34315 21.6569 3 20 3C18.3431 3 17 4.34315 17 6Z"
																				fill="#12131A" />
																			<path
																				d="M9 10C9 11.6569 10.3431 13 12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10Z"
																				fill="#12131A" />
																			<path
																				d="M4 17C2.34315 17 1 15.6569 1 14C1 12.3431 2.34315 11 4 11C5.65685 11 7 12.3431 7 14C7 15.6569 5.65685 17 4 17Z"
																				fill="#12131A" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="d-flex flex-column">
																<a class="fs-6 text-gray-800 text-hover-primary fw-bold">"Kept
																	API Project Meeting</a>
																<span class="fs-7 text-muted fw-bold">#84050</span>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<!--begin::Symbol-->
															<div class="symbol symbol-40px me-4">
																<span class="symbol-label bg-light">
																	<!--begin::Svg Icon | path: icons/duotone/Interface/Doughnut.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																			viewBox="0 0 24 24" fill="none">
																			<path opacity="0.25" fill-rule="evenodd" clip-rule="evenodd"
																				d="M11 4.25769C11 3.07501 9.9663 2.13515 8.84397 2.50814C4.86766 3.82961 2 7.57987 2 11.9999C2 13.6101 2.38057 15.1314 3.05667 16.4788C3.58731 17.5363 4.98303 17.6028 5.81966 16.7662L5.91302 16.6728C6.60358 15.9823 6.65613 14.9011 6.3341 13.9791C6.11766 13.3594 6 12.6934 6 11.9999C6 9.62064 7.38488 7.56483 9.39252 6.59458C10.2721 6.16952 11 5.36732 11 4.39046V4.25769ZM16.4787 20.9434C17.5362 20.4127 17.6027 19.017 16.7661 18.1804L16.6727 18.087C15.9822 17.3964 14.901 17.3439 13.979 17.6659C13.3594 17.8823 12.6934 17.9999 12 17.9999C11.3066 17.9999 10.6406 17.8823 10.021 17.6659C9.09899 17.3439 8.01784 17.3964 7.3273 18.087L7.23392 18.1804C6.39728 19.017 6.4638 20.4127 7.52133 20.9434C8.86866 21.6194 10.3899 21.9999 12 21.9999C13.6101 21.9999 15.1313 21.6194 16.4787 20.9434Z"
																				fill="#12131A" />
																			<path fill-rule="evenodd" clip-rule="evenodd"
																				d="M13 4.39046C13 5.36732 13.7279 6.16952 14.6075 6.59458C16.6151 7.56483 18 9.62064 18 11.9999C18 12.6934 17.8823 13.3594 17.6659 13.9791C17.3439 14.9011 17.3964 15.9823 18.087 16.6728L18.1803 16.7662C19.017 17.6028 20.4127 17.5363 20.9433 16.4788C21.6194 15.1314 22 13.6101 22 11.9999C22 7.57987 19.1323 3.82961 15.156 2.50814C14.0337 2.13515 13 3.07501 13 4.25769V4.39046Z"
																				fill="#12131A" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="d-flex flex-column">
																<a class="fs-6 text-gray-800 text-hover-primary fw-bold">"KPI
																	Monitoring App Launch</a>
																<span class="fs-7 text-muted fw-bold">#84250</span>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<!--begin::Symbol-->
															<div class="symbol symbol-40px me-4">
																<span class="symbol-label bg-light">
																	<!--begin::Svg Icon | path: icons/duotone/Interface/Stacked-Area-Down.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																			viewBox="0 0 24 24" fill="none">
																			<path opacity="0.25"
																				d="M2 13.8857C2 13.1875 2.69737 12.7042 3.35112 12.9493L8.14677 14.7477C8.64016 14.9327 9.17357 14.9845 9.69334 14.8979L14.6354 14.0742C14.8087 14.0453 14.9865 14.0626 15.151 14.1243L21.3511 16.4493C21.7414 16.5957 22 16.9688 22 17.3857V20C22 21.1046 21.1046 22 20 22H4C2.89543 22 2 21.1046 2 20V13.8857Z"
																				fill="#12131A" />
																			<path
																				d="M2 4.13517C2 2.4395 3.97771 1.51318 5.28037 2.59873L8.93565 5.64479C9.1593 5.83117 9.45306 5.91083 9.74023 5.86296L14.0555 5.14376C14.8073 5.01846 15.5786 5.18401 16.2128 5.60679L20.6641 8.57435C21.4987 9.13074 22 10.0674 22 11.0705V13.1138C22 13.812 21.3026 14.2953 20.6489 14.0501L15.8532 12.2518C15.3598 12.0667 14.8264 12.0149 14.3067 12.1016L9.36454 12.9253C9.19129 12.9541 9.01348 12.9369 8.84902 12.8752L2.64888 10.5501C2.25857 10.4038 2 10.0307 2 9.61381V4.13517Z"
																				fill="#12131A" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="d-flex flex-column">
																<a class="fs-6 text-gray-800 text-hover-primary fw-bold">Project
																	Reference FAQ</a>
																<span class="fs-7 text-muted fw-bold">#67945</span>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<!--begin::Symbol-->
															<div class="symbol symbol-40px me-4">
																<span class="symbol-label bg-light">
																	<!--begin::Svg Icon | path: icons/duotone/Interface/Envelope.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																			viewBox="0 0 24 24" fill="none">
																			<path opacity="0.25"
																				d="M1 6C1 4.34315 2.34315 3 4 3H20C21.6569 3 23 4.34315 23 6V18C23 19.6569 21.6569 21 20 21H4C2.34315 21 1 19.6569 1 18V6Z"
																				fill="#191213" />
																			<path fill-rule="evenodd" clip-rule="evenodd"
																				d="M5.23177 7.35984C5.58534 6.93556 6.2159 6.87824 6.64018 7.2318L11.3598 11.1648C11.7307 11.4739 12.2693 11.4739 12.6402 11.1648L17.3598 7.2318C17.7841 6.87824 18.4147 6.93556 18.7682 7.35984C19.1218 7.78412 19.0645 8.41468 18.6402 8.76825L13.9205 12.7013C12.808 13.6284 11.192 13.6284 10.0794 12.7013L5.35981 8.76825C4.93553 8.41468 4.87821 7.78412 5.23177 7.35984Z"
																				fill="#121319" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="d-flex flex-column">
																<a class="fs-6 text-gray-800 text-hover-primary fw-bold">"FitPro
																	App Development</a>
																<span class="fs-7 text-muted fw-bold">#84250</span>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<!--begin::Symbol-->
															<div class="symbol symbol-40px me-4">
																<span class="symbol-label bg-light">
																	<!--begin::Svg Icon | path: icons/duotone/Interface/Bank.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																			viewBox="0 0 24 24" fill="none">
																			<path opacity="0.25"
																				d="M4 10H8V17H10V10H14V17H16V10H20V17C21.1046 17 22 17.8954 22 19V20C22 21.1046 21.1046 22 20 22H4C2.89543 22 2 21.1046 2 20V19C2 17.8954 2.89543 17 4 17V10Z"
																				fill="#12131A" />
																			<path
																				d="M2 7.35405C2 6.53624 2.4979 5.80083 3.25722 5.4971L11.2572 2.2971C11.734 2.10637 12.266 2.10637 12.7428 2.2971L20.7428 5.4971C21.5021 5.80083 22 6.53624 22 7.35405V7.99999C22 9.10456 21.1046 9.99999 20 9.99999H4C2.89543 9.99999 2 9.10456 2 7.99999V7.35405Z"
																				fill="#12131A" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="d-flex flex-column">
																<a class="fs-6 text-gray-800 text-hover-primary fw-bold">Shopix
																	Mobile App</a>
																<span class="fs-7 text-muted fw-bold">#45690</span>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-5">
															<!--begin::Symbol-->
															<div class="symbol symbol-40px me-4">
																<span class="symbol-label bg-light">
																	<!--begin::Svg Icon | path: icons/duotone/Interface/Line-03-Up.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																			viewBox="0 0 24 24" fill="none">
																			<path opacity="0.25"
																				d="M1 5C1 3.89543 1.89543 3 3 3H21C22.1046 3 23 3.89543 23 5V19C23 20.1046 22.1046 21 21 21H3C1.89543 21 1 20.1046 1 19V5Z"
																				fill="#12131A" />
																			<path fill-rule="evenodd" clip-rule="evenodd"
																				d="M20.8682 6.49631C21.1422 6.01679 20.9756 5.40594 20.4961 5.13193C20.0166 4.85792 19.4058 5.02451 19.1317 5.50403L15.8834 11.1886C15.6612 11.5775 15.2073 11.7712 14.7727 11.6626L9.71238 10.3975C8.40847 10.0715 7.04688 10.6526 6.38005 11.8195L3.13174 17.504C2.85773 17.9835 3.02433 18.5944 3.50385 18.8684C3.98337 19.1424 4.59422 18.9758 4.86823 18.4963L8.11653 12.8118C8.33881 12.4228 8.79268 12.2291 9.22731 12.3378L14.2876 13.6028C15.5915 13.9288 16.9531 13.3478 17.6199 12.1808L20.8682 6.49631Z"
																				fill="#12131A" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="d-flex flex-column">
																<a
																	class="fs-6 text-gray-800 text-hover-primary fw-bold">"Landing UI Design"
																	Launch</a>
																<span class="fs-7 text-muted fw-bold">#24005</span>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Item-->
													</div>
													<!--end::Items-->
												</div>
												<!--end::Recently viewed-->
												<!--begin::Empty-->
												<div data-kt-search-element="empty" class="text-center d-none">
													<!--begin::Icon-->
													<div class="pt-10 pb-10">
														<!--begin::Svg Icon | path: icons/duotone/Interface/File-Search.svg-->
														<span class="svg-icon svg-icon-4x opacity-50">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
																viewBox="0 0 24 24" fill="none">
																<path opacity="0.25"
																	d="M3 4C3 2.34315 4.34315 1 6 1H15.7574C16.553 1 17.3161 1.31607 17.8787 1.87868L20.1213 4.12132C20.6839 4.68393 21 5.44699 21 6.24264V20C21 21.6569 19.6569 23 18 23H6C4.34315 23 3 21.6569 3 20V4Z"
																	fill="#12131A" />
																<path
																	d="M15 1.89181C15 1.39927 15.3993 1 15.8918 1V1C16.6014 1 17.2819 1.28187 17.7836 1.78361L20.2164 4.21639C20.7181 4.71813 21 5.39863 21 6.10819V6.10819C21 6.60073 20.6007 7 20.1082 7H16C15.4477 7 15 6.55228 15 6V1.89181Z"
																	fill="#12131A" />
																<path fill-rule="evenodd" clip-rule="evenodd"
																	d="M13.032 15.4462C12.4365 15.7981 11.7418 16 11 16C8.79086 16 7 14.2091 7 12C7 9.79086 8.79086 8 11 8C13.2091 8 15 9.79086 15 12C15 12.7418 14.7981 13.4365 14.4462 14.032L16.7072 16.293C17.0977 16.6835 17.0977 17.3167 16.7072 17.7072C16.3167 18.0977 15.6835 18.0977 15.293 17.7072L13.032 15.4462ZM13 12C13 13.1046 12.1046 14 11 14C9.89543 14 9 13.1046 9 12C9 10.8954 9.89543 10 11 10C12.1046 10 13 10.8954 13 12Z"
																	fill="#12131A" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</div>
													<!--end::Icon-->
													<!--begin::Message-->
													<div class="pb-15 fw-bold">
														<h3 class="text-gray-600 fs-5 mb-2">No result found</h3>
														<div class="text-muted fs-7">Please try again with a different
															query</div>
													</div>
													<!--end::Message-->
												</div>
												<!--end::Empty-->
											</div>
											<!--end::Wrapper-->

										</div>
										<!--end::Menu-->
									</div>
									<!--end::Search-->
								</div>

								<!--begin::Notifications-->
								<div class="d-flex align-items-center ms-1 ms-lg-3">
									<!--begin::Menu wrapper-->
									<!-- <div class="btn btn-icon btn-active-light-primary position-relative w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
											<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
												<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
											</svg>
										</span>
									</div> -->
									<!--begin::Menu-->
									<div
										class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px"
										data-kt-menu="true">
										<!--begin::Heading-->
										<div class="d-flex flex-column bgi-no-repeat rounded-top">
											<!--begin::Title-->
											<h3 class="text-white fw-bold px-9 mt-10 mb-6">Notifications
												<span class="fs-8 opacity-75 ps-3">24 reports</span></h3>
											<!--end::Title-->
											<!--begin::Tabs-->
											<ul
												class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
												<li class="nav-item">
													<a
														class="nav-link text-white opacity-75 opacity-state-100 pb-4 active"
														data-bs-toggle="tab">Alerts</a>
												</li>
												<li class="nav-item">
													<a class="nav-link text-white opacity-75 opacity-state-100 pb-4"
														data-bs-toggle="tab">Updates</a>
												</li>
												<li class="nav-item">
													<a class="nav-link text-white opacity-75 opacity-state-100 pb-4"
														data-bs-toggle="tab">Logs</a>
												</li>
											</ul>
											<!--end::Tabs-->
										</div>
										<!--end::Heading-->
										<!--begin::Tab content-->
										<div class="tab-content">
											<!--begin::Tab panel-->
											<div class="tab-pane fade show active" id="kt_topbar_notifications_1"
												role="tabpanel">
												<!--begin::Items-->
												<div class="scroll-y mh-325px my-5 px-8">
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-primary">
																	<!--begin::Svg Icon | path: icons/duotone/Clothes/Crown.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24px"
																			height="24px" viewBox="0 0 24 24" version="1.1">
																			<path
																				d="M11.2600599,5.81393408 L2,16 L22,16 L12.7399401,5.81393408 C12.3684331,5.40527646 11.7359848,5.37515988 11.3273272,5.7466668 C11.3038503,5.7680094 11.2814025,5.79045722 11.2600599,5.81393408 Z"
																				fill="#000000" opacity="0.3" />
																			<path
																				d="M12.0056789,15.7116802 L20.2805786,6.85290308 C20.6575758,6.44930487 21.2903735,6.42774054 21.6939717,6.8047378 C21.8964274,6.9938498 22.0113578,7.25847607 22.0113578,7.535517 L22.0113578,20 L16.0113578,20 L2,20 L2,7.535517 C2,7.25847607 2.11493033,6.9938498 2.31738608,6.8047378 C2.72098429,6.42774054 3.35378194,6.44930487 3.7307792,6.85290308 L12.0056789,15.7116802 Z"
																				fill="#000000" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a
																	class="fs-6 text-gray-800 text-hover-primary fw-bolder">Project
																	Alice</a>
																<div class="text-gray-400 fs-7">Phase 1 development</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">1 hr</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-danger">
																	<!--begin::Svg Icon | path: icons/duotone/Code/Warning-2.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-danger">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24px"
																			height="24px" viewBox="0 0 24 24" version="1.1">
																			<path
																				d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z"
																				fill="#000000" opacity="0.3" />
																			<rect fill="#000000" x="11" y="9" width="2" height="7"
																				rx="1" />
																			<rect fill="#000000" x="11" y="17" width="2" height="2"
																				rx="1" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a class="fs-6 text-gray-800 text-hover-primary fw-bolder">HR
																	Confidential</a>
																<div class="text-gray-400 fs-7">Confidential staff
																	documents</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">2 hrs</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-warning">
																	<!--begin::Svg Icon | path: icons/duotone/Communication/Group.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-warning">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24px"
																			height="24px" viewBox="0 0 24 24" version="1.1">
																			<path
																				d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
																				fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<path
																				d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
																				fill="#000000" fill-rule="nonzero" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a
																	class="fs-6 text-gray-800 text-hover-primary fw-bolder">Company
																	HR</a>
																<div class="text-gray-400 fs-7">Corporeate staff profiles</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">5 hrs</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-success">
																	<!--begin::Svg Icon | path: icons/duotone/General/Thunder.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-success">
																		<svg xmlns="http://www.w3.org/2000/svg"
																			xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
																			height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none"
																				fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24" />
																				<path
																					d="M12.3740377,19.9389434 L18.2226499,11.1660251 C18.4524142,10.8213786 18.3592838,10.3557266 18.0146373,10.1259623 C17.8914367,10.0438285 17.7466809,10 17.5986122,10 L13,10 L13,4.47708173 C13,4.06286817 12.6642136,3.72708173 12.25,3.72708173 C11.9992351,3.72708173 11.7650616,3.85240758 11.6259623,4.06105658 L5.7773501,12.8339749 C5.54758575,13.1786214 5.64071616,13.6442734 5.98536267,13.8740377 C6.10856331,13.9561715 6.25331908,14 6.40138782,14 L11,14 L11,19.5229183 C11,19.9371318 11.3357864,20.2729183 11.75,20.2729183 C12.0007649,20.2729183 12.2349384,20.1475924 12.3740377,19.9389434 Z"
																					fill="#000000" />
																			</g>
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a
																	class="fs-6 text-gray-800 text-hover-primary fw-bolder">Project
																	Jet</a>
																<div class="text-gray-400 fs-7">New frontend admin theme</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">2 days</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-primary">
																	<!--begin::Svg Icon | path: icons/duotone/Communication/Flag.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-primary">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24px"
																			height="24px" viewBox="0 0 24 24" version="1.1">
																			<path
																				d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z"
																				fill="#000000" />
																			<path
																				d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z"
																				fill="#000000" opacity="0.3" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a
																	class="fs-6 text-gray-800 text-hover-primary fw-bolder">Project
																	Breafing</a>
																<div class="text-gray-400 fs-7">Product launch status
																	update</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">21 Jan</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-info">
																	<!--begin::Svg Icon | path: icons/duotone/Design/Image.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-info">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24px"
																			height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none"
																				fill-rule="evenodd">
																				<polygon points="0 0 24 0 24 24 0 24" />
																				<path
																					d="M6,5 L18,5 C19.6568542,5 21,6.34314575 21,8 L21,17 C21,18.6568542 19.6568542,20 18,20 L6,20 C4.34314575,20 3,18.6568542 3,17 L3,8 C3,6.34314575 4.34314575,5 6,5 Z M5,17 L14,17 L9.5,11 L5,17 Z M16,14 C17.6568542,14 19,12.6568542 19,11 C19,9.34314575 17.6568542,8 16,8 C14.3431458,8 13,9.34314575 13,11 C13,12.6568542 14.3431458,14 16,14 Z"
																					fill="#000000" />
																			</g>
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a
																	class="fs-6 text-gray-800 text-hover-primary fw-bolder">Banner
																	Assets</a>
																<div class="text-gray-400 fs-7">Collection of banner
																	images</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">21 Jan</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-warning">
																	<!--begin::Svg Icon | path: icons/duotone/Design/Component.svg-->
																	<span class="svg-icon svg-icon-2 svg-icon-warning">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24px"
																			height="24px" viewBox="0 0 24 24" version="1.1">
																			<path
																				d="M12.7442084,3.27882877 L19.2473374,6.9949025 C19.7146999,7.26196679 20.003129,7.75898194 20.003129,8.29726722 L20.003129,15.7027328 C20.003129,16.2410181 19.7146999,16.7380332 19.2473374,17.0050975 L12.7442084,20.7211712 C12.2830594,20.9846849 11.7169406,20.9846849 11.2557916,20.7211712 L4.75266256,17.0050975 C4.28530007,16.7380332 3.99687097,16.2410181 3.99687097,15.7027328 L3.99687097,8.29726722 C3.99687097,7.75898194 4.28530007,7.26196679 4.75266256,6.9949025 L11.2557916,3.27882877 C11.7169406,3.01531506 12.2830594,3.01531506 12.7442084,3.27882877 Z M12,14.5 C13.3807119,14.5 14.5,13.3807119 14.5,12 C14.5,10.6192881 13.3807119,9.5 12,9.5 C10.6192881,9.5 9.5,10.6192881 9.5,12 C9.5,13.3807119 10.6192881,14.5 12,14.5 Z"
																				fill="#000000" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a class="fs-6 text-gray-800 text-hover-primary fw-bolder">Icon
																	Assets</a>
																<div class="text-gray-400 fs-7">Collection of SVG icons</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">20 March</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
												</div>
												<!--end::Items-->
												<!--begin::View more-->
												<div class="py-3 text-center border-top">
													<a class="btn btn-color-gray-600 btn-active-color-primary">View All
														<!--begin::Svg Icon | path: icons/duotone/Navigation/Right-2.svg-->
														<span class="svg-icon svg-icon-5">
															<svg xmlns="http://www.w3.org/2000/svg"
																xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
																height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none"
																	fill-rule="evenodd">
																	<polygon points="0 0 24 0 24 24 0 24" />
																	<rect fill="#000000" opacity="0.5"
																		transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)"
																		x="7.5" y="7.5" width="2" height="9" rx="1" />
																	<path
																		d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
																		fill="#000000" fill-rule="nonzero"
																		transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
																</g>
															</svg>
														</span>
														<!--end::Svg Icon--></a>
												</div>
												<!--end::View more-->
											</div>
											<!--end::Tab panel-->
											<!--begin::Tab panel-->
											<div class="tab-pane fade" id="kt_topbar_notifications_2"
												role="tabpanel">
												<!--begin::Wrapper-->
												<div class="d-flex flex-column px-9">
													<!--begin::Section-->
													<div class="pt-10 pb-0">
														<!--begin::Title-->
														<h3 class="text-dark text-center fw-bolder">Get Pro Access</h3>
														<!--end::Title-->
														<!--begin::Text-->
														<div class="text-center text-gray-600 fw-bold pt-1">Outlines keep
															you honest. They stoping you from amazing poorly about
															drive</div>
														<!--end::Text-->
														<!--begin::Action-->
														<div class="text-center mt-5 mb-9">
															<a class="btn btn-sm btn-primary px-6" data-bs-toggle="modal"
																data-bs-target="#kt_modal_create_app">Join Now</a>
														</div>
														<!--end::Action-->
													</div>
													<!--end::Section-->
													<!--begin::Illustration-->
													<div class="text-center mb-5 px-4">
													</div>
													<!--end::Illustration-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Tab panel-->
											<!--begin::Tab panel-->
											<div class="tab-pane fade" id="kt_topbar_notifications_3"
												role="tabpanel">
												<!--begin::Items-->
												<div class="scroll-y mh-325px my-5 px-8">
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-success me-4">200 OK</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a class="text-gray-800 text-hover-primary fw-bold">New order</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Just now</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-danger me-4">500 ERR</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a class="text-gray-800 text-hover-primary fw-bold">New
																customer</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">2 hrs</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-success me-4">200 OK</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a class="text-gray-800 text-hover-primary fw-bold">Payment
																process</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">5 hrs</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-warning me-4">300
																WRN</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a class="text-gray-800 text-hover-primary fw-bold">Search
																query</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">2 days</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-success me-4">200 OK</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a class="text-gray-800 text-hover-primary fw-bold">API
																connection</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">1 week</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-success me-4">200 OK</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a class="text-gray-800 text-hover-primary fw-bold">Database
																restore</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Mar 5</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-warning me-4">300
																WRN</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a class="text-gray-800 text-hover-primary fw-bold">System
																update</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">May 15</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-warning me-4">300
																WRN</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a class="text-gray-800 text-hover-primary fw-bold">Server OS
																update</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Apr 3</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-warning me-4">300
																WRN</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a class="text-gray-800 text-hover-primary fw-bold">API
																rollback</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Jun 30</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-danger me-4">500 ERR</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a class="text-gray-800 text-hover-primary fw-bold">Refund
																process</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Jul 10</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-danger me-4">500 ERR</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a class="text-gray-800 text-hover-primary fw-bold">Withdrawal
																process</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Sep 10</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-danger me-4">500 ERR</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a class="text-gray-800 text-hover-primary fw-bold">Mail
																tasks</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Dec 10</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
												</div>
												<!--end::Items-->
												<!--begin::View more-->
												<div class="py-3 text-center border-top">
													<a class="btn btn-color-gray-600 btn-active-color-primary">View All
														<!--begin::Svg Icon | path: icons/duotone/Navigation/Right-2.svg-->
														<span class="svg-icon svg-icon-5">
															<svg xmlns="http://www.w3.org/2000/svg"
																xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
																height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none"
																	fill-rule="evenodd">
																	<polygon points="0 0 24 0 24 24 0 24" />
																	<rect fill="#000000" opacity="0.5"
																		transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)"
																		x="7.5" y="7.5" width="2" height="9" rx="1" />
																	<path
																		d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
																		fill="#000000" fill-rule="nonzero"
																		transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
																</g>
															</svg>
														</span>
														<!--end::Svg Icon--></a>
												</div>
												<!--end::View more-->
											</div>
											<!--end::Tab panel-->
										</div>
										<!--end::Tab content-->
									</div>
									<!--end::Menu-->
									<!--end::Menu wrapper-->
								</div>
								<!--end::Notifications-->
								<!--begin::User-->
								<div class="d-flex align-items-center ms-1 ms-lg-3"
									id="kt_header_user_menu_toggle">
									<!--begin::Menu wrapper-->
									<div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
										{{ image("images/fotos/perfil.jpg", "alt":"Logo usuario") }}

									</div>
									<!--begin::Menu-->
									<div
										class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold py-4 fs-6 w-275px"
										data-kt-menu="true">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<!--begin::Avatar-->
												<div class="symbol symbol-50px me-5">
												{{ image("images/fotos/perfil.jpg", "alt":"Logo usuario") }}
												</div>
												<!--end::Avatar-->
												<!--begin::Username-->
												<div class="d-flex flex-column">
													<div class="fw-bolder d-flex align-items-center fs-5">{{ nombreadmin }}
                 
														<span
															class="badge badge-light-info fw-bolder fs-8 px-2 py-1 ms-2">{{rol}}</span></div>
													<a class="fw-bold text-muted text-hover-primary fs-7"></a>
												</div>
												<!--end::Username-->
											</div>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
									
										<!--end::Menu item-->
			
									
								
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
									
										<!--begin::Menu item-->
										<div class="menu-item px-5 my-1">
											{% if gmenu==2 %}
											<li>{{link_To(['empresa/perfil',"class":"menu-link px-5",'Perfil'])}}</li>
											{% else %}
											<li>{{link_To(['usuario/perfil',"class":"menu-link px-5",'Perfil'])}}</li>
											{% endif %}
										</div>
										
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a class="menu-link px-5">
									
													{{ link_To(['session/end',"class":"menu-link px-5",'
													<i class="fa fa-sign-out pull-right"></i> Cerrar Sesión']) }}
												  
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::Menu-->
									<!--end::Menu wrapper-->
								</div>
								<!--end::User -->
							</div>
							<!--end::Toolbar wrapper-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-column flex-md-row flex-stack">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">

								<a href="#"
								class="text-gray-400 fw-bold me-1">© 2019 SIPS v.1 -
								2019</a>
							</div>
							<!--end::Copyright-->

						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--begin::Drawers-->

		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotone/Navigation/Up-2.svg-->
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg"
					xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
					viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.5" x="11" y="10" width="2" height="10"
							rx="1" />
						<path
							d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
							fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
	<!-- JS INICIO -->
	{# 	 #}
	{{ javascript_include('jet/recursos/plugins/global/plugins.bundle.js')}}
	{{ javascript_include('jet/recursos/js/scripts.bundle.js') }}
	{{javascript_include('jet/recursos/plugins/custom/prismjs/prismjs.bundle.js')}}
	{{javascript_include('jet/recursos/js/custom/documentation/documentation.js')}}


	<!-- JS FIN -->	

	
	</body>
</html>