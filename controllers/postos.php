<?php

class Postos extends Controller{

    protected function Index()
    {
        $viewmodel = new PostoModel();
        $this->returnView($viewmodel->index(), true);
    }

    protected function ver()
    {
        $this->verificarNivel("comando");
        $viewmodel = new PostoModel();
        $this->returnView($viewmodel->ver($this->param), true);
    }
    protected function Editar()
    {
        $this->verificarNivel("comando");
        $viewmodel = new PostoModel();
        $this->returnView($viewmodel->Editar($this->param), true);
    }

    protected function eliminar()
    {
        $this->verificarNivel("comando");
        $viewmodel = new PostoModel();
        $this->returnView($viewmodel->eliminar($this->param), true);
    }

    protected function adicionar()
    {
        $this->verificarNivel("comando");
        $viewmodel = new PostoModel();
        $this->returnView($viewmodel->adicionar(), true);
    }
}
