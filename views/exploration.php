<main>
    <div class="container">
        <div class="row align items-start">
            <div class="explo">
                <h1>LISTE DES IDEES</h1>
                <div class="filter">
                    <form action="?action=exploration" method="post">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-primary" name="form_tab" value="top_3">Top 3</button>
                            <button type="submit" class="btn btn-primary" name="form_tab" value="top_10">Top 10</button>
                            <button type="submit" class="btn btn-primary" name="form_tab" value="all">All</button>
                        </div>
                    </form>
                    <br>
                    <form action="?action=exploration" method="post">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-primary" id="btn_yellow" name="form_filter"
                                    value="submitted">Submitted Idea
                            </button>
                            <button type="submit" class="btn btn-primary" id="btn_yellow" name="form_filter"
                                    value="openned">Openned Idea
                            </button>
                            <button type="submit" class="btn btn-primary" id="btn_yellow" name="form_filter"
                                    value="closed">Closed Idea
                            </button>
                            <button type="submit" class="btn btn-primary" id="btn_yellow" name="form_filter"
                                    value="refused">Refused Idea
                            </button>
                        </div>
                    </form>
                </div>
                <br>
                <?php if ($filter == 'submitted') { ?>
                    <?php echo $notificationFilter ?>
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
                                <?php if ($tabIdeasExploration[$i]->getStatus() == 'submitted') { ?>
                                    <tr>
                                        <td>
                                            <span class="number_of_vote"><?php echo $tabIdeasExploration[$i]->getNumberOfVotes() ?></span>
                                        </td>
                                        <td>
                                            <span class="title"><?php echo $tabIdeasExploration[$i]->getTitle() ?></span>
                                        </td>
                                        <td>
                                            <span class="text"><?php echo $tabIdeasExploration[$i]->getText() ?></span>
                                        </td>
                                        <td>
                                            <input type="radio" name="vote"
                                                   value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                        </td>
                                        <td>
                                            <input type="radio" name="comments"
                                                   value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                        <br>
                        <br>
                    </form>
                <?php } elseif ($filter == 'openned') { ?>
                    <?php echo $notificationFilter ?>
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
                                <?php if ($tabIdeasExploration[$i]->getStatus() == 'openned') { ?>
                                    <tr>
                                        <td>
                                            <span class="number_of_vote"><?php echo $tabIdeasExploration[$i]->getNumberOfVotes() ?></span>
                                        </td>
                                        <td>
                                            <span class="title"><?php echo $tabIdeasExploration[$i]->getTitle() ?></span>
                                        </td>
                                        <td>
                                            <span class="text"><?php echo $tabIdeasExploration[$i]->getText() ?></span>
                                        </td>
                                        <td>
                                            <input type="radio" name="vote"
                                                   value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                        </td>
                                        <td>
                                            <input type="radio" name="comments"
                                                   value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                        <br>
                        <br>
                    </form>
                <?php } elseif ($filter == 'closed') { ?>
                    <?php echo $notificationFilter ?>
                    <form action="?action=exploration" method="post">
                        <?php echo $notificationVote ?>
                        <table id="ideas">
                            <thead>
                            <tr>
                                <th>Number of Votes</th>
                                <th>Title</th>
                                <th>Idea</th>
                                <th><input type="submit" name="form_comments" value="Comments"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($tabIdeasExploration); $i++) { ?>
                                <?php if ($tabIdeasExploration[$i]->getStatus() == 'closed') { ?>
                                    <tr>
                                        <td>
                                            <span class="number_of_vote"><?php echo $tabIdeasExploration[$i]->getNumberOfVotes() ?></span>
                                        </td>
                                        <td>
                                            <span class="title"><?php echo $tabIdeasExploration[$i]->getTitle() ?></span>
                                        </td>
                                        <td>
                                            <span class="text"><?php echo $tabIdeasExploration[$i]->getText() ?></span>
                                        </td>
                                        <td>
                                            <input type="radio" name="comments"
                                                   value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                        <br>
                        <br>
                    </form>
                <?php } else { ?>
                    <?php echo $notificationFilter ?>
                    <form action="?action=exploration" method="post">
                        <?php echo $notificationVote ?>
                        <table id="ideas">
                            <thead>
                            <tr>
                                <th>Number of Votes</th>
                                <th>Title</th>
                                <th>Idea</th>
                                <th><input type="submit" name="form_comments" value="Comments"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($tabIdeasExploration); $i++) { ?>
                                <?php if ($tabIdeasExploration[$i]->getStatus() == 'refused') { ?>
                                    <tr>
                                        <td>
                                            <span class="number_of_vote"><?php echo $tabIdeasExploration[$i]->getNumberOfVotes() ?></span>
                                        </td>
                                        <td>
                                            <span class="title"><?php echo $tabIdeasExploration[$i]->getTitle() ?></span>
                                        </td>
                                        <td>
                                            <span class="text"><?php echo $tabIdeasExploration[$i]->getText() ?></span>
                                        </td>
                                        <td>
                                            <input type="radio" name="comments"
                                                   value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                        <br>
                        <br>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
