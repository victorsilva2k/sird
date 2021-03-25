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

    public function verificarNivel($nivel){

        if (isset($_SESSION['usuario_local'])) {

            if (!($_SESSION['usuario_local']['tipo_local'] == $nivel)) {
                Messages::setMessage("Você não tem permissão para executar esta acção", "error");
                header('Location: ' . ROOT_URL);
            }
        } else {

            header('Location: ' . ROOT_URL);

        }
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
            $data = ucwords(utf8_encode(strftime("%e de %B de %G", $ts)));
            $hora = utf8_encode(strftime("%H:%M", $ts));
            $tempo = "$data ás $hora";

        } else {
            $tempo = utf8_encode(strftime("%e de %B de %G", $ts));
        }
        return $tempo;
    }
}