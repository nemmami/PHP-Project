<div id="content">
    <h1>Admin Page</h1>
</div>

<h2>Users List</h2>
<?php
echo "<ul>";
foreach($tabMembers as $member){
    echo "<li>".$member->html_Username()." . ".$member->html_IsAdmin()."</li>";
    //echo "<ul>";
    //foreach($member->get_comments() as $comment){
      //  echo "<li>".$comment->html_text()."</li>";
    //}
   // echo "</ul>";
}
echo "</ul>";
?>

