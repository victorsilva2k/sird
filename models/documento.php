<?php

class DocumentosModel extends Model{
    public function Index()
    {
        return;
    }

    public function publicar()
    {
        //Sanitizing POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        if (isset($post['submit'])) {

            extract($post);

            // VERIFICAÇÕES
            try {
                $this->beginTransaction();
                    
                // Verifica se uma imagem foi selecionada
                if ($_FILES["adicionarDocumentoFoto1"]["error"] > 0) {
                    $foto1 = "usuario.png";
                } else {
                    $n = rand(0, 10000);
                    $exp = explode("/", $_FILES["adicionarDocumentoFoto1"]["type"]);
                    $tipo_ficheiro = $exp[1];

                    if ($tipo_ficheiro !== 'jpeg' && $tipo_ficheiro !== 'png' && $tipo_ficheiro !== 'jpg') {
                        Messages::setMessage("Ficheiro não suportado", "error");
                        return;
                    }
                    $data = date("Y-m-d");
                    $foto1 = $n . '-' . $data . '.' . $tipo_ficheiro;
                    $destino = "assets/img/documentos/" . $foto1;
                    move_uploaded_file($_FILES['adicionarDocumentoFoto1']['tmp_name'], $destino);
                }

                
                // Verifica se uma imagem foi selecionada
                if ($_FILES["adicionarDocumentoFoto2"]["error"] > 0) {
                    $foto2 = "usuario.png";
                } else {
                    $n = rand(0, 10000);
                    $exp = explode("/", $_FILES["adicionarDocumentoFoto2"]["type"]);
                    $tipo_ficheiro = $exp[1];

                    if ($tipo_ficheiro !== 'jpeg' && $tipo_ficheiro !== 'png' && $tipo_ficheiro !== 'jpg') {
                        Messages::setMessage("Ficheiro não suportado", "error");
                        return;
                    }
                    $data = date("Y-m-d");
                    $foto2 = $n . '-' . $data . '.' . $tipo_ficheiro;
                    $destino = "assets/img/documentos/" . $foto2;
                    move_uploaded_file($_FILES['adicionarDocumentoFoto2']['tmp_name'], $destino);
                }

     
                
                // Inserindo os dados pessoais de um agente
                $this->query("SELECT id_proprietario 
                            FROM propietario_documento 
                            ORDER BY id_proprietario 
                            DESC LIMIT 1;");
                $row = $this->singleResult();
                extract($row);

                $id_proprietario = $id_proprietario + 1;

                $this->query("INSERT INTO `sird-db`.`propietario_documento`
                            (`id_proprietario`,
                            `nome_completo`)
                            VALUES  
                            (:ID_PROPRIETARIO, 
                            :NOME);");
                $this->bind(':NOME', $adicionarDocumentoProprietarioNome);
                $this->bind(':ID_PROPRIETARIO', $id_proprietario);
                $this->execute();

                // $id_proprietario = $this->lastInsertId();
                // Inserindo numeros do proprietario
                $this->query("INSERT INTO `sird-db`.`proprietario_telefone`
                            (`id_proprietario`,
                            `telefone`)
                            VALUES
                            (:ID_PROPRIETARIO,
                            :NUMERO);");
                $this->bind(':ID_PROPRIETARIO', $id_proprietario);
                $this->bind(':NUMERO', $adicionarDocumentoProprietarioNumero);
                $this->execute();


// Inserindo os dados de entregador de docuemtos
                $this->query("INSERT INTO `sird-db`.`entregador_documento`
                            (`id_entregador`,
                            `nome_completo`,
                            `telefone`)
                            VALUES
                            (NULL,
                            :NOME_ENTREGADOR,
                            :NUMERO_ENTREGADOR);");
                $this->bind(':NOME_ENTREGADOR', $adicionarDocumentoEntregadorNome);
                $this->bind(':NUMERO_ENTREGADOR', $adicionarDocumentoEntregadorNumero);
                $this->execute();

                $id_entregador = $this->lastInsertId();

                // Inserindo os dados da relação entre entregador e proprietario
                
                $this->query("INSERT INTO `sird-db`.`entregador_proprietario`
                            (`id_entregador`,
                            `id_proprietario`)
                            VALUES
                            (:ID_ENTREGADOR,
                            :ID_PROPRIETARIO);");
                $this->bind(':ID_ENTREGADOR', $id_entregador);
                $this->bind(':ID_PROPRIETARIO', $id_proprietario);
                $this->execute();

                // Inserindo os dados do documentos
                
                    $this->query("INSERT INTO `sird-db`.`documentos`
                                (`id_documento`,
                                `categoria_documento`,
                                `data_emissao`,
                                `identifacador`,
                                `id_proprietario`,
                                `estado`)
                                VALUES
                                (NULL,
                                :CATEGORIA,
                                :DATA_EMISSAO,
                                :IDENTIFICADOR,
                                :ID_PROPRIETARIO,
                                1);");
                $this->bind(':CATEGORIA', $adicionarDocumentoCategoria);
                $this->bind(':DATA_EMISSAO', $adicionarDocumentoEmissao);
                $this->bind(':IDENTIFICADOR', $adicionarDocumentoIdentificador);
                $this->bind(':ID_PROPRIETARIO', $id_proprietario);
                $this->execute();

                $id_documento = $this->lastInsertId();

                // Inserindo foto 1
                
                $this->query("INSERT INTO `sird-db`.`foto_documento`
                            (`id_foto`,
                            `id_documento`,
                            `arquivo`)
                            VALUES
                            (NULL,
                            :ID_DOCUMENTO,
                            :ARQUIVO);");
                $this->bind(':ID_DOCUMENTO', $id_documento);
                $this->bind(':ARQUIVO', $foto1);
                $this->execute();

                // Inserindo foto 2
                
                $this->query("INSERT INTO `sird-db`.`foto_documento`
                            (`id_foto`,
                            `id_documento`,
                            `arquivo`)
                            VALUES
                            (NULL,
                            :ID_DOCUMENTO,
                            :ARQUIVO2);");
                $this->bind(':ID_DOCUMENTO', $id_documento);
                $this->bind(':ARQUIVO2', $foto2);
                $this->execute();


                // Inserindo os dados do local do documento
                
                $this->query("INSERT INTO `sird-db`.`local_documento`
                            (`tipo_local`,
                            `id_proprietario`,
                            `id_local`)
                            VALUES
                            (:TIPO_LOCAL,
                            :ID_PROPRIETARIO,
                            :ID_LOCAL);");
                $this->bind(':TIPO_LOCAL', $_SESSION['usuario_local']['tipo_local']);
                $this->bind(':ID_PROPRIETARIO', $id_proprietario);
                $this->bind(':ID_LOCAL', $_SESSION['usuario_local']['id_local']);
                $this->execute();
                
                // Registrando a alteração
                $this->query("INSERT INTO `sird-db`.`operacao_documento` 
                            (`id_operacao`, 
                            `id_agente`, 
                            `id_documento`, 
                            `tipo`, 
                            `data`) 
                            VALUES(NULL, 
                            :ID_AGENTE, 
                            :ID_DOCUMENTO, 
                            :TIPO_DOCUMENTO, 
                            CURRENT_TIMESTAMP);");
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                $this->bind(':ID_DOCUMENTO', $id_documento);
                $this->bind(':TIPO_DOCUMENTO', $adicionarDocumentoCategoria);
                $this->execute();
                
              
                $this->commit();
            } catch (\PDOException $erro) {
                $this->rollBack();
                
                Messages::setMessage("Aconteceu um erro tente novamente mais tarde. ERRO: {$erro->getMessage()}", "error");

            }


            
            //Verify
            
                //Redirect  
                Messages::setMessage("Publicação feita com sucesso", "success");
                header('Location: ' . ROOT_URL . 'documentos/');
 

        }

        $this->query('SELECT * FROM categoria_documento');
        $row = $this->resultSet();
        return $row;  
    }
    public function Editar($param)
    {
        
        $this->query('SELECT * FROM comando_municipal_informacao WHERE id_cm = :ID_CM');
        $this->bind(':ID_CM', $param);
        $row = $this->resultSet();
        return $row;  
    }
}