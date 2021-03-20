<?php

class agentes extends Controller{
    protected function Index()
    {
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->Index(), true);
    }
    protected function Login()
    {
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->Login(), true);
    }
    protected function Cadastrar()
    {
        $viewmodel = new AgenteModel();
        $this->returnView($viewmodel->Cadastrar(), true);
    }


}