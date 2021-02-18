<?php

class Inicio extends Controller{
    protected function Index()
    {
        $viewmodel = new InicioModel();
        $this->returnView($viewmodel->Index(), true);
    }
}