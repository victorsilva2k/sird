<?php

class Postos extends Controller{

    protected function Index()
    {
        $this->verificarNivel(1);
        $viewmodel = new PostoModel();
        $this->returnView($viewmodel->index(), true);
    }

    protected function ver()
    {
        $this->verificarNivel(2);
        $viewmodel = new PostoModel();
        $this->returnView($viewmodel->ver($this->param), true);
    }
    protected function editar()
    {
        $this->verificarNivel(2);
        $viewmodel = new PostoModel();
        $this->returnView($viewmodel->Editar($this->param), true);
    }

    protected function eliminar()
    {
        $this->verificarNivel(2);
        $viewmodel = new PostoModel();
        $this->returnView($viewmodel->eliminar($this->param), true);
    }

    protected function escolher()
    {
        $this->verificarNivel(2);
        $viewmodel = new PostoModel();
        $this->returnView($viewmodel->escolher($this->param), true);
    }

    protected function adicionar()
    {
        $this->verificarNivel(2);
        $viewmodel = new PostoModel();
        $this->returnView($viewmodel->adicionar(), true);
    }

}
