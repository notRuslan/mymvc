
<h1 class = "header">User view: <?=$data['name'];?></h1>
<?= App\Message::getMessage(); ?>
<h4><a href="/users/edit/<?=$data['id'];?>">Edit</a> profile for : <?=$data['name'];?></h4>
<dt>User name:</dt>
<dd> <?=$data['name'];?></dd>
<dt>Password:</dt>
<dd><?=$data['password'];?></dd>
<dt>Description:</dt>
<dd><?=$data['description'];?></dd>
<dt>Avatar:</dt>
<dd><?=$data['avatar_url'];?></dd>
<img src="/<?=$data['avatar_url'];?>" alt="<?=$data['name'];?>">


