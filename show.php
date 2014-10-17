<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: index.php");
}
echo "welcome, " . $_SESSION['name'] . "<br><br>";

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

$sql = "SELECT * FROM marker";

$result = mysqli_query($connection, $sql);

echo "<table border='1'>
<tr>
<th>title</th>
<th>about ua</th>
<th>about us</th>
<th>about ru</th>
<th>x</th>
<th>y</th>
<th>yt</th>
<th>category</th>
<th>address ua</th>
<th>address us</th>
<th>address ru</th>
<th>phone</th>
<th>link</th>
<th>parking</th>
<th>baby</th>
<th>music</th>
<th>smoking</th>
<th>bill</th>
<th>password</th>
</tr>";

while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" . $row['about_ua'] . "</td>";
    echo "<td>" . $row['about_us'] . "</td>";
    echo "<td>" . $row['about_ru'] . "</td>";
    echo "<td>" . $row['x'] . "</td>";
    echo "<td>" . $row['y'] . "</td>";
    echo "<td>" . $row['yt'] . "</td>";
    echo "<td>" . $row['category'] . "</td>";
    echo "<td>" . $row['address_ua'] . "</td>";
    echo "<td>" . $row['address_us'] . "</td>";
    echo "<td>" . $row['address_ru'] . "</td>";
    echo "<td>" . $row['phone'] . "</td>";
    echo "<td>" . $row['link'] . "</td>";
    echo "<td>" . $row['parking'] . "</td>";
    echo "<td>" . $row['baby'] . "</td>";
    echo "<td>" . $row['music'] . "</td>";
    echo "<td>" . $row['smoking'] . "</td>";
    echo "<td>" . $row['bill'] . "</td>";
    echo "<td>" . $row['password'] . "</td>";
    echo "</tr>";
}
echo "</table>";

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
    <title>edit places</title>
</head>
<body>
<br>

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
</body>
</html>