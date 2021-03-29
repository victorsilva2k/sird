<?php

class Bairros extends Controller{
    protected function index()
    {
        $viewmodel = new BairroModel();
        $this->returnView($viewmodel->index(), true);
    }

    protected function adicionar()
    {
        $viewmodel = new BairroModel();
        $this->returnView($viewmodel->adicionar(), true);
    }

    protected function editar()
    {
        $viewmodel = new BairroModel();
        $this->returnView($viewmodel->editar($this->param), true);
    }

    protected function eliminar()
    {

        $viewmodel = new BairroModel();
        $this->returnView($viewmodel->eliminar($this->param), true);
    }
}