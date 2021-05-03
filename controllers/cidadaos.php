<?php

class Cidadaos extends Controller{

    protected function Index()
    {

        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->cidadao(), true);
        
    }

    protected function ver()
    {
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->verCidadao($this->param), true);
    }

    protected function pesquisar()
    {
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->pesquisar(), true);
    }

}