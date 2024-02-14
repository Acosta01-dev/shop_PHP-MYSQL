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
                    <a class="hover-underline-animation" href="?a">Catalog</a>
                </li>
                <li>
                    <a class="hover-underline-animation" href="?b">About Us</a>
                </li>
                <li>
                    <a class="hover-underline-animation" href="?c">Contact Us</a>
                </li>
            </ul>
        </nav>
        <div class="header-user_cart_menu">
            <a href="./pages/user_panel.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
            </a>
            <a href="./pages/see_cart.php" id="carrito">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-cart-fill" viewBox="0 0 16 16">
                    <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
                <p id="numero-carrito">
                    <?= count($_SESSION["carrito"]); ?>
                </p>
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
        <section id="catalog">
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
                            <?= $producto["precio"] ?> per unit
                        </i>
                        <input type="number" class="catalog_card_numero" name="numero" value="1" min="1" max="99">
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
        <section id="about_us">
            <div class="about_us-sec">
                <h2>About Us</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, deleniti. Lorem ipsum dolor sit, amet
                    consectetur adipisicing elit. Rem, at!</p>

                <div class="about_us-sec-icons">
                    <div>
                        <span class="about_us-sec-icons-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                class="bi bi-truck" viewBox="0 0 16 16">
                                <path
                                    d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                            </svg>
                        </span>
                        <span class="about_us-sec-icons-title">
                            Lorem:
                        </span>
                        <span class="about_us-sec-icons-text">
                            Lorem, ipsum dolor sit amet consectetur adipisicing.
                        </span>
                    </div>
                    <div>
                        <span class="about_us-sec-icons-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                class="bi bi-bag-heart" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M14 14V5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1M8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                            </svg>
                        </span>
                        <span class="about_us-sec-icons-title">
                            Lorem:
                        </span>
                        <span class="about_us-sec-icons-text">Lorem, ipsum dolor sit amet consectetur
                            adipisicing.</span>
                    </div>
                    <div>
                        <span class="about_us-sec-icons-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                class="bi bi-patch-question" viewBox="0 0 16 16">
                                <path
                                    d="M8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.7 1.7 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745" />
                                <path
                                    d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911z" />
                                <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0" />
                            </svg>
                        </span>
                        <span class="about_us-sec-icons-title">
                            Lorem:
                        </span>
                        <span class="about_us-sec-icons-text">Lorem, ipsum dolor sit amet consectetur
                            adipisicing.</span>
                    </div>
                    <div>
                        <span class="about_us-sec-icons-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5" />
                            </svg>
                        </span>
                        <span class="about_us-sec-icons-title">
                            Lorem:
                        </span>
                        <span class="about_us-sec-icons-text">Lorem, ipsum dolor sit amet consectetur
                            adipisicing.</span>
                    </div>
                </div>
            </div>
            <div class="about_us-sec">
                <img src="./img/storefront2.jpg">
            </div>
        </section>
    </main>

    <footer>
        <h3>Contact Us</h3>

        <form action="#" id="contact_form" class="form-field">

            <div class="form-field-name">
                <label class="label" for="fname">Name</label>
                <input id="fname" type="text" required>
            </div>

            <div class="form-field-email">
                <label class="label" for="email">Email</label>
                <input id="email" type="email" required>
            </div>

            <div class="form-field-comment_box">
                <label class="label">Message</label>
                <textarea name="comment-box" id="message"></textarea>
            </div>

            <div class="form-field-submit_button">
                <input type="submit" value="Submit">
            </div>

        </form>
    </footer>

    <script src="./app/app.js"></script>
</body>

</html>