<?php

class MaisModel extends Model{
    public function Index()
    {
        // Pegando dados das categorias de documentos
        $this->query('SELECT * FROM categoria_documento ORDER BY categoria;');
        $row["categorias"] = $this->resultSet();

        // Pegando dados dos bairros
        $this->query('SELECT b.id_bairro, b.bairro, d.distrito from bairro b 
                            JOIN distrito d ON d.id_distrito = b.distrito ORDER BY bairro;');
        $row["bairros"] = $this->resultSet();


        // Pegando dados dos distritos
        $this->query('SELECT * FROM distrito ORDER BY distrito;');
        $row["distritos"] = $this->resultSet();
        return $row;
    }


}