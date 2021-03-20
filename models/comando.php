<?php

class ComandoModel extends Model{
    public function Index()
    {
        $this->query('SELECT * FROM comando_municipal_informacao;');
        $row = $this->resultSet();
        return $row;
    }
    public function mostrarComando()
    {
        $this->query('SELECT * FROM comando_municipal_informacao;');
        $row = $this->resultSet();
        return $row;
    }
    public function Editar()
    {
          

        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        
        if (isset($post['submit'])) {
        
            extract($post);
            $id_cm = 1;//HACK dado deve ser automatico
            $id_agente = 1;//HACK dado deve ser automatico
            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($cm_distrito == '' || $cm_bairro == '' || $cm_rua == '' ) {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }
            
            
            try {
                $this->beginTransaction();

                // Alterando os dados de localização do comando municipal
                $this->query("UPDATE comando_municipal_localizacao SET distrito = :DISTRITO, bairro = :BAIRRO, rua = :RUA  WHERE id_cm = :ID_CM");

                $this->bind(':DISTRITO', $cm_distrito);
                $this->bind(':BAIRRO', $cm_bairro);
                $this->bind(':RUA', $cm_rua);
                $this->bind(':ID_CM', $id_cm);//HACK esse valor deve vir de uma consulta relacional do agente para o posto e do posto para o comando municipal
                $this->execute();

                // Registrando a alteração
                $this->query("INSERT INTO `sird-db`.`operacao_comando_municipal` (`id_operacao`, `id_agente`, `id_cm`, `tipo`, `data`) VALUES(NULL, :ID_AGENTE, :ID_CM, 2, CURRENT_TIMESTAMP);");
                $this->bind(':ID_AGENTE', $id_agente);
                $this->bind(':ID_CM', $id_cm);//HACK esse valor deve vir de uma consulta relacional do agente para o posto e do posto para o comando municipal
                $this->execute();

                $this->commit();
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde", "error");

            }
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