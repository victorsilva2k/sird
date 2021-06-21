<?php

class InicioModel extends Model{
    public function Index()
    {
        
    }
    public function Cidadao()
    {
        $this->query('SELECT DISTINCT pd.nome_completo, pd.id_proprietario, group_concat(cd.categoria) AS categorias, group_concat(fd.arquivo) AS fotos
                    FROM propietario_documento pd 
                    JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
                    JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
                    JOIN foto_documento fd ON d.id_documento = fd.id_documento
                    WHERE d.estado = 1 GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC ');
     
        $row = $this->resultSet();
        return $row;
    }
    public function Agente()
    {
        $this->query('SELECT * FROM ver_documento_principal');
        
        $row['documentos'] = $this->resultSet();
        if ($_SESSION['usuario_local']['tipo_local'] === 'comando') {
            $this->query('SELECT * FROM estatisticas_comando_municipal');
        }
        
        else {
            
            $this->query("SELECT COUNT(*) AS total_documentos
                            FROM propietario_documento pd 
                            JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
                            JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
                            WHERE ld.tipo_local LIKE '%posto%' AND ld.id_local = :ID_POSTO AND d.estado = 1
                            UNION
                            SELECT COUNT(*) AS total_documentos
                            FROM propietario_documento pd 
                            JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
                            JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
                            WHERE ld.tipo_local LIKE '%posto%' AND ld.id_local = :ID_POSTO AND d.estado = 3;");
            $this->bind(':ID_POSTO', $_SESSION['usuario_local']['id_local']);            
        }

        $row['estatisticas'] = $this->resultSet();
        return $row;
    }
}