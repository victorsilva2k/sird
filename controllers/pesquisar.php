<?php

class Pesquisar extends Controller{
    protected function Index()
    {
        $viewmodel = new PesquisarModel();
        $this->returnView($viewmodel->Index(), true);
    }
}