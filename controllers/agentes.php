<?php

class agentes extends Controller{
    protected function Index()
    {
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->Index(), true);
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
        session_destroy();
        header('Location: ' .ROOT_URL. 'agentes/entrar');
    }
    protected function Cadastrar()
    {
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->Cadastrar(), true);
    }


}