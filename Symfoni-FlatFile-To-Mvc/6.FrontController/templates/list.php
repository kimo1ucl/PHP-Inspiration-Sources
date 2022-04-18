<!-- You now have a setup that will allow you to reuse the layout. 
Unfortunately, to accomplish this, you're forced to use 
a few ugly PHP functions (ob_start(), ob_get_clean()) in the template. 
Symfony solves this using a Templating component. 
You'll see it in action shortly. -->

<!-- templates/list.php -->
<?php $title = 'List of Posts' ?>

<?php ob_start() ?>
    <h1>List of Posts</h1>
    <ul>
        <?php foreach ($posts as $post): ?>
        <li>
            <a href="./show.php?id=<?= $post['id'] ?>">
                <?= $post['title'] ?>
            </a>
        </li>
        <?php endforeach ?>
    </ul>
<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>