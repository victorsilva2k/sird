<?php

class Inicio extends Controller{
    protected function Index()
    {

        
        if ($_SESSION['is_logged_in']) { 
            header('Location: ' . ROOT_URL . 'inicio/agente');
        } else {
            header('Location: ' . ROOT_URL . 'inicio/cidadao');
        }
        

    }

    protected function Agente()
    {
        $this->verificarNivel(1);
        $viewmodel = new InicioModel();
        $this->returnView($viewmodel->Agente(), true);
    }
    protected function Cidadao()
    {
        $viewmodel = new InicioModel();
        $this->returnView($viewmodel->Cidadao(), true);
    }
}