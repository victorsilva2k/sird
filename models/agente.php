<?php

class AgenteModel extends Model{

    // Mostra os agentes por posto, comando municipal, provincial
    public function index()
    {
        if (Controller::verificarLugar(2, true)) {
            $this->query('SELECT a.nome as agente_nome, a.sobrenome, p.nome as posto_nome, p.tipo,  ac.nip, a.id_agente
            FROM agente_conta ac 
            JOIN agente a ON ac.id_agente = a.id_agente
            JOIN agente_posto ap ON ac.id_agente = ap.id_agente
            JOIN posto p ON ap.id_posto = p.id_posto WHERE ac.estado_conta = 1 AND p.id_comando_municipal = :ID_COMANDO_MUNICIPAL');
            $this->bind(':ID_COMANDO_MUNICIPAL', $_SESSION['usuario_local']['id_local']);

            $row = $this->resultSet();

        } elseif (Controller::verificarLugar(3, true)){

            $this->query('SELECT a.nome, a.sobrenome, m.municipio, ac.nip, a.id_agente
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
                                WHERE cm.comando_provincial = :ID_COMANDO_PROVINCIAL AND ac.estado_conta = 1');
            $this->bind(':ID_COMANDO_PROVINCIAL', $_SESSION['usuario_local']['id_local']);
            $row = $this->resultSet();
        }elseif (Controller::verificarLugar(4, true)){

            $this->query('SELECT a.nome agente_nome, a.sobrenome, cp.nome nome_comando, ac.nip, a.id_agente
                                FROM agente a 
                                JOIN agente_conta ac 
                                    ON ac.id_agente = a.id_agente
                                JOIN agente_comando_provincial acp 
                                    ON acp.id_agente = a.id_agente
                                JOIN comando_provincial cp 
                                    ON acp.id_comando_provincial = cp.id_comando_provincial
                                WHERE ac.estado_conta = 1;');
            $row = $this->resultSet();
        }

        return $row;

    }

    public function perfil()
    {
        $this->query('SELECT a.nome , a.sobrenome, 
                a.data_nasc as data_nascimento, a.genero, a.foto_arquivo as foto,
                 ac.nip, a.id_agente, ac.password
                FROM agente_conta ac 
                JOIN agente a ON ac.id_agente = a.id_agente WHERE a.id_agente = :ID_AGENTE');
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
        $row = $this->resultSet();

        return $row;
    }
    // Permitir cadastro e dá um cargo a um agente
    public function permitirCadastro($id_agente)
    {
        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        
        if (isset($post['submit'])) {
            
            extract($post);    
            
            try {
                $this->beginTransaction();

                // Verifica qual é o tipo de estabelecimento escolhido
                switch ($permitirTipoEstabelecimento) {

                    case 'Posto':
                        $this->query("INSERT INTO `sird-db`.`agente_posto`
                        (`id_agente`,
                        `id_posto`)
                        VALUES
                        (:ID_AGENTE,
                        :ID_POSTO);");
                        $this->bind(':ID_AGENTE', $id_agente);
                        $this->bind(':ID_POSTO', $permitirPosto);
                        $this->execute();
                        break;

                    case 'comando_municipal':
                        $this->query("INSERT INTO `sird-db`.`agente_comando_municipal`
                                    (`id_agente`,
                                    `id_cm`,
                                    `cargo`)
                                    VALUES
                                    (:ID_AGENTE,
                                    :ID_COMANDO_MUNICIPAL,
                                    1)");
                        $this->bind(':ID_AGENTE', $id_agente);
                        $this->bind(':ID_COMANDO_MUNICIPAL', $permitirComandoMunicipal);
                        $this->execute();

                        // Alterando o local para comando municipal

                        $this->query("UPDATE agente_conta SET local = 'comando_municipal' WHERE id_agente = :ID_AGENTE");
                        $this->bind(':ID_AGENTE', $id_agente);
                        $this->execute();
                        break;

                    case 'comando_provincial':
                        
                        $this->query("INSERT INTO `sird-db`.`agente_comando_provincial`
                                    (`id_agente`,
                                    `id_comando_provincial`,
                                    `cargo`)
                                    VALUES
                                    (:ID_AGENTE,
                                    :ID_COMANDO_PROVINCIAL,
                                    1)");
                        $this->bind(':ID_AGENTE', $id_agente);
                        $this->bind(':ID_COMANDO_PROVINCIAL', $permitirComandoProvincial);
                        $this->execute();
                        
                        // Alterando o local para comando provincial

                        $this->query("UPDATE agente_conta SET local = 'comando_provincial' WHERE id_agente = :ID_AGENTE");
                        $this->bind(':ID_AGENTE', $id_agente);
                        $this->execute();
                        break;

                    case 'comando_nacional':
                        
                        $this->query("INSERT INTO `sird-db`.`agente_comando_nacional`
                                    (`id_agente`,
                                    `id_comando_nacional`,
                                    `cargo`)
                                    VALUES
                                    (:ID_AGENTE,
                                    :ID_COMANDO_NACIONAL,
                                    1)");
                        $this->bind(':ID_AGENTE', $id_agente);
                        $this->bind(':ID_COMANDO_NACIONAL', $permitirComandoNacional);
                        $this->execute();

                        // Alterando o local para comando nacional

                        $this->query("UPDATE agente_conta SET local = 'comando_nacional' WHERE id_agente = :ID_AGENTE");
                        $this->bind(':ID_AGENTE', $id_agente);
                        $this->execute();
                        break;

                    default:

                        $this->query("INSERT INTO `sird-db`.`agente_posto`
                        (`id_agente`,
                        `id_posto`)
                        VALUES
                        (:ID_AGENTE,
                        :ID_POSTO);");
                        $this->bind(':ID_AGENTE', $id_agente);
                        $this->bind(':ID_POSTO', $permitirPosto);
                        $this->execute();

                        break;
                }


                // Mudar o estado do agente para activo
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

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde. ERRO:  | " , "error");

            }
            //Verify

            
            
        }

        // Caso for um agente do comando nacional pode adicionar agentes em outros comandos provinciais, que pertecem a esse comando provincial e também pode adicionar agentes ao próprio comando nacional

        if(Controller::verificarLugar(4)){

            // Mostrar comandos provinciais
            $this->query('SELECT nome, id_comando_provincial FROM comando_provincial');
            $row["comando_provincial"] = $this->resultSet();
    
            // Mostrar comando nacional
            $this->query('SELECT nome, id_comando_nacional FROM comando_nacional');
            $row["comando_nacional"] = $this->resultSet();

            // Mostrar comandos municipais
            $this->query('SELECT cm.id_comando_municipal, m.municipio
            FROM `comando_municipal` `cm`
            JOIN `comando_municipal_localizacao` `cml` ON `cm`.`id_comando_municipal` = `cml`.`id_cm`
            JOIN municipio m ON cml.municipio = m.id_municipio
            WHERE cm.estado_actividade = 1;');
            $this->bind(':ID_COMANDO_PROVINCIAL', $_SESSION['usuario_local']['id_local']);
            $row["comando_municipal"] = $this->resultSet();

            // mostrar postos
            $this->query('SELECT id_posto, nome, tipo FROM posto WHERE estado_actividade = 1;');
            $row["postos"] = $this->resultSet();
        }
        // Caso for um agente do comando provincial pode adicionar agentes em outros comandos municipais, que pertecem a esse comando provincial e postos da mesma província
        elseif(Controller::verificarLugar(3)){
        // Mostrar comandos municipais
        $this->query('SELECT cm.id_comando_municipal, m.municipio
        FROM `comando_municipal` `cm`
        JOIN `comando_municipal_localizacao` `cml` ON `cm`.`id_comando_municipal` = `cml`.`id_cm`
        JOIN municipio m ON cml.municipio = m.id_municipio
        WHERE cm.comando_provincial = :ID_COMANDO_PROVINCIAL AND cm.estado_actividade = 1;');
        $this->bind(':ID_COMANDO_PROVINCIAL', $_SESSION['usuario_local']['id_local']);
        $row["comando_municipal"] = $this->resultSet();

        // mostrar postos
        $this->query('SELECT p.id_posto, p.nome, p.tipo FROM posto p 
        JOIN comando_municipal_localizacao cml ON p.id_comando_municipal = cml.id_cm 
        JOIN comando_provincial_localizacao cpl ON 	cml.provincia = cpl.provincia  WHERE estado_actividade = 1 AND cpl.id_cp = :ID_COMANDO_PROVINCIAL;');
        $this->bind(':ID_COMANDO_PROVINCIAL', $_SESSION['usuario_local']['id_local']);
        $row["postos"] = $this->resultSet();
        
        }

        // Caso for um usuario de comando municipal pode adicionar agentes em postos, que pertencem a ele
        elseif(Controller::verificarLugar(2)){
            // mostrar postos
            $this->query('SELECT id_posto, nome, tipo FROM posto WHERE estado_actividade = 1 AND id_comando_municipal = :ID_COMANDO_MUNICIPAL;');
            $this->bind(':ID_COMANDO_MUNICIPAL', $_SESSION['usuario_local']['id_local']);
            $row["postos"] = $this->resultSet();
        }


        
        // Mostrar dados do agente
        $this->query('SELECT a.nome, a.sobrenome, a.genero, a.data_nasc data_nascimento, ac.nip, a.foto_arquivo foto 
                    FROM agente_conta ac 
                    JOIN agente a ON ac.id_agente = a.id_agente 
                    WHERE a.id_agente = :ID_AGENTE');
        $this->bind(":ID_AGENTE", $id_agente);
        $row["agente"] = $this->resultSet();

        return $row;  
    }

    public function rejeitarCadastro($id_agente)
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
    // Nega uma alteração de perfil de um agente pertencente a um posto ou esquadra
    public function negaralteracao($id_permissao)
    {


            try {
                $this->beginTransaction();

                $this->query('UPDATE `sird-db`.`permissao_edicao`
                SET
                `estado` = 3,
                `agente_responsavel` = :ID_AGENTE
                WHERE `id_permissao` = :ID_PERMISSAO;');
                $this->bind(':ID_PERMISSAO', $id_permissao);
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                $this->execute();

                // Eliminando a foto
                $this->query("SELECT novo_valor FROM permissao_edicao WHERE id_permissao = :ID_PERMISSAO AND campo_editado = 'foto_arquivo'");
                $this->bind(':ID_PERMISSAO', $id_permissao);
                $agente = $this->singleResult();
                extract($agente);
                // verifica se a foto é igual a foto padrão
                if ($foto !== 'usuario.png') {
                    // elimina a foto
                    unlink("assets/img/agentes/$foto");
                }


                
                $this->commit();

         
                    Messages::setMessage("Pedido negado com sucess", "success");
                    header('Location: ' . ROOT_URL . 'agentes/alteracoes');

            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde. ERRO: " , "error");

            }
            //Verify

            
            
        
 
    }
        // Permiti uma alteração de perfil de um agente pertencente a um posto ou esquadra

    public function permitiralteracao($id_permissao)
    {
            

            try {
                $this->beginTransaction();

                $this->query("SELECT novo_valor, campo_editado, id_agente  FROM permissao_edicao WHERE id_permissao = :ID_PERMISSAO AND estado = 1;");
                $this->bind(':ID_PERMISSAO', $id_permissao);
                $row = $this->singleResult();
                extract($row);
                if ($this->rowCounte() < 1) {
                    header('Location: ' . ROOT_URL . 'agentes/alteracoes');

                }
                
                
                if ($campo_editado == 'foto_arquivo') {
                    $this->query("UPDATE agente SET foto_arquivo = :FOTO WHERE id_agente = :ID_AGENTE;");
                    $this->bind(':FOTO', $novo_valor);
                    $this->bind(':ID_AGENTE', $id_agente);

   
                } else {
                    $this->query("UPDATE agente SET :CAMPO_EDITADO = :NOVO_VALOR WHERE id_agente = :ID_AGENTE");
                    $this->bind(':NOVO_VALOR', $novo_valor);
                    $this->bind(':CAMPO_EDITADO', $campo_editado);
                    $this->bind(':ID_AGENTE', $id_agente);
                }
                $this->execute();


                // actualizando a permissão para "aceito"
                $this->query('UPDATE `sird-db`.`permissao_edicao`
                SET
                `estado` = 2,
                `agente_responsavel` = :ID_AGENTE
                WHERE `id_permissao` = :ID_PERMISSAO;');
                $this->bind(':ID_PERMISSAO', $id_permissao);
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                $this->execute();

               
                $this->commit();

                if ($this->rowCounte() >= 1) {
                    //Redirect  
                    Messages::setMessage("Pedido negado com sucess", "success");
                    header('Location: ' . ROOT_URL . 'agentes/alteracoes');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde. ERRO: {$erro->getMessage()}" , "error");

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

    public function alteracoes()
    {
        $this->query('SELECT a.nome, a.sobrenome, pe.id_permissao, pe.campo_editado, pe.novo_valor, pe.estado, pe.data, ar.nome as responsavel_nome, ar.sobrenome as responsavel_sobrenome
                        FROM permissao_edicao pe JOIN agente a ON a.id_agente = pe.id_agente 
                        LEFT OUTER JOIN agente ar ON pe.agente_responsavel = ar.id_agente
                        JOIN agente_posto ag ON a.id_agente = ag.id_agente
                        JOIN posto p ON p.id_posto = ag.id_posto WHERE p.id_comando_municipal = :IDCM;');
        $this->bind(':IDCM', $_SESSION['usuario_local']['id_local']);
        $row = $this->resultSet();

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
                header('Location: ' . ROOT_URL . 'agentes/aguardar/' . $cadastroId);
 

        }
        return;
    }
    public function alterar()
    {   
        //Sanitizing POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

                if (isset($post['submit'])) {

                    extract($post);
                    try {
                        $this->beginTransaction();
                        // VERIFICAÇÕES

                        // Verifica se todos os campos já foram preenchidos
                        if ($editarAgenteNome == '' || $editarAgenteSobrenome == '' ) {
                            Messages::setMessage("Por favor preencha todos os campos", "error");
                            return;
                        } 
                            // Verifica se uma imagem foi selecionada
                            if ($_FILES["editarAgenteFoto"]["error"] > 0) {
                                $foto = "usuario.png";
                            } else {
                                $n = rand(0, 10000);
                                $exp = explode("/", $_FILES["editarAgenteFoto"]["type"]);
                                $tipo_ficheiro = $exp[1];
            
                                if ($tipo_ficheiro !== 'jpeg' && $tipo_ficheiro !== 'png' && $tipo_ficheiro !== 'jpg') {
                                    Messages::setMessage("Ficheiro não suportado", "error");
                                    return;
                                }
                                $data = date("Y-m-d");
                                $foto = $n . '-' . $data . '.' . $tipo_ficheiro;
                                $destino = "assets/img/agentes/" . $foto;
                                move_uploaded_file($_FILES['editarAgenteFoto']['tmp_name'], $destino);
                            }
                        

                            // Verifica se o nivel do usuário
                        if (Controller::verificarLugar(1, true)) {

                            
                            $this->query('SELECT a.nome , a.sobrenome, 
                                        a.foto_arquivo as foto_armazenada
                                        FROM agente_conta ac 
                                        JOIN agente a ON ac.id_agente = a.id_agente WHERE a.id_agente = :ID_AGENTE');
                            $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                            $dados_perfil = $this->singleResult();
                            extract($dados_perfil);

                            // Verifica se o dado inserido é igual ao armazenado
                            if ($nome != $editarAgenteNome) {
                                
                                // Inserindo alteração de nome
                                $this->query("INSERT INTO `sird-db`.`permissao_edicao`
                                            (`id_permissao`,
                                            `id_agente`,
                                            `campo_editado`,
                                            `novo_valor`,
                                            `estado`,
                                            `agente_responsavel`)
                                            VALUES
                                            (NULL,
                                            :ID_AGENTE,
                                            :CAMPO_EDITADO,
                                            :NOVO_VALOR,
                                            1,
                                            NULL);");
                                $this->bind(':CAMPO_EDITADO', 'nome');
                                $this->bind(':NOVO_VALOR', $editarAgenteNome);
                                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                                $this->execute();
                            }

                            // Verifica se o dado inserido é igual ao armazenado
                            if ($sobrenome != $editarAgenteSobrenome) {
                            // Inserindo alteração de sobrenome
                            $this->query("INSERT INTO `sird-db`.`permissao_edicao`
                                        (`id_permissao`,
                                        `id_agente`,
                                        `campo_editado`,
                                        `novo_valor`,
                                        `estado`,
                                        `agente_responsavel`)
                                        VALUES
                                        (NULL,
                                        :ID_AGENTE,
                                        :CAMPO_EDITADO,
                                        :NOVO_VALOR,
                                        1,
                                        NULL);");
                            $this->bind(':CAMPO_EDITADO', 'sobrenome');
                            $this->bind(':NOVO_VALOR', $editarAgenteSobrenome);
                            $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                            $this->execute();
                            }   

                            // Verifica se o dado inserido é igual ao armazenado
                            if ($foto_armazenada != $foto) {
                            // Inserindo alteração de foto
                            $this->query("INSERT INTO `sird-db`.`permissao_edicao`
                                        (`id_permissao`,
                                        `id_agente`,
                                        `campo_editado`,
                                        `novo_valor`,
                                        `estado`,
                                        `agente_responsavel`)
                                        VALUES
                                        (NULL,
                                        :ID_AGENTE,
                                        :CAMPO_EDITADO,
                                        :NOVO_VALOR,
                                        1,
                                        NULL);");
                            $this->bind(':CAMPO_EDITADO', 'foto_arquivo');
                            $this->bind(':NOVO_VALOR', $foto);
                            $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                            $this->execute();
                            }   
                        } else {
                            // Inserindo os dados pessoais de um agente de comando municipal ou superior
                        $this->query("UPDATE agente SET nome = :NOME, sobrenome = :SOBRENOME,  foto_arquivo = :FOTO WHERE id_agente = :ID_AGENTE;");
                        $this->bind(':NOME', $editarAgenteNome);
                        $this->bind(':SOBRENOME', $editarAgenteSobrenome);
                        $this->bind(':FOTO', $foto);

                        $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                        $this->execute();
                        }
                        
                        $this->commit();

                            if ($this->rowCounte() >= 1) {
                                //Redirect  
                                Messages::setMessage("Cadastrado Permitido com sucesso", "success");
                                header('Location: ' . ROOT_URL . 'agentes/cadastros');
                            }
                        
                    } catch (\PDOException $erro) {
                        $this->rollBack();

                        Messages::setMessage("Aconteceu um erro tente novamente mais tarde. ERRO:  | {$erro->getMessage()}" , "error");

                    }
                    Messages::setMessage("Edição feita com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'agentes/perfil');
                    }
        
        
                
                

                $this->query('SELECT a.nome , a.sobrenome, 
                a.data_nasc as data_nascimento, a.genero, a.foto_arquivo as foto,
                 ac.nip, a.id_agente, ac.password
                FROM agente_conta ac 
                JOIN agente a ON ac.id_agente = a.id_agente WHERE a.id_agente = :ID_AGENTE');
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);

                $row = $this->resultSet();

                return $row;

    }
    public function editar()
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
                    if (password_verify($editarPasswordAntiga, $pass)) {
          
                        $password_f = password_hash($editarPassword, PASSWORD_DEFAULT);
                        $this->query("UPDATE agente_conta SET password = :PASSWORD WHERE id_agente = :ID_AGENTE");
                        $this->bind(':PASSWORD', $password_f);
                        $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                        $this->execute();
                        header('Location: ' . ROOT_URL . 'agentes/perfil');
        
                        
                                   
                    }else {
                        Messages::setMessage("Palavras-Passe Não concidem", "error");
                    }
                } else {
                    # code...
                    Messages::setMessage("As palavras-passe são diferentes", "error");
                    
                }
                    



                
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
                        // Verifica se o agente está ligado a que local
                        $this->query("SELECT local 
                                      FROM agente_conta 
                                      WHERE id_agente =  :ID_AGENTE");
                        $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                        $local_sel = $this->singleResult();
                        extract($local_sel);
                      
                        // Caso for posto
                        if ($local === "posto") {

                            $this->query("SELECT ap.id_posto posto, ap.cargo 
                                      FROM agente_conta ac 
                                      JOIN agente_posto ap ON ac.id_agente = ap.id_agente 
                                      WHERE ac.id_agente =  :ID_AGENTE");
                            $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                            $local_sel = $this->singleResult();
                            extract($local_sel);
                            $_SESSION['usuario_local'] = array(
                                "id_local"      => $posto,
                                "cargo"         => $cargo,
                                "tipo_local"    => "posto"
                            );
                            
                        } elseif ($local === "comando_municipal") {
                            # code...
                        
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
                                "tipo_local" => "comando_municipal"
                            );
                        } elseif ($local === "comando_provincial") {
                            # code...
                        
                            $this->query("SELECT acp.id_comando_provincial, acp.cargo 
                                        FROM agente_conta ac 
                                        JOIN agente_comando_provincial acp 
                                        ON ac.id_agente = acp.id_agente  
                                        WHERE ac.id_agente =  :ID_AGENTE");
                            $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                            $local_row = $this->singleResult();
                            extract($local_row);
                            $_SESSION['usuario_local'] = array(
                                "id_local"    => $id_comando_provincial,
                                "cargo" => $cargo,
                                "tipo_local" => "comando_provincial"
                            );
                        } elseif ($local === "comando_nacional") {
                            # code...
                        
                            $this->query("SELECT acn.id_cm, acn.cargo, acn.id_cm 
                                        FROM agente_conta ac 
                                        JOIN agente_comando_municipal acn 
                                        ON ac.id_agente = acn.id_agente  
                                        WHERE ac.id_agente =  :ID_AGENTE");
                            $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                            $local_row = $this->singleResult();
                            extract($local_row);
                            $_SESSION['usuario_local'] = array(
                                "id_local"    => $id_cm,
                                "cargo" => $cargo,
                                "tipo_local" => "comando_nacional"
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

    
    public function aguardar($id_agente)
    {
        $this->query('select estado_conta FROM agente_conta WHERE id_agente = :ID_AGENTE;');
        $this->bind(':ID_AGENTE', $id_agente);
        $estado = $this->singleResult();
        extract($estado);
        //Verifica se a solicitão foi aceite
        if ($estado_conta == 5){
            header('Location: ' . ROOT_URL . 'palavrapasse/actualizar');
        }
        $row = $this->resultSet();
        return $row;
    }
}