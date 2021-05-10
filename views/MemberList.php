
<div id="content">
      <h1>Admin Page</h1>
        <br>
          <div class="role">
              <form action="?action=memberList" method="post">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="submit" class="btn btn-secondary" name="form_role" value="Admin">Admin</button>
                    <button type="submit" class="btn btn-secondary" name="form_role" value="Member">Member</button>
                </div>
              </form>
            </div>
           
            <h2>Users List</h2>
                 <br>
  
            <?php echo $notificationRole ?>
            <br></br>
            <?php if ($role == 'Admin') { ?>
              <input type="submit" class="AdminMember" name="form_remo" value="Remove Admin acces to :">
            <?php } else { ?>
              <input type="submit" class="AdminMember" name="form_up" value="Give Admin acces to :">
              <?php } ?>
            <br>

            <?php foreach($tabMembers as $member){ ?>
              <?php if ($role == 'Admin') { ?>
                <?php echo "<li>".$member->html_Username()." - Admin"."</li>"; ?>
                <input type="radio" name="remove"
                         value="<?php echo $member->html_IdMember() ?>">
              <?php } else { ?>
                <?php echo "<li>".$member->html_Username()." - Member"."</li>"; ?>
                <input type="radio" name="upgrade"
                         value="<?php echo $member->html_IdMember() ?>">
               <?php } ?>
            <?php } ?>
</div>
