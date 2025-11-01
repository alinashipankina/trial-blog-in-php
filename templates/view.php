<?php include_once './templates/header.php' ?>


<main role="main">
    <div class="album py-5 bg-light">
        <div class="container">
            <?php include_once './templates/menu.php' ?>
            <h3><?= $article['title'] ?></h3>
            <div>
                <img src="/blog/images/<?= $article['img'] ?>" alt="<?= $article['title'] ?>" vspace="15">
                <p><?= $article['content'] ?></p>
                <div class="clear"></div>
                <form action="" method="post">
                    <input type="hidden" name="act" value="view">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Comment text</label>
                        <textarea class="form-control" id="exampleInputEmail1" name="comment" rows="5" placeholder="Comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add comment</button>
                </form>
            </div>
            <div class="clear"></div>
            <?php while ($comment = $stmtComment->fetch()): ?>
                <?php if ($comment['userId']): ?>
                    <?= $comment['email'] ?>
                <?php endif ?>
                <p>
                    <?= $comment['comment'] ?>
                </p>
            <?php endwhile ?>
        </div>
    </div>
</main>

<?php include_once './templates/footer.php' ?>