<?php
require_once __DIR__ . '/config.php';

$response = array();

$sql = "SELECT * FROM marker";
$result = mysqli_query($connection, $sql);

if ($result->num_rows > 0) {
    $response["success"] = 1;
    $response["markers"] = array();
    while ($row = mysqli_fetch_array($result)) {
        $marker = array();
        $marker["id"] = $row["id"];
        $marker["title"] = $row["title"];
        $marker["about_ua"] = $row["about_ua"];
        $marker["about_us"] = $row["about_us"];
        $marker["about_ru"] = $row["about_ru"];
        $marker["x"] = $row["x"];
        $marker["y"] = $row["y"];
        $marker["yt"] = $row["yt"];
        $marker["category"] = $row["category"];
        $marker["address_ua"] = $row["address_ua"];
        $marker["address_us"] = $row["address_us"];
        $marker["address_ru"] = $row["address_ru"];
        $marker["phone"] = $row["phone"];
        $marker["link"] = $row["link"];
        $marker["news_ua"] = $row["news_ua"];
        $marker["news_us"] = $row["news_us"];
        $marker["news_ru"] = $row["news_ru"];
        $marker["parking"] = $row["parking"];
        $marker["baby"] = $row["baby"];
        $marker["music"] = $row["music"];
        $marker["smoking"] = $row["smoking"];
        $marker["bill"] = $row["bill"];
        array_push($response["markers"], $marker);
    }
} else {
    $response["success"] = 0;
    $response["message"] = "no data available";
}
echo json_encode($response, JSON_UNESCAPED_UNICODE);
mysqli_free_result($result);
mysqli_close($connection);