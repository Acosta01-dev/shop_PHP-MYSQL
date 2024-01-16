<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}


require __DIR__ . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "config.php";

$query = "SELECT * FROM productos";
$stmt = $conn->prepare($query);
$stmt->execute();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ecommerce php</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body id="index_body">

    <header class="header">
        <div class="header-logo">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                    class="bi bi-bag-fill logo_svg" viewBox="0 0 16 16">
                    <path
                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z" />
                </svg>
                <p>Phone Shop</p>
            </a>
        </div>
        <nav class="header-nav_items">
            <ul>
                <li>
                    <a href="a">Catalog</a>
                </li>
                <li>
                    <a href="b">About Us</a>
                </li>
                <li>
                    <a href="c">Contact Us</a>
                </li>
            </ul>
        </nav>
        <div class="header-user_cart_menu">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
            </a>
            <a href="./php/see_cart.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-cart-fill" viewBox="0 0 16 16">
                    <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
                <p id="numero-carrito"><?=count($_SESSION["carrito"]);?></p>
            </a>
            <a id="burguer_menu" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </a>
        </div>
    </header>

    <main id="index_main">
        <section class="index_main-introduction">
            <div>
                <div>
                    <h2>
                        Get the last technology in
                        <div class="mask">
                            <span data-show>X </span>
                            <span>Y</span>
                            <span>Z </span>
                            <span>and more.</span>
                        </div>
                    </h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam repellendus laboriosam sint
                        molestias
                        praesentium est laudantium vitae distinctio quibusdam doloremq
                    </p>
                </div>
                <div class="index_main-introduction_buttons">
                    <a href="#" class="button">Shop Now</a>
                    <a href="#" class="button">Explore</a>
                </div>
            </div>
            <div>
                <img src="./img/PinePhone.png">
            </div>
        </section>
        <section class="catalog">
            <?php
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultados as $producto) {
                ?>
                <div class="catalog_card" data-id="<?= $producto["id"] ?>" data-nombre="<?= $producto["nombre"] ?>"
                    data-precio="<?= $producto["precio"] ?>">
                    <div class="catalog_card-title">
                        <p>
                            <?= $producto["nombre"] ?>
                        </p>
                    </div>
                    <div class="catalog_card-content">
                        <img src="./img/<?= $producto["imagen"] ?>">
                    </div>
                    <div class="catalog_card-footer">
                        <i>$
                            <?= $producto["precio"] ?> p.u.
                        </i>
                        <button class="agregar-carrito">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag-plus" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5" />
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                            </svg>
                            <p class="cart-message">Add to cart.</p>
                        </button>
                    </div>
                </div>
                <?php
            }
            ?>


        </section>

    </main>

    <footer>
        <p>Pie de página - © 2024 Tu Empresa</p>
    </footer>

    <script src="./app/app.js"></script>
</body>

</html>