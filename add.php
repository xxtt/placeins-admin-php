<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: index.php");
}

if ((isset($_POST['cancel'])) && ($_SERVER["REQUEST_METHOD"] == "POST")) {
    header("location: show.php");
}

require_once __DIR__ . '/config.php';
$complete = true;
$checked = 'checked="checked"';

$title = $x = $y = $yt = $phone = $link = "''";
$address_ua = $address_us = $address_ru = "''";
$about_ua = $about_us = $about_ru = "";
$smoking = $parking = $baby = $music = 0;
$category = $bill = 1;

$titleError = $aboutUaError = $aboutUsError = $aboutRuError = $xError = $yError = $ytError = "";
$categoryError = $addressUaError = $addressUsError = $addressRuError = $phoneError = $linkError = "";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["title"])) {
        $titleError = "title is required";
        $complete = false;
    } else {
        $title = test_input($connection, $_POST["title"]);
    }

    if (empty($_POST["about_ua"])) {
        $aboutUaError = "description is required";
        $complete = false;
    } else {
        $about_ua = test_input($connection, $_POST["about_ua"]);
    }

    if (empty($_POST["about_us"])) {
        $aboutUsError = "description is required";
        $complete = false;
    } else {
        $about_us = test_input($connection, $_POST["about_us"]);
    }

    if (empty($_POST["about_ru"])) {
        $aboutRuError = "description is required";
        $complete = false;
    } else {
        $about_ru = test_input($connection, $_POST["about_ru"]);
    }

    if (empty($_POST["x"])) {
        $xError = "x is required";
        $complete = false;
    } else {
        $x = test_input($connection, $_POST["x"]);
    }

    if (empty($_POST["y"])) {
        $yError = "y is required";
        $complete = false;
    } else {
        $y = test_input($connection, $_POST["y"]);
    }

    if (empty($_POST["yt"])) {
        $ytError = "yt is required";
        $complete = false;
    } else {
        $yt = test_input($connection, $_POST["yt"]);
    }

    if (empty($_POST["category"])) {
        $categoryError = "category is required";
        $complete = false;
    } else {
        $category = test_input($connection, $_POST["category"]);
    }

    if (empty($_POST["address_ua"])) {
        $addressUaError = "address is required";
        $complete = false;
    } else {
        $address_ua = test_input($connection, $_POST["address_ua"]);
    }

    if (empty($_POST["address_us"])) {
        $addressUsError = "address is required";
        $complete = false;
    } else {
        $address_us = test_input($connection, $_POST["address_us"]);
    }

    if (empty($_POST["address_ru"])) {
        $addressRuError = "address is required";
        $complete = false;
    } else {
        $address_ru = test_input($connection, $_POST["address_ru"]);
    }

    if (empty($_POST["phone"])) {
        $phoneError = "phone is required";
        $complete = false;
    } else {
        $phone = test_input($connection, $_POST["phone"]);
    }

    if (empty($_POST["link"])) {
        $linkError = "link is required";
        $complete = false;
    } else {
        $link = test_input($connection, $_POST["link"]);
    }

    if (isset($_POST["smoking"])) {
        $smoking = $_POST["smoking"];
    }

    if (isset($_POST["parking"])) {
        $parking = $_POST["parking"];
    }

    if (isset($_POST["baby"])) {
        $baby = $_POST["baby"];
    }

    if (isset($_POST["music"])) {
        $music = $_POST["music"];
    }

    if (isset($_POST["bill"])) {
        $bill = $_POST["bill"];
    }

    if ($complete) {
        $sql = "INSERT INTO marker (title,about_ua,about_us,about_ru,x,y,yt,category,address_ua,address_us,address_ru,phone,link,parking,baby,music,smoking,bill)
VALUES ('$title','$about_ua','$about_us','$about_ru','$x','$y','$yt','$category','$address_ua','$address_us','$address_ru','$phone','$link','$parking','$baby','$music','$smoking','$bill')";

        if (!mysqli_query($connection, $sql)) {
            $error = "database error:" . mysqli_error($connection);
        } else {
            header("location: show.php");
        }
    }
}

