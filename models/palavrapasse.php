<?php

class PalavraPasseModel extends Model{

    public function adicionar()
    {

        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

        if (isset($post['submit'])) {

            extract($post);

            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($adicionarDistritoNome == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("INSERT INTO `sird-db`.`Distrito`
                                    (`Distrito`)
                                    VALUES
                                    (:NOME);");

                $this->bind(':NOME', $adicionarDistritoNome);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Distrito adicionado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify



        }
        $this->query('select * from Distrito;');
        $row = $this->resultSet();
        return $row;



    }
    public function actualizar($id_agente)
    {
        //Sanitizing POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        if (isset($post['submit'])) {
            
            extract($post);
     
            $this->query("SELECT 
            ac.password as pass
            FROM agente_conta ac 
            WHERE ac.id_agente =  :ID_AGENTE");
            $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
            $row = $this->singleResult();
            
            // Verifica se existe um oficial na base de dados com o NIP inserido
          
                extract($row);
                // verifica se a conta está activa ou não
                
                if ($editarPassword === $editarConfirmarPassword) {
                    // verifica se a palavra passe está correcta
                    
          
                        $password_f = password_hash($editarPassword, PASSWORD_DEFAULT);
                        $this->query("UPDATE agente_conta SET password = 
                        :PASSWORD WHERE id_agente = :ID_AGENTE AND estado_conta = 5");
                        $this->bind(':PASSWORD', $password_f);
                        $this->bind(':ID_AGENTE', $id_agente);
                        $this->execute();
                        header('Location: ' . ROOT_URL . 'agentes/entrar');

                } else {
                    # code...
                    Messages::setMessage("As palavras-passe são diferentes", "error");
                    
                }
                    



                
        }
        
        return;
    }
    public function pedir()
    {
        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

        if (isset($post['submit'])) {

            extract($post);

            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($PedirPasseNIP == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }




            try {
                $this->beginTransaction();

                $this->query('select estado_conta, id_agente FROM agente_conta WHERE nip = :NIP;');
                $this->bind(':NIP', $PedirPasseNIP);
                $row = $this->singleResult();
                extract($row);

                if ($estado_conta == 4) {
                    header('Location: ' . ROOT_URL . 'agentes/aguardar/' . $id_agente);
                }

                // Alterando os dados do posto
                $this->query("UPDATE `sird-db`.`agente_conta`
                            SET `estado_conta` = 4
                            WHERE `nip` = :NIP AND estado_conta = 1");

                $this->bind(':NIP', $PedirPasseNIP);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Solitação pedida com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'agentes/aguardar/' . $id_agente);
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify



        }

        // Verifica s

        return $row;



    }
    public function permitir($id_agente)
    {
        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL



            try {
                $this->beginTransaction();

                $this->query('select estado_conta, id_agente FROM agente_conta WHERE id_agente = :ID_AGENTE;');
                $this->bind(':ID_AGENTE', $id_agente);
                $row = $this->singleResult();
                extract($row);

                if ($estado_conta != 4) {
                    header('Location: ' . ROOT_URL . 'agentes/aguardar/' . $id_agente);
                } elseif ($estado_conta == 5){
                    header('Location: ' . ROOT_URL . 'palavrapasse/actualizar/' . $id_agente);
                }
                // Alterando os dados do posto
                $this->query("UPDATE `sird-db`.`agente_conta`
                            SET `estado_conta` = 5
                            WHERE `id_agente` = :ID_AGENTE AND estado_conta = 4");
                $this->bind(':ID_AGENTE', $id_agente);
                $this->execute();



                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Solitação aceite com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'palavrapasse/' . $id_agente);
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }



    }
    public function negar($id_agente)
    {



            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("UPDATE `sird-db`.`agente_conta`
                            SET `estado_conta` = 6
                            WHERE `id_agente` = :ID_AGENTE AND estado_conta = 4");
                $this->bind(':ID_AGENTE', $id_agente);
                $this->execute();

                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Solitação negada com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'palavrapasse/');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }



    }
    public function index()
    {
        if (Controller::verificarLugar(2, true)) {
            $this->query('SELECT a.nome as agente_nome, a.id_agente, a.sobrenome, p.nome as posto_nome, p.tipo,  ac.nip
            FROM agente_conta ac 
            JOIN agente a ON ac.id_agente = a.id_agente
            JOIN agente_posto ap ON ac.id_agente = ap.id_agente
            JOIN posto p ON ap.id_posto = p.id_posto WHERE ac.estado_conta = 4');
            $row = $this->resultSet();

        } elseif (Controller::verificarLugar(3, true)){

            $this->query('SELECT a.nome, a.id_agente, a.sobrenome, m.municipio, ac.nip
                                FROM agente a 
                                JOIN agente_conta ac 
                                    ON ac.id_agente = a.id_agente
                                JOIN agente_comando_municipal acm 
                                    ON acm.id_agente = a.id_agente
                                JOIN `comando_municipal` `cm` 
                                    ON acm.id_cm = cm.id_comando_municipal
                                JOIN `comando_municipal_localizacao` `cml` 
                                    ON `cm`.`id_comando_municipal` = `cml`.`id_cm`
                                JOIN municipio m 
                                    ON cml.municipio = m.id_municipio 
                                WHERE cm.comando_provincial = :IDCM AND ac.estado_conta = 4');
            $this->bind(':IDCM', $_SESSION['usuario_local']['id_local']);
            $row = $this->resultSet();
        }elseif (Controller::verificarLugar(4, true)){

            $this->query('SELECT a.nome agente_nome, a.id_agente, a.sobrenome, cp.nome nome_comando, ac.nip
                                FROM agente a 
                                JOIN agente_conta ac 
                                    ON ac.id_agente = a.id_agente
                                JOIN agente_comando_provincial acp 
                                    ON acp.id_agente = a.id_agente
                                JOIN comando_provincial cp 
                                    ON acp.id_comando_provincial = cp.id_comando_provincial
                                WHERE ac.estado_conta = 4;');
            $row = $this->resultSet();
        }

        return $row;

    }







}