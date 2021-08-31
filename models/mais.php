<?php

class MaisModel extends Model{
    public function Index($param)
    {
        


        switch ($param) {
            case 'bairro':
                
                // Pegando dados dos bairros
                $this->query('SELECT b.id_bairro, b.bairro, d.distrito from bairro b 
                JOIN distrito d ON d.id_distrito = b.distrito ORDER BY bairro;');
                $row["bairros"] = $this->resultSet();

                // Pegando dados dos distritos
                $this->query('SELECT d.id_distrito, d.distrito, m.municipio FROM distrito d JOIN municipio m ON d.municipio = m.id_municipio');
                $row["distritos"] = $this->resultSet();


                break;
                case 'municipio':
                     // Pegando dados dos municipios
                    $this->query('SELECT m.id_municipio, m.municipio, p.provincia FROM municipio m JOIN provincia p ON m.provincia = p.id_provincia ORDER BY m.municipio;');
                    $row["municipios"] = $this->resultSet();


                    // Pegando dados dos distritos
                    $this->query('SELECT * FROM provincia ORDER BY provincia');
                    $row["provincias"] = $this->resultSet();
                    break;
                    case 'categoria':
                        // Pegando dados das categorias de documentos
                        $this->query('SELECT * FROM categoria_documento ORDER BY categoria;');
                        $row["categorias"] = $this->resultSet();
                        break;
            
            default:
                // Pegando dados dos bairros
                $this->query('SELECT b.id_bairro, b.bairro, d.distrito from bairro b 
                JOIN distrito d ON d.id_distrito = b.distrito ORDER BY bairro;');
                $row["bairros"] = $this->resultSet();

                // Pegando dados dos distritos
                $this->query('SELECT d.id_distrito, d.distrito, m.municipio FROM distrito d JOIN municipio m ON d.municipio = m.id_municipio');
                $row["distritos"] = $this->resultSet();
                break;
        }

        return $row;
    }


}