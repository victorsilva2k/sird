<?php

class Documentos extends Controller{

    protected function Index()
    {

        $this->verificarNivel(1);
        header('Location: ' . ROOT_URL . 'documentos/recebidos');

    }
    protected function listar()
    {

    if (stristr($this->param, 'p')) {// HACK era suposto ele por mais uma barra e essa barra ser a pagina pro exemplo documentos/recebidos/1
        $parametros = explode("p", $this->param);
            $estado = $parametros[0];
            $pagina = $parametros[1];
            echo "$estado e $pagina";
        }
        switch ($estado) {
            case 'entregues':
                $estado = 3;
                break;
            case 'eliminados':
                $estado = 2;
                break;
            
            default:
                $estado = 1;

                break;
        }
        $this->verificarNivel(1);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->Index($estado, $pagina), true);
    }
    
    protected function recebidos()
    {
        $this->verificarNivel(1);
        $limites = $this->paginar($this->param);
        extract($limites);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->recebidos($limite_inicial, $limite_final), true);
    }
    protected function entregues()
    {
        $this->verificarNivel(1);
        $limites = $this->paginar($this->param);
        extract($limites);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->entregues($limite_inicial, $limite_final), true);
    }
    protected function eliminados()
    {
        $this->verificarNivel(1);
        $limites = $this->paginar($this->param);
        extract($limites);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->eliminados($limite_inicial, $limite_final), true);
    }

    protected function pesquisar()
    {
        $this->verificarNivel(1);
        // separa o GET['pesquisar'] do url normal
        $string =  substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "?") + 1);
        // separa a parte da pesquisa da url acima
        $pesquisa_request = substr($string, strpos($string, "=") + 1);
        $pesquisa_string = explode("?", $pesquisa_request);
        $pesquisar = $pesquisa_string[0];
        $pagina = substr($pesquisa_request, strpos($pesquisa_request, "=") + 1);
        $limites = $this->paginar($pagina);
        extract($limites);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->pesquisar($pesquisar, $limite_inicial, $limite_final, $pagina), true);
    }

    protected function ver()
    {
        $this->verificarNivel(1);
        $this->verificarParametro();
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->ver($this->param), true);
    }
    protected function devolver()
    {
        $this->verificarNivel(1);
        $this->verificarParametro();
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->devolver($this->param), true);
    }
    public function Editar()
    {
        
        $this->verificarNivel(1);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->Editar($this->param), true);
        
    }

    public function publicar()
    {
        
        $this->verificarNivel(1);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->publicar(), true);
        
    }

    public function eliminar()
    {
        
        $this->verificarNivel(1);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->eliminar($this->param), true);
        
    }
}