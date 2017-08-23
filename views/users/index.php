<h1>Users list:</h1>
<?php foreach ($data['users'] as  $user) : ?>
    <?php pr($key);?>
    <li><a href="/users/show/<?=$user['id']?>"><?= $user['name'] ?></a></li>
<?php endforeach; ?>