<?php

class Categorias extends Controller{
    protected function index()
    {
        $viewmodel = new CategoriaModel();
        $this->returnView($viewmodel->index(), true);
    }

    protected function adicionar()
    {
        $viewmodel = new CategoriaModel();
        $this->returnView($viewmodel->adicionar(), true);
    }

    protected function editar()
    {
        $viewmodel = new CategoriaModel();
        $this->returnView($viewmodel->editar($this->param), true);
    }

    protected function eliminar()
    {

        $viewmodel = new CategoriaModel();
        $this->returnView($viewmodel->eliminar($this->param), true);
    }
}