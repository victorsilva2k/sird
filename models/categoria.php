<?php

class CategoriaModel extends Model{


    public function adicionar()
    {




        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

        if (isset($post['submit'])) {

            extract($post);

            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($adicionarCategoriaNome == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("INSERT INTO `sird-db`.`categoria_documento`
                                    (`categoria`)
                                    VALUES
                                    (:NOME);");

                $this->bind(':NOME', $adicionarCategoriaNome);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Categoria adicionada com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify



        }
        $this->query('select * from categoria_documento;');
        $row = $this->resultSet();
        return $row;



    }
    public function editar($id_categoria)
    {




        //Limpando POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL

        if (isset($post['submit'])) {

            extract($post);

            // Caso o utizador não escrever ou deixar em branco um dos campos
            if ($editarCategoriaNome == '') {
                Messages::setMessage("Por favor preencha todos os campos", "error");
                return;
            }


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("UPDATE `sird-db`.`categoria_documento`
                                    SET
                                    `categoria` = :NOME
                                    WHERE `id_categoria_documento` = :ID_CATEGORIA;");

                $this->bind(':NOME', $editarCategoriaNome);
                $this->bind(':ID_CATEGORIA', $id_categoria);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Categoria editada com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify



        }
        $this->query('select * from categoria_documento WHERE id_categoria_documento = :ID_CATEGORIA;');
        $this->bind(":ID_CATEGORIA", $id_categoria);
        $row = $this->resultSet();
        return $row;




    }
    public function eliminar($id_categoria)
    {


            try {
                $this->beginTransaction();

                // Alterando os dados do posto
                $this->query("DELETE FROM `sird-db`.`categoria_documento`
                                    WHERE id_categoria_documento = :ID_CATEGORIA;");
                $this->bind(':ID_CATEGORIA', $id_categoria);
                $this->execute();


                $this->commit();
                if ($this->rowCounte() >= 1) {
                    //Redirect
                    Messages::setMessage("Categoria eliminada com sucesso", "success");
                    header('Location: ' . ROOT_URL . 'mais');
                }
            } catch (\PDOException $erro) {
                $this->rollBack();

                Messages::setMessage("Aconteceu um erro tente novamente mais tarde ", "error");

            }
            //Verify



        }







}