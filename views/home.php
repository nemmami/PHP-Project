
<form class="table" action="?action=login" method="post" id="login">
    <h5>LOGIN</h5>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
        <label for="floatingPassword">Password</label>
        <br>
        <input class="btn btn-primary" type="submit" value="Login" name="form_login">
        <?php echo $notificationLogin; ?>
    </div>
</form>


<form class="table" action="index.php?action=register" method="post" id="register">
    <h5>REGISTER</h5>
    <div class="form-floating mb-3">
        <input type="username" class="form-control" id="floatingInput" placeholder="Username" name="username">
        <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
        <label for="floatingPassword">Password</label>
        <br>
        <input class="btn btn-primary" type="submit" value="Register" name="form_ajout">
        <?php echo $notificationRegister; ?>
    </div>
</form>
