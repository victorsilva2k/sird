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
        $this->query('SELECT d.id_distrito, d.distrito, m.municipio FROM distrito d JOIN municipio m ON d.municipio = m.id_municipio');
        $row["distritos"] = $this->resultSet();
        return $row;
    }


}