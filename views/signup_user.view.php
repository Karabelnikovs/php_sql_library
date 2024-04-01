 <?php require "components/head.php"?>
 <p><a href="logout" class="btn btn-outline-danger">Atpakaļ</a></p>
      <div class="content">
    <h1>Signup</h1>
    
    <form method="post" id="signup" novalidate>
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?=$_POST['name'] ?? "" ?>" class="form-control">
        </div>
        
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?=$_POST['email'] ?? "" ?>" class="form-control">
        </div>
        
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="<?=$_POST['password'] ?? "" ?>" class="form-control">
        </div>
        
        <div>
            <label for="password_confirmation">Repeat password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" value="<?=$_POST['password_confirmation'] ?? "" ?>" class="form-control">
        </div>
        <br>
        <button class="btn btn-primary">Sign up</button>
    </form>
</div>
</body>
</html>