<?php

class InicioModel extends Model{
    public function Index()
    {
        
    }
    public function Cidadao($inicio, $fim)
    {
        $this->query('SELECT DISTINCT pd.nome_completo, pd.id_proprietario, group_concat(cd.categoria) AS categorias, group_concat(fd.arquivo) AS fotos
                    FROM propietario_documento pd 
                    JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
                    JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
                    JOIN foto_documento fd ON d.id_documento = fd.id_documento
                    WHERE d.estado = 1 GROUP BY pd.id_proprietario LIMIT :INICIO, :FIM ;');
        $this->bind(':INICIO', $inicio);            
        $this->bind(':FIM', $fim);            
        $row = $this->resultSet();
        return $row;
    }
    public function Agente()
    {
        $this->query('SELECT DISTINCT pd.nome_completo, 
                    pd.id_proprietario, group_concat(cd.categoria) AS categorias
                    FROM propietario_documento pd 
                    JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
                    JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
                    WHERE d.estado = 1 GROUP BY pd.id_proprietario LIMIT 10');
        $row['perdidos'] = $this->resultSet();

        $this->query('SELECT DISTINCT pd.nome_completo, 
                    pd.id_proprietario, group_concat(cd.categoria) AS categorias
                    FROM propietario_documento pd 
                    JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
                    JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
                    WHERE d.estado = 2 GROUP BY pd.id_proprietario LIMIT 10');
        $row['devolvidos'] = $this->resultSet();
        return $row;
    }
}