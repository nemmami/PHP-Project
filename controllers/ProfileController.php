<?php


class ProfileController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        $notificationIdea = "";
        $notificationComments = "";
        $tabIdeasProfile = $this->_db->get_idea_profile($_SESSION['member']);
        $tabVote = $this->_db->get_vote($_SESSION['member']);
        $tabVoteIdea = array();
        for ($i = 0; $i < count($tabVote); $i++) {
            $tabVoteIdea[$i] = $this->_db->get_idea($tabVote[$i]->getIdIdea());
        }
        $tabComment = $this->_db->get_comments_of_a_member($_SESSION['member']);
        include (VIEWS_PATH."profile.php");
    }
}