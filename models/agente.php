<?php

class agenteModel extends Model{
    public function Index()
    {
        $this->query('SELECT * FROM comando_municipal_informacao;');
        $row = $this->resultSet();
        return $row;
    }
    public function Login()
    {
        
        return;
    }

    public function Cadastrar()
    {
        
        return;
    }
    public function Editar()
    {
          

        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        
        if (isset($post['submit'])) {
        
            extract($post);
            $id_cm = 1;//HACK dado deve ser automatico, aprender sobre  transações
            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($cm_provincia == '' || $cm_municipio == '' || $cm_distrito == '' || $cm_bairro == '' || $cm_rua == '' ) {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }
            // Alterando os dados de localização do comando municipal
            $this->query("UPDATE comando_municipal_localizacao SET provincia = :PROVINCIA, municipio = :MUNICIPIO, distrito = :DISTRITO, bairro = :BAIRRO, rua = :RUA  WHERE id_cm = :ID_CM");
            $this->bind(':PROVINCIA', $cm_provincia);
            $this->bind(':MUNICIPIO', $cm_municipio);
            $this->bind(':DISTRITO', $cm_distrito);
            $this->bind(':BAIRRO', $cm_bairro);
            $this->bind(':RUA', $cm_rua);
            $this->bind(':ID_CM', $id_cm);//HACK esse valor deve vir de uma consulta relacional do agente para o posto e do posto para o comando municipal
            $this->execute();
            //Verify

            if ($this->rowCounte() >= 1) {
                //Redirect  
                header('Location: ' . ROOT_URL . 'comando');
            }
            
        }
        $this->query('SELECT * FROM comando_municipal_informacao;');
        $row = $this->resultSet();
    
        return $row;  
    }
}