<main>
    <div class="container">
        <div class="row align items-start">
            <div class="explo">
                <h1>LIST OF IDEAS</h1>
                <div class="filter">
                    <form action="?action=explorationAdmin" method="post">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-primary" name="form_tab" value="top_3">Top 3</button>
                            <button type="submit" class="btn btn-primary" name="form_tab" value="top_10">Top 10</button>
                            <button type="submit" class="btn btn-primary" name="form_tab" value="all">All</button>
                        </div>
                    </form>
                    <br>
                    <form action="?action=explorationAdmin" method="post">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-primary" id="btn_yellow" name="form_filter"
                                    value="submitted">Submitted Idea
                            </button>
                            <button type="submit" class="btn btn-primary" id="btn_yellow" name="form_filter"
                                    value="opened">Opened Idea
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
                    <form action="?action=explorationAdmin" method="post">
                        <?php echo $notificationSelect ?>
                        <table id="ideas">
                            <thead>
                            <tr>
                                <th>Number of Votes</th>
                                <th>Title</th>
                                <th>Idea</th>
                                <th><input type="submit" name="form_open" value="open"></th>
                                <th><input type="submit" name="form_refuse" value="refuse"></th>
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
                                            <input type="radio" name="open"
                                                   value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                                   <!--<?php $tabIdeasExploration[$i]->update_status("opened", value) ?>-->
                                        </td>
                                        <td>
                                            <input type="radio" name="refuse"
                                                   value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                                   <!--<?php $tabIdeasExploration[$i]->update_status("refused", value) ?>-->
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                        <br>
                        <br>
                    </form>
                <?php } elseif ($filter == 'opened') { ?>
                    <?php echo $notificationFilter ?>
                    <form action="?action=explorationAdmin" method="post">
                        <?php echo $notificationSelect ?>
                        <table id="ideas">
                            <thead>
                            <tr>
                                <th>Number of Votes</th>
                                <th>Title</th>
                                <th>Idea</th>
                                <th><input type="submit" name="form_close" value="close"></th>
                                <th><input type="submit" name="form_refuse" value="refuse"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($tabIdeasExploration); $i++) { ?>
                                <?php if ($tabIdeasExploration[$i]->getStatus() == 'opened') { ?>
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
                                            <input type="radio" name="close"
                                                   value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                                   <!--<?php $tabIdeasExploration[$i]->update_status("closed", $tabIdeasExploration[$i]->getIdIdea()) ?>-->
                                        </td>
                                        <td>
                                            <input type="radio" name="refuse"
                                                   value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                                   <!--<?php $tabIdeasExploration[$i]->update_status("refused", $tabIdeasExploration[$i]->getIdIdea()) ?>-->
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
                    <form action="?action=explorationAdmin" method="post">
                        <?php echo $notificationSelect ?>
                        <table id="ideas">
                            <thead>
                            <tr>
                                <th>Number of Votes</th>
                                <th>Title</th>
                                <th>Idea</th>
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
                    <form action="?action=explorationAdmin" method="post">
                        <?php echo $notificationSelect ?>
                        <table id="ideas">
                            <thead>
                            <tr>
                                <th>Number of Votes</th>
                                <th>Title</th>
                                <th>Idea</th>
                                <th><input type="submit" name="form_open" value="open"></th>
                                <th><input type="submit" name="form_close" value="close"></th>
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
                                            <input type="radio" name="open"
                                                   value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                                   <!--<?php $tabIdeasExploration[$i]->update_status("opened", $tabIdeasExploration[$i]->getIdIdea()) ?> -->          
                                        </td>
                                        <td>
                                            <input type="radio" name="close"
                                                   value="<?php echo $tabIdeasExploration[$i]->html_IdIdea() ?>">
                                                   <!--<?php $tabIdeasExploration[$i]->update_status("closed", $tabIdeasExploration[$i]->getIdIdea()) ?>-->      
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
