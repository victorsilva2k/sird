<?php

class Categorias extends Controller{

    protected function adicionar()
    {
        $this->verificarNivel(1);
        $viewmodel = new CategoriaModel();
        $this->returnView($viewmodel->adicionar(), true);
    }

    protected function editar()
    {
        $this->verificarNivel(1);
        $viewmodel = new CategoriaModel();
        $this->returnView($viewmodel->editar($this->param), true);
    }

    protected function eliminar()
    {
        $this->verificarNivel(1);

        $viewmodel = new CategoriaModel();
        $this->returnView($viewmodel->eliminar($this->param), true);
    }
}