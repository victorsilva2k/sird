<?php
// Classe base para os controladores
abstract class Controller{

    // Propiedades
    protected $request;
    protected $action;

    // Functions
    // Pega a acao e os dados da url
    public function __construct($action, $request) {
        
        $this->request = $request;
        $this->action = $action;

    }


    public function executeAction()
    {
        return $this->{$this->action}();
    }
    // Retorna ou mostra uma view
    protected function returnView($viewmodel, $fullview)
    {
        $view = 'views/' . get_class($this) . '/' . $this->action . '.php';

        if ($fullview) {
            require_once "views/main.php";
        } else {
            require_once $view;
        }
    }
}