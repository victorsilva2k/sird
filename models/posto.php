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
            $this->bind(':ID_POSTO', $_SESSION['usuario_local']['id_local']);

            $row["posto"] = $this->resultSet();

            $this->query('SELECT op.tipo, op.data, a.nome, a.sobrenome
                        FROM `sird-db`.operacao_posto op 
                        JOIN agente a ON a.id_agente = op.id_agente
                        WHERE id_posto = :ID_POSTO');
            $this->bind(':ID_POSTO', $_SESSION['usuario_local']['id_local']);

            $row["alteracoes"] = $this->resultSet();
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

                    Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

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

            $row["posto"] = $this->resultSet();

            $this->query('SELECT op.tipo, op.data, a.nome, a.sobrenome
                        FROM `sird-db`.operacao_posto op 
                        JOIN agente a ON a.id_agente = op.id_agente
                        WHERE id_posto = :ID_POSTO');
            $this->bind(':ID_POSTO', $id_posto);

            $row["alteracoes"] = $this->resultSet();
            return $row;
        }




    }

    public function editar($id_posto)
    {
          

        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

        if (isset($post['submit'])) {

            extract($post);

            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($editarPostoNome == '' || $editarPostoRua == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Editando os dados de localização do posto
                $this->query("UPDATE `sird-db`.`posto_localizacao`
                                    SET
                                    `distrito` = :DISTRITO,
                                    `bairro` = :BAIRRO,
                                    `rua` = :RUA
                                    WHERE `id_posto` = :ID_POSTO;");
                $this->bind(':DISTRITO', $editarPostoDistrito);
                $this->bind(':BAIRRO', $editarPostoBairro);
                $this->bind(':RUA', $editarPostoRua);
                $this->bind(':ID_POSTO', $id_posto);
                $this->execute();

                // Editando os dados do posto
                $this->query("UPDATE `sird-db`.`posto`
                                    SET
                                    `tipo` = :TIPO,
                                    `nome` = :NOME
                                    WHERE `id_posto` = :ID_POSTO;");
                $this->bind(':ID_POSTO', $id_posto);
                $this->bind(':TIPO', $editarPostoTipo);
                $this->bind(':NOME', $editarPostoNome);
                $this->execute();



                // Registrando a alteração
                $this->query("INSERT INTO `sird-db`.`operacao_posto` (`id_operacao`, `id_agente`, `id_posto`, `tipo`, `data`) VALUES(NULL, :ID_AGENTE, :ID_POSTO, 2, CURRENT_TIMESTAMP);");
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

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify



        }

        // Pegando dados do posto
        $this->query('SELECT * FROM ver_posto WHERE id_posto = :ID_POSTO');
        $this->bind(':ID_POSTO', $id_posto);
        $row["posto"] = $this->resultSet();

        // Pegando dados dos bairros
        $this->query('select * from bairro;');
        $row["bairros"] = $this->resultSet();

    
        return $row;  
    }

    public function eliminar($id_posto)
    {


        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL



            try {
                $this->beginTransaction();

                // Verificando a seleção
                $this->query('SELECT `agente_posto`.`id_agente`
                                    FROM `sird-db`.`agente_posto`
                                    WHERE id_posto = :ID_POSTO;');
                $this->bind(':ID_POSTO', $id_posto);
                $row = $this->resultSet();
                // Caso exista agentes ligados a esse posto
                if ($this->rowCounte() >= 1) {
                    foreach($row as $item)  {
                        extract($item);

                        // Suspender a conta
                        $this->query("UPDATE `sird-db`.`agente_conta`
                                        SET
                                        `estado_conta` = 2
                                        WHERE id_agente = :ID_AGENTE;");
                        $this->bind(':ID_AGENTE', $id_agente);
                        $this->execute();

                        // Eliminando a relação
                        $this->query("DELETE FROM `sird-db`.`agente_posto`
                                            WHERE id_agente = :ID_AGENTE;");
                        $this->bind(':ID_AGENTE', $id_agente);
                        $this->execute();

                    }
                }

                // eliminando as operações
                $this->query("DELETE FROM `sird-db`.`operacao_posto`
                                    WHERE id_posto = :ID_POSTO");
                $this->bind(':ID_POSTO', $id_posto);
                $this->execute();

                // Eliminando a localização do posto
                $this->query("DELETE FROM `sird-db`.`posto_localizacao`
                                    WHERE id_posto = :ID_POSTO;");
                $this->bind(':ID_POSTO', $id_posto);
                $this->execute();

                // Eliminando o Posto
                $this->query("DELETE FROM `sird-db`.`posto`
                                    WHERE id_posto = :ID_POSTO;");
                $this->bind(':ID_POSTO', $id_posto);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Posto eliminado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'postos');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde {$erro->getMessage()}", "error");

            }
            //Verify





        // Pegando dados do posto
        $this->query('SELECT * FROM ver_posto WHERE id_posto = :ID_POSTO');
        $this->bind(':ID_POSTO', $id_posto);
        $row["posto"] = $this->resultSet();

        // Pegando dados dos bairros
        $this->query('select * from bairro;');
        $row["bairros"] = $this->resultSet();
        return $row;
    }
}