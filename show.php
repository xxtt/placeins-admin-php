<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: index.php");
}
require_once __DIR__ . '/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["delete"])) {
        if (isset($_POST["place"])) {
            $place = mysqli_real_escape_string($connection, $_POST['place']);
            $sql = "DELETE FROM marker WHERE id='$place'";

            if (!mysqli_query($connection, $sql)) {
                echo "database delete error:" . mysqli_error($connection) . "<br><br>";
            } else {
                echo "place has been deleted" . "<br><br>";
            }
        }
    }

    if (isset($_POST["edit"])) {
        $_SESSION['id'] = $_POST["place"];
        header("location: edit.php");
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <style>
        input[name="delete"] {
            color: mediumvioletred;
        }
    </style>
    <meta charset="UTF-8">
    <title>our places</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/favicon.ico">
</head>
<body class="stars">
<a href="http://placeins.com/">
    <img id="logo" src="images/logo.png" alt="place in space logo" align="middle">
</a>

<form action="" method="post">
    choose place: </label><?php include 'selection.php'; ?>
    <input type="submit" name="edit" value="edit">
    <input type="submit" name="delete" value="delete">
</form>

<form action="add.php" method="get">
    <input type="submit" value="add new">
</form>

<form action="logout.php" method="get">
    <input type="submit" value="log out">
</form>

<?php include 'table.php'; ?>

</body>
</html>