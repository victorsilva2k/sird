<?php

class Oficiais extends Controller{
    protected function Index()
    {
        $viewmodel = new OficialModel();
        $this->returnView($viewmodel->Index(), true);
    }
    protected function Login()
    {
        $viewmodel = new OficialModel();
        $this->returnView($viewmodel->Login(), true);
    }
    protected function Cadastrar()
    {
        $viewmodel = new OficialModel();
        $this->returnView($viewmodel->Cadastrar(), true);
    }


}