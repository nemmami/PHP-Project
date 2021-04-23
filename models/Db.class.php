<?php
class Db
{
    private static $instance = null;
    private $_connection;

    private function __construct()
    {
        try {
            $this->_connection = new PDO('mysql:host=localhost;port=3306;dbname=webproject;charset=utf8','root','');
            //$this->_connection = new PDO('mysql:host=localhost;port=3307;dbname=webproject;charset=utf8','root','');
            $this->_connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->_connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        } 
		catch (PDOException $e) {
		    die('Erreur de connexion à la base de données : '.$e->getMessage());
        }
    }

	# Singleton Pattern
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

// idéalement, nous avons demandé que tout le code soit en anglais
    public function valider_utilisateur($email_adress,$password) {
        $query = 'SELECT password FROM members WHERE email_adress=:email_adress';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':email_adress', $email_adress);
        $ps->execute();
        if($ps->rowCount() == 0)
            return false;
        $hash = $ps->fetch()->password;
        return password_verify($password, $hash);
    }

    public function get_member ($email_adress) {
        $query = 'SELECT * FROM members WHERE email_adress=:email_adress';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':email_adress',$email_adress);
        $ps->execute();
        while ($row = $ps->fetch()) {
            $membre = new Member($row->id_member, $row->username, $row->email_adress, $row->password, $row->is_admin, $row->is_banned);
        }
        return $membre;
    }

    public function select_connection($email_adress, $password) {
        $query = "SELECT * FROM members WHERE email_adress =" . $this->_connection->quote($email_adress) . " AND password =" . $this->_connection->quote($password);
        $result = $this->_connection->query($query);
        if ($result->rowcount() == 0) {
            return null;
        } else {
            $row = $result->fetch();
            return $row;
        }
    }

    public function username_exists($username) {
        $query = 'SELECT * from members WHERE username=:username';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':username',$username);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    public function email_exists($email_adress) {
        $query = 'SELECT * from members WHERE email_adress=:email_adress';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':email_adress',$email_adress);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    public function insert_membre($username,$email_adress,$password) {
        $query = 'INSERT INTO members (username,email_adress,password) values (:username,:email_adress,:password)';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':username', $username);
        $ps->bindValue(':email_adress', $email_adress);
        $ps->bindValue(':password', $password);
        $ps->execute();
    }

    public function insert_idea($title, $text,$id_member) {
        $query = 'INSERT INTO ideas (title,text,id_member) values (:title,:text,:id_member)';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':title', $title);
        $ps->bindValue(':text', $text);
        $ps->bindValue(':id_member', $id_member);
        //$ps->bindValue(':submitted_date', $submitted_date);
        $ps->execute();
        //var_dump($ps);
        /*
        while ($row = $ps->fetch()) {
            $idea = new Idea($row->id_idea,$row->id_member,$row->title,$row->text,$row->submitted_date,
                $row->accepted_date,$row->refused_date,$row->closed_date,$row->status);
        }
        return $ps;
        */
    }

    public function get_idea_profile($id_member) {
        $query = 'SELECT * FROM ideas WHERE id_member=:id_member';
        $ps = $this->_connection->prepare($query);
        //$ps->bindValue(':title',$title);
        //$ps->bindValue(':text',$text);
        $ps->bindValue(':id_member',$id_member);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Idea($row->id_idea,$row->id_member,$row->title,$row->text,$row->submitted_date,
                $row->accepted_date,$row->refused_date,$row->closed_date,$row->status);
        }
        return $tableau;
    }

    public function get_idea_exploration($id_member) {
        $query = 'SELECT * FROM ideas WHERE id_member!=:id_member';
        $ps = $this->_connection->prepare($query);
        //$ps->bindValue(':title',$title);
        //$ps->bindValue(':text',$text);
        $ps->bindValue(':id_member',$id_member);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Idea($row->id_idea,$row->id_member,$row->title,$row->text,$row->submitted_date,
                $row->accepted_date,$row->refused_date,$row->closed_date,$row->status);
        }
        return $tableau;
    }

        # Function that performs a SELECT in the members table
        # and which returns a Array of object
        public function selectMember(){
            $query = 'SELECT username FROM members';
            $ps = $this->_db->prepare($query);
            $ps->execute();

            $tableau = array();
            while ($row = $ps->fetch()) {
                $tableau[] = new Member($row->username);
            }
            # For debug : display of the table to be returned
            // var_dump($tableau);
            return $tableau;
        }


}
