<?php

class ComandosProvinciais extends Controller{
    protected function Index()
    {
        $this->verificarNivel(1);
        $viewmodel = new ComandoProvincialModel();
        $this->returnView($viewmodel->index(), true);
    }
    
    protected function Editar()
    {
        $this->verificarNivel(2);
        $viewmodel = new ComandoProvincialModel();
        $this->returnView($viewmodel->Editar($this->param), true);
    }
    protected function ver()
    {
        $this->verificarNivel(2);
        $viewmodel = new ComandoProvincialModel();
        $this->returnView($viewmodel->ver($this->param), true);
    }

    protected function adicionar()
    {
        $this->verificarNivel(3);
        $viewmodel = new ComandoProvincialModel();
        $this->returnView($viewmodel->adicionar(), true);
    }
}


