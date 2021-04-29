<?php echo $idea->getTitle() ?>
<form class="tableComments" action="" method="post" id="addComments">
    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px" name="text"></textarea>
        <label for="floatingTextarea2">Comments</label>
        <input class="btn btn-primary" type="submit" value="Add Comments" name="form_comments">
        <?php echo $notification ?>
    </div>
</form>
