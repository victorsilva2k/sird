<?php

class ComandoProvincialModel extends Model{
    public function Index()
    {
     
            // TODO
            $this->query("SELECT p.provincia, m.municipio, d.distrito, 
            b.bairro, cpl.rua, cp.nome as 'nome_cp', cp.terminal  
            FROM comando_provincial_localizacao cpl 
            JOIN comando_provincial cp
                    ON cp.id_comando_provincial = cpl.id_cp
                            JOIN `distrito` `d` ON `cpl`.`distrito` = `d`.`id_distrito`
                            JOIN `bairro` `b` ON `cpl`.`bairro` = `b`.`id_bairro`
                            JOIN `municipio` `m` ON `cpl`.`municipio` = `m`.`id_municipio`
                            JOIN `provincia` `p` ON `cpl`.`provincia` = `p`.`id_provincia`
                            WHERE cp.id_comando_provincial = :ID_CP;");
            $this->bind(':ID_CP', $_SESSION['usuario_local']['id_local']);
            $row['comando_provincial'] = $this->resultSet();


            $this->query("SELECT cm.id_comando_municipal id_cm, p.provincia, m.municipio,  cm.terminal, cm.estado_actividade
                        FROM `comando_municipal` `cm`
                        JOIN `comando_municipal_localizacao` `cml` ON `cm`.`id_comando_municipal` = `cml`.`id_cm`
                        JOIN `provincia` `p` ON `cml`.`provincia` = `p`.`id_provincia`
                        JOIN municipio m ON cml.municipio = m.id_municipio
                        JOIN `bairro` `b` ON `cml`.`bairro` = `b`.`id_bairro` WHERE cm.comando_provincial = :IDCP;");
            $this->bind(':IDCP', $_SESSION['usuario_local']['id_local']);
            $row['comando_municipal'] = $this->resultSet();
            return $row;


    }
    public function ver($comando_provincial_id)
    {
     
            // TODO
     
            // TODO
            $this->query("SELECT p.provincia, m.municipio, d.distrito, 
            b.bairro, cpl.rua, cp.nome as 'nome_cp', cp.terminal, cp.id_comando_provincial as id_cp  
            FROM comando_provincial_localizacao cpl 
            JOIN comando_provincial cp
                    ON cp.id_comando_provincial = cpl.id_cp
                            JOIN `distrito` `d` ON `cpl`.`distrito` = `d`.`id_distrito`
                            JOIN `bairro` `b` ON `cpl`.`bairro` = `b`.`id_bairro`
                            JOIN `municipio` `m` ON `cpl`.`municipio` = `m`.`id_municipio`
                            JOIN `provincia` `p` ON `cpl`.`provincia` = `p`.`id_provincia`
                            WHERE cp.id_comando_provincial = :ID_CP;");
            $this->bind(':ID_CP', $comando_provincial_id);
            $row['comando_provincial'] = $this->resultSet();


            $this->query("SELECT cm.id_comando_municipal id_cm, p.provincia, m.municipio,  cm.terminal, cm.estado_actividade
                        FROM `comando_municipal` `cm`
                        JOIN `comando_municipal_localizacao` `cml` ON `cm`.`id_comando_municipal` = `cml`.`id_cm`
                        JOIN `provincia` `p` ON `cml`.`provincia` = `p`.`id_provincia`
                        JOIN municipio m ON cml.municipio = m.id_municipio
                        JOIN `bairro` `b` ON `cml`.`bairro` = `b`.`id_bairro` WHERE cm.comando_provincial = :IDCP;");
            $this->bind(':IDCP', $comando_provincial_id);
            $row['comando_municipal'] = $this->resultSet();
            return $row;

    }

    public function registros($comando_provincial_id)
    {

            // TODO

            // TODO
            $this->query("SELECT p.provincia, m.municipio, d.distrito, 
            b.bairro, cpl.rua, cp.nome as 'nome_cp', cp.terminal, cp.id_comando_provincial as id_cp  
            FROM comando_provincial_localizacao cpl 
            JOIN comando_provincial cp
                    ON cp.id_comando_provincial = cpl.id_cp
                            JOIN `distrito` `d` ON `cpl`.`distrito` = `d`.`id_distrito`
                            JOIN `bairro` `b` ON `cpl`.`bairro` = `b`.`id_bairro`
                            JOIN `municipio` `m` ON `cpl`.`municipio` = `m`.`id_municipio`
                            JOIN `provincia` `p` ON `cpl`.`provincia` = `p`.`id_provincia`
                            WHERE cp.id_comando_provincial = :ID_CP;");
            $this->bind(':ID_CP', $comando_provincial_id);
            $row['comando_provincial'] = $this->resultSet();


        $this->query('SELECT ocp.tipo, ocp.data, a.nome, a.sobrenome
                        FROM `sird-db`.operacao_comando_provincial ocp 
                        JOIN agente a ON a.id_agente = ocp.id_agente
                        WHERE id_cp = :IDCP ORDER BY data DESC');
        $this->bind(':IDCP', $comando_provincial_id);

        $row["alteracoes"] = $this->resultSet();
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
            if ($adicionarComandoPTerminal == '' || $adicionarComandoPRua == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query('INSERT INTO comando_provincial VALUES(NULL,:NOME, DEFAULT,  :TERMINAL_CP)');
                $this->bind('NOME', $adicionarComandoPNome);
                $this->bind('TERMINAL_CP', $adicionarComandoPTerminal);
                $this->execute();

                $id_comando_provincial = $this->lastInsertId();

                // Alterando os dados de localização do posto
                $this->query("INSERT INTO comando_provincial_localizacao VALUES(:IDCP, 
                                                                                    :PROVINCIA, :MUNICIPIO, 
                                                                                    :DISTRITO, :BAIRRO, 
                                                                                    :RUA)");

                $this->bind(':PROVINCIA', $adicionarComandoPProvincia);
                $this->bind(':MUNICIPIO', $adicionarComandoPMunicipio);
                $this->bind(':DISTRITO', $adicionarComandoPDistrito);
                $this->bind(':BAIRRO', $adicionarComandoPBairro);
                $this->bind(':RUA', $adicionarComandoPRua);
                $this->bind(':IDCP', $id_comando_provincial);
                $this->execute();

                // Registrando a alteração
                $this->query("INSERT INTO `sird-db`.`operacao_comando_provincial` (`id_operacao`, `id_agente`, `id_cp`, `tipo`, `data`) VALUES(NULL, :ID_AGENTE, :IDCP, 1, CURRENT_TIMESTAMP);");
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                $this->bind(':IDCP', $id_comando_provincial);
                $this->execute();

                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Comando Provincial adicionado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'comandosprovinciais');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde {$erro->getMessage()}", "error");

            }
            //Verify



        }
        // Pegando dados dos bairros
        $this->query('select * from bairro;');
        $row["bairros"] = $this->resultSet();

        // Pegando dados dos distritos
        $this->query('select * from distrito');
        $row['distritos'] = $this->resultSet();

        // Pegando dados dos municipios
        $this->query('select * from municipio');
        $row['municipios'] = $this->resultSet();

        // Pegando dados dos provincias
        $this->query('select * from provincia');
        $row['provincias'] = $this->resultSet();
        return $row;




    }

    public function Editar($comando_provincial_id)
    {
          

        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        
        if (isset($post['submit'])) {
        
            extract($post);

            
            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($editarComandoPRua == '' || $editarComandoPTerminal == '' ) {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }
            
            
            try {
                $this->beginTransaction();

                // Alterando os dados de localização do comando provincial
                $this->query("UPDATE comando_provincial_localizacao SET distrito = :DISTRITO, bairro = :BAIRRO, rua = :RUA, provincia = :PROVINCIA, municipio = :MUNICIPIO  WHERE id_cp = :IDCP");

                $this->bind(':PROVINCIA', $editarComandoPProvincia);
                $this->bind(':MUNICIPIO', $editarComandoPMunicipio);
                $this->bind(':DISTRITO', $editarComandoPDistrito);
                $this->bind(':BAIRRO', $editarComandoPBairro);
                $this->bind(':RUA', $editarComandoPRua);
                $this->bind(':IDCP', $comando_provincial_id);
                $this->execute();

                
                // Alterando os terminal do comando provincial
                $this->query("UPDATE `sird-db`.`comando_provincial`
                                SET
                                `terminal` = :TERMINAL
                                WHERE id_comando_provincial = :IDCP;
                                ");

                $this->bind(':TERMINAL', $editarComandoPTerminal);
                $this->bind(':IDCP', $comando_provincial_id);
                $this->execute();
                
                // Registrando a alteração
                $this->query("INSERT INTO `sird-db`.`operacao_comando_provincial` (`id_operacao`, `id_agente`, `id_cp`, `tipo`, `data`) VALUES(NULL, :ID_AGENTE, :IDCP, 2, CURRENT_TIMESTAMP);");
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                $this->bind(':IDCP', $comando_provincial_id);
                $this->execute();

                $this->commit();
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify

            if ($this->rowCounte() >= 1) {
                //Redirect  
                Messages::setMessage("Edição feita com sucesso", "success");
                header('Location: ' . ROOT_URL . 'comandonacional');
            }
            
        }
        $this->query("SELECT p.provincia, m.municipio, d.distrito, d.id_distrito, b.id_bairro, p.id_provincia, m.id_municipio,
            b.bairro, cpl.rua, cp.nome as 'nome_cp', cp.terminal, cp.id_comando_provincial as id_cp  
            FROM comando_provincial_localizacao cpl 
            JOIN comando_provincial cp
                    ON cp.id_comando_provincial = cpl.id_cp
                            JOIN `distrito` `d` ON `cpl`.`distrito` = `d`.`id_distrito`
                            JOIN `bairro` `b` ON `cpl`.`bairro` = `b`.`id_bairro`
                            JOIN `municipio` `m` ON `cpl`.`municipio` = `m`.`id_municipio`
                            JOIN `provincia` `p` ON `cpl`.`provincia` = `p`.`id_provincia`
                            WHERE cp.id_comando_provincial = :IDCP;");
        $this->bind(':IDCP', $comando_provincial_id);
        $row["comando_provincial"] = $this->resultSet();

        $this->query('select * from municipio');
        $row["municipios"] = $this->resultSet();

        $this->query('select * from provincia');

        $row["provincias"] = $this->resultSet();
        $this->query('select * from distrito');
        $row["distritos"] = $this->resultSet();

        $this->query('select * from bairro ;');
        $row["bairros"] = $this->resultSet();
    
        return $row;  
    }
}