<?php

class ComandoMunicipalModel extends Model{
    public function Index()
    {
        if(Controller::verificarLugar(2, true)) {
        $this->query("SELECT cm.id_comando_municipal id_cm, cml.rua, cm.data_criacao, d.distrito, b.bairro,  p.provincia, m.municipio, cm.id_comando_municipal, cm.terminal
                        FROM `comando_municipal` `cm`
                        JOIN `comando_municipal_localizacao` `cml` ON `cm`.`id_comando_municipal` = `cml`.`id_cm`
                        JOIN `provincia` `p` ON `cml`.`provincia` = `p`.`id_provincia`
                        JOIN municipio m ON cml.municipio = m.id_municipio
                        JOIN distrito d ON cml.distrito = d.id_distrito
                        JOIN `bairro` `b` ON `cml`.`bairro` = `b`.`id_bairro` WHERE cm.id_comando_municipal = :ID_CM;");
        $this->bind(':ID_CM', $_SESSION['usuario_local']['id_local']);
        
        $row = $this->resultSet();
        return $row;

        } else {
            header('Location: ' . ROOT_URL . 'comandosprovinciais');

        }
        
    }

    public function ver($id_cm)
    {
        $this->query("SELECT cm.id_comando_municipal id_cm, cml.rua, cm.data_criacao, d.distrito, b.bairro,  p.provincia, m.municipio, cm.id_comando_municipal, cm.terminal
                        FROM `comando_municipal` `cm`
                        JOIN `comando_municipal_localizacao` `cml` ON `cm`.`id_comando_municipal` = `cml`.`id_cm`
                        JOIN `provincia` `p` ON `cml`.`provincia` = `p`.`id_provincia`
                        JOIN municipio m ON cml.municipio = m.id_municipio
                        JOIN distrito d ON cml.distrito = d.id_distrito
                        JOIN `bairro` `b` ON `cml`.`bairro` = `b`.`id_bairro` WHERE cm.id_comando_municipal = :ID_CM;");
        $this->bind(':ID_CM', $id_cm);
        $row['comando_municipal'] = $this->resultSet();

        $this->query('SELECT ocm.tipo, ocm.data, a.nome, a.sobrenome
                        FROM `sird-db`.operacao_comando_municipal ocm 
                        JOIN agente a ON a.id_agente = ocm.id_agente
                        WHERE id_cm = :ID_CM ORDER BY data DESC');
        $this->bind(':ID_CM', $id_cm);

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
            if ($adicionarComandoMTerminal == '' || $adicionarComandoMRua == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query('INSERT INTO comando_municipal VALUES(NULL, DEFAULT, :IDCM, :TERMINAL_CP)');
                $this->bind('IDCM', $_SESSION['usuario_local']['id_local']);
                $this->bind('TERMINAL_CP', $adicionarComandoMTerminal);
                $this->execute();

                $id_comando_municipal = $this->lastInsertId();

                // Alterando os dados de localização do posto
                $this->query("INSERT INTO comando_municipal_localizacao VALUES(:ID_CM, 
                                                                                    :PROVINCIA, :MUNICIPIO, 
                                                                                    :DISTRITO, :BAIRRO, 
                                                                                    :RUA)");

                $this->bind(':PROVINCIA', $adicionarComandoMProvincia);
                $this->bind(':MUNICIPIO', $adicionarComandoMMunicipio);
                $this->bind(':DISTRITO', $adicionarComandoMDistrito);
                $this->bind(':BAIRRO', $adicionarComandoMBairro);
                $this->bind(':RUA', $adicionarComandoMRua);
                $this->bind(':ID_CM', $id_comando_municipal);
                $this->execute();

                // Registrando a alteração
                $this->query("INSERT INTO `sird-db`.`operacao_comando_municipal` (`id_operacao`, `id_agente`, `id_cm`, `tipo`, `data`) VALUES(NULL, :ID_AGENTE, :ID_CM, 1, CURRENT_TIMESTAMP);");
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                $this->bind(':ID_CM', $id_comando_municipal);
                $this->execute();

                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Comando Municipal adicionado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'comandosmunicipais');
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

        // Pegando dados dos municipios
        $this->query('select * from municipio');
        $row['municipios'] = $this->resultSet();

        // Pegando dados dos provincias
        $this->query('select * from provincia');
        $row['provincias'] = $this->resultSet();
        return $row;




    }

    public function Editar($comando_municipal_id)
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
                $this->bind(':ID_CM', $comando_municipal_id);
                $this->execute();

                // Alterando o terminal do comando municipal
                $this->query("UPDATE comando_municipal SET terminal = :TERMINAL  WHERE id_comando_municipal = :ID_CM");

                $this->bind(':TERMINAL', $editarComandoTerminal );
                $this->bind(':ID_CM', $comando_municipal_id);
                $this->execute();
                
                // Registrando a alteração
                $this->query("INSERT INTO `sird-db`.`operacao_comando_municipal` (`id_operacao`, `id_agente`, `id_cm`, `tipo`, `data`) VALUES(NULL, :ID_AGENTE, :ID_CM, 2, CURRENT_TIMESTAMP);");
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                $this->bind(':ID_CM', $comando_municipal_id);
                $this->execute();

                $this->commit();
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde {$erro->getMessage()}", "error");

            }
            //Verify

            if ($this->rowCounte() >= 1) {
                //Redirect  
                Messages::setMessage("Edição feita com sucesso", "success");
                header('Location: ' . ROOT_URL . 'comandosmunicipais');
            }
            
        }


        $this->query("SELECT cm.id_comando_municipal id_cm, cml.rua, cm.data_criacao, d.id_distrito, d.distrito, b.bairro, b.id_bairro,  p.provincia, m.municipio, cm.id_comando_municipal, cm.terminal
                        FROM `comando_municipal` `cm`
                        JOIN `comando_municipal_localizacao` `cml` ON `cm`.`id_comando_municipal` = `cml`.`id_cm`
                        JOIN `provincia` `p` ON `cml`.`provincia` = `p`.`id_provincia`
                        JOIN municipio m ON cml.municipio = m.id_municipio
                        JOIN distrito d ON cml.distrito = d.id_distrito
                        JOIN `bairro` `b` ON `cml`.`bairro` = `b`.`id_bairro` WHERE cm.id_comando_municipal = :ID_CM;");
        $this->bind(':ID_CM', $comando_municipal_id);
        $row["comando_municipal"] = $this->resultSet();

        $this->query('select * from distrito');
        $row["distritos"] = $this->resultSet();

        $this->query('select * from bairro ;');
        $row["bairros"] = $this->resultSet();
    
        return $row;  
    }
}