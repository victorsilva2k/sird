<?php

class Documentos extends Controller{

    protected function Index()
    {
        $this->verificarNivel(1);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->Index(), true);
    }

    protected function ver()
    {
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->ver($this->param), true);
    }
    public function Editar()
    {
        
        $this->verificarNivel(1);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->Editar($this->param), true);
        
    }

    public function publicar()
    {
        
        $this->verificarNivel(1);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->publicar(), true);
        
    }
}