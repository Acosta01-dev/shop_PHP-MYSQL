<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register Screen</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="body_loginregister">
    <?php
    if (isset($_GET["user"]) && $_GET["user"] === "0") {
        echo "<p  class='alert alert-warning'>Please sign in before purchasing</p>";
        echo "<p class='alert alert-danger'>Developer note: admin account: email: admin@admin.com password: admin</p>";
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
            <input type="password" class="form-control" id="register_password" name="register_password" required>
        </div>
        <button class="btn btn-primary mb-5" type="submit">Register</button>
    </form>
    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>