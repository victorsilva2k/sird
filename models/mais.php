<?php

class MaisModel extends Model{
    public function Index()
    {
        // Pegando dados das categorias de documentos
        $this->query('SELECT * FROM categoria_documento;');
        $row["categorias"] = $this->resultSet();

        // Pegando dados dos bairros
        $this->query('select b.id_bairro, b.bairro, d.distrito from bairro b 
                            JOIN distrito d ON d.id_distrito = b.distrito ;');
        $row["bairros"] = $this->resultSet();


        // Pegando dados dos distritos
        $this->query('select * from distrito;');
        $row["distritos"] = $this->resultSet();
        return $row;
    }


}