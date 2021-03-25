<?php

class agentes extends Controller{
    
    protected function index()
    {
        $this->verificarNivel("comando");
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->index(), true);
    } 
    protected function adicionar()
    {
        $this->verificarNivel("comando");
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->adicionar(), true);
    }

    protected function cadastros()
    {
        $this->verificarNivel("comando");
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->cadastros(), true);
    }
    protected function permitir()
    {
        $this->verificarNivel("comando");
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->permitir($this->param), true);
    }
    protected function rejeitar()
    {
        $this->verificarNivel("comando");
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->rejeitar($this->param), true);
    }
    protected function Entrar()
    {

        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->Entrar(), true);

    }
    protected function sair()
    {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['dados_usuario']);
        unset($_SESSION['usuario_local']);
        session_destroy();
        header('Location: ' .ROOT_URL. 'agentes/entrar');
    }
    protected function cadastrar()
    {
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->cadastrar(), true);
    }
    protected function aguardar()
    {
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->aguardar(), true);
    }


}