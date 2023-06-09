<?php


class Idea
{
    private $_id_idea;
    private $_id_member;
    private $_title;
    private $_text;
    private $_submitted_date;
    private $_opened_date;
    private $_refused_date;
    private $_closed_date;
    private $_status;
    private $_number_of_vote;


    public function __construct($_id_idea, $_id_member, $_title, $_text, $_submitted_date, $_opened_date, $_refused_date, $_closed_date, $_status, $_number_of_vote)
    {
        $this->_id_idea = $_id_idea;
        $this->_id_member = $_id_member;
        $this->_title = $_title;
        $this->_text = $_text;
        $this->_submitted_date = $_submitted_date;
        $this->_opened_date = $_opened_date;
        $this->_refused_date = $_refused_date;
        $this->_closed_date = $_closed_date;
        $this->_status = $_status;
        $this->_number_of_vote = $_number_of_vote;
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
    public function getOpenedDate()
    {
        return $this->_opened_date;
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

    public function getNumberOfVotes() {
        return $this->_number_of_vote;
    }

    public function setNumberOfVotes($nbr) {
        $this->_number_of_vote = $nbr;
    }

    public function html_IdIdea(){
        return htmlspecialchars($this->_id_idea);
    }
}
