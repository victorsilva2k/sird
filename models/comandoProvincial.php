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


            $this->query("SELECT cm.data_criacao, p.provincia, m.municipio, cm.id_comando_municipal, cm.terminal
                        FROM `comando_municipal` `cm`
                        JOIN `comando_municipal_localizacao` `cml` ON `cm`.`id_comando_municipal` = `cml`.`id_cm`
                        JOIN `provincia` `p` ON `cml`.`provincia` = `p`.`id_provincia`
                        JOIN municipio m ON cml.municipio = m.id_municipio
                        JOIN `bairro` `b` ON `cml`.`bairro` = `b`.`id_bairro` WHERE cm.comando_provincial = :ID_CP;");
            $this->bind(':ID_CP', $_SESSION['usuario_local']['id_local']);
            $row['comando_municipal'] = $this->resultSet();
            return $row;


    }
    public function mostrarComando()
    {
        $this->query('SELECT * FROM comando_municipal_informacao;');
        $row = $this->resultSet();
        return $row;
    }
    public function Editar()
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
                $this->bind(':ID_CM', $_SESSION['usuario_local']['id_local']);
                $this->execute();

                // Registrando a alteração
                $this->query("INSERT INTO `sird-db`.`operacao_comando_municipal` (`id_operacao`, `id_agente`, `id_cm`, `tipo`, `data`) VALUES(NULL, :ID_AGENTE, :ID_CM, 2, CURRENT_TIMESTAMP);");
                $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                $this->bind(':ID_CM', $_SESSION['usuario_local']['id_local']);
                $this->execute();

                $this->commit();
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde", "error");

            }
            //Verify

            if ($this->rowCounte() >= 1) {
                //Redirect  
                Messages::setMessage("Edição feita com sucesso", "success");
                header('Location: ' . ROOT_URL . 'comandosmunicipais');
            }
            
        }
        $this->query('SELECT * FROM comando_municipal_informacao;');
        $row["comando_municipal"] = $this->resultSet();

        $this->query('select * from distrito');
        $row["distritos"] = $this->resultSet();

        $this->query('select * from bairro ;');
        $row["bairros"] = $this->resultSet();
    
        return $row;  
    }
}