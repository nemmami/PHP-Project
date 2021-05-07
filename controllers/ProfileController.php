<?php


class ProfileController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        # If someone writes ?action=profile without going through the login 
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=home"); # HTTP redirection to the login action
            die();
        }

        $notificationIdea = "";
        $notificationComments = "";

        # The user's votes table
        $tabVote = $this->_db->get_vote($_SESSION['member']);
        $tabVoteIdea = array();
        for ($i = 0; $i < count($tabVote); $i++) {
            $tabVoteIdea[$i] = $this->_db->get_idea($tabVote[$i]->getIdIdea());
        }

        # The user's comments table
        $tabComment = $this->_db->get_comments_of_a_member($_SESSION['member']);

        # Insertion of a new idea
        if (!empty($_POST['form_ajout'])) {
            # The user need to complete the form
            if (empty($_POST['title']) && empty($_POST['text'])) {
                $notificationIdea = 'Please enter a title and the text';
            } elseif (empty($_POST['title'])) {
                $notificationIdea = 'Please enter a title';
            } elseif (empty($_POST['text'])) {
                $notificationIdea = 'Please enter a text';
            } else {
                # The user has successfully added a new idea
                $_SESSION['idea'] = $this->_db->insert_idea($_POST['title'], $_POST['text'], $_SESSION['member']);
                $notificationIdea = 'The idea has been add';
            }
        }

        # Redirection to the comments page
        $notificationComments = '';
        if(!empty($_POST['form_comments'])) {
            if(empty($_POST['comments'])) {
                $notificationComments = 'Please select an idea';
            } else {
                $_SESSION['idea'] = $_POST['comments'];
                header("Location: index.php?action=comments");
                die();
            }
        }

        # Redirection to the comments page
        if(!empty($_POST['form_discussion'])) {
            if(empty($_POST['comments'])) {
                $notificationComments = 'Please select an idea';
            } else {
                $_SESSION['idea'] = $_POST['comments'];
                header("Location: index.php?action=comments");
                die();
            }
        }

        # The user's ideas table
        $tabIdeasProfile = $this->_db->get_idea_profile($_SESSION['member']);

        include (VIEWS_PATH."profile.php");
    }
}