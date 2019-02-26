<?php

class GeneralController{

    public function run($action){
        try{
            $this->$action();
        }catch (Error $e){
            $this->index();
        }
    }

    public function view($view, $data){
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        if (isset($_SESSION["hash"])) {
            $data["hash"] =  $_SESSION["hash"];
        }
        require_once __DIR__."/../vendor/autoload.php";
        $loader = new Twig_Loader_Filesystem(__DIR__."/../view");
        $twig = new Twig_Environment($loader);
        echo $twig->render($view."View.twig", $data);
    }

    public function index(){
        $paremeters = array();
        $this->view('index', $paremeters);
    }

    public function runContacto(){
        $paremeters = array();
        $this->view('contacto', $paremeters);  
    }
}

?>