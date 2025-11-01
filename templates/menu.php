<?php if (isset($user) && $user['isAdmin'] == 1): ?>
    <a href="/blog/admin">
        <button type="button" class="btn btn-primary add-article">Admin articles</button>
    </a>
<?php endif ?>

<?php if (isset($user) && $user): ?>
    <a href="/blog/?act=articles">
        <button type="button" class="btn btn-secondary add-article">My articles</button>
    </a>
    <a href="/blog/?act=add">
        <button type="button" class="btn btn-success add-article">Add new article</button>
    </a>
    <a href="/blog/?act=profile">
        <button type="button" class="btn btn-secondary add-article">Profile</button>
    </a>
    <a href="/blog/?act=logout">
        <button type="button" class="btn btn-dark add-article">Logout</button>
    </a>
<?php else: ?>
    <a href="/blog/?act=login">
        <button type="button" class="btn btn-success add-article">Log in</button>
    </a>
<?php endif ?>