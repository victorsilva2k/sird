<?php

class DocumentosModel extends Model{
    public function Index()
    {
        return;
    }
    public function Editar($param)
    {
        
        $this->query('SELECT * FROM comando_municipal_informacao WHERE id_cm = :ID_CM');
        $this->bind(':ID_CM', $param);
        $row = $this->resultSet();
        return $row;  
    }
}