<?php

class ComandoMunicipal extends Controller{
    protected function Index()
    {
        $this->verificarNivel(1);
        $viewmodel = new ComandoMunicipalModel();
        $this->returnView($viewmodel->mostrarComando(), true);
    }

    protected function Editar()
    {
        $this->verificarNivel(2);
        $viewmodel = new ComandoMunicipalModel();
        $this->returnView($viewmodel->Editar($this->param), true);
    }
}