<?php

class Mais extends Controller{
    protected function index()
    {
        $viewmodel = new MaisModel();
        $this->returnView($viewmodel->index(), true);
    }

    protected function Editar()
    {
        
        $viewmodel = new ComandoModel();
        $this->returnView($viewmodel->Editar($this->param), true);
    }
}