<?php


class Idea
{
    private $_id_idea;
    private $_id_member;
    private $_title;
    private $_text;
    private $_submitted_date;
    private $_accepted_date;
    private $_refused_date;
    private $_closed_date;
    private $_status;


    public function __construct($_id_idea, $_id_member, $_title, $_text, $_submitted_date, $_accepted_date, $_refused_date, $_closed_date, $_status)
    {
        $this->_id_idea = $_id_idea;
        $this->_id_member = $_id_member;
        $this->_title = $_title;
        $this->_text = $_text;
        $this->_submitted_date = $_submitted_date;
        $this->_accepted_date = $_accepted_date;
        $this->_refused_date = $_refused_date;
        $this->_closed_date = $_closed_date;
        $this->_status = $_status;
    }

    /**
     * @return mixed
     */
    public function getIdIdea()
    {
        return $this->_id_idea;
    }

    /**
     * @return mixed
     */
    public function getIdMember()
    {
        return $this->_id_member;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
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
    public function getAcceptedDate()
    {
        return $this->_accepted_date;
    }

    /**
     * @return mixed
     */
    public function getRefusedDate()
    {
        return $this->_refused_date;
    }

    /**
     * @return mixed
     */
    public function getClosedDate()
    {
        return $this->_closed_date;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_status;
    }

    public function html_IdIdea()
    {
        return htmlspecialchars($this->_id_idea);
    }
}
