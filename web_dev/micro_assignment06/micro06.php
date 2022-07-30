<!DOCTYPE html>
<html>
    <head>
        <title>Micro 06 PHP</title>
        <style></style>
    </head>
    <body>
        <h1>PHP Process</h1>
        <?php
            if ($_GET['error']=='empty_username'){
                print "<strong>Please fill in the username!</strong>";
            } else if ($_GET['error']=='empty_password') {
                print "<strong>Please fill in the password!</strong>";
            } else if ($_GET['error']=='username_password_wrong'){
                print "<strong>Username or password wrong!</strong>";
            } else if ($_GET['correct']=='pokemon_caught'){
                print "You caught a secrete pokemon by logging in!";
            } else if ($_GET['error']=='unknown'){
                print "<strong>Unknown error!</strong>";

            }
        ?>
        <form action="micro06_process.php" method="POST">
            Username: <input type="text" name="username"><br>
            Password: <input type="text" name="password">
            <input type="submit">
        </form>
    </body>
</html>