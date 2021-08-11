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
            switch ($_SESSION['usuario_local']['tipo_local']) {
                case "posto":
                    $nivel_num = 1;
                    break;
                case "comando_municipal":
                    $nivel_num = 2;
                    break;
                case "comando_provincial":
                    $nivel_num = 3;
                    break;
                case "comando_nacional":
                    $nivel_num = 4;
                    break;
                default:
                    $nivel_num = 0;
            }
            if (!($nivel_num >= $nivel)) {
                Messages::setMessage("Você não tem permissão para executar esta acção", "error");
                header('Location: ' . ROOT_URL);
            }
        } else {

            header('Location: ' . ROOT_URL);

        }
    }

    public static function verificarLugar($nivel, $uni = NULL){

        if (isset($_SESSION['usuario_local'])) {
            switch ($_SESSION['usuario_local']['tipo_local']) {
                case "posto":
                    $nivel_num = 1;
                    break;
                case "comando_municipal":
                    $nivel_num = 2;
                    break;
                case "comando_provincial":
                    $nivel_num = 3;
                    break;
                case "comando_nacional":
                    $nivel_num = 4;
                    break;
                default:
                    $nivel_num = 0;
            }
            if ($uni == false) {
                if (($nivel_num >= $nivel)) {
                    return true;
                    
                } else {
                    return false;
                }
            
            }else {
                if (($nivel_num === $nivel)) {
                    return true;
                    
                } else {
                    return false;
                }
            }
    }
}
    public function verificarParametro(){

        if (!isset($this->param)) {
            $this->action = "index";
            header('Location: ' . ROOT_URL);

            
        } 
    }

    public function verificarRepeticao($string){

        $str = implode(',',array_unique(explode(',', $string)));
        return $str;
    }

    public function pegarPrimeiro($array = []){
        $exp = explode(",", $array);
        return $exp[0];
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
            $tempo = "$data às $hora";

        } else {
            $tempo = utf8_encode(strftime("%e de %B de %G", $ts));
        }
        return $tempo;
    }
}