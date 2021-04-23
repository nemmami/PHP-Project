
<li><a href="index.php?action=logout">Se déconnecter</li></a>
<br>
<h1>AJOUT D'IDEE</h1>
<form class="tableIdea" action="index.php?action=addIdea" method="post" id="addIdea">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="title" name="title">
        <label for="floatingInput">Title</label>
    </div>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="text" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Text</label>
        <br>
        <input class="btn btn-primary" type="submit" value="Add Idea" name="form_ajout">
        <?php echo $notificationIdea ?>
    </div>
</form>
