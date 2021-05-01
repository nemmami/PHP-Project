<main>
    <?php echo $idea->getTitle() ?>

    <?php for ($i = 0; $i < count($tabComments); $i++) { ?>
        <br>
        <?php if ($tabComments[$i]->getIdMember() == $_SESSION['member'] && $tabComments[$i]->getIsDeleted() == 0) { ?>
            <?php echo $tabComments[$i]->getText() ?>
            <form action="?action=comments" method="post">
                <input type="radio" name="delete"
                       value="<?php echo $tabComments[$i]->getIdComment() ?>">
                <button type="submit" class="btn btn-danger" name="form_delete">Delete</button>
            </form>
        <?php } elseif ($tabComments[$i]->getIdMember() != $_SESSION['member'] && $tabComments[$i]->getIsDeleted() == 0) { ?>
            <?php echo $tabComments[$i]->getText() ?>
        <?php } else { ?>
            Ce message a été supprimé.
        <?php } ?>
        <br>
    <?php } ?>

    <br>
    <form class="tableComments" action="" method="post" id="addComments">
        <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 110px"
                  name="text"></textarea>
            <label for="floatingTextarea2">Comments</label>
            <input class="btn btn-primary" type="submit" value="Add Comments" name="form_comments">
            <?php echo $notification ?>
        </div>
    </form>
    <br>
    <br>
</main>