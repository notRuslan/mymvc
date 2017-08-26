
<h1 class = "header">User view: <?=$data['name'];?></h1>
<?= App\Message::getMessage(); ?>

<dt>User name:</dt>
<dd> <?=$data['name'];?></dd>
<dt>Password:</dt>
<dd><?=$data['password'];?></dd>
<dt>Description:</dt>
<dd><?=$data['description'];?></dd>
<dt>Avatar:</dt>
<dd><?=$data['avatar_url'];?></dd>
<!--<dd><img src="/files/users_pic/" alt=""></dd>-->


