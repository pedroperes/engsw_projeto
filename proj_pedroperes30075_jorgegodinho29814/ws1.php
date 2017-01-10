<?php

session_start();
require 'lib/nusoap.php';
require 'password_compat-master/lib/password.php';

// WEB SERVICE ADMIN //

class WS1 {
    /*     * ******************** WEBSERVICE 1 ********************* */

    public $server = null;
    public $namespace = "http://localhost/engsw/proj_pedroperes30075_jorgegodinho29814/ws1.php";

    public function __construct() {
        // instanciar
        $this->server = new nusoap_server();

        $this->$server->configureWSDL('ws1wsdl', 'urn:ws1wsdl');
        $this->$server->wsdl->schemaTargetNamespace = $this->$namespace;


        $this->$server->register(
                'WS1.registerStudent', // method name
                array('uname' => 'xsd:string', // input parameters
            'email' => 'xsd:string', // input parameters
            'gender' => 'xsd:string', // input parameters
            'upass' => 'xsd:string'), // input parameters
                array('return' => 'xsd:string'), // output parameters
                'urn:ws1wsdl', // namespace
                'urn:ws1wsdl#wregisterstudent', // soapaction
                'rpc', // style
                'encoded', // use
                'Faz o registo de um estudante'                        // documentation
        );

        $this->$server->register(
                'WS1.registerInstructor', // method name
                array('uname' => 'xsd:string', // input parameters
            'email' => 'xsd:string', // input parameters
            'gender' => 'xsd:string', // input parameters
            'upass' => 'xsd:string'), // input parameters
                array('return' => 'xsd:string'), // output parameters
                'urn:ws1wsdl', // namespace
                'urn:ws1wsdl#registerinstructor', // soapaction
                'rpc', // style
                'encoded', // use
                'Faz o registo de um docente'                        // documentation
        );

        $this->$server->register(
                'WS1.registerAdmin', // method name
                array('uname' => 'xsd:string', // input parameters
            'email' => 'xsd:string', // input parameters
            'upass' => 'xsd:string'), // input parameters
                array('return' => 'xsd:string'), // output parameters
                'urn:ws1wsdl', // namespace
                'urn:ws1wsdl#registeradmin', // soapaction
                'rpc', // style
                'encoded', // use
                'Faz o registo de um admin'                        // documentation
        );

        $this->$server->register(
                'WS1.createDegree', // method name
                array('name' => 'xsd:string', // input parameters
            'code' => 'xsd:string'), // input parameters
                array('return' => 'xsd:string'), // output parameters
                'urn:ws1wsdl', // namespace
                'urn:ws1wsdl#createdegree', // soapaction
                'rpc', // style
                'encoded', // use
                'Criar curso'                        // documentation
        );

        $this->$server->register(
                'WS1.addInstructorCourse', // method name
                array('instructor_id' => 'xsd:string', // input parameters
            'course_id' => 'xsd:string', // input parameters
            'section_id' => 'xsd:string'), // input parameters
                array('return' => 'xsd:string'), // output parameters
                'urn:ws1wsdl', // namespace
                'urn:ws1wsdl#addinstructorcourse', // soapaction
                'rpc', // style
                'encoded', // use
                'Adicionar docente a disciplina'                        // documentation
        );

        $this->$server->register(
                'WS1.setRoom', // method name
                array('selectRoom' => 'xsd:string', // input parameters
            'selectInstructor' => 'xsd:string', // input parameters
            'selectCourse' => 'xsd:string', // input parameters
            'day' => 'xsd:string', // input parameters
            'start_hour' => 'xsd:string', // input parameters
            'duration' => 'xsd:string'), // input parameters
                array('return' => 'xsd:string'), // output parameters
                'urn:ws1wsdl', // namespace
                'urn:ws1wsdl#setroom', // soapaction
                'rpc', // style
                'encoded', // use
                'Definir sala'                        // documentation
        );

        $this->$server->register(
                'WS1.listStudents', // method name
                array('name' => 'xsd:string', // input parameters
            'code' => 'xsd:string'), // input parameters
                array('return' => 'xsd:string'), // output parameters
                'urn:ws1wsdl', // namespace
                'urn:ws1wsdl#liststudents', // soapaction
                'rpc', // style
                'encoded', // use
                'Listar estudantes'                        // documentation
        );


// ------------------------------------------------------------------------- //
    }

    function registerStudent($uname, $email, $gender, $upass) {
        $a = new Aluno();
        return $a->registerStudent($uname, $email, $gender, $upass);
    }

    function registerInstructor($uname, $email, $gender, $upass) {
        $d = new Docente();
        return $d->registerInstructor($uname, $email, $gender, $upass);
    }

    function registerAdmin($uname, $email, $upass) {
        $a = new Administrativo();
        return $a->registerAdmin($uname, $email, $upass);
    }

    function createDegree($name, $code) {
        $c = new Curso();
        return $c->createDegree($name, $code);
    }

    function addInstructorCourse($instructor_id, $course_id, $section_id) {
        $d = new Docente();
        return $d->addInstructorCourse($instructor_id, $course_id, $section_id);
    }

    function listStudents($name, $code) {
        $a = new Aluno();
        return $a->listStudents($name, $code);
    }

    function setRoom($selectRoom, $selectInstructor, $selectCourse, $day, $start_hour, $duration) {
        $s = new Sala();
        return $s->setRoom($selectRoom, $selectInstructor, $selectCourse, $day, $start_hour, $duration);
    }

    public function processRequest() {
        $this->server->service($GLOBALS['HTTP_RAW_POST_DATA']);
    }

}

$ws = new WS1();
$ws->processRequest();
?>