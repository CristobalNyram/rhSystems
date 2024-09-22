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

				'users' => new Role('Users'),
				'companies' => new Role('Companies')
				

			);
			foreach ($roles as $role) {
				$acl->addRole($role);
			}

			

			//Public area resources
			$publicResources = array(
				'index'     => array('index'),
				'session'   => array('start','end','start_aes','end_aes'),
				'soporte'	=> array('verificasesion'),
				'archivo'	=> array('prueba'),
				'consulta'	=> array('validaqr'),
				'apnubarcons'	=> array('apnubarimsscons'),
				'autoestudio'=>array('index'),
				'apivacante'=>array('get_vigentes_landing'),

				
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
				'usuario'		=> array('index','tabla','perfil','editarperfil','editarpassword','guardarperfil','eliminar','cambiarcontraadmin','formulario','nuevo','editar','buseditar','ajax_getinvestigador', 'ajax_getanalista','ajax_get_investigador_transporte','ajax_getanalista_excluir_un_analista','ajax_get_all_investigadores','ajax_get_all_ejecutivos','ajax_usuario_auxiliares'),
				'bitacora'		=> array('index'),
				'errors'		=> array('errorpermiso'),
				'empresa'		=> array('index','tabla','nuevo','buseditar','editar','eliminar','ajax_empresas','cambiarfoto','ajax_empresa_detalle','ajax_get_detalle_completo'),
				'centrocosto'	=> array('tabla','crear','buseditar','editar','ajax_centros'),
				'contactoemp'	=> array('tabla','crear','buseditar','editar','tabladetallescontacto','ajax_contactos','ajax_get_detalle_uno'),
				'nivelestudio'	=> array('get_ajax_nivelestudios'),
				'estadocivil'	=> array('get_ajax_estadocivil'),
				'api' => array('getimssinfo','pruebadescarga'),
				'empleooculto'=>array('tabla','eliminar','crear_general','actualizar_general','ajax_get_detalle'),
				'negocio'		=> array('index','tabla','nuevo','buseditar','editar','eliminar','ajax_negocios'),
				'ocupacion'		=> array('index', 'tabla', 'nuevo', 'buseditar', 'editar', 'eliminar', 'ajax_ocupaciones'),
				'catvacante'	=> array('index', 'tabla', 'nuevo', 'buseditar', 'editar', 'eliminar', 'ajax_catvacantes','tabla_catvacante_empresa','nuevo_emp','editar_emp','detalles'),
				'vacante'		=> array('alta','nuevo','general_index','general_tabla','relacionvacante_index','relacionvacante_tabla','ajax_get_detalle','actualizar','referencias_index','referencias_tabla','autorizacion_index','autorizacion_tabla','entrevista_index','entrevista_tabla',"cambiar_estatus","actualizar_no_vac_disponibles","ajax_get_detalle_vac_numero","ajax_get_detalle_vac_cancelar","cancelar_vacante","ajax_get_detalle_arc_cot","mandar_garantia",'compartir_vacante','regresar_vacante_fin'),
				'configuracion'=>array('apariencia_index','actualizar_apariencia','obtener_link',"correos_index","actualizar_envio_correo"),
				'tipovacante'	=> array('index', 'tabla', 'nuevo', 'buseditar', 'editar', 'eliminar', 'ajax_tipovacantes'),
				'tipoempleo'	=> array('index', 'tabla', 'nuevo', 'buseditar', 'editar', 'eliminar', 'ajax_tipoempleos'),
				'tipopago'		=> array('index', 'tabla', 'nuevo', 'buseditar', 'editar', 'eliminar', 'ajax_tipopagos'),
				'generacion'	=> array('index', 'tabla', 'nuevo', 'buseditar', 'editar', 'eliminar', 'ajax_generaciones'),
				'estadocivil'	=> array('index', 'tabla', 'nuevo', 'buseditar', 'editar', 'eliminar', 'ajax_estadoscivil'),
				'sexo'=> array('index', 'tabla', 'nuevo', 'buseditar', 'editar', 'eliminar', 'ajax_sexos'),
				'prestacion'=> array('index', 'tabla', 'nuevo', 'buseditar', 'editar', 'eliminar', 'ajax_prestaciones'),
				'gradoescolar'=> array('index', 'tabla', 'nuevo', 'buseditar', 'editar', 'eliminar', 'ajax_gradosescolares'),
				'cita'=>array('ajax_get_datos_selects_vac',"vac_exc_cit_tabla","crear_general","ajax_get_detalle_cit_exc_can","editar_general", "reprogramar_general", "general_index","general_tabla"),
				'helper'=>array('ajax_get_datos_selects_vac',"sacar_promedio","ajax_tipopagos","get_encript_id"),
				'tipocita'=>array('ajax_tiposcitas'),
				'medio'=>array('ajax_medios','index','tabla', 'nuevo', 'buseditar', 'editar', 'eliminar'),
				'archivo'=> array('tabla','get_archivos_exc','archivo','eliminar','descargar','eliminar','ajax_getImagen','tabla_visualizador_resumen_exc'),
				'expedientecan'	=> array("ajax_get_detalle","cambiar_estatus","ajax_get_detalle_estatus_cambio","autorizar","rel_vac_tabla","mandar_garantia", "metricas","reactivar","regresar_facturacion","cambiar_ejecutivo"),
				'categoria' => array('ajax_categorias','ajax_getinfo'),
				'comentarioexc'=> array('tabla','crear','tabla_resumen','tabla_visualizar','tabla_seguimiento'),
				'seccionlaboral'=> array('ajax_get_set_detalle','ajax_set_update',"ajax_get_detalle"),
				'referencialaboral'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','ajax_set_orden_abajo','ajax_set_orden_arriba'),
				'empleooculto'=>array('tabla','eliminar','crear_general','actualizar_general','ajax_get_detalle'),
				'periodoinactivo'=>array('crear','borrar','actualizar','tabla','eliminar','ajax_get_detalle','tablagabtubos','tablagabencognv','tablagabtubos'),
				'psicometria'=>array("crear_general","actualizar_general","general_index","general_tabla","ajax_get_detalle"),
				'entrevista'=>array("crear_general","actualizar_general","general_index","general_tabla","ajax_get_detalle"),
				'reporte'=>array("reporte_evaluacion_candidato","reporte_referencias_candidato", "reporte_auxiliar_administrativo","reporte_requision_personal","facturacion_index","facturacion_tabla"),
				'consulta'=> array('index','tabla','get_ajax_detalles_ese_uno','index_vac','tabla_vac'),				
				'facturacion'=>array('ajax_get_detalle','enviar_correo_fatu_auto'),
				'soporte'=>array('limpiarcachevolt'),
				'archivovac'=> array('tabla','get_archivos_exc','archivo','eliminar','descargar','eliminar','ajax_getImagen'),
				'categoriavac' => array('ajax_categorias','ajax_getinfo'),
			    'candidato' => array('ajax_get_coincidencias_by_nombre_completo','ajax_get_coincidencias_by_curp','general_index', 'general_tabla','ajax_get_detalle_completo','enviar_agradecimiento_whats','enviar_agradecimiento_correo'),
				'ejecutivo' => array('ajax_get_all_ejecutivos','ajax_get_all_ejecutivos_no_compartidos_vac'),
				'relvacanteejecutivo' => array('ajax_get_detalle_relacion','general_tabla','eliminar'),


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
			$dispatcher->forward(array(
				'controller' => 'session',
				'action'     => 'end'
			));

            $this->session->destroy();
            
			return false;
		}
	}
}
