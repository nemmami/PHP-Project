<h1>LISTE DES IDEA</h1>
<table class="ideas">
    <thead>
    <tr>
        <th>Title</th>
        <th>Idea</th>
        <th>Id_idea</th>
    </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($tabIdeas); $i++) { ?>
            <tr>
                <td><span class="title"><?php echo $tabIdeas[$i]->getTitle() ?></span></td>
                <td><span class="text"><?php echo $tabIdeas[$i]->getText() ?></span></td>
                <td><span class="idIdea"><?php echo $tabIdeas[$i]->getIdIdea() ?></span></td>
            </tr>
        <?php } ?>
    </tbody>
</table>