<?php

class Documentos extends Controller{

    protected function Index()
    {
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->Index(), true);
    }
    public function Editar()
    {
        
        
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->Editar($this->param), true);
        
    }
}