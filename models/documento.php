<?php

class DocumentosModel extends Model{
    public function Index($estado, $pagina = NULL)
    {
        
        $limite_inicial = 1;
        $limite_final = 50;
        $paginacao = 1;
        if ($pagina) {
            $limite_inicial = $pagina * 50;
            $limite_final = $limite_inicial + 50;
        }
        switch ($estado) {
            case 3:
                $this->query('SELECT * FROM ver_documentos_entregues');
                break;
            case 2:
                $this->query('SELECT * FROM ver_documentos_eliminados');
                break;
            
            default:
                $this->query('SELECT * FROM ver_documento_principal');
                break;
        }
        

        $row = $this->resultSet();
        return $row;
    }
    // Mostra os documentos recebidos a partir de um certo limite para outro
    public function recebidos($limite_inicial, $limite_final)
    {
        
        

        $this->query('SELECT DISTINCT pd.nome_completo, pd.id_proprietario,  group_concat(cd.categoria) 
        AS categorias, group_concat(od.data) 
        AS datas, group_concat(d.id_documento) 
        AS ids,
        ld.tipo_local, ld.id_local
        FROM propietario_documento pd 
        JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
        JOIN operacao_documento od ON od.id_documento = d.id_documento
        JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
        JOIN foto_documento fd ON d.id_documento = fd.id_documento
        JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
        WHERE d.estado = 1  GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC limit :LIMITE_INICIAL, :LIMITE_FINAL;');
        $this->bind(":LIMITE_INICIAL", $limite_inicial);
        $this->bind(":LIMITE_FINAL", $limite_final);

        $row['documentos'] = $this->resultSet();
        return $row;
    }
    public function entregues($limite_inicial, $limite_final)
    {
        
        

        $this->query('SELECT DISTINCT pd.nome_completo, pd.id_proprietario,  group_concat(cd.categoria) 
        AS categorias, group_concat(od.data) 
        AS datas, group_concat(d.id_documento) 
        AS ids,
        ld.tipo_local, ld.id_local
        FROM propietario_documento pd 
        JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
        JOIN operacao_documento od ON od.id_documento = d.id_documento
        JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
        JOIN foto_documento fd ON d.id_documento = fd.id_documento
        JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
        WHERE d.estado = 3  GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC limit :LIMITE_INICIAL, :LIMITE_FINAL;');
        $this->bind(":LIMITE_INICIAL", $limite_inicial);
        $this->bind(":LIMITE_FINAL", $limite_final);

        $row['documentos'] = $this->resultSet();
        return $row;
    }
    public function eliminados($limite_inicial, $limite_final)
    {
        
        

        $this->query('SELECT DISTINCT pd.nome_completo, pd.id_proprietario,  group_concat(cd.categoria) 
        AS categorias, group_concat(od.data) 
        AS datas, group_concat(d.id_documento) 
        AS ids,
        ld.tipo_local, ld.id_local
        FROM propietario_documento pd 
        JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
        JOIN operacao_documento od ON od.id_documento = d.id_documento
        JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
        JOIN foto_documento fd ON d.id_documento = fd.id_documento
        JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
        WHERE d.estado = 2  GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC LIMIT :LIMITE_INICIAL, :LIMITE_FINAL;');
        $this->bind(":LIMITE_INICIAL", $limite_inicial);
        $this->bind(":LIMITE_FINAL", $limite_final);

        $row['documentos'] = $this->resultSet();
        return $row;
    }
    public function Cidadao()
    {
        
        $this->query('SELECT DISTINCT pd.nome_completo, pd.id_proprietario,  group_concat(cd.categoria) 
        AS categorias, group_concat(od.data) 
        AS datas,   group_concat(fd.arquivo) AS fotos,
        ld.tipo_local, ld.id_local
        FROM propietario_documento pd 
        JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
        JOIN operacao_documento od ON od.id_documento = d.id_documento
        JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
        JOIN foto_documento fd ON d.id_documento = fd.id_documento
        JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
         WHERE d.estado = 1 GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC ');
      //hack adicionar data de publicacção na table dos agentes view
        $row = $this->resultSet();
        return $row;
    }
    public function pesquisar($pesquisar, $limite_inicial, $limite_final, $pagina)
    {


        if (isset($pesquisar)) {
            $row['pesquisar']['valor'] = $pesquisar;
            $row['pesquisar']['pagina'] = $pagina;
            $this->query("SELECT DISTINCT pd.nome_completo, pd.id_proprietario,  group_concat(cd.categoria) 
                        AS categorias, group_concat(od.data) 
                        AS datas,   group_concat(fd.arquivo) AS fotos,
                        ld.tipo_local, ld.id_local
                        FROM propietario_documento pd 
                        JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
                        JOIN operacao_documento od ON od.id_documento = d.id_documento
                        JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
                        JOIN foto_documento fd ON d.id_documento = fd.id_documento
                        JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
                        JOIN proprietario_telefone pt ON pt.id_proprietario = pd.id_proprietario
                        WHERE d.estado = 1 AND d.identifacador LIKE :PESQUISA 
                        OR pd.nome_completo LIKE :PESQUISA OR cd.categoria LIKE :PESQUISA 
                        OR pt.telefone LIKE :PESQUISA
                        GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC LIMIT :LIMITE_INICIAL, :LIMITE_FINAL;");
            $this->bind(':PESQUISA', "%$pesquisar%");
            $this->bind(":LIMITE_INICIAL", $limite_inicial);
            $this->bind(":LIMITE_FINAL", $limite_final);
            $row['documentos'] = $this->resultSet();
            return $row;
        }
    }
    // Não está a ser usado
    public function verCidadao($id_proprietario)
    {
        $this->query('SELECT DISTINCT pd.nome_completo, pd.id_proprietario,  group_concat(cd.categoria) 
        AS categorias, group_concat(od.data) 
        AS datas,   group_concat(fd.arquivo) AS fotos,
        ld.tipo_local, ld.id_local
        FROM propietario_documento pd 
        JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
        JOIN operacao_documento od ON od.id_documento = d.id_documento
        JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
        JOIN foto_documento fd ON d.id_documento = fd.id_documento
        JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
        WHERE pd.id_proprietario = :ID_PROPRIETARIO GROUP BY pd.id_proprietario;');
        $this->bind(':ID_PROPRIETARIO', $id_proprietario);
        $ro = $this->singleResult();
        $row['documento'] = $this->resultSet();
        extract($ro);
        if ($tipo_local == 'posto') {
            $this->query('SELECT p.nome, d.distrito, p.terminal, b.bairro, pl.rua, cml.municipio
                        FROM posto p 
                        JOIN posto_localizacao pl ON p.id_posto = pl.id_posto
                        JOIN bairro b ON b.id_bairro= pl.bairro
                        JOIN `distrito` `d` ON ((`d`.`id_distrito` = `pl`.`distrito`))
                        JOIN comando_municipal_localizacao cml ON p.id_comando_municipal = cml.id_cm WHERE p.id_posto = :ID_POSTO;');
            $this->bind(':ID_POSTO', $id_local);
            $row['local'] = $this->resultSet();
        } else {
            
                $this->query('SELECT cml.provincia, cml.municipio, d.distrito, b.bairro, cml.rua  
                FROM comando_municipal cm 
                JOIN comando_municipal_localizacao cml ON cm.id_comando_municipal = cml.id_cm
                JOIN bairro b ON b.id_bairro= cml.bairro
                JOIN distrito d ON ((d.id_distrito = cml.distrito))');
                $row['local'] = $this->resultSet();
                $nome = "Comando Municipal Talatona";

            
        }
        return $row;  
    }
    public function ver($id_proprietario)
    {
        $this->query('SELECT DISTINCT pd.nome_completo AS nome_proprietario, pd.id_proprietario, ed.nome_completo 
                    AS nome_entregador, ed.telefone AS telefone_entregador, group_concat(fd.arquivo) AS fotos,  group_concat(cd.categoria) 
                    AS categorias, group_concat(od.data) 
                    AS datas,  group_concat(pt.telefone) 
                    AS telefone_proprietario, group_concat(d.id_documento) 
                    AS ids,
                    ld.tipo_local, ld.id_local
                    FROM propietario_documento pd 
                    JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
                    JOIN operacao_documento od ON od.id_documento = d.id_documento
                    JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
                    JOIN foto_documento fd ON d.id_documento = fd.id_documento
                    JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
                    JOIN proprietario_telefone pt ON pt.id_proprietario = pd.id_proprietario
                    JOIN entregador_proprietario ep ON ep.id_proprietario = pd.id_proprietario
                    JOIN entregador_documento ed ON ed.id_entregador = ep.id_entregador
                    WHERE pd.id_proprietario = :ID_PROPRIETARIO GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC;');
        $this->bind(':ID_PROPRIETARIO', $id_proprietario);
        $ro = $this->singleResult();
        $row['documento'] = $this->resultSet();
        extract($ro);
        if ($tipo_local == 'posto') {
            $this->query('SELECT p.nome, d.distrito, p.terminal, b.bairro, pl.rua, m.municipio
                        FROM posto p 
                        JOIN posto_localizacao pl ON p.id_posto = pl.id_posto
                        JOIN bairro b ON b.id_bairro= pl.bairro
                        JOIN comando_municipal_localizacao cml ON p.id_comando_municipal = cml.id_cm
                        JOIN municipio m ON m.id_municipio = cml.municipio
                        JOIN `distrito` `d` ON ((`d`.`id_distrito` = `pl`.`distrito`))
                        WHERE p.id_posto = :ID_POSTO;');
            $this->bind(':ID_POSTO', $id_local);
            $row['local'] = $this->resultSet();
        } else {
            
                $this->query('SELECT cml.provincia, m.municipio, d.distrito, b.bairro, cml.rua, cm.terminal  
                FROM comando_municipal cm 
                JOIN comando_municipal_localizacao cml ON cm.id_comando_municipal = cml.id_cm
                JOIN bairro b ON b.id_bairro= cml.bairro
                JOIN distrito d ON ((d.id_distrito = cml.distrito))
                JOIN municipio m ON m.id_municipio = cml.municipio WHERE cm.id_comando_municipal = :ID_COMANDO_MUNICIPAL');
                $this->bind(':ID_COMANDO_MUNICIPAL', $id_local);
                $row['local'] = $this->resultSet();
                

            
        }

        $exp = explode(",", $ids);
    
            $this->query('SELECT od.tipo, od.data, a.nome, a.sobrenome
                        FROM `sird-db`.operacao_documento od 
                        JOIN agente a ON a.id_agente = od.id_agente
                        WHERE id_documento = :ID_DOCUMENTO ORDER BY data DESC');
            $this->bind(':ID_DOCUMENTO', $exp[0]);

            $row["alteracoes"] = $this->resultSet();
            return $row;

    }
    public function devolver($id_proprietario)
    {

               //Sanitizing POST
               $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
               // INSERT MySQL
               if (isset($post['submit'])) {
       
                try {
                    $this->beginTransaction();
    
                    // Alterando os dados do posto
                    $this->query("SELECT id_documento FROM documentos WHERE id_proprietario = :ID_PROPRIETARIO;");
                    $this->bind(':ID_PROPRIETARIO', $id_proprietario);
                    $this->execute();
    
                    $row = $this->resultSet();
                    foreach ($row as $item) {
                        extract($item);
                        
                        $this->query("UPDATE documentos SET estado = 3 WHERE id_documento = :ID_DOCUMENTO;");
                        $this->bind(':ID_DOCUMENTO', $id_documento);
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
                                    4, 
                                    CURRENT_TIMESTAMP);");
                        $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                        $this->bind(':ID_DOCUMENTO', $id_documento);
                        $this->execute();
                    }
    
                    $this->commit();
                    if ($this->rowCounte() >= 1) {
                        //Redirect
                        Messages::setMessage("Documento devolvido com sucesso", "success");
                        header('Location: ' . ROOT_URL . 'documentos/listar/entregues');
                    }
                } catch (\PDOException $erro) {
                    $this->rollBack();
    
                    Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");
    
                }
          

                       
                        // Inserindo os dados do local do documento
           
                    $this->query("UPDATE documentos SET estado = 3 WHERE id_documento = :ID_DOCUMENTO;");
                    $this->bind(':ID_DOCUMENTO', $devolverIdDocumento);
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
                                4, 
                                CURRENT_TIMESTAMP);");
                    $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                    $this->bind(':ID_DOCUMENTO', $devolverIdDocumento);
                    $this->execute();

                    
                      
                   
                       //Redirect  
                       Messages::setMessage("Devolução feita com sucesso", "success");
                       header('Location: ' . ROOT_URL . 'documentos/');
        
       
               }
        
               $this->query('SELECT DISTINCT pd.nome_completo, pd.id_proprietario,  group_concat(cd.categoria) 
               AS categorias, group_concat(od.data) 
               AS datas, group_concat(d.id_documento) 
               AS ids,  group_concat(fd.arquivo) AS fotos,
               ld.tipo_local, ld.id_local
               FROM propietario_documento pd 
               JOIN documentos d ON pd.id_proprietario = d.id_proprietario 
               JOIN operacao_documento od ON od.id_documento = d.id_documento
               JOIN categoria_documento cd ON d.categoria_documento = cd.id_categoria_documento 
               JOIN foto_documento fd ON d.id_documento = fd.id_documento
               JOIN local_documento ld ON ld.id_proprietario = pd.id_proprietario
               WHERE pd.id_proprietario = :ID_PROPRIETARIO GROUP BY pd.id_proprietario ORDER BY pd.id_proprietario DESC;');
                    $this->bind(':ID_PROPRIETARIO', $id_proprietario);

                $ro = $this->singleResult();
                $row['documento'] = $this->resultSet();
                extract($ro);
                if ($tipo_local == 'posto') {
                    $this->query('SELECT p.nome, d.distrito, b.bairro, pl.rua, cml.municipio
                                FROM posto p 
                                JOIN posto_localizacao pl ON p.id_posto = pl.id_posto
                                JOIN bairro b ON b.id_bairro= pl.bairro
                                JOIN `distrito` `d` ON ((`d`.`id_distrito` = `pl`.`distrito`))
                                JOIN comando_municipal_localizacao cml ON p.id_comando_municipal = cml.id_cm WHERE p.id_posto = :ID_POSTO;');
                    $this->bind(':ID_POSTO', $id_local);
                    $row['local'] = $this->resultSet();
                } else {
                    
                        $this->query('SELECT cml.provincia, cml.municipio, d.distrito, b.bairro, cml.rua  
                        FROM comando_municipal cm 
                        JOIN comando_municipal_localizacao cml ON cm.id_comando_municipal = cml.id_cm
                        JOIN bairro b ON b.id_bairro= cml.bairro
                        JOIN distrito d ON ((d.id_distrito = cml.distrito))');
                        $row['local'] = $this->resultSet();
                        $nome = "Comando Municipal Talatona";

                    
                }
                return $row;  
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
                for ($i=0; $i <= (count($adicionarDocumentoProprietarioNumero) - 1); $i++) { 

                    $this->query("INSERT INTO `sird-db`.`proprietario_telefone`
                            (`id_proprietario`,
                            `telefone`)
                            VALUES
                            (:ID_PROPRIETARIO,
                            :NUMERO);");
                    $this->bind(':ID_PROPRIETARIO', $id_proprietario);
                    $this->bind(':NUMERO', $adicionarDocumentoProprietarioNumero[$i]);
                    $this->execute();

                }
                


                // Inserindo os dados de entregador de documentos
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

                for ($i=0; $i <= (count($adicionarDocumentoCategoria) - 1); $i++) { 

                
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
                    $this->bind(':CATEGORIA', $adicionarDocumentoCategoria[$i]);
                    $this->bind(':DATA_EMISSAO', $adicionarDocumentoEmissao[$i]);
                    $this->bind(':IDENTIFICADOR', $adicionarDocumentoIdentificador[$i]);
                    $this->bind(':ID_PROPRIETARIO', $id_proprietario);
                    $this->execute();

                    $id_documento = $this->lastInsertId();

                    // Verifica se uma imagem 1 foi selecionada
                    if ($_FILES["adicionarDocumentoFotoFrente"]["error"][$i] > 0) {
                        $foto = "no-img.png";
                    } else {
                        $n = rand(0, 10000);
                        $exp = explode("/", $_FILES["adicionarDocumentoFotoFrente"]["type"][$i]);
                        $tipo_ficheiro = $exp[1];
    
                        if ($tipo_ficheiro !== 'jpeg' && $tipo_ficheiro !== 'png' && $tipo_ficheiro !== 'jpg') {
                            Messages::setMessage("Ficheiro não suportado", "error");
                            return;
                        }
                        $data = date("Y-m-d");
                        $foto = $n . '-' . $data . '.' . $tipo_ficheiro;
                        $destino = "assets/img/documentos/" . $foto;
                        move_uploaded_file($_FILES['adicionarDocumentoFotoFrente']['tmp_name'][$i], $destino);
                    }

                
                

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
                    $this->bind(':ARQUIVO', $foto);
                    $this->execute();

                    // Inserindo foto 2

                    // Verifica se uma imagem 2 foi selecionada
                    if ($_FILES["adicionarDocumentoFotoTraz"]["error"][$i] > 0) {
                        $foto = "no-img.png";
                    } else {
                        $n = rand(0, 10000);
                        $exp = explode("/", $_FILES["adicionarDocumentoFotoTraz"]["type"][$i]);
                        $tipo_ficheiro = $exp[1];
    
                        if ($tipo_ficheiro !== 'jpeg' && $tipo_ficheiro !== 'png' && $tipo_ficheiro !== 'jpg') {
                            Messages::setMessage("Ficheiro não suportado", "error");
                            return;
                        }
                        $data = date("Y-m-d");
                        $foto = $n . '-' . $data . '.' . $tipo_ficheiro;
                        $destino = "assets/img/documentos/" . $foto;
                        move_uploaded_file($_FILES['adicionarDocumentoFotoTraz']['tmp_name'][$i], $destino);
                    }
                    
                    $this->query("INSERT INTO `sird-db`.`foto_documento`
                                (`id_foto`,
                                `id_documento`,
                                `arquivo`)
                                VALUES
                                (NULL,
                                :ID_DOCUMENTO,
                                :ARQUIVO);");
                    $this->bind(':ID_DOCUMENTO', $id_documento);
                    $this->bind(':ARQUIVO', $foto);
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
                                1, 
                                CURRENT_TIMESTAMP);");
                    $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                    $this->bind(':ID_DOCUMENTO', $id_documento);
                    $this->execute();
                
                }
                
                $this->commit();
            } catch (\PDOException $erro) {
                $this->rollBack();
                
                Messages::setMessage("Aconteceu um erro tente novamente mais tarde. ERRO: {$erro->getMessage()}", "error");

            }
            
                //Redirect  
                Messages::setMessage("Publicação feita com sucesso", "success");
                header('Location: ' . ROOT_URL . 'documentos/');
 

        }

        $this->query('SELECT * FROM categoria_documento');
        $row = $this->resultSet();
        return $row;  
    }

    public function eliminar($id_proprietario)
    {


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("SELECT id_documento FROM documentos WHERE id_proprietario = :ID_PROPRIETARIO;");
                $this->bind(':ID_PROPRIETARIO', $id_proprietario);
                $this->execute();

                $row = $this->resultSet();
                foreach ($row as $item) {
                    extract($item);
                    
                    $this->query("UPDATE documentos SET estado = 2 WHERE id_documento = :ID_DOCUMENTO;");
                    $this->bind(':ID_DOCUMENTO', $id_documento);
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
                                4, 
                                CURRENT_TIMESTAMP);");
                    $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                    $this->bind(':ID_DOCUMENTO', $id_documento);
                    $this->execute();
                }

                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Documento eliminado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'documentos');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify



    }
    public function Editar($param)
    {
        
        $this->query('SELECT * FROM comando_municipal_informacao WHERE id_cm = :ID_CM');
        $this->bind(':ID_CM', $param);
        $row = $this->resultSet();
        return $row;  
    }
}