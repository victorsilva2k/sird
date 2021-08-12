<?php

class ComandoNacional extends Controller{
    protected function Index()
    {
        $this->verificarNivel(4);
        $viewmodel = new ComandoNacionalModel();
        $this->returnView($viewmodel->index(), true);
    }
    
    protected function Editar()
    {
        $this->verificarNivel(4);
        $viewmodel = new ComandoNacionalModel();
        $this->returnView($viewmodel->Editar($this->param), true);
    }

    protected function adicionar()
    {
        $this->verificarNivel(4);
        $viewmodel = new ComandoNacionalModel();
        $this->returnView($viewmodel->adicionar(), true);
    }
}


