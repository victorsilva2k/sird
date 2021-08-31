<?php

class Municipios extends Controller{
    protected function index()
    {
        $this->verificarNivel(1);
        $viewmodel = new MunicipioModel();
        $this->returnView($viewmodel->index(), true);
    }

    protected function adicionar()
    {
        $this->verificarNivel(1);
        $viewmodel = new MunicipioModel();
        $this->returnView($viewmodel->adicionar(), true);
    }

    protected function editar()
    {
        $this->verificarNivel(1);
        $viewmodel = new MunicipioModel();
        $this->returnView($viewmodel->editar($this->param), true);
    }

    protected function eliminar()
    {

        $this->verificarNivel(1);
        $viewmodel = new MunicipioModel();
        $this->returnView($viewmodel->eliminar($this->param), true);
    }
}