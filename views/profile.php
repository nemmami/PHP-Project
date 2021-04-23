
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

<table id="ideas">
    <thead>
    <tr>
        <th>Title</th>
        <th>Idea</th>
        <th>Id_idea</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i = 0; $i < count($tabIdeasProfile); $i++) { ?>
        <tr>
            <td><span class="title"><?php echo $tabIdeasProfile[$i]->getTitle() ?></span></td>
            <td><span class="text"><?php echo $tabIdeasProfile[$i]->getText() ?></span></td>
            <td><span class="idIdea"><?php echo $tabIdeasProfile[$i]->getIdIdea() ?></span></td>
        </tr>
    <?php } ?>
    </tbody>
