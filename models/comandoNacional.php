<?php

class ComandoNacionalModel extends Model{
    public function Index()
    {
     
            // TODO
            $this->query("SELECT p.provincia, m.municipio, d.distrito, 
            b.bairro, cnl.rua, cn.terminal  
            FROM comando_nacional_localizacao cnl 
            JOIN comando_nacional cn
                    ON cn.id_comando_nacional = cnl.fk_id_cn
                            JOIN `distrito` `d` ON `cnl`.`distrito` = `d`.`id_distrito`
                            JOIN `bairro` `b` ON `cnl`.`bairro` = `b`.`id_bairro`
                            JOIN `municipio` `m` ON `cnl`.`municipio` = `m`.`id_municipio`
                            JOIN `provincia` `p` ON `cnl`.`provincia` = `p`.`id_provincia`
                            ");
            $row['comando_nacional'] = $this->resultSet();


            $this->query("SELECT p.provincia,  cp.nome as 'nome_cp', cp.terminal  
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
            if ($editarComandoRua == '' || $editarComandoTerminal == '' ) {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }
            
            
            try {
                $this->beginTransaction();

                // Alterando os dados de localização do comandosmunicipais municipal
                $this->query("UPDATE comando_provincial_localizacao SET distrito = :DISTRITO, bairro = :BAIRRO, rua = :RUA  WHERE id_cm = :ID_CM");

                $this->bind(':DISTRITO', $editarComandoDistrito);
                $this->bind(':BAIRRO', $editarComandoBairro);
                $this->bind(':RUA', $editarComandoRua);
                $this->bind(':ID_CM', $comando_provincial_id);
                $this->execute();

                
                // Alterando os terminal do comando municipal
                $this->query("UPDATE `sird-db`.`comando_provincial`
                                SET
                                `terminal` = :TERMINAL
                                WHERE id_comando_provincial = ID_CM;
                                ");

                $this->bind(':TERMINAL', $editarComandoTerminal);
                $this->bind(':ID_CM', $comando_provincial_id);
                $this->execute();
                
                // Registrando a alteração
                $this->query("INSERT INTO `sird-db`.`operacao_comando_provincial` (`id_operacao`, `id_agente`, `id_cm`, `tipo`, `data`) VALUES(NULL, :ID_AGENTE, :ID_CM, 2, CURRENT_TIMESTAMP);");
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                $this->bind(':ID_CM', $comando_provincial_id);
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
        $this->query("SELECT cm.id_comando_provincial id_cm, cml.rua, cm.data_criacao, d.id_distrito, d.distrito, b.bairro, b.id_bairro,  p.provincia, m.municipio, cm.id_comando_provincial, cm.terminal
                        FROM `comando_provincial` `cm`
                        JOIN `comando_provincial_localizacao` `cml` ON `cm`.`id_comando_provincial` = `cml`.`id_cm`
                        JOIN `provincia` `p` ON `cml`.`provincia` = `p`.`id_provincia`
                        JOIN municipio m ON cml.municipio = m.id_municipio
                        JOIN distrito d ON cml.distrito = d.id_distrito
                        JOIN `bairro` `b` ON `cml`.`bairro` = `b`.`id_bairro` WHERE cm.id_comando_provincial = :ID_CM;");
        $this->bind(':ID_CM', $comando_provincial_id);
        $row["comando_provincial"] = $this->resultSet();

        $this->query('select * from distrito');
        $row["distritos"] = $this->resultSet();

        $this->query('select * from bairro ;');
        $row["bairros"] = $this->resultSet();
    
        return $row;  
    }
}