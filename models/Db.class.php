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
        $query = 'SELECT * from membres WHERE username=:username';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':username',$username);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    public function email_exists($email_adress) {
        $query = 'SELECT * from membres WHERE email_adress=:email_adress';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':username',$email_adress);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    public function insert_membre($username,$email_adress,$password)
    {
        $query = 'INSERT INTO membres (username,email_adress,password) values (:username,:email_adress,:password)';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':username', $username);
        $ps->bindValue(':email_adress', $email_adress);
        $ps->bindValue(':password', $password);
        $ps->execute();
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