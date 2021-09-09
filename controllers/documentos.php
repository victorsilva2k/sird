<?php

class Documentos extends Controller{

    protected function Index()
    {

        $this->verificarNivel(1);
        header('Location: ' . ROOT_URL . 'documentos/listar');

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

    protected function pesquisar()
    {
        $this->verificarNivel(1);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->pesquisar(), true);
    }

    protected function ver()
    {
        $this->verificarNivel(1);
        $this->verificarParametro();
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->verAgente($this->param), true);
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