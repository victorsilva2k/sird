<?php

class ComandoModel extends Model{
    public function Index()
    {
        $this->query('SELECT * FROM comando_municipal_informacao;');
        $row = $this->resultSet();
        return $row;
    }
    public function Editar()
    {
        $this->query('SELECT * FROM comando_municipal_informacao;');
        $row = $this->resultSet();
    
        return $row;    

        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        var_dump($post);
        
        if (isset($post['submit'])) {
            extract($post);
            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($cm_provincia == '' || $cm_municipio == '' || $cm_distrito == '' || $cm_bairro == '' || $cm_rua == '' ) {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }
            // Alterando os dados de localização do comando municipal
            $this->query("UPDATE UPDATE comando_municipal_localizacao SET provincia = :PROVINCIA, municipio = :MUNICIPIO, distrito = :DISTRITO, bairro = :BAIRRO, rua = :RUA  WHERE id_cm = ID_CM");
            $this->bind(':PROVINCIA', $cm_provincia);
            $this->bind(':MUNICIPIO', $cm_municipio);
            $this->bind(':DISTRITO', $cm_distrito);
            $this->bind(':BAIRRO', $cm_bairro);
            $this->bind(':RUA', $cm_rua);
            $this->execute();
            //Verify
            if ($this->lastInsertId()) {
                //Redirect  
                header('Location: ' . ROOT_URL . 'comando');
            }

        }
        return;
    }
}