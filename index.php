<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) || empty($_POST['password'])) {
        $error = "name or password is invalid";
    } else {
        require_once __DIR__ . '/config.php';
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        $sql = "SELECT * FROM user WHERE name='$name' and password='$password'";
        $result = mysqli_query($connection, $sql);

        if ($result->num_rows == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['name'] = $name;
            header("location: show.php");
        } else {
            $error = "name or password is invalid";
        }
        mysqli_free_result($result);
        mysqli_close($connection);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>place login page</title>
</head>
<body>
<form action="" method="post">
    <label>username : </label><input name="name" type="text"><br>
    <label>password : </label><input name="password" type="password">
    <input type="submit" value="submit"><br>

    <p style="color: red;"><?php echo $error; ?>
</form>
</body>
</html>