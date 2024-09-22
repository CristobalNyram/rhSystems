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
				'users' => new Role('Users'),
				'companies' => new Role('Companies')
				

			);
			foreach ($roles as $role) {
				$acl->addRole($role);
			}

			

			//Public area resources
			$publicResources = array(
				'index'      => array('index'),
				'consulta'   => array('participantes','participantedc3','participantedip','verificar','buscar','diplomainstructor'),
				'session'    => array('start','end'),
				'cuestionariouno'	=> array('formulario','guardar','respuesta'),
				'cuestionariodos'	=> array('formulario','guardar','respuesta'),
				'cuestionariotres'	=> array('formulario','guardar','respuesta')
				
			);
			foreach ($publicResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}

			//Users area resources

			
			$usersResources = array(
				'administrador' => array('index','tabla','formulario','eliminar','cambiarfoto','cambiarfirma','eliminardirector','creardirector','buseditardirector','editardirector'),
				'archivos'   	=> array('descargar'),
				'areatematica'	=> array('index','tabla','formulario','eliminar'),
				'centrotrabajo'	=> array('buseditar','index','tabla','formulario','editar','eliminar','cambiarfoto','crear','lista','ajax_centros','ajax_getrepresentantes'),
				'consulta'		=> array('participantes','participantedc3','participantedip','verificar','buscar','diplomainstructor'),
				'cursoabierto'	=> array('index', 'tabla', 'participantes','tablaparticipantes','reportedc3','reportediploma','formulario','participantenuevo','dc3masa','diplomamasa','eliminarmasa','gethoras','asignarempresa','asignarcentro'),
				'cursolinea'	=> array('index', 'tabla', 'participantes','tablaparticipantes','reportedc3','reportediploma','formulario','participantenuevo','dc3masa','diplomamasa','eliminarmasa','gethoras','asignarempresa','asignarcentro','fechaexamen'),
				'curso'			=> array('index', 'tabla','formulario','nuevo','editar','eliminar'),
				'cursootorgado'	=> array('index', 'tabla', 'participantes','tablaparticipantes','reportedc3','reportediploma','formulario','eliminar','participantenuevo','dc3masa','diplomamasa','eliminarmasa','gethoras','diplomainstructor','imprimir','actualizar'),
				'empresa'   	=> array('index','tabla','formulario','eliminar','cambiarfoto','ajax_empresas'),
				'estado'		=> array('index','tabla','lista'),
				'index'        	=> array('index','panel','menu'),
				'instructor'	=> array('index','tabla','formulario','eliminar','cambiarfirma'),
				'menu'			=> array('tab','nuevo'),
				'mpdf'			=> array('ejemplo','verificar'),
				'municipio'		=> array('lista'),
				'ocupacion'		=> array('index','tabla','formulario','eliminar','ajax_ocupaciones'),
				'pais'			=> array('index','tabla'),
				'reporte'		=> array('index','participantescurso','participantescursoexcel','cursoempresa','descargar','participantescursoabierto','participantescursoabiertoexcel'),
				'representante' => array('buseditar','editar','crear','crearcentro','eliminar','eliminarcentro'),
				'rol'			=> array('index','tabla','nuevo','editar','eliminar','permiso'),
				'session'    	=> array('end'),
				'trabajador'	=> array('buseditar','editar','crear','eliminar'),
				'usuario'      	=> array('index','tabla','perfil','perfil','editarperfil','editarpassword','guardarperfil','eliminar','cambiarcontraadmin','formulario'),
				'historialdescarga'=> array('tabla'),
				'soporte'		=> array('asignardatoscerrados','agregarhistorialcerrado','agregarhistorialabierto','agregarhistoriallinea'),
				'cuestionario'	=> array('activarfolio','tablafolio','folionuevo'),
				'bitacora'		=> array('index')
			

			);
			
			foreach ($usersResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}


			$companiesResources = array(
				'index'        => array('index','panel'),
				// 'empresa'		=> array('index','tabla','perfil','editarpassword')
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
