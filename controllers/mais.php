<?php

class Mais extends Controller{
    protected function index()
    {
        $this->verificarNivel(1);
        $viewmodel = new MaisModel();
        $this->returnView($viewmodel->index(), true);
    }


}