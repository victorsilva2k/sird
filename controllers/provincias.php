<?php

class Provincias extends Controller{


    protected function adicionar()
    {
        $this->verificarNivel(1);
        $viewmodel = new ProvinciaModel();
        $this->returnView($viewmodel->adicionar(), true);
    }

    protected function editar()
    {
        $this->verificarNivel(1);
        $viewmodel = new ProvinciaModel();
        $this->returnView($viewmodel->editar($this->param), true);
    }

}