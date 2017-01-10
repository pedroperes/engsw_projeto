<?php

session_start();
require 'lib/nusoap.php';
require 'password_compat-master/lib/password.php';

// WEB SERVICE DOCENTE //

class WS2 {

    public $server = null;
    public $namespace = "http://localhost/engsw/proj_pedroperes30075_jorgegodinho29814/ws2.php";

    public function __construct() {
        $this->server = new nusoap_server();
        
        $this->$server->configureWSDL('ws2wsdl', 'urn:ws2wsdl');
        $this->$server->wsdl->schemaTargetNamespace = $this->$namespace;

        $this->$server->register(
                'WS2.updateInstructor', // method name
                array('nome' => 'xsd:string', // input parameters
            'gender' => 'xsd:string',
            'email' => 'xsd:string',
            'id' => 'xsd:string'), // input parameters
                array('return' => 'xsd:string'), // output parameters
                'urn:ws2wsdl', // namespace
                'urn:ws2wsdl#updateInstructor', // soapaction
                'rpc', // style
                'encoded', // use
                'Atualizar docente'                        // documentation
        );

        $this->$server->register(
                'WS2.giveGrades', // method name
                array('student_id' => 'xsd:string', // input parameters
            'course_id' => 'xsd:string',
            'grade' => 'xsd:string'), // input parameters
                array('return' => 'xsd:string'), // output parameters
                'urn:ws2wsdl', // namespace
                'urn:ws2wsdl#giveGrades', // soapaction
                'rpc', // style
                'encoded', // use
                'Lançar nota'                        // documentation
        );

        $this->$server->register(
                'WS2.searchFreeRoom', // method name
                array('room' => 'xsd:string'), // input parameters
                array('result' => 'tns:query'), // output parameters
                'urn:ws2wsdl', // namespace
                'urn:ws2wsdl#listRoom', // soapaction
                'rpc', // style
                'encoded', // use
                'Lista todas as salas livres'                      // documentation
        );

// ------------------------------------------------------------------------- //
    }

    function giveGrades($student_id, $course_id, $grade) {
        $d = new Docente();
        return $d->giveGrades($student_id, $course_id, $grade);
    }

    function updateInstructor($nome, $gender, $email, $id) {
        $d = new Docente();
        return $d->updateInstructor($nome, $gender, $email, $id);
    }

    function searchFreeRoom($room) {
        $s = new Sala();
        return $s->searchFreeRoom($room);
    }
    
    public function processRequest() {
        $this->server->service($GLOBALS['HTTP_RAW_POST_DATA']);
    }

}

$ws = new WS2();
$ws->processRequest();

?>