<?php
$sql = "SELECT * FROM marker";
$result = mysqli_query($connection, $sql);

echo "<table border='1'>

<tr>
<th>title</th>
<th>about ua</th>
<th>about ru</th>
<th>about us</th>
<th>x</th>
<th>y</th>
<th>yt</th>
<th>category</th>
<th>address ua</th>
<th>address ru</th>
<th>address us</th>
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
    echo "<td>" . $row['about_ru'] . "</td>";
    echo "<td>" . $row['about_us'] . "</td>";
    echo "<td>" . $row['x'] . "</td>";
    echo "<td>" . $row['y'] . "</td>";
    echo "<td>" . $row['yt'] . "</td>";
    echo "<td>" . $row['category'] . "</td>";
    echo "<td>" . $row['address_ua'] . "</td>";
    echo "<td>" . $row['address_ru'] . "</td>";
    echo "<td>" . $row['address_us'] . "</td>";
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

mysqli_free_result($result);