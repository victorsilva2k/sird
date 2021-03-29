<?php

class BairroModel extends Model{
    public function Index()
    {
        // Pegando dados das categorias de documentos
        $this->query('SELECT * FROM categoria_documento;');
        $row["categorias"] = $this->resultSet();

        // Pegando dados dos bairros
        $this->query('select * from bairro;');
        $row["bairros"] = $this->resultSet();
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
            if ($adicionarBairroNome == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("INSERT INTO `sird-db`.`bairro`
                                    (`bairro`)
                                    VALUES
                                    (:NOME);");

                $this->bind(':NOME', $adicionarBairroNome);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Bairro adicionado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify



        }
        $this->query('select * from bairro;');
        $row = $this->resultSet();
        return $row;



    }
    public function editar($id_bairro)
    {




        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

        if (isset($post['submit'])) {

            extract($post);

            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($editarBairroNome == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("UPDATE `sird-db`.`bairro`
                                    SET
                                    `bairro` = :NOME
                                    WHERE `id_bairro` = :ID_BAIRRO;");

                $this->bind(':NOME', $editarBairroNome);
                $this->bind(':ID_BAIRRO', $id_bairro);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Bairro editado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify



        }
        $this->query('select * from bairro WHERE id_bairro = :ID_BAIRRO;');
        $this->bind(":ID_BAIRRO", $id_bairro);
        $row = $this->resultSet();
        return $row;




    }
    public function eliminar($id_bairro)
    {


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("DELETE FROM `sird-db`.`bairro`
                                    WHERE id_bairro = :ID_BAIRRO;");
                $this->bind(':ID_BAIRRO', $id_bairro);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Bairro eliminado com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde {$erro->getMessage()}", "error");

            }
            //Verify



        }







}