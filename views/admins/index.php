<h1>Users list:</h1>
<form action="/admins/delete" method="post">
<table class="user_list">
    <tr>
        <th></th>
        <th>id</th>
        <th>Name</th>
        <th>Password</th>
        <th>Age</th>
        <th>Notes</th>
        <th>Description</th>
        <th>Picture path</th>
        <th>Picture</th>
        <th>Actions</th>
    </tr>
<?php foreach ($data['users'] as  $user) : ?>
    <tr>
        <td>
            <input type="radio" name="data[user][id]" value="<?=$user['id'];?>">
        </td>
        <td><?=$user['id'];?></td>
        <td><?=$user['name'];?></td>
        <td><?=$user['password'];?></td>
        <td><?=$user['age'];?></td>
        <td><?=($user['age'] > 18)? 'Совершеннолетний' : 'Несовершеннолетний';?></td>
        <td><?=$user['description'];?></td>
        <td><?=$user['avatar_url'];?></td>
        <td><img src="/<?=$user['avatar_url'];?>" alt="<?=$user['avatar_url'];?>"> </td>
        <td>
            <a href="/users/view/<?=$user['id'];?>">View /</a>
            <a href="/users/edit/<?=$user['id'];?>"> edit</a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
    <br>
    <br>
    <input value="Delete" type="submit" name="delete">
</form>