<?php

class ShareModel extends Model{
    public function Index()
    {
        $this->query('SELECT * FROM shares ORDER BY id DESC');
        $rows = $this->resultSet();
        return $rows;
    }

    public function add()
    {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'shares');
        }
        //Sanitizing POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // INSERT MySQL
        if (isset($post['submit'])) {
            extract($post);
            if ($title == '' || $body == '' || $link == '' ) {
                Messages::setMessage("Please Fill in all fields", "error");
                return;
            }
            $this->query("INSERT INTO shares (title, body, link, user_id) VALUES(:TITLE, :BODY, :LINK, :USER_ID)");
            $this->bind(':TITLE', $title);
            $this->bind(':BODY', $body);
            $this->bind(':LINK', $link);
            $this->bind(':USER_ID', $_SESSION['dados_usuario']['id']);
            $this->execute();
            //Verify
            if ($this->lastInsertId()) {
                //Redirect  
                header('Location: ' . ROOT_URL . 'shares');
            }

        }
        return;
    }


}