function test_input($connection, $data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($connection, $data);
    return $data;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>add new place</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/favicon.ico">
</head>
<body class="stars">

<div id="main">
    <a href="http://placeins.com/">
        <img id="logo" src="images/logo.png" alt="place in space logo" align="middle">
    </a>

    <b>add new place</b>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        title: <input type="text" name="title" value='<?php echo $title ?>'>
        <span class="error"><?php echo $titleError; ?></span>
        <br>
        about ua(400 characters max):<br><textarea style="width: 500px;height:110px;" name="about_ua"
                                                   maxlength="400"><?php echo $about_ua ?></textarea>
        <span class="error"><?php echo $aboutUaError; ?></span>
        <br>
        about ru(400 characters max):<br><textarea style="width: 500px;height:110px;" name="about_ru"
                                                   maxlength="400"><?php echo $about_ru ?></textarea>
        <span class="error"><?php echo $aboutRuError; ?></span>
        <br>
        about us(400 characters max):<br><textarea style="width: 500px;height:110px;" name="about_us"
                                                   maxlength="400"><?php echo $about_us ?></textarea>
        <span class="error"><?php echo $aboutUsError; ?></span>
        <br>
        x (map latitude coordinate): <input type="text" name="x" value='<?php echo $x ?>' maxlength="11">
        <span class="error"><?php echo $xError; ?></span>
        <br>
        y (map longitude coordinate): <input type="text" name="y" value='<?php echo $y ?>' maxlength="11">
        <span class="error"><?php echo $yError; ?></span>
        <br>
        youtube id: <input type="text" name="yt" value='<?php echo $yt ?>' maxlength="11">
        <span class="error"><?php echo $ytError; ?></span>
        <br>
        category: <?php include 'category.php';
        add_category($connection, $category) ?>
        <span class="error"><?php echo $categoryError; ?></span>
        <br>
        address ua: <input type="text" name="address_ua" value='<?php echo $address_ua ?>' maxlength="100">
        <span class="error"><?php echo $addressUaError; ?></span>
        <br>
        address ru: <input type="text" name="address_ru" value='<?php echo $address_ru ?>' maxlength="100">
        <span class="error"><?php echo $addressRuError; ?></span>
        <br>
        address us: <input type="text" name="address_us" value='<?php echo $address_us ?>' maxlength="100">
        <span class="error"><?php echo $addressUsError; ?></span>
        <br>
        phone: <input type="text" name="phone" value='<?php echo $phone ?>' maxlength="13">
        <span class="error"><?php echo $phoneError; ?></span>
        <br>
        link: <input type="text" name="link" value='<?php echo $link ?>' maxlength="100">
        <span class="error"><?php echo $linkError; ?></span>
        <br>
        smoking:
        <input type="radio" name="smoking" value="0" <?php if ($smoking == 0) echo $checked ?>>no
        <input type="radio" name="smoking" value="1"<?php if ($smoking == 1) echo $checked ?>>yes
        <br>
        parking:
        <input type="radio" name="parking" value="0" <?php if ($parking == 0) echo $checked ?>>no
        <input type="radio" name="parking" value="1"<?php if ($parking == 1) echo $checked ?>>yes
        <br>
        baby room:
        <input type="radio" name="baby" value="0" <?php if ($baby == 0) echo $checked ?>>no
        <input type="radio" name="baby" value="1"<?php if ($baby == 1) echo $checked ?>>yes
        <br>
        live music:
        <input type="radio" name="music" value="0" <?php if ($music == 0) echo $checked ?>>no
        <input type="radio" name="music" value="1"<?php if ($music == 1) echo $checked ?>>yes
        <br>
        average bill:
        <input type="radio" name="bill" value="1" <?php if ($bill == 1) echo $checked ?> >$
        <input type="radio" name="bill" value="2" <?php if ($bill == 2) echo $checked ?>>$$
        <input type="radio" name="bill" value="3" <?php if ($bill == 3) echo $checked ?>>$$$
        <br>
        <input type="submit" name="save" value="save">
        <input type="submit" name="cancel" value="cancel">

        <br>

        <p><span class="error"><?php echo $error ?></span></p>
    </form>
</div>

</body>
</html>