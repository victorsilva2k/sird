<?php

class agentes extends Controller{
    
    protected function index()
    {
        $this->verificarNivel(2);
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->index(), true);
    }

    protected function perfil()
    {
        $this->verificarNivel(1);
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->perfil(), true);
    }

    protected function cadastros()
    {
        $this->verificarNivel(2);
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->cadastros(), true);
    }

    protected function alteracoes()
    {
        $this->verificarNivel(2);
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->alteracoes(), true);
    }
    protected function permitir()
    {
        $this->verificarNivel(2);
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->permitirCadastro($this->param), true);
    }
    protected function rejeitar()
    {
        // TODO verificiar se esse metodo ainda funciona bem uma vez que foi refactorado
        $this->verificarNivel(2);
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->rejeitarCadastro($this->param), true);
    }
    protected function Entrar()
    {

        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->Entrar(), true);

    }
    protected function sair()
    {
        unset($_SESSION['is_logged_in'], $_SESSION['dados_usuario'], $_SESSION['usuario_local']);
        session_destroy();
        header('Location: ' .ROOT_URL. 'agentes/entrar');
    }
    protected function cadastrar()
    {

        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->cadastrar(), true);
    }
    protected function editar()
    {
        $this->verificarNivel(2);
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->editar(), true);
    }
    protected function negaralteracao()
    {
        $this->verificarNivel(2);
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->negaralteracao($this->param), true);
    }
    protected function permitiralteracao()
    {
        $this->verificarNivel(2);
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->permitiralteracao($this->param), true);
    }

    protected function alterar()
    {
        $this->verificarNivel(1);
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->alterar(), true);
    }
    protected function aguardar()
    {
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->aguardar($this->param), true);
    }


}