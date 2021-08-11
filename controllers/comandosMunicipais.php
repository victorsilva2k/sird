<?php

class ComandosMunicipais extends Controller{
    protected function Index()
    {
        $this->verificarNivel(2);
        $viewmodel = new ComandoMunicipalModel();
        $this->returnView($viewmodel->index(), true);
    }
    
    protected function Editar()
    {
        $this->verificarNivel(2);
        $viewmodel = new ComandoMunicipalModel();
        $this->returnView($viewmodel->Editar($this->param), true);
    }
    protected function ver()
    {
        $this->verificarNivel(2);
        $viewmodel = new ComandoMunicipalModel();
        $this->returnView($viewmodel->ver($this->param), true);
    }

    protected function adicionar()
    {
        $this->verificarNivel(3);
        $viewmodel = new ComandoMunicipalModel();
        $this->returnView($viewmodel->adicionar(), true);
    }
}


