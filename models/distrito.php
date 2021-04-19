<?php

class DistritoModel extends Model{

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
    public function editar($id_Distrito)
    {




        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

        if (isset($post['submit'])) {

            extract($post);

            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($editarDistritoNome == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("UPDATE `sird-db`.`Distrito`
                                    SET
                                    `Distrito` = :NOME
                                    WHERE `id_Distrito` = :ID_Distrito;");

                $this->bind(':NOME', $editarDistritoNome);
                $this->bind(':ID_Distrito', $id_Distrito);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Distrito editado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais/index/distrito');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify



        }
        $this->query('select * from Distrito WHERE id_Distrito = :ID_Distrito;');
        $this->bind(":ID_Distrito", $id_Distrito);
        $row = $this->resultSet();
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