<?php

class Comando extends Controller{
    protected function Index()
    {
        $viewmodel = new ComandoModel();
        $this->returnView($viewmodel->Index(), true);
    }

    protected function Editar()
    {
        
        $viewmodel = new ComandoModel();
        $this->returnView($viewmodel->Editar($this->param), true);
    }
}