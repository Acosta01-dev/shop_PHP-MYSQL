<?php
session_start();
include "../php/config.php";

$query = "SELECT * FROM productos";
$stmt = $conn->prepare($query);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="body_adminpanel">
    <div class="d-flex flex-row">
        <a href="../index.php" class="btn btn-primary m-1">Go Back</a>
        <form action="../php/logout.php" method="post">
            <button type="submit" class="btn btn-danger  m-1">Sign Out</button>
        </form>
    </div>
    <?php
    if (isset($_GET["edited"])) {
        echo "<p class='alert alert-primary m-3' role='alert'>Element edited!</p>";
    }

    if (isset($_GET["deleted"])) {
        echo "<p class='alert alert-warning m-3' role='alert'>Element deleted!</p>";
    }

    if (isset($_GET["added"])) {
        echo "<p class='alert alert-success m-3' role='alert'>Element added!</p>";
    }
    ?>
    <main>
        <?php
        if ($result) {
            foreach ($result as $row) {
                ?>

                <form action="../php/update_database.php" method="post" enctype="multipart/form-data"
                    class="border border-secondary">
                    <input type="text" style="margin:0px" id="nombre" name="nombre" value="<?= $row["nombre"] ?>" required>
                    <div>
                        <input type="number" id="cantidad" name="cantidad" value="<?= $row["stock"] ?>" required>
                        <label for="cantidad">Stock</label>
                    </div>
                    <div>

                        <input type="number" id="precio" name="precio" value="<?= $row["precio"] ?>" required>
                        <label for="precio">Precio</label>
                    </div>

                    <input type="text" id="descripcion" name="descripcion" value="<?= $row["descripcion"] ?>" required>

                    <input type="text" id="categoria" name="categoria" value="<?= $row["categoria"] ?>" required>


                    <label for="imagen">New Image:</label>
                    <input type="file" name="uploadfile" value="<?= $row["imagen"] ?>" />
                    <?= "Current Image: " . $row["imagen"] ?>
                    <img src="../img/<?= $row["imagen"] ?>" style="width:50px; height:50px; margin:5px;">
                    <input type="hidden" name="id" id="id" value="<?= $row["id"] ?>">

                    <div>
                        <input class="btn btn-secondary btn-warning" type="submit" name="update" value="Update">
                        <input class="btn btn-secondary btn-danger" type="submit" name="delete" value="Delete"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                    </div>
                </form>

                <?php
            }
            ?>
            <div>
                <form action="../php/update_database.php" method="post" enctype="multipart/form-data"
                    class="border border-secondary">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre" required>

                    <label for="cantidad">Stock:</label>
                    <input type="number" id="cantidad" name="cantidad" required min="1">

                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" required min="1">

                    <label for="descripcion">Descripcion:</label>
                    <input type="text" id="descripcion" name="descripcion" required>

                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" required min="1">

                    <label for="categoria">Categoria:</label>
                    <input type="text" id="categoria" name="categoria" required>

                    <label for="imagen">Imagen:</label>
                    <input type="file" name="uploadfile" value="" />

                    <input class="btn btn-secondary btn-success" type="submit" name="newitem" value="Add New Item">
                </form>
            </div>
            <?php
        } else {
            echo "No rows found";
        }
        ?>
    </main>
    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script src="../app/app.js"></script>
</body>

</html>