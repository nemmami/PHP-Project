<div id="content">
    <h1>Admin Page</h1>
</div>

<h2>Users List</h2>
<?php
echo "<ul>";
foreach($tabMembers as $member){
  if($member->getIsAdmin() == 1){
    echo "<li>".$member->html_Username()." - Admin"."</li>";
    //<div class="AdminMember"> <button type="submit" class="AdminMember" name="form_tab" value="Remove Admin acces">All</button></div>
  }else{
    echo "<li>".$member->html_Username()." - Member"."</li>";
  }

    //echo "<ul>";
    //foreach($member->get_comments() as $comment){
      //  echo "<li>".$comment->html_text()."</li>";
    //}
   // echo "</ul>";
}
echo "</ul>";
?>

