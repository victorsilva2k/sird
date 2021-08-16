<?php

class ComandoNacionalModel extends Model{
    public function Index()
    {
     
            // TODO
            $this->query("SELECT p.provincia, m.municipio, d.distrito, 
            b.bairro, cnl.rua, cn.terminal, cn.id_comando_nacional as id_cn   
            FROM comando_nacional_localizacao cnl 
            JOIN comando_nacional cn
                    ON cn.id_comando_nacional = cnl.fk_id_cn
                            JOIN `distrito` `d` ON `cnl`.`distrito` = `d`.`id_distrito`
                            JOIN `bairro` `b` ON `cnl`.`bairro` = `b`.`id_bairro`
                            JOIN `municipio` `m` ON `cnl`.`municipio` = `m`.`id_municipio`
                            JOIN `provincia` `p` ON `cnl`.`provincia` = `p`.`id_provincia`
                            ");
            $row['comando_nacional'] = $this->resultSet();


            $this->query("SELECT p.provincia,  cp.nome as 'nome_cp', cp.id_comando_provincial as id_cp, cp.terminal  
            FROM comando_provincial_localizacao cpl 
            JOIN comando_provincial cp
                    ON cp.id_comando_provincial = cpl.id_cp
                            JOIN `distrito` `d` ON `cpl`.`distrito` = `d`.`id_distrito`
                            JOIN `bairro` `b` ON `cpl`.`bairro` = `b`.`id_bairro`
                            JOIN `municipio` `m` ON `cpl`.`municipio` = `m`.`id_municipio`
                            JOIN `provincia` `p` ON `cpl`.`provincia` = `p`.`id_provincia`;");
            $row['comando_provincial'] = $this->resultSet();
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
            if ($adicionarComandoNTerminal == '' || $adicionarComandoNRua == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query('INSERT INTO comando_provincial VALUES(NULL,:NOME, DEFAULT,  :TERMINAL_CP)');
                $this->bind('NOME', $adicionarComandoNNome);
                $this->bind('TERMINAL_CP', $adicionarComandoNTerminal);
                $this->execute();

                $id_comando_provincial = $this->lastInsertId();

                // Alterando os dados de localização do posto
                $this->query("INSERT INTO comando_provincial_localizacao VALUES(:IDCP, 
                                                                                    :PROVINCIA, :MUNICIPIO, 
                                                                                    :DISTRITO, :BAIRRO, 
                                                                                    :RUA)");

                $this->bind(':PROVINCIA', $adicionarComandoNProvincia);
                $this->bind(':MUNICIPIO', $adicionarComandoNMunicipio);
                $this->bind(':DISTRITO', $adicionarComandoNDistrito);
                $this->bind(':BAIRRO', $adicionarComandoNBairro);
                $this->bind(':RUA', $adicionarComandoNRua);
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

    public function registros($comando_nacional_id)
    {

        // TODO
        $this->query("SELECT p.provincia, m.municipio, d.distrito, 
            b.bairro, cnl.rua, cn.terminal, cn.id_comando_nacional as id_cn   
            FROM comando_nacional_localizacao cnl 
            JOIN comando_nacional cn
                    ON cn.id_comando_nacional = cnl.fk_id_cn
                            JOIN `distrito` `d` ON `cnl`.`distrito` = `d`.`id_distrito`
                            JOIN `bairro` `b` ON `cnl`.`bairro` = `b`.`id_bairro`
                            JOIN `municipio` `m` ON `cnl`.`municipio` = `m`.`id_municipio`
                            JOIN `provincia` `p` ON `cnl`.`provincia` = `p`.`id_provincia`
                            WHERE cn.id_comando_nacional = :IDCN");
        $this->bind(':IDCN', $comando_nacional_id);
        $row['comando_nacional'] = $this->resultSet();


        $this->query('SELECT ocn.tipo, ocn.data, a.nome, a.sobrenome
                        FROM `sird-db`.operacao_comando_nacional ocn 
                        JOIN agente a ON a.id_agente = ocn.id_agente
                        WHERE id_cn = :IDCN ORDER BY data DESC');
        $this->bind(':IDCN', $comando_nacional_id);

        $row["alteracoes"] = $this->resultSet();

        return $row;

    }

    public function Editar($comando_nacional_id)
    {


        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

        if (isset($post['submit'])) {

            extract($post);


            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($editarComandoNRua == '' || $editarComandoNTerminal == '' ) {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados de localização do comando nacional
                $this->query("UPDATE comando_nacional_localizacao SET distrito = :DISTRITO, bairro = :BAIRRO, rua = :RUA, provincia = :PROVINCIA, municipio = :MUNICIPIO  WHERE fk_id_cn = :IDCN");

                $this->bind(':PROVINCIA', $editarComandoNProvincia);
                $this->bind(':MUNICIPIO', $editarComandoNMunicipio);
                $this->bind(':DISTRITO', $editarComandoNDistrito);
                $this->bind(':BAIRRO', $editarComandoNBairro);
                $this->bind(':RUA', $editarComandoNRua);
                $this->bind(':IDCN', $comando_nacional_id);
                $this->execute();


                // Alterando os terminal do comando nacional
                $this->query("UPDATE `sird-db`.`comando_nacional`
                                SET
                                `terminal` = :TERMINAL
                                WHERE id_comando_nacional = :IDCN;
                                ");

                $this->bind(':TERMINAL', $editarComandoNTerminal);
                $this->bind(':IDCN', $comando_nacional_id);
                $this->execute();

                // Registrando a alteração
                $this->query("INSERT INTO `sird-db`.`operacao_comando_nacional` (`id_operacao`, `id_agente`, `id_cN`, `tipo`, `data`) VALUES(NULL, :ID_AGENTE, :IDCN, 2, CURRENT_TIMESTAMP);");
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                $this->bind(':IDCN', $comando_nacional_id);
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
            b.bairro, cnl.rua, cn.terminal, cn.id_comando_nacional as id_cn  
            FROM comando_nacional_localizacao cnl 
            JOIN comando_nacional cn
                    ON cn.id_comando_nacional = cnl.fk_id_cn
                            JOIN `distrito` `d` ON `cnl`.`distrito` = `d`.`id_distrito`
                            JOIN `bairro` `b` ON `cnl`.`bairro` = `b`.`id_bairro`
                            JOIN `municipio` `m` ON `cnl`.`municipio` = `m`.`id_municipio`
                            JOIN `provincia` `p` ON `cnl`.`provincia` = `p`.`id_provincia`
                            WHERE cn.id_comando_nacional = :IDCP;");
        $this->bind(':IDCP', $comando_nacional_id);
        $row["comando_nacional"] = $this->resultSet();

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