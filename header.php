<?php
session_start();
$python = "./3.11/bin/python3.11";
global $conn;

// Modifier les informations de connexion à la base de données ici
$host = "localhost";
$login = "root";
$password = "";
$database = "INFO834";
$conn = mysqli_connect($host, $login, $password, $database);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form method="POST" class=" flex navbar bg-base-100 shadow-lg justify-between">
        <a href="index.php" class="btn btn-ghost text-xl">Info834</a>
        <div class="flex">
            <?php if (isset($_SESSION["user_id"])) : ?>
                <input type="submit" class="btn btn-primary" value="Logout" name="logout"/>
            <?php else : ?>
                <a href="login.php" class="btn btn-primary">Login</a>
                <a href="register.php" class="btn btn-secondary ml-4">Register</a>
            <?php endif; ?>

        </div>
    </form>