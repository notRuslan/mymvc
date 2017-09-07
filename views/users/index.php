<h1>Users list:</h1>

<table class="user_list">
    <tr>
        <th>Name</th>
        <th>Notes</th>
        <th>Description</th>
        <th>Picture path</th>
        <th>Picture</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($data['users'] as  $user) : ?>
        <tr>
            <td><?=$user['name'];?></td>
            <td><?=($user['age'] > 18)? 'Совершеннолетний' : 'Несовершеннолетний';?></td>
            <td><?=$user['description'];?></td>
            <td><?=$user['avatar_url'];?></td>
            <td><img src="/<?=$user['avatar_url'];?>" alt="<?=$user['avatar_url'];?>"> </td>
            <td><a href="/users/view/<?=$user['id'];?>">View</a>  </td>
        </tr>
    <?php endforeach; ?>
</table>
