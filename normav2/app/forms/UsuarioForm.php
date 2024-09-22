<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;

class UsuarioForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {



    }
    
    /**
     * [TodosCampos Seleccionar los campos de la tabla usuario]
     * @param       []
     * @return []   []
     */
    public function TodosCampos()
    {
        $id = new Numeric('usu_id');
        $id->setLabel('ID');
        $id->setFilters(array('striptags', 'string'));
        $this->add($id); 

        $password = new Password('usu_password');
        $password->setLabel('Contraseña');
        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'Contraseña requerida'
            ))
        ));
        $this->add($password);

        $nombre = new Text("usu_nombre");
        $nombre->setLabel("Nombre");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $apellidop = new Text("usu_apellidop");
        $apellidop->setLabel("Apellido Paterno");
        $apellidop->setFilters(array('striptags', 'string'));
        $apellidop->setAttributes(array('maxlength' => 150));
        $apellidop->addValidators(array(
            new PresenceOf(array(
                'message' => 'Apellido obligatorio'
            ))
        ));
        $this->add($apellidop);

        $apellidom = new Text("usu_apellidom");
        $apellidom->setLabel("Apellido Materno");
        $apellidom->setFilters(array('striptags', 'string'));
        $apellidom->setAttributes(array('maxlength' => 150));
        $apellidom->addValidators(array(
            new PresenceOf(array(
                'message' => 'Apellido obligatorio'
            ))
        ));
        $this->add($apellidom);

        $sexo = new Select('usu_sexo');
        $sexo->setLabel('Sexo');
        $sexo->setOptions(array('Masculino'=>'Masculino','Femenino'=>'Femenino'));
        $this->add($sexo);

        $estadocivil = new Select('usu_estcivil');
        $estadocivil->setLabel('Estado Civil');
        $estadocivil->setOptions(array('Soltero'=>'Soltero','Casado'=>'Casado','Divorciado'=>'Divorciado'));
        $this->add($estadocivil);

        $hijos = new Numeric('usu_hijos');
        $hijos->setLabel('Cantidad de hijos');
        $hijos->setFilters(array('striptags', 'string'));
        $this->add($hijos); 

        $calle = new Text("usu_calle");
        $calle->setLabel("Calle");
        $calle->setFilters(array('striptags', 'string'));
        $calle->setAttributes(array('maxlength' => 150));
        $calle->addValidators(array(
            new PresenceOf(array(
                'message' => 'Calle obligatorio'
            ))
        ));
        $this->add($calle);

        $interior = new Text("usu_interior");
        $interior->setLabel("Interior");
        $interior->setFilters(array('striptags', 'string'));
        $interior->setAttributes(array('maxlength' => 150));
        $this->add($interior);

        $exterior = new Text("usu_exterior");
        $exterior->setLabel("Exterior");
        $exterior->setFilters(array('striptags', 'string'));
        $exterior->setAttributes(array('maxlength' => 150));
        $exterior->addValidators(array(
            new PresenceOf(array(
                'message' => 'Exterior obligatorio'
            ))
        ));
        $this->add($exterior);

        $colonia = new Text("usu_colonia");
        $colonia->setLabel("Colonia");
        $colonia->setFilters(array('striptags', 'string'));
        $colonia->setAttributes(array('maxlength' => 150));
        $colonia->addValidators(array(
            new PresenceOf(array(
                'message' => 'Colonia obligatorio'
            ))
        ));
        $this->add($colonia);

        $municipio = new Text("usu_municipio");
        $municipio->setLabel("Municipio");
        $municipio->setFilters(array('striptags', 'string'));
        $municipio->setAttributes(array('maxlength' => 150));
        $municipio->addValidators(array(
            new PresenceOf(array(
                'message' => 'Municipio obligatorio'
            ))
        ));
        $this->add($municipio);

        $telefono = new Numeric('usu_telefono');
        $telefono->setLabel('Teléfono');
        $telefono->setFilters(array('striptags', 'string'));
        $this->add($telefono);

        $extension = new Numeric('usu_extension');
        $extension->setLabel('Extensión');
        $extension->setFilters(array('striptags', 'string'));
        $this->add($extension);

        $celular = new Numeric('usu_celular');
        $celular->setLabel('Celular');
        $celular->setFilters(array('striptags', 'string'));
        $this->add($celular);

        // $horascapacitacion = new Numeric('usu_horascap');
        // $horascapacitacion->setLabel('Horas de capacitación');
        // $horascapacitacion->setFilters(array('striptags', 'string'));
        // $this->add($horascapacitacion);

        $departamento = new DepartamentoForm;
        $this->add($departamento->FillSelect());

        $pais = new PaisForm;
        $this->add($pais->FillSelect());

        $estado = new EstadoForm;
        $this->add($estado->FillSelect());

        $correo = new Text('usu_correo');
        $correo->setLabel('Correo electrónico');
        $correo->setFilters(array('striptags', 'email'));
        $this->add($correo);

        $correo_personal = new Text('usu_correo_personal');
        $correo_personal->setLabel('Correo electrónico personal');
        $correo_personal->setFilters(array('striptags', 'email'));
        $this->add($correo_personal);        

        $puesto = new PuestoForm;
        $this->add($puesto->FillSelect());

        $fechaing = new Date('usu_fechaingreso');
        $fechaing->setLabel('Fecha de Ingreso');
        $fechaing->setFilters(array('striptags', 'string'));
        $this->add($fechaing);

        $fechanac = new Date('usu_fechanacimiento');
        $fechanac->setLabel('Fecha de Nacimiento');
        $fechanac->setFilters(array('striptags', 'string'));
        $this->add($fechanac); 

        $fechaproxeval = new Date('usu_proxevaluacion');
        $fechaproxeval->setLabel('Fecha de Próxima evaluación');
        $fechaproxeval->setFilters(array('striptags', 'string'));
        $this->add($fechaproxeval);

        $nss = new Text("usu_nss");
        $nss->setLabel("Número de seguro social");
        $nss->setFilters(array('striptags', 'string'));
        $nss->setAttributes(array('maxlength' => 150));
        $nss->addValidators(array(
            new PresenceOf(array(
                'message' => 'Número de seguro social obligatorio'
            ))
        ));
        $this->add($nss);

        $curp = new Text("usu_curp");
        $curp->setLabel("CURP");
        $curp->setFilters(array('striptags', 'string'));
        $curp->setAttributes(array('maxlength' => 150));
        $curp->addValidators(array(
            new PresenceOf(array(
                'message' => 'CURP obligatorio'
            ))
        ));
        $this->add($curp);

        $rfc = new Text("usu_rfc");
        $rfc->setLabel("RFC");
        $rfc->setFilters(array('striptags', 'string'));
        $rfc->setAttributes(array('maxlength' => 150));
        $rfc->addValidators(array(
            new PresenceOf(array(
                'message' => 'RFC obligatorio'
            ))
        ));
        $this->add($rfc);

        $tipocontrato = new TipocontratoForm;
        $this->add($tipocontrato->FillSelect());

        $tipojornada = new TipojornadaForm;
        $this->add($tipojornada->FillSelect());

        $banco= new BancoForm;
        $this->add($banco->FillSelect());

        $nocuenta = new Numeric('usu_nocuenta');
        $nocuenta->setLabel('Número de cuenta');
        $nocuenta->setFilters(array('striptags', 'string'));
        $this->add($nocuenta);

        $licenciatura = new Text("usu_licenciatura");
        $licenciatura->setLabel("Licenciatura");
        $licenciatura->setFilters(array('striptags', 'string'));
        $licenciatura->setAttributes(array('maxlength' => 150));
        $licenciatura->addValidators(array(
            new PresenceOf(array(
                'message' => 'Licenciatura obligatoria'
            ))
        ));
        $this->add($licenciatura);

        $experiencia = new Text("usu_experiencia");
        $experiencia->setLabel("Experiencia");
        $experiencia->setFilters(array('striptags', 'string'));
        $experiencia->setAttributes(array('maxlength' => 150));
        $experiencia->addValidators(array(
            new PresenceOf(array(
                'message' => 'Experiencia obligatoria'
            ))
        ));
        $this->add($experiencia);

        $subdepartamento= new SubdepartamentoForm;
        $this->add($subdepartamento->FillSelect());

        $jefe= new UsuarioForm;
        $this->add($jefe->FillSelect());

        $cuotahora = new Numeric('usu_cuotahora');
        $cuotahora->setLabel('Cuota de hora');
        $cuotahora->setFilters(array('striptags', 'string'));
        $this->add($cuotahora);

        $estatus = new Select('usu_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $socio = new SocioForm;
        $this->add($socio->FillSelect());
        // $tipo = new Select('usu_socio');
        // $tipo->setLabel('Socio');
        // $tipo->setOptions(array('Carlos Saucillo'=>'Carlos Saucillo','Dario Zamorano'=>'Dario Zamorano','Eloy Obregón'=>'Eloy Obregón','Francisco Bracamonte'=>'Francisco Bracamonte','Guillermo Saldívar'=>'Guillermo Saldívar','Jorge Oropeza'=>'Jorge Oropeza','José García'=>'José García','Juan Espinosa'=>'Juan Espinosa'));
        // $this->add($tipo);

        $fechavac = new Date('usu_vigenciavacaciones');
        $fechavac->setLabel('Vigencia de vacaciones');
        $fechavac->setFilters(array('striptags', 'string'));
        $this->add($fechavac);
//estatus
        // $foto = new Text("usu_foto");
        // $foto->setLabel("Foto");
        // $foto->setFilters(array('striptags', 'string'));
        // $foto->setAttributes(array('maxlength' => 150));
        // $foto->addValidators(array(
        //     new PresenceOf(array(
        //         'message' => 'Foto obligatoria'
        //     ))
        // ));
        // $this->add($foto);

    }

    public function NuevosCampos()
    {
        $id = new Numeric('usu_id');
        $id->setLabel('ID');
        $id->setFilters(array('striptags', 'string'));
        $this->add($id); 

        $password = new Password('usu_contrasena');
        $password->setLabel('Contraseña');
        $password->setAttributes(array('placeholder' => "Clave del área temática", "class"=>"form-control"));
        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'Contraseña requerida'
            ))
        ));
        $this->add($password);

        $nombre = new Text("usu_nombre");
        $nombre->setLabel("Nombre");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del área temática", "class"=>"form-control"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $apellidop = new Text("usu_primerapellido");
        $apellidop->setLabel("Primer apellido");
        $apellidop->setFilters(array('striptags', 'string'));
        $apellidop->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del área temática", "class"=>"form-control"));
        $apellidop->addValidators(array(
            new PresenceOf(array(
                'message' => 'Apellido obligatorio'
            ))
        ));
        $this->add($apellidop);

        $apellidom = new Text("usu_segundoapellido");
        $apellidom->setLabel("Segundo apellido");
        $apellidom->setFilters(array('striptags', 'string'));
        $apellidom->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del área temática", "class"=>"form-control"));
        $apellidom->addValidators(array(
            new PresenceOf(array(
                'message' => 'Apellido obligatorio'
            ))
        ));
        $this->add($apellidom);

        $rol = new RolForm;
        $this->add($rol->FillSelect());

        $correo = new Text('usu_correo');
        $correo->setLabel('Correo electrónico');
        $correo->setFilters(array('striptags', 'email'));
        $correo->setAttributes(array('placeholder' => "Correo electrónico", "class"=>"form-control"));
        $this->add($correo);

        $estatus = new Select('usu_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $nombre = new Submit("enviar");
        $nombre->setLabel("");
        $nombre->setAttributes(array('value' => "Siguiente", 'class' =>"btn-block btn-btnempresa submit"));
        $this->add($nombre);

    }

    public function EditarCampos()
    {
        $id = new Numeric('usu_id');
        $id->setLabel('ID');
        $id->setFilters(array('striptags', 'string'));
        $id->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del área temática", "class"=>"form-control"));
        $this->add($id); 

        $nombre = new Text("usu_nombre");
        $nombre->setLabel("Nombre");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del área temática", "class"=>"form-control"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $apellidop = new Text("usu_primerapellido");
        $apellidop->setLabel("Primer apellido");
        $apellidop->setFilters(array('striptags', 'string'));
        $apellidop->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del área temática", "class"=>"form-control"));
        $apellidop->addValidators(array(
            new PresenceOf(array(
                'message' => 'Apellido obligatorio'
            ))
        ));
        $this->add($apellidop);

        $apellidom = new Text("usu_segundoapellido");
        $apellidom->setLabel("Segundo apellido");
        $apellidom->setFilters(array('striptags', 'string'));
        $apellidom->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del área temática", "class"=>"form-control"));
        $apellidom->addValidators(array(
            new PresenceOf(array(
                'message' => 'Apellido obligatorio'
            ))
        ));
        $this->add($apellidom);

        $rol = new RolForm;
        $this->add($rol->FillSelect());

        $correo = new Text('usu_correo');
        $correo->setLabel('Correo electrónico');
        $correo->setFilters(array('striptags', 'email'));
        $correo->setAttributes(array('placeholder' => "Correo electrónico", "class"=>"form-control"));
        $this->add($correo);

        $estatus = new Select('usu_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $nombre = new Submit("enviar");
        $nombre->setLabel("");
        $nombre->setAttributes(array('value' => "Siguiente", 'class' =>"btn-block btn-btnempresa submit"));
        $this->add($nombre);

    }

    public function FillSelect($baja=false)
    {
        $usuario= new Usuario();
        $usuario = new Select('usu_jefe', $usuario->FillSelect($baja), array(
            'using'      => array('usu_jefe', 'nombre')
        ));
        $usuario->setLabel('Superior');
        return $usuario;
    }

    public function FillSelectUsuario($baja=false,$todos=1,$lclave=-1,$leyenda="Usuario")
    {
        $usuario= new Usuario();
        $usuario2 = new Select('usu_id', $usuario->FillSelectUsuario($baja,$todos,$lclave), array(
            'using'      => array('usu_id', 'nombre'),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $usuario2->setLabel($leyenda);
        return $usuario2;
    }
    
}