<?php

class UserModel extends Model{
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

    public function login()
    {
        //Sanitizing POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        if (isset($post['submit'])) {
            
            extract($post);
            
            
            $this->query("SELECT password, name, email, id FROM users WHERE email = :EMAIL");
            $this->bind(':EMAIL', $email);
            // $this->bind(':PASSWORD', $password);
            $row = $this->singleResult();
            
            if ($this->rowCounte() > 0) {

                extract($row);
                if (password_verify($input_password, $password)) {

                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['dados_usuario'] = array(
                        "id"    => $id,
                        "email" => $email,
                        "name"  => $name
                    );
    
                    header('Location: ' . ROOT_URL . 'shares');
    
                    
                }else {
                    Messages::setMessage("Incorrect login", "error");
                }
            }else {
                Messages::setMessage("Incorrect login", "error");
            }

        }
        return;
    }
}