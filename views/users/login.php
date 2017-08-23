<h1 class="header">Login</h1>
<?= App\Message::getMessage(); ?>
<form action="/users/login" method="post" accept-charset="utf-8">
    <label for="name">Name:</label>
    <input type="text" name="data[user][name]" placeholder="Name" >
    <br>
    <label for="name">Password:</label>
    <input type="password" name="data[user][password]" placeholder="Password">
    <br>
    <br>
    <br>
    <input value="Login" type="submit" name="submit">


</form>
