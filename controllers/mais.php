<?php

class Mais extends Controller{
    protected function index()
    {
        $viewmodel = new MaisModel();
        $this->returnView($viewmodel->index(), true);
    }


}