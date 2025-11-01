<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/blog/templates/admin/header.php' ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <h2>Articles</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Is published</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Created at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?php echo $row['isPublished'] ? 'Yes' : 'No' ?></td>
                        <td><img width="200" src="/blog/images/<?= $row['img'] ?>" alt="<?= $row['title'] ?>"></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['createdAt'] ?></td>
                        <td>
                            <a href="/blog/admin/?act=edit&id=<?= $row['id'] ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                            <a href="/blog/admin/?act=delete&id=<?= $row['id'] ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?php echo $currentPage == 1 ? 'disabled' : '' ?>"><a class="page-link" href="/blog/admin/?page=<?= $currentPage - 1 ?>">Previous</a></li>
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <li class="page-item <?php echo $i == $currentPage ? 'active' : '' ?>"><a class="page-link" href="/blog/admin/?page=<?= $i ?>"><?= $i ?></a></li>
            <?php endfor ?>
            <li class="page-item <?php echo $currentPage == $pages ? 'disabled' : '' ?>"><a class="page-link" href="/blog/admin/?page=<?= $currentPage + 1 ?>">Next</a></li>
        </ul>
    </nav>
</main>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/blog/templates/admin/footer.php' ?>