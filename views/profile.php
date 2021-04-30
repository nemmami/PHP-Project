<div class="container">
    <div class="row align items-start">
        <div class="col">
            <h1>AJOUT D'IDEE</h1>
            <form class="tableIdea" action="?action=default" method="post" id="addIdea">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="title" name="title">
                    <label for="floatingInput">Title</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="text"
                              style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Text</label>
                    <br>
                    <input class="btn btn-primary" type="submit" value="Add Idea" name="form_ajout">
                    <?php echo $notificationIdea ?>
                </div>
            </form>
        </div>

        <div class="col">
            <h1>MY IDEAS</h1>
            <form action="?action=default" method="post">
                <?php echo $notificationComments ?>
                <table id="ideas">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Idea</th>
                        <th><input type="submit" name="form_comments" value="Comments"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($tabIdeasProfile); $i++) { ?>
                        <tr>
                            <td><span class="title"><?php echo $tabIdeasProfile[$i]->getTitle() ?></span></td>
                            <td><span class="text"><?php echo $tabIdeasProfile[$i]->getText() ?></span></td>
                            <td><input type="radio" name="comments"
                                       value="<?php echo $tabIdeasProfile[$i]->getIdIdea() ?>">
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>

        <div class="col">
            <h1>MY VOTES</h1>
            <table id="ideas">
                <thead>
                <tr>
                    <th>Number Of Idea</th>
                    <th>Title</th>
                    <th>Idea</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < count($tabVoteIdea); $i++) { ?>
                    <tr>
                        <td><span class="id"><?php echo $tabVoteIdea[$i]->getIdIdea() ?></span></td>
                        <td><span class="title"><?php echo $tabVoteIdea[$i]->getTitle() ?></span></td>
                        <td><span class="text"><?php echo $tabVoteIdea[$i]->getText() ?></span></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="col">
            <h1>MY COMMENTS</h1>
            <form action="?action=default" method="post">
                <?php echo $notificationComments ?>
                <table id="ideas">
                    <thead>
                    <tr>
                        <th>Number Of Idea</th>
                        <th>My Comments</th>
                        <th><input type="submit" value="Go to discussion" name="form_comments"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($tabComment); $i++) { ?>
                        <tr>
                            <td><span class="id"><?php echo $tabComment[$i]->getIdIdea() ?></span></td>
                            <td><span class="text"><?php echo $tabComment[$i]->getText() ?></span></td>
                            <td><input type="radio" name="comments"
                                       value="<?php echo $tabComment[$i]->getIdComment() ?>">
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>

    </div>
</div>


