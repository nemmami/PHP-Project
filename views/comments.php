<main>
    <!-- The idea-->
    <div class="main_idea">
        <h1><?php echo $idea->getTitle() ?></h1>
        <p id="text_idea"><?php echo $idea->getText() ?></p>
        <p>
            <hidden id="usenrmae_idea"><?php echo $member->getUsername() ?></hidden>
            shared this idea.
        </p>
        <?php echo $idea->getSubmittedDate() ?>
    </div>

    <!-- The comment of the idea -->
    <div class="comments">
        <?php for ($i = 0; $i < count($tabComments); $i++) { ?>
            <br>
            <!-- if the user is the comment's author -->
            <?php if ($tabComments[$i]->getIdMember() == $_SESSION['member'] && $tabComments[$i]->getIsDeleted() == 0) { ?>
                <p id="text_comment"><?php echo $tabComments[$i]->getText() ?></p>
                <p><?php echo $tabComments[$i]->getSubmittedDate() ?>
                <form action="?action=comments" method="post">
                    <button type="submit" class="btn btn-danger" name="form_delete"
                            value="<?php echo $tabComments[$i]->getIdComment() ?>">Delete
                    </button>
                </form></p>
                --------------------------------------------------
                <!-- if the user is not the comment's author -->
            <?php } elseif ($tabComments[$i]->getIdMember() != $_SESSION['member'] && $tabComments[$i]->getIsDeleted() == 0) { ?>
                <p id="text_comment"><?php echo $tabComments[$i]->getText() ?></p>
                <p><?php echo $tabComments[$i]->getSubmittedDate() ?></p>
                --------------------------------------------------
                <!-- if the comment is deleted -->
            <?php } elseif ($tabComments[$i]->getIsDeleted() == 1) { ?>
                <p>Ce message a été supprimé</p>
                <p><?php echo $tabComments[$i]->getSubmittedDate() ?></p>
                --------------------------------------------------
            <?php } ?>
            <br>
        <?php } ?>
    </div>
    <br>

    <!-- form to add comments -->
    <form class="tableComments" action="" method="post" id="addComments">
        <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 110px"
                  name="text"></textarea>
            <label for="floatingTextarea2">Comments</label>
            <br>
            <input class="btn btn-secondary" type="submit" value="Add Comments" name="form_comments">
            <?php echo $notification ?>
        </div>
    </form>
    <br>
    <br>
</main>