<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: show.php");
}

if ((isset($_POST['cancel'])) && ($_SERVER["REQUEST_METHOD"] == "POST")) {
    unset($_SESSION['id']);
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

$place = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "SELECT * FROM marker WHERE id='$place'";
    $result = mysqli_query($connection, $sql);

    if ($result->num_rows == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $title = $row['title'];
        $about_ua = $row['about_ua'];
        $about_us = $row['about_us'];
        $about_ru = $row['about_ru'];
        $x = $row['x'];
        $y = $row['y'];
        $yt = $row['yt'];
        $category = $row['category'];
        $address_ua = $row['address_ua'];
        $address_us = $row['address_us'];
        $address_ru = $row['address_ru'];
        $phone = $row['phone'];
        $link = $row['link'];
        $smoking = $row['smoking'];
        $parking = $row['parking'];
        $baby = $row['baby'];
        $music = $row['music'];
        $bill = $row['bill'];
    } else {
        echo "data load error:" . mysqli_error($connection);
        exit();
    }
    mysqli_free_result($result);
}
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
        $sql = "UPDATE marker SET title='$title',about_ua='$about_ua',about_us='$about_us',about_ru='$about_ru',x='$x',y='$y',
yt='$yt',category='$category',address_ua='$address_ua',address_us='$address_us',address_ru='$address_ru',phone='$phone',
link='$link',parking='$parking',baby='$baby',music='$music',
smoking='$smoking',bill='$bill' WHERE id=$place";

        if (!mysqli_query($connection, $sql)) {
            $error = "database error:" . mysqli_error($connection);
        } else {
            unset($_SESSION['id']);
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
    <title>edit place</title>
    <style>
        .info {
            color: green;
        }

        .error {
            color: mediumvioletred;
        }

        input[type="text"] {
            width: 300px;
        }
    </style>
</head>
<body>

<p><b>edit place</b></p>

<div>
    <p><span class="info">* all fields are required </span></p>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        title: <input type="text" name="title" value='<?php echo $title ?>'>
        <span class="error"><?php echo $titleError; ?></span>
        <br>
        about ua(400 characters max):<br><textarea style="width: 500px;height:100px;" name="about_ua"
                                                   maxlength="400"><?php echo $about_ua ?></textarea>
        <span class="error"><?php echo $aboutUaError; ?></span>
        <br>
        about us(400 characters max):<br><textarea style="width: 500px;height:100px;" name="about_us"
                                                   maxlength="400"><?php echo $about_us ?></textarea>
        <span class="error"><?php echo $aboutUsError; ?></span>
        <br>
        about ru(400 characters max):<br><textarea style="width: 500px;height:100px;" name="about_ru"
                                                   maxlength="400"><?php echo $about_ru ?></textarea>
        <span class="error"><?php echo $aboutRuError; ?></span>
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
        address us: <input type="text" name="address_us" value='<?php echo $address_us ?>' maxlength="100">
        <span class="error"><?php echo $addressUsError; ?></span>
        <br>
        address ru: <input type="text" name="address_ru" value='<?php echo $address_ru ?>' maxlength="100">
        <span class="error"><?php echo $addressRuError; ?></span>
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

        <p><span class="error"><?php echo $error ?></span></p>
    </form>
</div>

</body>
</html>