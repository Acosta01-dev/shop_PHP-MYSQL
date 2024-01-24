<?php
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'config.php';

session_start();

if (!isset($_SESSION["user"])) {
    header("location: ../pages/login_register_screen.php?user=0");
    exit();
} else {
    $user_email = $_SESSION["user"];
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$user_email]);
    $user_result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user_result) {
        echo "Error: User not found";
        exit();
    }

    $user_id = $user_result['id'];

    $purchase_stmt = $conn->prepare("SELECT * FROM purchase_history WHERE user_id = ?");
    $purchase_stmt->execute([$user_id]);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Purchase History</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body id="user_panel_body">
        
        <h2 class='mb-2'>Purchase History:</h2> <p><?=  $_SESSION["user"] . " | Your user ID: ". $user_id?> </p><hr/>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Purchase Date</th>
                    <th scope="col">Payment Status</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($row = $purchase_stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($row['product_name']); ?>
                        </td>
                        <td>
                            <?= $row['quantity']; ?>
                        </td>
                        <td>$
                            <?= $row['amount'];  ?> 
                        </td>
                        <td>
                            <?= $row['purchase_date']; ?>
                        </td>
                        <td>
                            <?= $row['payment_status']; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>

        <a href="../index.php" class="btn btn-primary mb-1">Go Back</a>
        <form action="../php/logout.php" method="post">
            <button type="submit" class="btn btn-danger">Sign Out</button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    </body>

    </html>

    <?php
}
?>
