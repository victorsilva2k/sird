<?php

class Distritos extends Controller{
    protected function index()
    {
        $this->verificarNivel(1);
        $viewmodel = new DistritoModel();
        $this->returnView($viewmodel->index(), true);
    }

    protected function adicionar()
    {
        $this->verificarNivel(1);
        $viewmodel = new DistritoModel();
        $this->returnView($viewmodel->adicionar(), true);
    }

    protected function editar()
    {
        $this->verificarNivel(1);
        $viewmodel = new DistritoModel();
        $this->returnView($viewmodel->editar($this->param), true);
    }

    protected function eliminar()
    {

        $this->verificarNivel(1);
        $viewmodel = new DistritoModel();
        $this->returnView($viewmodel->eliminar($this->param), true);
    }
}