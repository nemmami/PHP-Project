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
		    die('Database connection error : '.$e->getMessage());
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

    # -------------------------------------
    # Login & Register methods
    # -------------------------------------

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

    public function get_member_id($id_member) {
        $query = 'SELECT * FROM members WHERE id_member=:id_member';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_member',$id_member);
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
        $ps->execute();
    }

    # -------------------------------------
    # Idea methods
    # -------------------------------------

    public function get_idea_profile($id_member) {
        $query = 'SELECT * FROM ideas WHERE id_member=:id_member';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_member',$id_member);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Idea($row->id_idea,$row->id_member,$row->title,$row->text,$row->submitted_date,
                $row->opened_date,$row->refused_date,$row->closed_date,$row->status,$row->number_of_vote);
        }
        return $tableau;
    }

    public function get_idea_exploration($id_member) {
        $query = 'SELECT * FROM ideas WHERE id_member!=:id_member ORDER BY number_of_vote DESC';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_member',$id_member);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Idea($row->id_idea,$row->id_member,$row->title,$row->text,$row->submitted_date,
                $row->opened_date,$row->refused_date,$row->closed_date,$row->status,$row->number_of_vote);
        }
        return $tableau;
    }

    public function get_idea_exploration_limit_3($id_member) {
        $query = 'SELECT * FROM ideas WHERE id_member!=:id_member ORDER BY number_of_vote DESC LIMIT 3';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_member',$id_member);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Idea($row->id_idea,$row->id_member,$row->title,$row->text,$row->submitted_date,
                $row->opened_date,$row->refused_date,$row->closed_date,$row->status,$row->number_of_vote);
        }
        return $tableau;
    }

    public function get_idea_exploration_limit_10($id_member) {
        $query = 'SELECT * FROM ideas WHERE id_member!=:id_member ORDER BY number_of_vote DESC LIMIT 10';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_member',$id_member);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Idea($row->id_idea,$row->id_member,$row->title,$row->text,$row->submitted_date,
                $row->opened_date,$row->refused_date,$row->closed_date,$row->status,$row->number_of_vote);
        }
        return $tableau;
    }

    public function get_idea_filter($id_member, $status) {
        $query = 'SELECT * FROM ideas WHERE id_member!=:id_member AND status=:status ORDER BY number_of_vote DESC';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_member',$id_member);
        $ps->bindValue(':status',$status);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Idea($row->id_idea,$row->id_member,$row->title,$row->text,$row->submitted_date,
                $row->opened_date,$row->refused_date,$row->closed_date,$row->status,$row->number_of_vote);
        }
        return $tableau;
    }

    public function get_idea($id_idea) {
        $query = 'SELECT * FROM ideas WHERE id_idea=:id_idea';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_idea',$id_idea);
        $ps->execute();
        while ($row = $ps->fetch()) {
            $idea = new Idea($row->id_idea,$row->id_member,$row->title,$row->text,$row->submitted_date,
                $row->opened_date,$row->refused_date,$row->closed_date,$row->status,$row->number_of_vote);
        }
        return $idea;
    }

    public function update_idea($id_idea,$number_of_vote) {
        $query = 'UPDATE ideas SET number_of_vote=:number_of_vote WHERE id_idea=:id_idea';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_idea',$id_idea);
        $ps->bindValue(':number_of_vote',$number_of_vote);
        $ps->execute();
    }

    public function update_status($status, $id_idea, $datetime){ 
        if($status == 'submitted'){
            $query = "UPDATE ideas SET status= 'submitted', submitted_date = datetime WHERE id_idea=:id_idea";
            $ps = $this->_connection->prepare($query);
            $ps->bindValue('submitted',$status);
            $ps->bindValue(':submitted_date',$datetime);
            $ps->execute();   
        }elseif ($status == "opened") {
            $query = "UPDATE ideas SET status= 'opened', 'opened_date=datetime WHERE id_idea=:id_idea";
            $ps = $this->_connection->prepare($query);
            $ps->bindValue(':status',$status);
            $ps->bindValue(':opened_date',$datetime);
            $ps->execute();
        }elseif($status == "refused"){
            $query = "UPDATE ideas SET status= 'refused', refused_date=datetime WHERE id_idea=:id_idea";
            $ps = $this->_connection->prepare($query);
            $ps->bindValue('refused',$status);
            $ps->bindValue(':refused_date',$datetime);
            $ps->execute();
        }else{
            $query = "UPDATE ideas SET status= 'closed', closed_date=datetime WHERE id_idea=:id_idea";
            $ps = $this->_connection->prepare($query);
            $ps->bindValue('closed',$status);
            $ps->bindValue(':closed_date',$datetime);
            $ps->execute();
        }
    }

    public function idea_open_status($id_idea, $date_time){ 
        $query = "UPDATE ideas SET status= 'opened', opened_date = :date_time WHERE id_idea=:id_idea";
        $ps = $this->_connection->prepare($query);
        //$ps->bindValue(':status','opened');
        $ps->bindValue(':opened_date',$date_time);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }

    public function idea_close_status($id_idea, $datetime){ 
        $query = "UPDATE ideas SET status= 'closed', closed_date = :datetime WHERE id_idea=:id_idea";
        $ps = $this->_connection->prepare($query);
        //$ps->bindValue(':status','opened');
        //$ps->bindValue(':closed_date',$datetime);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }

    public function idea_refuse_status($id_idea, $datetime){ 
        $query = "UPDATE ideas SET status= 'refused', refused_date = :datetime WHERE id_idea=:id_idea";
        $ps = $this->_connection->prepare($query);
        //$ps->bindValue(':status','opened');
        //$ps->bindValue(':refused_date',$datetime);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }
    # -------------------------------------
    # Vote methods
    # -------------------------------------

    public function get_vote($id_member) {
        $query = 'SELECT * FROM votes WHERE id_member = :id_member';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_member',$id_member);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Vote($row->id_member,$row->id_idea);
        }
        return $tableau;
    }


    public function possible_vote($id_member, $id_idea) {
        $query = 'SELECT * FROM votes WHERE id_member = :id_member AND id_idea = :id_idea';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_member',$id_member);
        $ps->bindValue(':id_idea',$id_idea);
        $ps->execute();
        return $ps->rowCount();
    }

    public function insert_vote($id_member, $id_idea) {
        $query = 'INSERT INTO votes (id_member,id_idea) values (:id_member,:id_idea)';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->bindValue(':id_member',$id_member);
        $ps->execute();
    }

    public function get_number_of_vote($id_idea) {
        $query = 'SELECT * FROM votes WHERE id_idea=:id_idea';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_idea',$id_idea);
        $ps->execute();
        return $ps->rowCount();
    }

    # -------------------------------------
    # Comment methods
    # -------------------------------------

    public function insert_comments($id_member, $id_idea, $text) {
        $query = 'INSERT INTO comments (id_member,id_idea,text) values (:id_member,:id_idea,:text)';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_member',$id_member);
        $ps->bindValue(':id_idea',$id_idea);
        $ps->bindValue(':text',$text);
        $ps->execute();
    }

    public function get_comments_of_an_idea($id_idea) {
        $query = 'SELECT * FROM comments WHERE id_idea=:id_idea';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_idea',$id_idea);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Comment($row->id_comment, $row->id_member, $row->id_idea,
                $row->text, $row->submitted_date, $row->is_deleted);
        }
        return $tableau;
    }

    public function get_comments_of_a_member($id_member) {
        $query = 'SELECT * FROM comments WHERE id_member=:id_member';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_member',$id_member);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Comment($row->id_comment, $row->id_member, $row->id_idea,
                $row->text, $row->submitted_date, $row->is_deleted);
        }
        return $tableau;
    }

    public function get_comments($id_comment) {
        $query = 'SELECT * FROM comments WHERE id_comment=:id_comment';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_comment',$id_comment);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Comment($row->id_comment, $row->id_member, $row->id_idea,
                $row->text, $row->submitted_date, $row->is_deleted);
        }
        return $tableau;
    }

    public function update_comments($id_comment) {
        $query = 'UPDATE comments SET is_deleted=1 WHERE id_comment=:id_comment';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_comment',$id_comment);
        $ps->execute();
    }

    # -------------------------------------
    # Member methods
    # -------------------------------------

    public function get_members_list() {
        $query = 'SELECT * FROM members';
        $ps = $this->_connection->prepare($query);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Member($row->id_member,$row->username,$row->email_adress,$row->password,$row->is_admin,
                $row->is_banned);
        }
        return $tableau;
    }

    public function get_admin_list() {
        $query = 'SELECT * FROM members WHERE is_admin = 1';
        $ps = $this->_connection->prepare($query);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Member($row->id_member,$row->username,$row->email_adress,$row->password,$row->is_admin,
                $row->is_banned);
        }
        return $tableau;
    }

    public function get_simple_members_list() {
        $query = 'SELECT * FROM members WHERE is_admin = 0';
        $ps = $this->_connection->prepare($query);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
            $tableau[] = new Member($row->id_member,$row->username,$row->email_adress,$row->password,$row->is_admin,
                $row->is_banned);
        }
        return $tableau;
    }

    public function update_member_to_admin($id_member) {
        $query = 'UPDATE members SET is_admin=1 WHERE id_member=:id_member';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_member',$id_member);
        $ps->execute();
    }

    public function update_admin_to_member($id_member) {
        $query = 'UPDATE members SET is_admin=0 WHERE id_member=:id_member';
        $ps = $this->_connection->prepare($query);
        $ps->bindValue(':id_member',$id_member);
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
