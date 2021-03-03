<?php
// Classe base para os controladores
abstract class Controller{

    // Propiedades
    protected $request;
    protected $action;
    protected $id;

    // Functions
    // Pega a acao e os dados da url
    public function __construct($action, $param, $request) {
        
        $this->request = $request;
        $this->action = $action;
        $this->param = $param;

    }


    public function executeAction()
    {
        
        return $this->{$this->action}($this->param);
            

    }

    public function rangeResults($query)
    {
        
        $start = $this->param * 20;
        $end = $start * 2;
            

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