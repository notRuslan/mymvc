<h1 class="header">Registration</h1>
    <?= App\Message::getMessage(); ?>
<form action="/users/registration" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <label for="name">Name:</label>
    <input type="text" name="data[user][name]" placeholder="Name">
    <br>
    <label for="name">Password:</label>
    <input type="password" name="data[user][password]" placeholder="Password" >
    <br>
    <label for="age">Age:</label>
    <input type="text" name="data[user][age]" placeholder="age">
    <br>
    <label for="description">About your self:</label>
    <textarea name="data[user][description]" id="" cols="30" rows="10" placeholder="About your self:"></textarea>
    <br>
    <br>
<!--    <label for=data[user][file]">Add your avatar:</label>-->
<!--    <input type="file" name="uploadFile">-->
    <br>
    <br>
    <input value="Registration" type="submit" name="submit">


</form>