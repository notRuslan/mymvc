<h1 class = "header">User edit: <?=$data['name'];?></h1>
<dt>User name:</dt>
<dd> <?=$data['name'];?></dd>
<dt>Password:</dt>
<dd><?=$data['password'];?></dd>
<dt>Description:</dt>
<dd><?=$data['description'];?></dd>
<dt>Avatar:</dt>
<dd><?=$data['avatar_url'];?></dd>
<dt>Pic:</dt>
<dd><img src="<?=$_SERVER['HTTP_ORIGIN'].'/'.$data['avatar_url'];?>" alt=""></dd>

<?= App\Message::getMessage(); ?>
<form action="/users/edit/<?=$data['id'];?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <input type="hidden" name="data[user][id]" placeholder="Name" value="<?=$data['id'];?>">
    <label for="data[user][name]">Name:</label>
    <input type="text" name="data[user][name]" placeholder="Name" value="<?=$data['name'];?>">
    <br>
    <label for="data[user][password]">Password:</label>
    <input type="password" name="data[user][password]" placeholder="Password" value="<?=$data['password'];?>">
    <br>
    <label for="data[user][age]">Age:</label>
    <input type="text" name="data[user][age]" placeholder="age" value="<?=$data['age'];?>">
    <br>
    <label for="data[user][description]">About your self:</label>
    <textarea name="data[user][description]" id="" cols="30" rows="10" placeholder="About your self:" ><?=$data['description'];?></textarea>
    <br>
    <br>
    <input type="hidden" name="data[user][avatar_url]" placeholder="Name" value="<?=$data['avatar_url'];?>">
        <label for=uploadFile">Add your avatar:</label>
        <input type="file" name="uploadFile">
    <br>
    <br>
    <input value="Send" type="submit" name="submit">


</form>
