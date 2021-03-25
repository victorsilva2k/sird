<?php

class PostoModel extends Model{
    public function Index()
    {

        if($_SESSION['usuario_local']['tipo_local'] === "comando") {

            $this->query('select * from listar_postos;');
            $row = $this->resultSet();
            return $row;
        } elseif($_SESSION['usuario_local']['tipo_local'] === "posto"){
            $this->query('SELECT * FROM ver_posto WHERE id_posto = :ID_POSTO');
            $this->bind(":ID_POSTO", $_SESSION['usuario_local']['id_local']);
            $row = $this->resultSet();
            return $row;
        }



    }

    public function adicionar()
    {




            //Limpando POST
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // INSERT MySQL

            if (isset($post['submit'])) {

                extract($post);

                // Caso o utizador não escrever ou deixar em branco um dos campos
                if ($adicionarPostoNome == '' || $adicionarPostoRua == '') {
                    Messages::setMessage("Por favor preencha todos os campos", "error");
                    return;
                }


                try {
                    $this->beginTransaction();

                    // Alterando os dados do posto
                    $this->query("INSERT INTO `sird-db`.`posto`
                                        (`id_posto`,
                                        `id_comando_municipal`,
                                        `tipo`,
                                        `nome`,
                                        `data_criacao`,
                                        `estado_actividade`)
                                        VALUES
                                        (null,
                                        :ID_CM,
                                        :TIPO,
                                        :NOME,
                                        CURRENT_TIMESTAMP,
                                        1)");

                    $this->bind(':ID_CM', $_SESSION['usuario_local']['id_local']);
                    $this->bind(':TIPO', $adicionarPostoTipo);
                    $this->bind(':NOME', $adicionarPostoNome);
                    $this->execute();

                    $id_posto = $this->lastInsertId();

                    // Alterando os dados de localização do posto
                    $this->query("INSERT INTO `sird-db`.`posto_localizacao`
                                        (`id_posto`,
                                        `distrito`,
                                        `bairro`,
                                        `rua`)
                                        VALUES
                                        (:ID_POSTO,
                                        :DISTRITO,
                                        :BAIRRO,
                                        :RUA)");

                    $this->bind(':DISTRITO', $adicionarPostoDistrito);
                    $this->bind(':BAIRRO', $adicionarPostoBairro);
                    $this->bind(':RUA', $adicionarPostoRua);
                    $this->bind(':ID_POSTO', $id_posto);
                    $this->execute();

                    // Registrando a alteração
                    $this->query("INSERT INTO `sird-db`.`operacao_posto` (`id_operacao`, `id_agente`, `id_posto`, `tipo`, `data`) VALUES(NULL, :ID_AGENTE, :ID_POSTO, 1, CURRENT_TIMESTAMP);");
                    $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                    $this->bind(':ID_POSTO', $id_posto);
                    $this->execute();

                    $this->commit();
                    if ($this->rowCounte() >= 1) {
                        //Redirect
                        Messages::setMessage("Posto adicionado com sucesso", "success");
                        header('Location: ' . ROOT_URL . 'postos');
                    }
                } catch (\PDOException $erro) {
                    $this->rollBack();

                    Messages::setMessage("Aconteceu um erro tente novamente mais tarde {$erro->getMessage()}", "error");

                }
                //Verify



            }
            $this->query('select * from bairro;');
            $row = $this->resultSet();
            return $row;



    }

    public function ver($id_posto)
    {


        if ($id_posto == 0 OR $id_posto == ""){
            Messages::setMessage("Posto não existente", "error");
            header('Location: ' . ROOT_URL . 'postos');

        } else {
            $this->query('SELECT * FROM ver_posto WHERE id_posto = :ID_POSTO');
            $this->bind(':ID_POSTO', $id_posto);

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
            $id_cm = 1;//HACK dado deve ser automatico
            
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
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
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
                Messages::setMessage("Edição feita com sucesso", "success");
                header('Location: ' . ROOT_URL . 'comando');
            }
            
        }
        $this->query('SELECT * FROM comando_municipal_informacao;');
        $row = $this->resultSet();
    
        return $row;  
    }
}