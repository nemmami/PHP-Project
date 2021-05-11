
<div class="list_member">
      <h1>Admin Page</h1>
        <br>
        <h2>Users List</h2>
          <div class="role">
              <form action="?action=memberList" method="post">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="submit" class="btn btn-secondary" name="form_role" value="Admin">Admin</button>
                    <button type="submit" class="btn btn-secondary" name="form_role" value="Member">Member</button>
                    <button type="submit" class="btn btn-secondary" name="form_role" value="Banned">Banned</button>
                </div>
              </form>
          </div>
           

            <br>
            
            <h4><?php echo $notificationRole ?></h4>
            <br>
            <?php echo $notificationUpdate ?>
            <br>
            <form class="members" action="?action=memberList" method="post">
            <?php if ($role == 'Admin') { ?>
              <input type="submit" name="form_remo" value="Remove Admin acces to :">
            <?php } elseif ($role == 'Member') { ?>
              <input type="submit" name="form_up" value="Give Admin acces to :">
              <input type="submit" name="form_ban" value="BAN">
              <?php } ?>
            <br>

            <?php foreach($tabMembers as $member){ ?>
              <?php if($member->html_IdMember() != $_SESSION['member']) {?>
                <?php if ($role == 'Admin') { ?>
                  <?php echo "<li>".$member->html_Username()." - Admin"."</li>"; ?>
                  <input type="radio" name="remove"
                          value="<?php echo $member->html_IdMember() ?>">
                <?php } elseif ($role == 'Banned') {?>
                    <?php echo "<li>".$member->html_Username()." - Banned"."</li>"; ?>
                <?php } else { ?>
                  <?php echo "<li>".$member->html_Username()." - Member"."</li>"; ?>
                    <input type="radio" name="upgrade"
                          value="<?php echo $member->html_IdMember() ?>">
                <?php } ?>
              <?php } ?>
            <?php } ?>
            </form>
</div>
