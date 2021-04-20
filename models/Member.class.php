<?php


class Member
{
    private $_id_member;
    private $_username;
    private $_email_adress;
    private $_password;
    private $_is_admin;
    private $_is_banned;

    public function __construct($id_member,$username,$email_adress,$password,$is_admin,$is_banned){
        $this->_id_member = $id_member;
        $this->_username = $username;
        $this->_email_adress = $email_adress;
        $this->_password = $password;
        $this->_is_admin = $is_admin;
        $this->_is_banned = $is_banned;
    }

    public function getIdMember()
    {
        return $this->_id_member;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function getEmailAdress()
    {
        return $this->_email_adress;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getIsAdmin()
    {
        return $this->_is_admin;
    }

    public function getIsBanned()
    {
        return $this->_is_banned;
    }

    public function html_IdMember()
    {
        return htmlspecialchars($this->_id_member);
    }

    public function html_Username()
    {
        return htmlspecialchars($this->_username);
    }

    public function html_EmailAdress()
    {
        return htmlspecialchars($this->_email_adress);
    }

    public function html_Password()
    {
        return htmlspecialchars($this->_password);
    }

    public function html_IsAdmin()
    {
        return htmlspecialchars($this->_is_admin);
    }

    public function html_IsBanned()
    {
        return htmlspecialchars($this->_is_banned);
    }
}