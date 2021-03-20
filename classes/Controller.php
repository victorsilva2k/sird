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
    // Trata ou transforma uma data normal do php em uma data legivel
    protected function tratarData($tempo, $hora = false)
    {
        // recebe uma data e calcula quanto tempo se passou até a data presente
        $ts = strtotime($tempo);
    
        if ($hora) {
            $tr = strftime("%e de %B de %G ás %H:%M", $ts);
        } else {
            $tr = strftime("%e de %B de %G", $ts);
        }
        return $tr;
    }
}