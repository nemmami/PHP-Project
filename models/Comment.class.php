<?php


class Comment {

    private $_id_comment;
    private $_id_member;
    private $_id_idea;
    private $_text;
    private $_submitted_date;
    private $_is_deleted;

    public function __construct($id_comment, $id_member, $id_idea, $text, $submitted_date, $is_deleted) {
        $this->_id_comment = $id_comment;
        $this->_id_member = $id_member;
        $this->_id_idea = $id_idea;
        $this->_text = $text;
        $this->_submitted_date = $submitted_date;
        $this->_is_deleted = $is_deleted;
    }


    public function getIdComment()
    {
        return $this->_id_comment;
    }


    public function getIdMember()
    {
        return $this->_id_member;
    }


    public function getIdIdea()
    {
        return $this->_id_idea;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->_text;
    }

    /**
     * @return mixed
     */
    public function getSubmittedDate()
    {
        return $this->_submitted_date;
    }

    /**
     * @return mixed
     */
    public function getIsDeleted()
    {
        return $this->_is_deleted;
    }







}