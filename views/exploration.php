<h1>LISTE DES IDEES</h1>
<table id="ideas">
    <thead>
    <tr>
        <th>Title</th>
        <th>Idea</th>
        <th>Id_idea</th>
    </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($tabIdeasExploration); $i++) { ?>
            <tr>
                <td><span class="title"><?php echo $tabIdeasExploration[$i]->getTitle() ?></span></td>
                <td><span class="text"><?php echo $tabIdeasExploration[$i]->getText() ?></span></td>
                <td><span class="idIdea"><?php echo $tabIdeasExploration[$i]->getIdIdea() ?></span></td>
                <td><span class="comments"><button value="<?php echo $tabIdeasExploration[$i]->getIdIdea(); ?>"
                            <?php echo $idIdea = $tabIdeasExploration[$i]->getIdIdea()?> >Comments</button></td>
                <td><span classe="vote"><button>Vote</button></span></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
