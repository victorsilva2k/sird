<?php

class Documentos extends Controller{
    protected function Index()
    {
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->Index(), true);
    }
}