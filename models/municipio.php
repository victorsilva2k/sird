<?php

class MunicipioModel extends Model{

    public function adicionar()
    {

        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

        if (isset($post['submit'])) {

            extract($post);

            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($adicionarMunicipioNome == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("INSERT INTO `sird-db`.`municipio`
                            (`municipio`,
                            `provincia`)
                            VALUES
                            (
                            :MUNICIPIO,
                            :PROVINCIA);
                            ");

                $this->bind(':PROVINCIA', $adicionarMunicipioProvincia);
                $this->bind(':MUNICIPIO', $adicionarMunicipioNome);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Municipio adicionado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais/index/municipio');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde {$erro->getMessage()}", "error");

            }
            //Verify



        }
        $this->query('SELECT * FROM provincia');
        $row = $this->resultSet();
        return $row;



    }
    public function editar($id_municipio)
    {




        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

        if (isset($post['submit'])) {

            extract($post);

            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($editarMunicipioNome == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("UPDATE `sird-db`.`Municipio`
                                    SET
                                    `Municipio` = :MUNICIPIO, 
                                    provincia = :PROVINCIA
                                    WHERE `id_municipio` = :ID_MUNICIPIO;");

                $this->bind(':MUNICIPIO', $editarMunicipioNome);
                $this->bind(':PROVINCIA', $editarMunicipioProvincia);
                $this->bind(':ID_MUNICIPIO', $id_municipio);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Municipio editado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais/index/municipio');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify



        }
        // Pegas os dados dos distritos e municipio
        $this->query('SELECT m.municipio, p.provincia, p.id_provincia FROM municipio m JOIN provincia p ON m.provincia = p.id_provincia WHERE m.id_municipio = :ID_MUNICIPIO');
        $this->bind(':ID_MUNICIPIO', $id_municipio);
        $row['municipio'] = $this->resultSet();
        $this->query('SELECT * FROM provincia');
        $row['provincia'] = $this->resultSet();
        return $row;




    }
    public function eliminar($id_Distrito)
    {


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("DELETE FROM `sird-db`.`Distrito`
                                    WHERE id_Distrito = :ID_Distrito;");
                $this->bind(':ID_Distrito', $id_Distrito);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Distrito eliminado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde {$erro->getMessage()}", "error");

            }
            //Verify



        }







}