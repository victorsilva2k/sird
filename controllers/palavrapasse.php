<?php

class PalavraPasse extends Controller{


    protected function pedir()
    {
        $viewmodel = new PalavraPasseModel();
        $this->returnView($viewmodel->pedir(), true);
    }

    protected function index()
    {

        $this->verificarNivel(2);
        $viewmodel = new PalavraPasseModel();
        $this->returnView($viewmodel->index(), true);
    }
    protected function negar()
    {

        $this->verificarNivel(2);
        $viewmodel = new PalavraPasseModel();
        $this->returnView($viewmodel->negar($this->param), true);
    }
    protected function actualizar()
    {

        $viewmodel = new PalavraPasseModel();
        $this->returnView($viewmodel->actualizar($this->param), true);
    }
    protected function permitir()
    {
        $this->verificarNivel(2);
        $viewmodel = new PalavraPasseModel();
        $this->returnView($viewmodel->permitir($this->param), true);
    }
}