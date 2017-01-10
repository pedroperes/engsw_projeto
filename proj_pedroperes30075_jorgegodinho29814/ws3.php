<?php

session_start();
require 'lib/nusoap.php';
require 'password_compat-master/lib/password.php';

// WEB SERVICE ALUNO //
class WS3 {

    public $server = null;
    public $namespace = "http://localhost/engsw/proj_pedroperes30075_jorgegodinho29814/ws3.php";

    public function __construct() {
        $this->$server->configureWSDL('ws3wsdl', 'urn:ws3wsdl');
        $this->$server->wsdl->schemaTargetNamespace = $this->$namespace;


        $this->$server->register(
                'WS3.enrollDegree', // method name
                array('student_id' => 'xsd:string', // input parameters
            'degree_id' => 'xsd:string'), // input parameters
                array('return' => 'xsd:string'), // output parameters
                'urn:ws3wsdl', // namespace
                'urn:ws3wsdl#enrollDegree', // soapaction
                'rpc', // style
                'encoded', // use
                'Inscriçao em curso'                        // documentation
        );

        $this->$server->register(
                'WS3.enrollCourse', // method name
                array('student_id' => 'xsd:string', // input parameters
            'course_id' => 'xsd:string'), // input parameters
                array('return' => 'xsd:string'), // output parameters
                'urn:ws3wsdl', // namespace
                'urn:ws3wsdl#enrollCourse', // soapaction
                'rpc', // style
                'encoded', // use
                'Inscriçao em disciplina'                        // documentation
        );

        $this->$server->register(
                'WS3.updateStudent', // method name
                array('nome' => 'xsd:string', // input parameters
            'gender' => 'xsd:string',
            'email' => 'xsd:string',
            'id' => 'xsd:string'), // input parameters
                array('return' => 'xsd:string'), // output parameters
                'urn:ws3wsdl', // namespace
                'urn:ws3wsdl#updateStudent', // soapaction
                'rpc', // style
                'encoded', // use
                'Atualizar aluno'                        // documentation
        );
    }

// ------------------------------------------------------------------------- //

    function enrollDegree($student_id, $degree_id) {
        $a = new Aluno();
        return $a->enrollDegree($student_id, $degree_id);
    }

    function enrollCourse($student_id, $course_id) {
        $a = new Aluno();
        return $a->enrollCourse($student_id, $course_id);
    }

    function updateStudent($nome, $gender, $email, $id) {
        $d = new Docente();
        return $d->updateStudent($nome, $gender, $email, $id);
    }
    
    public function processRequest() {
        $this->server->service($GLOBALS['HTTP_RAW_POST_DATA']);
    }

}

$ws = new WS3();
$ws->processRequest();

?>