 <?php require "components/head.php"?>
 <p><a href="logout"  class="btn btn-outline-danger">Log out</a></p>
 <div class="content">
    <h1>Administratora pārvadības lapa</h1><br><br>
    <div class='admin-content'>
    <div>
        <h2>Pievienot grāmatu</h2>
        <form>
                <label for="title">Nosaukums:</label><br>
                <input id='title' name='title' value="<?= htmlspecialchars($GET["title"] ?? "") ?>" class="form-control" placeholder="Nosaukums"/>
            <br>
                <label for="author">Autors:</label><br>
                <input id='author' name='author' value="<?= htmlspecialchars($GET["author"] ?? "") ?>" class="form-control" placeholder="Autors"/>
            <br>
                <label for="release_date">Izdošanas gads:</label><br>
                <input type='date' placeholder="yyyy" max="2024" id='release_date' name='release_date' value="<?= htmlspecialchars($GET["release_date"] ?? "") ?>"/>
            <br><br>
                <input type="hidden" name="status" value="0">
                <label for="status">Pieejams:</label>
                <input type="checkbox" id='status' name='status' value="1"/><br>
            <button class="btn btn-primary">Pievienot grāmatu</button>
        </form>
    </div>
        <br>
    <div>
        <h2>Atrast grāmatu</h2>
        <form>
            <div class="input-group mb-3">
            <input name='d_title' value='<?= ($_GET["d_title"] ?? '') ?>' class="form-control" placeholder="Atrast grāmatu pēc nosaukuma"/>
            <div class="input-group-append">
            <button class="btn btn-outline-secondary">Meklēt</button>
            </div>
            </div>
        </form>
        <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Nosaukums</th>
                <th scope="col">Autors</th>
                <th scope="col">Izdošanas gads</th>
                <th scope="col">Pieejamība</th>
                <th scope="col">Izdzēst</th>
                <th scope="col">Rediģēt</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($books as $book){
                $availability= $book["status"]=='1' ? "pieejams" : "nepieejams";?>
                <tr>
                    <th scope="row"><?= $book["title"] ?></td>
                    <td><?= $book["author"] ?></td>
                    <td><?= $book["release_date"] ?></td>
                    <td><?= $availability ?></td>
                    <td>
                    <form method="GET">
                            <input type="hidden" name="delete" value="<?= $book['id'] ?>">
                            <button class="btn btn-outline-danger" type="submit">Izdzēst</button>    
                    </form>
                    </td>
                    <td>
                    <form method="GET">
                            <input type="hidden" name="edit" value="<?= $book['id'] ?>">
                            <button class="btn btn-outline-info" type="submit">Rediģēt</button>    
                    </form>
                    </td>
                </tr>
                <?php
        }?>
    </div>
    <div>
        <?php

        if (isset($editing) && $editing) {?>
        <h2>Rediģēt grāmatu</h2>
        <form method="POST">
        <input type="hidden" name="edit_id" value="<?= $edit_id ?>">
        <label for="title">Nosaukums:</label><br>
        <input id="title" name="title" value="<?= htmlspecialchars($edit_title) ?>" class="form-control" placeholder="Nosaukums"/><br>
        <label for="author">Autors:</label><br>
        <input id="author" name="author" value="<?=  htmlspecialchars($edit_author) ?>" class="form-control" placeholder="Autors"/><br>
        <label for="release_date">Izdošanas gads:</label><br>
        <input type="date" id="release_date" name="release_date" value="<?= htmlspecialchars($edit_release_date) ?>"/><br>
        <label for="status">Pieejams:</label>
        <input type="checkbox" id="status" name="status" value="1" <?= ($edit_status == 1 ? 'checked' : '') ?>/><br>
        <button type="submit" name="submit_edit" class="btn btn-primary">Saglabāt izmaiņas</button><br>
        </form>
        <?php
        } 
        ?>
        </div>
    </div>
    </div>
</body>
</html>