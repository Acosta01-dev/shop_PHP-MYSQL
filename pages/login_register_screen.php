<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register Screen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="body_loginregister">
    <?php
    if (isset($_GET["user"]) && $_GET["user"] === "0") {
        echo "<p  class='alert alert-warning'>Please sign in before purchasing</p>";
    }
    ?>
    <h2>Sign In</h2>
    <hr>
    <form action="../php/verify_user.php" method="post">
        <div class="form-group">
            <label for="login_email">Email:</label>
            <input type="email" class="form-control" id="login_email" name="login_email" required>
        </div>
        <div class="form-group mb-3">
            <label for="login_password">Password:</label>
            <input type="password" class="form-control" id="login_password" name="login_password" required>
        </div>
        <button class="btn btn-primary mb-5" type="submit">Login</button>
    </form>

    <h2>Sign Up</h2>
    <hr>
    <form action="../php/add_user.php" method="post">
        <div class="form-group">
            <label for="register_email">Email:</label>
            <input type="email" class="form-control" id="register_email" name="register_email" required>
        </div>
        <div class="form-group mb-3">
            <label for="register_password">Password:</label>
            <input type="password" class="form-control"  id="register_password" name="register_password" required>
        </div>
        <button class="btn btn-primary mb-5" type="submit">Register</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>