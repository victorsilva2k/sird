<?php

class MaisModel extends Model{
    public function Index()
    {
        // Pegando dados das categorias de documentos
        $this->query('SELECT * FROM categoria_documento;');
        $row["categorias"] = $this->resultSet();

        // Pegando dados dos bairros
        $this->query('select * from bairro;');
        $row["bairros"] = $this->resultSet();
        return $row;
    }


}