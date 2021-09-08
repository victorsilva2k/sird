<?php

class Documentos extends Controller{

    protected function Index()
    {

        $this->verificarNivel(1);
        header('Location: ' . ROOT_URL . 'documentos/listar');

    }
    protected function listar()
    {
        echo $estado = $this->param;
        if (stristr($this->param, '?')) {
            $parametros = explode($this->param, "pagina");
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