<?php

class PostoModel extends Model{
    public function Index()
    {

        if(Controller::verificarLugar(4)) {

        $this->query('     SELECT 
                                    `p`.`id_posto` AS `id_posto`,
                                    `p`.`estado_actividade` AS `estado_actividade`,
                                    `p`.`tipo` AS `tipo`,
                                    `p`.`nome` AS `nome`,
                                    `d`.`distrito` AS `distrito`,
                                    `b`.`bairro` AS `bairro`,
                                    `pl`.`rua` AS `rua`,
                                    `cml`.`municipio` AS `municipio`
                                FROM
                                    ((((`posto` `p`
                                    JOIN `posto_localizacao` `pl` ON ((`p`.`id_posto` = `pl`.`id_posto`)))
                                    JOIN `bairro` `b` ON ((`b`.`id_bairro` = `pl`.`bairro`)))
                                    JOIN `distrito` `d` ON ((`d`.`id_distrito` = `pl`.`distrito`)))
                                    JOIN `comando_municipal_localizacao` `cml` ON ((`p`.`id_comando_municipal` = `cml`.`id_cm`))
                                    JOIN comando_municipal cm ON cml.id_cm = cm.id_comando_municipal)
                                WHERE cm.comando_provincial = :ID_COMANDO_PROVINCIAL');
        $this->bind('ID_COMANDO_PROVINCIAL', $_SESSION['usuario_local']['id_local']);
        $row = $this->resultSet();
        return $row;
        // HACK ele deve pesquisar por postos por municipio e provincia
    }

        elseif(Controller::verificarLugar(3)) {

            $this->query('     SELECT 
                                    `p`.`id_posto` AS `id_posto`,
                                    `p`.`estado_actividade` AS `estado_actividade`,
                                    `p`.`tipo` AS `tipo`,
                                    `p`.`nome` AS `nome`,
                                    `d`.`distrito` AS `distrito`,
                                    `b`.`bairro` AS `bairro`,
                                    `pl`.`rua` AS `rua`,
                                    `cml`.`municipio` AS `municipio`
                                FROM
                                    ((((`posto` `p`
                                    JOIN `posto_localizacao` `pl` ON ((`p`.`id_posto` = `pl`.`id_posto`)))
                                    JOIN `bairro` `b` ON ((`b`.`id_bairro` = `pl`.`bairro`)))
                                    JOIN `distrito` `d` ON ((`d`.`id_distrito` = `pl`.`distrito`)))
                                    JOIN `comando_municipal_localizacao` `cml` ON ((`p`.`id_comando_municipal` = `cml`.`id_cm`))
                                    JOIN comando_municipal cm ON cml.id_cm = cm.id_comando_municipal)
                                WHERE cm.comando_provincial = :ID_COMANDO_PROVINCIAL');
            $this->bind('ID_COMANDO_PROVINCIAL', $_SESSION['usuario_local']['id_local']);
            $row = $this->resultSet();
            return $row;
            // HACK ele deve pesquisar por postos por municipio e provincia
        }
        
        elseif(Controller::verificarLugar(2)){


            $this->query('    SELECT 
                            `p`.`id_posto` AS `id_posto`,
                            `p`.`estado_actividade` AS `estado_actividade`,
                            `p`.`tipo` AS `tipo`,
                            `p`.`nome` AS `nome`,
                            `d`.`distrito` AS `distrito`,
                            `b`.`bairro` AS `bairro`,
                            `pl`.`rua` AS `rua`,
                            `cml`.`municipio` AS `municipio`
                        FROM
                            ((((`posto` `p`
                            JOIN `posto_localizacao` `pl` ON ((`p`.`id_posto` = `pl`.`id_posto`)))
                            JOIN `bairro` `b` ON ((`b`.`id_bairro` = `pl`.`bairro`)))
                            JOIN `distrito` `d` ON ((`d`.`id_distrito` = `pl`.`distrito`)))
                            JOIN `comando_municipal_localizacao` `cml` ON ((`p`.`id_comando_municipal` = `cml`.`id_cm`)))
                        WHERE p.id_comando_municipal = :ID_COMANDO_MUNICIPAL');
            $this->bind('ID_COMANDO_MUNICIPAL', $_SESSION['usuario_local']['id_local']);

            $row = $this->resultSet();
            return $row;
        }
        elseif(Controller::verificarLugar(1)){
            $this->query('SELECT * FROM ver_posto WHERE id_posto = :ID_POSTO');
            $this->bind(':ID_POSTO', $_SESSION['usuario_local']['id_local']);

            $row["posto"] = $this->resultSet();

            $this->query('SELECT op.tipo, op.data, a.nome, a.sobrenome
                        FROM `sird-db`.operacao_posto op 
                        JOIN agente a ON a.id_agente = op.id_agente
                        WHERE id_posto = :ID_POSTO ');
            $this->bind(':ID_POSTO', $_SESSION['usuario_local']['id_local']);

            $row["alteracoes"] = $this->resultSet();
            return $row;
        }



    }


    public function escolher($id_posto)
    {



        $this->query('   SELECT * FROM `sird-db`.ver_posto;');

        $row = $this->resultSet();
        return $row;

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
                    // Pegando dados dos bairros
        $this->query('select * from bairro;');
        $row["bairros"] = $this->resultSet();
        
        // Pegando dados dos distritos
        $this->query('select * from distrito');
        $row['distritos'] = $this->resultSet();
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
                        WHERE id_posto = :ID_POSTO ORDER BY data DESC');
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

                // Alterando os terminal do posto
                $this->query("UPDATE `sird-db`.`posto`
                                SET
                                `terminal` = :TERMINAL
                                WHERE id_posto = :ID_POSTO;");

                $this->bind(':TERMINAL', $editarPostoTerminal);
                $this->bind(':ID_POSTO', $id_posto);
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
        
        // Pegando dados dos distritos
        $this->query('select * from distrito');
        $row['distritos'] = $this->resultSet();
        return $row;

    
        return $row;  
    }




}