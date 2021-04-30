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
        $pagina = $this->param;
        $inicio = 1;
        $fim = 20;
        if (isset($pagina)) {
            
            if ($pagina > 1) {
                $inicio = ($pagina - 1) * 20; 
                $fim = $pagina * 20; 
                
            }

            
        }
        
        $viewmodel = new InicioModel();
        $this->returnView($viewmodel->Cidadao($inicio, $fim), true);
    }
}