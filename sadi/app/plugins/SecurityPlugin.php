<?php

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

/**
 * SecurityPlugin
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class SecurityPlugin extends Plugin
{
	/**
	 * Returns an existing or new access control list
	 *
	 * @returns AclList
	 */
	public function getAcl()
	{
		if (!isset($this->persistent->acl)) {

			$acl = new AclList();

			$acl->setDefaultAction(Acl::DENY);

			//Register roles
			$roles = array(
				'guests' => new Role('Guests'),	
				'autoestudios' => new Role('Autoestudios'),
				'cliente' => new Role('Cliente'),

				'users' => new Role('Users'),
				'companies' => new Role('Companies')
				

			);
			foreach ($roles as $role) {
				$acl->addRole($role);
			}

			

			//Public area resources
			$publicResources = array(
				'index'     => array('index'),
				'session'   => array('start','end','start_aes','end_aes','start_cliente','end_cliente'),
				'soporte'	=> array('verificasesion'),
				'prueba1'	=> array('index'),
				'archivo'	=> array('prueba'),
				'consulta'	=> array('validaqr'),
				'apnubarcons'	=> array('apnubarimsscons'),
				'autoestudio'=>array('index'),
				'cliente'=>array('index'),

				
			);
			foreach ($publicResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}

			//Users area resources

			
			$usersResources = array(
				'estado'		=> array('index','tabla','nuevo','buseditar','editar','eliminar','ajax_estados','ajax_get_uno'),
				'municipio'		=> array('index','tabla','nuevo','buseditar','editar','eliminar','ajax_municipios'),
				'index'			=> array('index','panel','menu'),
				'menu'			=> array('tab','nuevo'),
				'rol'			=> array('index','tabla','nuevo','editar','eliminar','permiso','ajax_roles'),
				'usuario'		=> array('index','tabla','perfil','editarperfil','editarpassword','guardarperfil','eliminar','cambiarcontraadmin','formulario','nuevo','editar','buseditar','ajax_getinvestigador', 'ajax_getanalista','ajax_get_investigador_transporte','ajax_getanalista_excluir_un_analista','ajax_get_all_investigadores'),
				'bitacora'		=> array('index'),
				'errors'		=> array('errorpermiso'),
				'empresa'		=> array('index','tabla','nuevo','buseditar','editar','eliminar','ajax_empresas','cambiarfoto','ajax_empresa_detalle','ajax_empresas_con_formato'),
				'estudio'		=> array('get_ajax_datos_estudio_empresa_especifico','asignarinvestigador_index','asignarinvestigador_tabla','nuevo','buseditar','editar','eliminar','cancelar','trafico_index','trafico_tabla','reasignarinvestigador','asignaranalista_index','asignaranalista_tabla','alta','ajax_setasignaranalista','nuevo','ajax_setasignarinvestigador','traficoanalista_index','traficoanalista_tabla','ajax_setreasignaranalista','investigadormandarese','autorizacion_index','autorizacion_tabla','autorizarese','noaprobarese','enviaraautorizacion','vercompletoese-modal','detalles','regresar_estatus','resumenanalistatabla','resumeninvestigadortabla','detalleseditarverificacion','editarverificacion','get_ajax_datos_estudio_especifico','detalleseditarsocioeconomico','editarsocioeconomico','detalleseditarsupervivencia','editarsupervivencia','ajax_setasignaranalista_en_trafico_investigador','ajax_get_detalles_analista_asignado','ajax_re_asignaranalista_en_trafico_investigador','ajax_set_sin_analista','ajax_honorario_actualizar','get_ajax_datos_calificacion',"ajax_setreasignarinvestigador"),
				'comentarioese'	=> array('tabla','crear','tabla_resumen','tabla_visualizar'),
				'consulta'		=> array('index','tabla','get_ajax_detalles_ese_uno'),
				'archivo'	=> array('tabla','archivo','eliminar','descargar','eliminar','ajax_get_detalles_archivo','ajax_adjuntar_archivo_reporte','getcurpapi','getPoderJudicial','tabla_truper','ajax_getImagen'),
				'categoria' => array('ajax_categorias','ajax_getinfo'),
				'honorario'		=> array('tabla','ajax_asigtipo','detallestipoestudio','nuevo','eliminar','ajax_get_lista'),
				'tipoestudio' =>array('tabla','index','agregar-modal','guardar','ajax_tiposestudios'),
				'negocio'		=> array('index','tabla','nuevo','buseditar','editar','eliminar','ajax_negocios'),
				'contactoemp'	=> array('tabla','crear','buseditar','editar','tabladetallescontacto','ajax_contactos'),
				'transporte'    =>array('asignados_index','asignados_tabla','ajax_nuevo_comprobar_transporte_investigador','ajax_editar_comprobar_transporte_investigador','comprobar-modal','ajax_solicitar_tranpsorte_investigador','solicitar-modal-js','ajax_subir_archivo_transporte','archivo_tabla','eliminar_evidencia_transporte','archivo-modales-js','aprobar_index','aprobar_tabla','ajax_aprobar','descargar','editar-modal-js','ajax_get_detalle','ajax_asignar_transporte','ajax_asignarautorizado_transporte'),
				'centrocosto'	=> array('tabla','crear','buseditar','editar','ajax_centros'),
				'verificaciones'	=> array('ajax_verificaciones'),
				'reporte'	=> array('estatus_index','estatus_tabla','estatus_consulta','honorario_index','honorario_tabla','enviarhonorario','formatoeses','formatogabtubos','formatoencognv'
									 ,'formatogabsips','formatoargos','formatotruper','formatotruper_ventas','comentarioese_index','comentarioese_tabla'
									 ,'respuesta_estadisticas_servicio_calidad','efectividad_index','efectividad_tabla','reporte_efectividad','transporte_index','transporte_tabla','transporte_autorizado'
									 ,'formatogabtruper',"ese_cancelado_index","ese_cancelado_tabla","ese_cancelado_tabla"),
				'prueba'	=> array('formato_honorario','generar_formato_honorario','revision'),
				'nivelestudio'	=> array('get_ajax_nivelestudios'),
				'estadocivil'	=> array('get_ajax_estadocivil'),
				'datocomprobatorio'	=> array('ajax_set_update','ajax_get_especifico','ajax_set_update_formato_gabtubos','ajax_set_update_formato_gabencognv','ajax_encontrar_o_crear','ajax_set_update_formato_truper'),
				'datogrupofamiliar'=> array('ajax_get_detalle','ajax_set_update','tabla','eliminar_dgd','actualizar_dgd','crear_dgd','crear_automatico_dgf','crear_registro_automatico_otras_tablas','tablagabtubos','actualizar_formato_truper'),
				'datoescolar'	=> array('ajax_get_detalle','guardar','guardar_formato_gabtubos','ajax_get_data_selects_documentorecibidos','guardar_formato_truper'),
				'antecedentesocial'	=> array('ajax_get_detalle','guardar','guardar_formato_truper','ajax_get_detalle_formato_truper'),
				'antecedentegrupofamiliar'	=> array('ajax_get_detalle','crear_automatico_agf','ajax_set_update','tabla_agf','crear_agd'),
				'estadosalud'	=> array('ajax_get_detalle','guardar','ajax_get_detalle_ans_ess_formato_truper','guardar_ess_anss'),
				'antecedentegrupofamiliardetalles' => array('eliminar','actualizar','ajax_get_detalle'),
				'dashboard' => array('index','ajax_estudios_cancelados','ajax_estudios_aprobados','ajax_estudios_alta','ajax_estudios_trafico_investigador','ajax_estudios_trafico_analista','ajax_estudios_transporte_aprobados','ajax_get_total_transporte_aprobados','ajax_get_detalle_general_eses','ajax_get_reporte_alta_aprobado_cancelados_eses','ajax_get_cuenta_estudios','ajax_get_cuenta_alta','ajax_get_cuenta_analista_entregados'),
				'situacioneconomica'=>array('ajax_get_total_ingresos_candidato_formatotruper','ajax_get_total_ingresos_familiar_formatotruper','ajax_get_detalle','ajax_set_update','crear_automatico','ajax_get_detalle_formato_truper','ajax_set_update_formato_truper'),
				'situacioneconomicaingresos'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','ajax_get_total_ingreso_ese','tabla_truper_ingresosfamiliares','tabla_truper_ingresoscandidato','crear_formato_truper','crear_familiar_formato_truper','eliminarIngresoFamiliar','eliminarIngresoCandidato','actualizar_candidato_formato_truper','actualizar_familiar_formato_truper'),
				'situacioneconomicacredito'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle'),
				'bieninmueble'=>array('ajax_get_detalle','ajax_set_update','crear_automatico'),
				'bieninmuebledetalles'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','tabla_truper','crear_formatotruper','actualizar_formatotruper'),
				'seccionpersonal'=>array('ajax_get_detalle','ajax_set_update','crear_automatico','ajax_get_create_detalle'),
				'referenciapersonal'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','tablagabtubos','tabla_truper','crear_formato_truper','actualizar_formato_truper'),
				'referenciavecinal'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','tabla_truper','crear_formato_truper','actualizar_formato_truper'),
				'seccionlaboral'=>array('ajax_get_detalle','ajax_set_update','crear_automatico','ajax_set_update_formato_truper'),
				'referencialaboral'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','tablagabtubos','tablagabtencognv','tabla_truper','crear_formato_truper','actualizar_formato_truper','ajax_set_orden_abajo','ajax_set_orden_arriba'),
				'periodoinactivo'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','tablagabtubos','tablagabencognv','tablagabtubos'),
				'datofinal'	=> array('ajax_get_detalle','guardar','guardar_formatotruper'),
				'incidencia'	=> array('incidenciaformulario','registrarincidencia','reporte_index','reporte_tabla'),
				'datogrupofamiliardetalles'=>array('ajax_get_detalle','viven_tabla_truper','trabajancompania_tabla_truper','negociootrabajoen_tabla_truper','ajax_get_data_selects_estatucscontacto','crear_vivecon_formatotruper','actualizar_vivecon_formatotruper','crear_trabajancompania_formatotruper','actualizar_trabacompania_formatotruper','crear_negociootrabajoen_formatotruper','actualizar_negociootrabajoen_formatotruper','ajax_get_data_ocupacion_formatotruper','ajax_get_data_parentesco_formatotruper'),
				'tipoformato' =>array('ajax_tiposformatos','ajax_tiposformatos_acorde_a_empresa'),
				'automovil'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','ajax_get_data_tipo_auto','tabla_truper','ajax_get_data_tipo_auto_formatotruper'),
				'datospersonalesese'=>array('ajax_set_update_formato_truper'),
				'datovivienda'=>array('ajax_set_update_formato_truper','ajax_crear_automatico','ajax_get_detalle','ajax_get_data_selects_dinamicos'),
				'datoviviendanterdetalles'=>array('ajax_get_detalle','crear_formato_truper','actualizar_formato_truper','tabla_truper','eliminar'),
				'trayectorialaboralregistrado'=>array('ajax_encontrar_crear_detalle','crear_formato_truper','actualizar_formato_truper','tabla_truper'),
				'trayectorialaboralregistradodetalles'=>array('tabla_truper','crear_formato_truper','actualizar_formato_truper','eliminar','ajax_get_detalle','editar_formato_truper'),
				'trayectorialaboral'=>array('tabla_truper','crear_formato_truper','actualizar_formato_truper','ajax_get_detalle','actualizar_formato_truper','eliminar'),
				'evaluaciontruper'=>array('ajax_get_create_detalle','actualizar_formato_truper'),
				'referenciafamiliar'=>array('tabla_truper','actualizar_formato_truper','eliminar','crear_formato_truper','actualizar_formato_truper','ajax_get_detalle'),
				'documento'=>array('archivocurp','archivonacimiento','archivodomicilio','archivoestudios','archivoelector','archivofotografia','archivocaratula','archivofiscal','ajax_getinfo','ajax_documentos'),
				'documentousuario'=>array('tabla','eliminar','descargar','aprobar','desactualizado','archivo','checklist'),
				'correo'=>array('correoese','correotruper'),
				'api' => array('getimssinfo','pruebadescarga','leerjson','pdftoimg'),
				'autoestudio'=>array('ajax_detalle','actualizar'),
				'encuestacalidad'=>array('servicio','ajax_get_textos_opciones_servicio','ajax_set_no_contesto_candidato','reporte','encuestas_tabla','respuestas_tabla','ajax_get_data_respuestas_porcentaje_estadisiticas','index',"verificiar_encuesta_contestada","cambiar_estatus_contestada_encuesta"),
				'pregunta'=>array('ajax_get_textos_preguntas_servicio'),
				'soporte' => array('generarencuesta','transporte_index','transporte_tabla', 'correoprueba','limpiarcachevolt','honorario_pagos_ese','honorario_pagos_ese','estudio_index','estudio_tabla','set_update_gruid_cal_id'),
				'respuesta'=>array('guardar_calidadservicio'),
				'empleooculto'=>array('tabla','eliminar','crear_general','actualizar_general','ajax_get_detalle','tabla_gabencognv','tabla_gabtubos'),
				'cliente' 	=>	array('index','tabla'),
				'empresaformato'=>array('tabla','ajax_detalle','desactivar_activar','ajax_formatos_disponibles_para_empresa','asignar_a_empresa'),
				'cita'=>array('tabla_general','agendar','re_agendar','ajax_get_detalle','agregar_comentario','agenda_index','agenda_tabla','ajax_get_count_registro'),
				'configuracion'=>array('apariencia_index','actualizar_apariencia','obtener_link',"correos_index","actualizar_envio_correo"),
				'helper'=>array("get_encript_id"),
				'investigador'=> array('ajax_getall_cercanos_ruta'),
				'encuestacalidadreporte'=>array("reporte_vdos","encuestas_vdos_tabla","encuestas_vdos_tabla","respuestas_vdos_tabla",'ajax_get_data_respuestas_porcentaje_estadisiticas','respuesta_estadisticas_servicio_calidad_pdf'),
				'calificacionfinalgrupo'=>array('ajax_get_valores_por_grupo',"ajax_get_calificacion_por_id"),
				'tipocatcancelado'=>array('ajax_get_todos'),
				'archivocancelacion'=>array('tabla'),

				
			);
			
			foreach ($usersResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}


			$companiesResources = array(
				'index'        => array('index','panel'),
			);
			foreach ($companiesResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}	


			//URLS para los usuarios de autoestudio
			$autoestudioesResources = array(
				'autoestudio'=>array('eses_principal','enviar_a_trafico_analista_aes','ajax_detalle'),
				'estado'		=> array('ajax_estados','ajax_get_uno'),
				'municipio'		=> array('ajax_municipios'),
				'errors'		=> array('errorpermiso'),
				'empresa'		=> array('ajax_empresas','cambiarfoto','ajax_empresa_detalle'),
				'estudio'		=> array('get_ajax_datos_estudio_empresa_especifico','asignarinvestigador_index','asignarinvestigador_tabla','nuevo','buseditar','editar','eliminar','cancelar','trafico_index','trafico_tabla','reasignarinvestigador','asignaranalista_index','asignaranalista_tabla','alta','ajax_setasignaranalista','nuevo','ajax_setasignarinvestigador','traficoanalista_index','traficoanalista_tabla','ajax_setreasignaranalista','investigadormandarese','autorizacion_index','autorizacion_tabla','autorizarese','noaprobarese','enviaraautorizacion','vercompletoese-modal','detalles','regresar_estatus','resumenanalistatabla','resumeninvestigadortabla','detalleseditarverificacion','editarverificacion','get_ajax_datos_estudio_especifico','detalleseditarsocioeconomico','editarsocioeconomico','detalleseditarsupervivencia','editarsupervivencia','ajax_setasignaranalista_en_trafico_investigador','ajax_get_detalles_analista_asignado','ajax_re_asignaranalista_en_trafico_investigador'),
				'comentarioese'	=> array('tabla','crear','tabla_resumen','tabla_visualizar'),
				'archivo'	=> array('tabla','archivo','eliminar','descargar','eliminar','ajax_get_detalles_archivo','ajax_adjuntar_archivo_reporte','getcurpapi','tabla_truper','ajax_getImagen'),
				'categoria' => array('ajax_categorias','ajax_getinfo'),
				'tipoestudio' =>array('tabla','index','agregar-modal','guardar','ajax_tiposestudios'),
				'transporte'    =>array('asignados_index','asignados_tabla','ajax_nuevo_comprobar_transporte_investigador','ajax_editar_comprobar_transporte_investigador','comprobar-modal','ajax_solicitar_tranpsorte_investigador','solicitar-modal-js','ajax_subir_archivo_transporte','archivo_tabla','eliminar_evidencia_transporte','archivo-modales-js','aprobar_index','aprobar_tabla','ajax_aprobar','descargar','editar-modal-js','ajax_get_detalle','ajax_asignar_transporte'),
				'centrocosto'	=> array('tabla','crear','buseditar','editar','ajax_centros'),
				'verificaciones'	=> array('ajax_verificaciones'),
				'nivelestudio'	=> array('get_ajax_nivelestudios'),
				'estadocivil'	=> array('get_ajax_estadocivil'),
				'datocomprobatorio'	=> array('ajax_set_update','ajax_get_especifico','ajax_set_update_formato_gabtubos','ajax_set_update_formato_gabencognv','ajax_encontrar_o_crear','ajax_set_update_formato_truper'),
				'datogrupofamiliar'=> array('ajax_get_detalle','ajax_set_update','tabla','eliminar_dgd','actualizar_dgd','crear_dgd','crear_automatico_dgf','crear_registro_automatico_otras_tablas','tablagabtubos','actualizar_formato_truper'),
				'datoescolar'	=> array('ajax_get_detalle','guardar','guardar_formato_gabtubos','ajax_get_data_selects_documentorecibidos','guardar_formato_truper'),
				'antecedentesocial'	=> array('ajax_get_detalle','guardar','guardar_formato_truper','ajax_get_detalle_formato_truper'),
				'antecedentegrupofamiliar'	=> array('ajax_get_detalle','crear_automatico_agf','ajax_set_update','tabla_agf','crear_agd'),
				'estadosalud'	=> array('ajax_get_detalle','guardar','ajax_get_detalle_ans_ess_formato_truper','guardar_ess_anss'),
				'antecedentegrupofamiliardetalles' => array('eliminar','actualizar','ajax_get_detalle'),
				'situacioneconomica'=>array('ajax_get_total_ingresos_candidato_formatotruper','ajax_get_total_ingresos_familiar_formatotruper','ajax_get_detalle','ajax_set_update','crear_automatico','ajax_get_detalle_formato_truper','ajax_set_update_formato_truper'),
				'situacioneconomicaingresos'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','ajax_get_total_ingreso_ese','tabla_truper_ingresosfamiliares','tabla_truper_ingresoscandidato','crear_formato_truper','crear_familiar_formato_truper','eliminarIngresoFamiliar','eliminarIngresoCandidato','actualizar_candidato_formato_truper','actualizar_familiar_formato_truper'),
				'situacioneconomicacredito'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle'),
				'bieninmueble'=>array('ajax_get_detalle','ajax_set_update','crear_automatico'),
				'bieninmuebledetalles'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','tabla_truper','crear_formatotruper','actualizar_formatotruper'),
				'seccionpersonal'=>array('ajax_get_detalle','ajax_set_update','crear_automatico','ajax_get_create_detalle'),
				'referenciapersonal'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','tablagabtubos','tabla_truper','crear_formato_truper','actualizar_formato_truper'),
				'referenciavecinal'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','tabla_truper','crear_formato_truper','actualizar_formato_truper'),
				'seccionlaboral'=>array('ajax_get_detalle','ajax_set_update','crear_automatico','ajax_set_update_formato_truper'),
				'referencialaboral'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','tablagabtubos','tablagabtencognv','tabla_truper','crear_formato_truper','actualizar_formato_truper'),
				'periodoinactivo'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','tablagabtubos','tablagabencognv','tablagabtubos'),
				'datofinal'	=> array('ajax_get_detalle','guardar','guardar_formatotruper'),
				'incidencia'	=> array('incidenciaformulario','registrarincidencia','reporte_index','reporte_tabla'),
				'datogrupofamiliardetalles'=>array('ajax_get_detalle','viven_tabla_truper','trabajancompania_tabla_truper','negociootrabajoen_tabla_truper','ajax_get_data_selects_estatucscontacto','crear_vivecon_formatotruper','actualizar_vivecon_formatotruper','crear_trabajancompania_formatotruper','actualizar_trabacompania_formatotruper','crear_negociootrabajoen_formatotruper','actualizar_negociootrabajoen_formatotruper','ajax_get_data_ocupacion_formatotruper','ajax_get_data_parentesco_formatotruper'),
				'tipoformato' =>array('ajax_tiposformatos','ajax_tiposformatos_acorde_a_empresa'),
				'automovil'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','ajax_get_data_tipo_auto','tabla_truper','ajax_get_data_tipo_auto_formatotruper'),
				'datospersonalesese'=>array('ajax_set_update_formato_truper'),
				'datovivienda'=>array('ajax_set_update_formato_truper','ajax_crear_automatico','ajax_get_detalle','ajax_get_data_selects_dinamicos'),
				'datoviviendanterdetalles'=>array('ajax_get_detalle','crear_formato_truper','actualizar_formato_truper','tabla_truper','eliminar'),
				'trayectorialaboralregistrado'=>array('ajax_encontrar_crear_detalle','crear_formato_truper','actualizar_formato_truper','tabla_truper'),
				'trayectorialaboralregistradodetalles'=>array('tabla_truper','crear_formato_truper','actualizar_formato_truper','eliminar','ajax_get_detalle','editar_formato_truper'),
				'trayectorialaboral'=>array('tabla_truper','crear_formato_truper','actualizar_formato_truper','ajax_get_detalle','actualizar_formato_truper','eliminar'),
				'evaluaciontruper'=>array('ajax_get_create_detalle','actualizar_formato_truper'),
				'referenciafamiliar'=>array('tabla_truper','actualizar_formato_truper','eliminar','crear_formato_truper','actualizar_formato_truper','ajax_get_detalle'),
				'api' => array('getimssinfo','pruebadescarga','leerjson','pdftoimg'),
	
			
			);
			foreach ($autoestudioesResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}
			
			//URLS para los usuarios de clientes
			$clienteResources = array(
				'cliente'	=>array('trafico_index','trafico_tabla','asiginv_index','asiginv_tabla','asigana_index','asigana_tabla',
				'traficoanalista_index','traficoanalista_tabla','autorizacion_index','autorizacion_tabla','historial_index',
						'historial_tabla','agenda_index','agenda_tabla',),
				'errors'	=> array('errorpermiso'),
				'session'   => array('end_cliente'),
				'archivo'	=> array('tabla_cliente','descenc'),
				'reporte'	=> array('formatoeses','formatogabtubos','formatoencognv','formatogabsips','formatoargos','formatotruper','formatogabtruper'),
				'index'			=> array('panel'),

			);
			foreach ($clienteResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}


			//Grant access to public areas to both users and guests
			foreach ($roles as $role) {
				foreach ($publicResources as $resource => $actions) {
					foreach ($actions as $action){
						$acl->allow($role->getName(), $resource, $action);
					}
				}
			}

			//Grant access to private area to role Promoter
			foreach ($usersResources as $resource => $actions) 
			{
				foreach ($actions as $action)
				{
					$acl->allow('Users', $resource, $action);
				}
			}	


			//Grant access to private area to role Seller
			foreach ($companiesResources as $resource => $actions) 
			{
				foreach ($actions as $action)
				{
					$acl->allow('Companies', $resource, $action);
				}
			}	

			//Grant access to private area to role AUTOESTUDIOS
			foreach ($autoestudioesResources as $resource => $actions) 
			{
				foreach ($actions as $action)
				{
					$acl->allow('Autoestudios', $resource, $action);
				}
			}
			
			foreach ($clienteResources as $resource => $actions) 
			{
				foreach ($actions as $action)
				{
					$acl->allow('Cliente', $resource, $action);
				}
			}
			
			//The acl is stored in session, APC would be useful here too
			$this->persistent->acl = $acl;
		}

		return $this->persistent->acl;
	}

	/**
	 * This action is executed before execute any action in the application
	 *
	 * @param Event $event
	 * @param Dispatcher $dispatcher
	 * @return bool
	 */
	public function beforeDispatch(Event $event, Dispatcher $dispatcher)
	{

		$auth = $this->session->get('auth');
		if (!$auth)
		{
			$role = 'Guests';
			$id=-1;
		} 
		else 
		{
			$role = $auth['tipo'];
			$id=$auth["id"];
			
		}

		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();

		$acl = $this->getAcl();

		$pos=strpos($action, '_');
		if($pos===false)
			$posicion=0;
		else
			$posicion=$pos;

		
		$allowed = $acl->isAllowed($role, $controller, $action);
		if ($allowed != Acl::ALLOW||$controller=='public') 
		{
		
				if ($controller == "cliente") {
					$dispatcher->forward(array(
						'controller' => 'end_cliente', 
						'action'     => 'end'
					));
				}elseif ($controller=="autoestudio") {
					$dispatcher->forward(array(
						'controller' => 'session',
						'action'     => 'end_aes'
					));
				}else {
					$dispatcher->forward(array(
						'controller' => 'session',
						'action'     => 'end'
					));
				}
				
			$this->session->destroy();
			return false;
		}
	}
}
