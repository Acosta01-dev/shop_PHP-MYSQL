<?php
include "../php/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update"])) {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $cant = (int)$_POST["cantidad"];
        $price = (float)$_POST["precio"];
        $category = $_POST["categoria"];
        $descripcion = $_POST["descripcion"];

        if (isset($_FILES["uploadfile"]) && $_FILES["uploadfile"]["error"] == 0) {
            $filename = $_FILES["uploadfile"]["name"];
            $tempname = $_FILES["uploadfile"]["tmp_name"];
            $folder = "../img/" . $filename;
            move_uploaded_file($tempname, $folder);

            $query = "UPDATE productos SET nombre = :nombre, stock = :cant, precio = :price, categoria = :category, imagen = :image , descripcion = :desc WHERE id = :id";
        } else {
            $query = "UPDATE productos SET nombre = :nombre, stock = :cant, precio = :price, categoria = :category , descripcion = :desc WHERE id = :id";
        }

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':cant', $cant, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':desc', $descripcion, PDO::PARAM_STR);

        if (isset($filename)) {
            $stmt->bindParam(":image", $filename);
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("location: ../pages/admin_panel.php?edited");
    }

    if (isset($_POST["delete"])) {
        $id = $_POST["id"];
        $query = "DELETE FROM productos where id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        header("location: ../pages/admin_panel.php?deleted");

    }

    if (isset($_POST["newitem"])) {
        $nombre = $_POST["nombre"];
        $cant = (int) $_POST["cantidad"];
        $price = (float) $_POST["precio"];
        $category = $_POST["categoria"];
        $descripcion = $_POST["descripcion"];

        if (isset($_FILES["uploadfile"]) && $_FILES["uploadfile"]["error"] == 0) {
            $filename = $_FILES["uploadfile"]["name"];
            $tempname = $_FILES["uploadfile"]["tmp_name"];
            $folder = "../img/" . $filename;
            move_uploaded_file($tempname, $folder);
        } else {
            echo "Error uploading file.";
            exit;
        }

        $query = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria, imagen) VALUES (:nombre, :desc, :price, :stock, :category, :image)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':desc', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $cant, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':image', $filename);

        try {
            $stmt->execute();
            header("location: ../pages/admin_panel.php?added");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
?>