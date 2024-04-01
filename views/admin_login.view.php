 <?php require "components/head.php"?>
<p><a href="/" class="btn btn-outline-danger">Atpakaļ</a></p>
 <div class="content">
 <h1>Login for boss</h1>
 <br>
 <p>Hint: admin123</p>
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    <form method="post">
        <label for="name">Name</label>
        <input name="name" id="name" value="<?= htmlspecialchars($_POST["name"] ?? "") ?>" class="form-control">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control"><br>
        
        <button class="btn btn-primary">Log in</button>
    </form>

    </div>
</body>
</html>