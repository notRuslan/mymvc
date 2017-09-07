<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel='stylesheet' href='/css/style.css'>
</head>
<body>
<?php if($_SESSION['user']['id']) : ?>
    <ul>
        <li><a href="/users/edit/<?php echo $_SESSION['user']['id']; ?>" >Edit Profile</a></li>
        <li><?php echo $_SESSION['user']?$_SESSION['user']['name'] . ': ':'' ?> <a href="/users/logout">Logout</a> </li>
    </ul>

<?php endif ;?>

<?php if(!$_SESSION['user']['id']) : ?>
    <ul>
        <li><a href="/users/index">Users list</a></li>
        <li><a href="/users/registration">Registration</a></li>
        <li><a href="/users/login">Login</a></li>
    </ul>

<?php endif ;?>




<?php if($_SESSION['user']['admin']) : ?>
    <ul>
        <li><a href="/admins/index">Edit users list</a></li>
    </ul>
<?php endif ;?>
