<?php
User::changeEmail();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
</head>
<body>

<div class="changeEmail">
    <form action="">
        <label for="oldPassword">Old password:</label>
        <input type="text" name="oldPassword">
        <br>
        <label for="newPassword">New password:</label>
        <input type="text" name="newPassword">
        <br>
        <label for="confPassword">Confirm password:</label>
        <input type="text" name="confPassword">
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
</div>

</body>
</html>