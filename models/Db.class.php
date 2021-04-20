<?php
class Db
{
    private static $instance = null;
    private $_connection;

    private function __construct()
    {
        try {
            //$this->_connection = new PDO('mysql:host=localhost;port=3306;dbname=webproject;charset=utf8','root','');
            $this->_connection = new PDO('mysql:host=localhost;port=3307;dbname=webproject;charset=utf8','root','');
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
    public function select_connection($email_adress, $password)
    {
        $query = "SELECT * FROM members WHERE email_adress =" . $this->_connection->quote($email_adress) . " AND password =" . $this->_connection->quote($password);
        $result = $this->_connection->query($query);
        if ($result->rowcount() == 0) {
            return null;
        } else {
            $row = $result->fetch();
            return $row;
        }
    }
    public function selectMembres() {
        $query = 'SELECT * FROM members ORDER BY no ASC';
        $ps = $this->_connection->prepare($query);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Membre($row->no,$row->nom,$row->password,$row->photo);
        }
        var_dump($tableau);
        return $tableau;
    }
}