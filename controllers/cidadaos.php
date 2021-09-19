<?php

class Cidadaos extends Controller{

    protected function Index()
    {

        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->cidadao(), true);
        
    }

    protected function ver()
    {
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->ver($this->param), true);
    }

    protected function pesquisar()
    {
       
        // separa o GET['pesquisar'] do url normal
        $string =  substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "?") + 1);
        // separa a parte da pesquisa da url acima
        $pesquisa_request = substr($string, strpos($string, "=") + 1);
        $pesquisa_string = explode("?", $pesquisa_request);
        $pesquisar = $pesquisa_string[0];
        $pagina = substr($pesquisa_request, strpos($pesquisa_request, "=") + 1);
        $limites = $this->paginar($pagina);
        extract($limites);
        $viewmodel = new DocumentosModel();
        $this->returnView($viewmodel->pesquisar($pesquisar, $limite_inicial, $limite_final, $pagina), true);
    }

}