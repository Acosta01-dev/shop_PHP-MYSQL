<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="see_cart_body">
    <?php
    session_start();

    if (!isset($_SESSION["user"])) {
        header("location: ../pages/login_register_screen.php?user=0");
    } else {
        ?>
        <a href='../index.php' class="btn btn-primary mb-3">Go Back</a>

        <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['carrito'] as $index => $producto): ?>
                        <tr>
                            <th scope="row">
                                <?php echo $index + 1; ?>
                            </th>
                            <td>
                                <?php echo $producto['nombre']; ?>
                            </td>
                            <td>
                                <input type='number' id='cantidad-<?php echo $producto['id']; ?>' name='cant'
                                    value='<?php echo $producto['cantidad']; ?>' min='1' max='99'>
                            </td>
                            <td>
                                <?php echo "$ " . number_format($producto['precio'] * $producto['cantidad'], 2); ?>
                            </td>
                            <td>
                                <button class='actualizar-cantidad' data-id='<?php echo $producto['id']; ?>'>Update
                                    Quantity</button>
                                <button class='eliminar-item' data-id='<?php echo $producto['id']; ?>'>Delete Product</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button class="paypal-button" onclick="window.location.href='../php/checkout.php'">
                <span class="paypal-button-title">
                    Buy now with
                </span>
                <span class="paypal-logo">
                    <i>Pay</i><i>Pal</i>
                </span>
            </button>

        <?php else: ?>
            <p class="alert alert-warning">The cart is empty.</p>
        <?php endif;
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    <script src="../app/app.js"></script>
</body>

</html>