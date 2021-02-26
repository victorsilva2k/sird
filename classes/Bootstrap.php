<?php
// Classe que dá ínicio ao programa, carrega a classes, e metodos
class Bootstrap{

    //Properties

    private $controller;
    private $action;
    private $request;

    public function __construct($request) {
        $this->request = $request;
        if ($this->request['controller'] == "") {
            
            $this->controller = "home";

        } else{

            $this->controller = $this->request['controller'];
      
            
            
        }
        if ($this->request['action'] == "") {
            
            $this->action = "index";

        } else{
            
            $this->action = $this->request['action'];
            
        }
        
    }

    // Verifica se um controlador ou classe existe e o executa
    public function createController()
    {
        //Check Class
        if(class_exists($this->controller)){
            $parents = class_parents($this->controller);
            // Check Extend
            if(in_array("Controller", $parents)){
                if (method_exists($this->controller, $this->action)) {
                    return new $this->controller($this->action, $this->request);
                    
                } else {
                    //Method does not exist
                    echo "<h1> Method does not exists</h1>";
                    return;
                }
            } else {
                //Base controller does not exist

                echo "<h1> Base controller does not exists</h1>";
                return;

            }
        
        }else {
                //Controller Class does not exist

                echo "<h1> Controller Class does not exists</h1>";
                return;

        }
    }
    

}