<?php

class Shares extends Controller{
    protected function Index()
    {
        $viewmodel = new ShareModel();
        $this->returnView($viewmodel->Index(), true);
    }

    protected function add()
    {
        $viewmodel = new ShareModel();
        $this->returnView($viewmodel->add(), true);
    }

    public function logout()
    {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL);
        }

        $viewmodel = new ShareModel();
        $this->returnView($viewmodel->logout(), true);
    }
}