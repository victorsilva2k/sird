<?php

class AgenteModel extends Model{
    public function register()
    {   
        //Sanitizing POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        if (isset($post['submit'])) {

            extract($post);

            if ($name == '' || $email == '' || $password == '' ) {
                Messages::setMessage("Please Fill in all fields", "error");
                return;
            }
            $password = password_hash($password, PASSWORD_DEFAULT);
            
            $this->query("INSERT INTO users (name, email, password) VALUES(:NAME, :EMAIL, :PASSWORD)");
            $this->bind(':NAME', $name);
            $this->bind(':EMAIL', $email);
            $this->bind(':PASSWORD', $password);
            $this->execute();
            //Verify
            if ($this->lastInsertId()) {
                //Redirect  
                header('Location: ' . ROOT_URL . 'users/login');
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
                            $this->query("SELECT ap.id_posto posto, ap.cargo 
                                      FROM agente_conta ac 
                                      JOIN agente_posto ap ON ac.id_agente = ap.id_agente 
                                      WHERE ac.id_agente =  :ID_AGENTE");
                            $this->bind(':ID_AGENTE', $_SESSION['dados_usuario']['id']);
                            $local_row = $this->singleResult();
                            extract($local_row);
                            $_SESSION['dados_usuario'] = array(
                                "id_local"    => $posto,
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
}