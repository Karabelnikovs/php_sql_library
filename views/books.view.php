 <?php require "components/head.php"?>
 <p><a href="logout" class="btn btn-outline-danger">Log out</a></p>
  <div class="content">
<h1>Bibliotēka</h1><br>
    <form>
    <h2>Atrast grāmatu pēc nosaukuma</h2>
    <div class="input-group mb-3">
        <input name="title" type="text" value='<?= ($_GET["title"] ?? '') ?>' class="form-control" placeholder="Nosaukums">
    <div class="input-group-append">
        <button class="btn btn-outline-secondary"><a><span>Meklēt</span></a></button>
        </div>
        </div>
    </form>
    

<h2>Grāmatas:</h1>
<div class="table-responsive">
<table class="table table-bordered" id="responsive-table">
    <thead>
        <tr>
            <th scope="col">Nosaukums</th>
            <th scope="col">Autors</th>
            <th scope="col">Izdošanas gads</th>
            <th scope="col">Pieejamība</th>
            <th scope="col">Pierezervēt</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($books as $index => $book): ?>
        <?php $availability; 
        if($book["status"] == '1'){ $availability = "Pieejams"; }
        else if($book["user_id"] == $_SESSION['user_id']){ $availability = "Rezervēts tev"; }
        else{ $availability = "Nepieejams"; }
        ?>
        <tr>
            <th scope="row"><?= $book["title"] ?></td>
            <td><?= $book["author"] ?></td>
            <td><?= $book["release_date"] ?></td>
            <td><?= $availability ?></td>
            <td>
            <?php if ($book["status"] == '1'): ?>
                <form method="POST">
                    <input type="hidden" name="reserve" value="<?= $index ?>" class="form-control">
                    <button type="submit" name="reserve_book" class="btn btn-info">Rezervēt</button>
                </form>
            <?php elseif ($book["user_id"] == $_SESSION['user_id']): ?>
                <form method="POST">
                    <input type="hidden" name="return" value="<?= $index ?>" class="form-control">
                    <button type="submit" name="return_book" class="btn btn-danger">Atgriezt</button>
                </form>
            <?php else: ?>
                Rezervēts citam lietotājam
            <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
</div>             
</div>
</body>
</html>