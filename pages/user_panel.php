<?php
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'config.php';

session_start();
if (isset($_SESSION["admin"]) && $_SESSION["admin"] === TRUE) {
    header("location: ../pages/admin_panel.php");
    exit();
}
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
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
        <!-- MDB -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body id="user_panel_body">

        <h2 class='mb-2'>Purchase History:</h2>
        <p>
            <?= $_SESSION["user"] . " | Your user ID: " . $user_id ?>
        </p>
        <hr />
        <div class="table-responsive">
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
                                <?= $row['amount']; ?>
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
        </div>

        <a href="../index.php" class="btn btn-primary mb-1">Go Back</a>
        <form action="../php/logout.php" method="post">
            <button type="submit" class="btn btn-danger">Sign Out</button>
        </form>
    </body>

    </html>

    <?php
}
?>