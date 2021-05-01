<?php


class ProfileController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        # Si un petit fûté écrit ?action=profile sans passer par l'action login
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=home"); # redirection HTTP vers l'action login
            die();
        }

        $notificationIdea = "";
        $notificationComments = "";
        $tabIdeasProfile = $this->_db->get_idea_profile($_SESSION['member']);

        $tabVote = $this->_db->get_vote($_SESSION['member']);
        $tabVoteIdea = array();
        for ($i = 0; $i < count($tabVote); $i++) {
            $tabVoteIdea[$i] = $this->_db->get_idea($tabVote[$i]->getIdIdea());
        }

        $tabComment = $this->_db->get_comments_of_a_member($_SESSION['member']);
        $tabIdeasProfile = $this->_db->get_idea_profile($_SESSION['member']);
        if (!empty($_POST['form_ajout'])) {
            if (empty($_POST['title']) && empty($_POST['text'])) {
                $notificationIdea = 'Please enter a title and the text';
            } elseif (empty($_POST['title'])) {
                $notificationIdea = 'Please enter a title';
            } elseif (empty($_POST['text'])) {
                $notificationIdea = 'Please enter a text';
            } else {
                $_SESSION['idea'] = $this->_db->insert_idea($_POST['title'], $_POST['text'], $_SESSION['member']);
                $notificationIdea = 'The idea has been add';
            }
        }

        $notificationComments = '';
        if(!empty($_POST['form_comments'])) {
            if(empty($_POST['comments'])) {
                $notificationComments = 'Veuillez selectionner une idée';
            } else {
                $_SESSION['idea'] = $_POST['comments'];
                header("Location: index.php?action=comments");
                die();
            }
        }

        if(!empty($_POST['form_discussion'])) {
            if(empty($_POST['comments'])) {
                $notificationComments = 'Veuillez selectionner une idée';
            } else {
                $_SESSION['idea'] = $_POST['comments'];
                header("Location: index.php?action=comments");
                die();
            }
        }


        include (VIEWS_PATH."profile.php");
    }
}