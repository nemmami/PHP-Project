<main>
    <div class="container">
        <div class="row align items-start">
            <div class="explo">
                <h1>LISTE DES IDEES</h1>
                <form action="?action=exploration" method="post">
                    <?php echo $notificationVote ?>
                    <table id="ideas">
                        <thead>
                        <tr>
                            <th>Number of Votes</th>
                            <th>Title</th>
                            <th>Idea</th>
                            <th><input type="submit" name="form_vote" value="Vote"></th>
                            <th><input type="submit" name="form_comments" value="Comments"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for ($i = 0; $i < count($tabIdeasExploration); $i++) { ?>
                            <tr>
                                <td>
                                    <span class="number_of_vote"><?php echo $tabIdeasExploration[$i]->getNumberOfVotes() ?></span>
                                </td>
                                <td><span class="title"><?php echo $tabIdeasExploration[$i]->getTitle() ?></span></td>
                                <td><span class="text"><?php echo $tabIdeasExploration[$i]->getText() ?></span></td>
                                <td><input type="radio" name="vote"
                                           value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>"></td>
                                <td><input type="radio" name="comments"
                                           value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <br>
                    <br>
                </form>
            </div>
        </div>
    </div>
</main>
