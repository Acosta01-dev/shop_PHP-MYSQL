<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register Screen</title>
</head>
<body>
    <h2>Login</h2>
    <form action="../php/verify_user.php" method="post">
        <label for="login_email">Email:</label>
        <input type="email" id="login_email" name="login_email" required>
        <br>
        <label for="login_password">Password:</label>
        <input type="password" id="login_password" name="login_password" required>
        <br>
        <button type="submit">Login</button>
    </form>

    <h2>Register</h2>
    <form action="../php/add_user.php" method="post">
        <label for="register_email">Email:</label>
        <input type="email" id="register_email" name="register_email" required>
        <br>
        <label for="register_password">Password:</label>
        <input type="password" id="register_password" name="register_password" required>
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
