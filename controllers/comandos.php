<?php

class Comando extends Controller{
    protected function Index()
    {
        $this->verificarNivel(1);
        $viewmodel = new ComandoModel();
        $this->returnView($viewmodel->mostrarComando(), true);
    }

    protected function Editar()
    {
        $this->verificarNivel(2);
        $viewmodel = new ComandoModel();
        $this->returnView($viewmodel->Editar($this->param), true);
    }
}