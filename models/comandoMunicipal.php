<?php

class ComandoMunicipalModel extends Model{
    public function Index()
    {
        if(Controller::verificarLugar(3)) {
            // TODO
            $this->query('select * from listar_comandos;');
            $row = $this->resultSet();
            return $row;
        } else {
          $this->query('SELECT * FROM comando_municipal_informacao;');
            $row = $this->resultSet();
            return $row;  
        }
        
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

            
            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($editarComandoDistrito == '' || $editarComandoBairro == '' || $editarComandoRua == '' ) {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }
            
            
            try {
                $this->beginTransaction();

                // Alterando os dados de localização do comandosmunicipais municipal
                $this->query("UPDATE comando_municipal_localizacao SET distrito = :DISTRITO, bairro = :BAIRRO, rua = :RUA  WHERE id_cm = :ID_CM");

                $this->bind(':DISTRITO', $editarComandoDistrito);
                $this->bind(':BAIRRO', $editarComandoBairro);
                $this->bind(':RUA', $editarComandoRua);
                $this->bind(':ID_CM', $_SESSION['usuario_local']['id_local']);
                $this->execute();

                // Registrando a alteração
                $this->query("INSERT INTO `sird-db`.`operacao_comando_municipal` (`id_operacao`, `id_agente`, `id_cm`, `tipo`, `data`) VALUES(NULL, :ID_AGENTE, :ID_CM, 2, CURRENT_TIMESTAMP);");
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                $this->bind(':ID_CM', $_SESSION['usuario_local']['id_local']);
                $this->execute();

                $this->commit();
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde", "error");

            }
            //Verify

            if ($this->rowCounte() >= 1) {
                //Redirect  
                Messages::setMessage("Edição feita com sucesso", "success");
                header('Location: ' . ROOT_URL . 'comandosmunicipais');
            }
            
        }
        $this->query('SELECT * FROM comando_municipal_informacao;');
        $row["comando_municipal"] = $this->resultSet();

        $this->query('select * from distrito');
        $row["distritos"] = $this->resultSet();

        $this->query('select * from bairro ;');
        $row["bairros"] = $this->resultSet();
    
        return $row;  
    }
}