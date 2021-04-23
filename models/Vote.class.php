<?php


class Vote {
    private $_id_member;
    private $_id_idea;

    /**
     * Vote constructor.
     * @param $_id_member
     * @param $_id_idea
     */
    public function __construct($_id_member, $_id_idea)
    {
        $this->_id_member = $_id_member;
        $this->_id_idea = $_id_idea;
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
    public function getIdIdea()
    {
        return $this->_id_idea;
    }




}