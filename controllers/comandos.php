<?php

class Comando extends Controller{
    protected function Index()
    {
        $viewmodel = new ComandoModel();
        $this->returnView($viewmodel->mostrarComando(), true);
    }

    protected function Editar()
    {
        
        $viewmodel = new ComandoModel();
        $this->returnView($viewmodel->Editar($this->param), true);
    }
}