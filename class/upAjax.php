<?php
/*
* upAjax
* Kleines Plugin zum einfachen aufruf von PHP Funktionen vom Client aus mit dem XMLHttpRequest Objekt Level 2
*
* @author Lennart Sommerfeld
* @copyright (c) 2014 Lennart Sommerfeld
* @link http://lennart-sommerfeld.de
* @version 1.0
*/

class upAjax {
    private $responseVarArray = Array();
    private $activ = false;

    function __construct(){
        // Überprüfe ob ein JOSON String geschickt wurde
        $this->getDataFromResponse();
    }

    private function getDataFromResponse(){

        if(isset($_GET['EasyAjaxJSONString'])){

            $this->activ = true;
            $this->responseVarArray['FUNCTION'] = $_GET['EasyAjaxJSONString'];
            $this->responseVarArray['DATA'] = json_decode($_POST['EasyAjaxData'], true);

            return true;
        }

        if(isset($_GET['EasyAjaxJSONForm'])){

            $this->activ = true;
            $this->responseVarArray['FUNCTION'] = $_GET['EasyAjaxJSONForm'];
            $this->responseVarArray['DATA'][0] = $_POST;

            return true;
        }

        return false;
    }

    // Funktionsnamen registrieren
    function regFunction ($functionName){
        if($this->activ == true) {
            $this->checkAjaxResponse($functionName);
        }
    }


    // Überprüfe ob der übergebene Name der Funktionen übereinstimmt
    function checkAjaxResponse($tempfunctionName){

        if ($tempfunctionName == $this->responseVarArray['FUNCTION']) {

            // Wenn eine Funktion gefunden wurde ausführen
            call_user_func_array ($tempfunctionName, $this->responseVarArray['DATA']);
            die(0);
        }

        return false;
    }

    // Array in JOSN format umwandeln
    function sendArray($data){
        if(is_array($data) == true){
            echo json_encode($data);
        }
    }

    // HTML String zurückgeben
    function sendHTML($data){
        if(is_string($data)){
            echo $data;
        }
    }
} 
