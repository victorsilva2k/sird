<?php
// Classe que dá ínicio ao programa, carrega a classes, e metodos
class Bootstrap{

    //Properties

    private $controller;
    private $action;
    private $request;
    private $param = [];

    public function __construct($request) {
        $this->request = $request;
        if ($this->request['controller'] == "") {

            $this->controller = "inicio";

        } else{

            $this->controller = $this->request['controller'];

      
            
            
        }
        if ($this->request['action'] == "") {
            
            $this->action = "index";

        } else{
            
            $this->action = $this->request['action'];
            
        }
        if ($this->request['param'] == "") {
            
            $this->param = NULL;

        } else{
            
            $this->param = $this->request['param'];

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
                    return new $this->controller($this->action, $this->param, $this->request);
                    
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
    
    protected function convertToStudlyCaps($string) {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    protected function convertToCamelCase($string)
    {
        lcfirst($this->convertToStudlyCaps($string));
    }

    protected function convertStrings($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z]+)', $route);

        // Convert variables with custom regular expressions e.g {id:\d+}
        $route = preg_replace('/|{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimeters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        
    }

}