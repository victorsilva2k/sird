<?php

class AgenteModel extends Model{

    public function index()
    {
        $this->query('SELECT a.nome agente_nome, a.sobrenome, p.nome posto_nome, p.tipo,  ac.nip, a.id_agente
                    FROM agente_conta ac 
                    JOIN agente a ON ac.id_agente = a.id_agente
                    JOIN agente_posto ap ON ac.id_agente = ap.id_agente
                    JOIN posto p ON ap.id_posto = p.id_posto');
        $row = $this->resultSet();
    
        return $row;  
    }
    public function permitir($id_agente)
    {
        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        
        if (isset($post['submit'])) {
            
            extract($post);    
            
            try {
                $this->beginTransaction();

                // Verifica qual é o tipo de estabelecimento escolhido
                if ($permitirTipoEstabelecimento == "Posto") {
                    
                    $this->query("INSERT INTO `sird-db`.`agente_posto`
                    (`id_agente`,
                    `id_posto`)
                    VALUES
                    (:ID_AGENTE,
                    :ID_POSTO);");
                    $this->bind(':ID_AGENTE', $id_agente);
                    $this->bind(':ID_POSTO', $permitirPosto);
                    $this->execute();
                } elseif ($permitirTipoEstabelecimento == "Comando") {
                    
                    $this->query("INSERT INTO `sird-db`.`agente_comando_municipal`
                    (`id_agente`,
                    `id_cm`,
                    `cargo`)
                    VALUES
                    (:ID_AGENTE,
                     :ID_CM,
                     1)");
                    $this->bind(':ID_AGENTE', $id_agente);
                    $this->bind(':ID_CM', $permitirComando);
                    $this->execute();
                }

                // Eliminar agente da tabela agente
                $this->query("UPDATE agente_conta SET estado_conta = 1 WHERE id_agente = :ID_AGENTE");
                $this->bind(':ID_AGENTE', $id_agente);
                $this->execute();

                $this->commit();

                if ($this->rowCounte() >= 1) {
                    //Redirect  
                    Messages::setMessage("Cadastrado Permitido com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'agentes/cadastros');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde. ERRO:  | $permitirPosto" , "error");

            }
            //Verify

            
            
        }

        $this->query('SELECT id_posto, nome, tipo FROM posto WHERE estado_actividade = 1;');
        $row["postos"] = $this->resultSet();
        $this->query('SELECT a.nome, a.sobrenome, a.genero, a.data_nasc data_nascimento, ac.nip, a.foto_arquivo foto 
                    FROM agente_conta ac 
                    JOIN agente a ON ac.id_agente = a.id_agente 
                    WHERE a.id_agente = :ID_AGENTE');
        $this->bind(":ID_AGENTE", $id_agente);
        $row["agente"] = $this->resultSet();
    
        return $row;  
    }
    public function rejeitar($id_agente)
    {


            try {
                $this->beginTransaction();

                $this->query('SELECT id_agente FROM agente_conta WHERE estado_conta > 0 AND id_agente = :ID_AGENTE');
                $this->bind(':ID_AGENTE', $id_agente);

                $row = $this->singleResult();
                if ($this->rowCounte() > 0) {
                    //Redirect  
                    Messages::setMessage("Este agente já foi permitido", "error");
                    header('Location: ' . ROOT_URL . 'agentes/cadastros');
                }

                // Eliminando a foto
                $this->query('SELECT foto_arquivo foto
                            FROM agente 
                            WHERE id_agente = :ID_AGENTE');
                $this->bind(':ID_AGENTE', $id_agente);
                $agente = $this->singleResult();
                extract($agente);
                // verifica se a foto é igual a foto padrão
                if ($foto !== 'usuario.png') {
                    // elimina a foto
                    unlink("assets/img/agentes/$foto");
                }
                // Eliminar agente da tabela agente_conta
                $this->query("DELETE FROM agente_conta WHERE id_agente = :ID_AGENTE");
                $this->bind(':ID_AGENTE', $id_agente);
                $this->execute();

                // Eliminar agente da tabela agente
                $this->query("DELETE FROM agente WHERE id_agente = :ID_AGENTE");
                $this->bind(':ID_AGENTE', $id_agente);
                $this->execute();


                
                $this->commit();

                if ($this->rowCounte() >= 1) {
                    //Redirect  
                    Messages::setMessage("Cadastrado Rejeitado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'agentes/cadastros');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde. ERRO: " , "error");

            }
            //Verify

            
            
        
 
    }
    public function cadastros()
    {
        $this->query('SELECT a.id_agente id, a.nome, a.sobrenome, a.genero, ac.nip 
                      FROM agente a 
                      JOIN agente_conta ac ON ac.id_agente = a.id_agente 
                      WHERE ac.estado_conta = 0;');
        $row = $this->resultSet();
        if ($this->rowCounte() < 1){
            header('Location: ' . ROOT_URL . 'agentes/');

        }
        return $row;    
    }
    public function cadastrar()
    {   
        //Sanitizing POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        if (isset($post['submit'])) {

            extract($post);

            // VERIFICAÇÕES
            // Verifica se as palavras-passe são iguais
            if ($cadastroPassword !== $cadastroConfirmarPassword) {
                Messages::setMessage("Palavras-passe são diferentes", "error");
                return;
            }

            // Verifica se todos os campos já foram preenchidos
            if ($cadastroNome == '' || $cadastroSobrenome == '' || $cadastroNIP == '' || $cadastroPassword == '' || $cadastroConfirmarPassword == '' ) {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            } 

            // Verifica se o NIP digitado já existe
            $this->query("SELECT nip FROM agente_conta WHERE nip = :NIP");
            $this->bind(':NIP', $cadastroNIP);
            $row = $this->singleResult();

            if ($this->rowCounte() > 0) {
                Messages::setMessage("O NIP inserido já está registrado", "error");
                return;
            }

            $password = password_hash($cadastroPassword, PASSWORD_DEFAULT);

            try {

                
                
                $this->beginTransaction();

                // Verifica se uma imagem foi selecionada
                if ($_FILES["cadastroFoto"]["error"] > 0) {
                    $foto = "usuario.png";
                } else {
                    $n = rand(0, 10000);
                    $exp = explode("/", $_FILES["cadastroFoto"]["type"]);
                    $tipo_ficheiro = $exp[1];

                    if ($tipo_ficheiro !== 'jpeg' && $tipo_ficheiro !== 'png' && $tipo_ficheiro !== 'jpg') {
                        Messages::setMessage("Ficheiro não suportado", "error");
                        return;
                    }
                    $data = date("Y-m-d");
                    $foto = $n . '-' . $data . '.' . $tipo_ficheiro;
                    $destino = "assets/img/agentes/" . $foto;
                    move_uploaded_file($_FILES['cadastroFoto']['tmp_name'], $destino);
                }

                
                // Inserindo os dados pessoais de um agente
                $this->query("INSERT INTO `sird-db`.`agente`
                (`id_agente`, 
                `nome`,
                `sobrenome`,
                `foto_arquivo`,
                `data_nasc`,
                `genero`)
                VALUES
                (NULL,
                :NOME,
                :SOBRENOME,
                :FOTO,
                :DATA,
                :GENERO);");
                $this->bind(':NOME', $cadastroNome);
                $this->bind(':SOBRENOME', $cadastroSobrenome);
                $this->bind(':FOTO', $foto);
                $this->bind(':DATA', $cadastroDataNascimento);
                $this->bind(':GENERO', $cadastroGenero);
                $this->execute();

                $cadastroId = $this->lastInsertId();
                // Inserindo os dados de conta
                
                $this->query("INSERT INTO `sird-db`.`agente_conta`
                (`id_agente`,
                `nip`,
                `password`,
                `estado_conta`)
                VALUES
                (:ID,
                :NIP,
                :PASSWORD,
                0)");
                $this->bind(':ID', $cadastroId);
                $this->bind(':NIP', $cadastroNIP);
                $this->bind(':PASSWORD', $password);
                $this->execute();
                $this->commit();
            } catch (\PDOException $erro) {
                $this->rollBack();
                
                Messages::setMessage("Aconteceu um erro tente novamente mais tarde. ERRO: ", "error");

            }
            //Verify
            
                //Redirect  
                Messages::setMessage("Cadastro feito com sucesso", "success");
                header('Location: ' . ROOT_URL . 'agentes/aguardar');
 

        }
        return;
    }

    public function entrar()
    {
        //Sanitizing POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        if (isset($post['submit'])) {
            
            extract($post);
            
            
            $this->query("SELECT a.id_agente id, a.nome, a.foto_arquivo foto, 
            ac.password, 
            ac.estado_conta estado
            FROM agente_conta ac 
            JOIN agente a ON ac.id_agente = a.id_agente 
            WHERE ac.nip =  :NIP");
            $this->bind(':NIP', $loginNIP);
            $row = $this->singleResult();
            
            // Verifica se existe um oficial na base de dados com o NIP inserido
            if ($this->rowCounte() > 0) {

                extract($row);
                // verifica se a conta está activa ou não
                if ($estado == 1) {

                    // verifica se a palavra passe está correcta
                    if (password_verify($loginPassword, $password)) {

                        $_SESSION['is_logged_in'] = true;
                        $_SESSION['dados_usuario'] = array(
                            "id"    => $id,
                            "nome" => $nome,
                            "foto" => $foto
                        );
                        
                        $this->query("SELECT ap.id_posto posto, ap.cargo 
                                      FROM agente_conta ac 
                                      JOIN agente_posto ap ON ac.id_agente = ap.id_agente 
                                      WHERE ac.id_agente =  :ID_AGENTE");
                        $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                        $local_row = $this->singleResult();
                        if ($this->rowCounte() > 0) {
                            extract($local_row);
                            $_SESSION['usuario_local'] = array(
                                "id_local"      => $posto,
                                "cargo"         => $cargo,
                                "tipo_local"    => "posto"
                            );
                            
                        } else {
                            $this->query("SELECT acm.id_cm, acm.cargo, acm.id_cm 
                                        FROM agente_conta ac 
                                        JOIN agente_comando_municipal acm 
                                        ON ac.id_agente = acm.id_agente  
                                        WHERE ac.id_agente =  :ID_AGENTE");
                            $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                            $local_row = $this->singleResult();
                            extract($local_row);
                            $_SESSION['usuario_local'] = array(
                                "id_local"    => $id_cm,
                                "cargo" => $cargo,
                                "tipo_local" => "comando"
                            );
                        } 
                        
                        header('Location: ' . ROOT_URL . 'inicio/agente');
        
                        
                    }else {
                        Messages::setMessage("Dados Incorretos", "error");
                    }
                } else {
                    Messages::setMessage("A sua conta foi desactivada, por favor contacte o seu superior", "error");
                }
            }else {
                Messages::setMessage("Dados Incorretos", "error");
            }

        }
        return;
    }

    public function aguardar()
    {
        return;
    }
}