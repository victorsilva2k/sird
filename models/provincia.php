<?php

class ProvinciaModel extends Model{

    public function adicionar()
    {

        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

        if (isset($post['submit'])) {

            extract($post);

            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($adicionarProvinciaNome == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("INSERT INTO `sird-db`.`provincia`
                            (
                            `provincia`)
                            VALUES
                            (:PROVINCIA);
                            ");

                $this->bind(':PROVINCIA', $adicionarProvinciaNome);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Provincia adicionado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais/index/municipio');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde {$erro->getMessage()}", "error");

            }
            //Verify



        }


    }
    public function editar($id_provincia)
    {




        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

        if (isset($post['submit'])) {

            extract($post);

            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($editarProvinciaNome == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados da provincia
                $this->query("UPDATE `sird-db`.`provincia`
                                    SET
                                    provincia = :PROVINCIA
                                    WHERE `id_provincia` = :ID_PROVINCIA;");
                $this->bind(':PROVINCIA', $editarProvinciaNome);
                $this->bind(':ID_PROVINCIA', $id_provincia);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Provincia editada com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais/index/municipio');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify



        }
        // Pegas os dados da Provincia

        $this->query('SELECT * FROM provincia WHERE id_provincia = :ID_PROVINCIA');
        $this->bind(':ID_PROVINCIA', $id_provincia);
        $row['provincia'] = $this->resultSet();
        return $row;




    }








}