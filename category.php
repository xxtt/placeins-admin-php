<?php

function add_category($connection, $id)
{
    $sql = "SELECT * FROM category";
    $result = mysqli_query($connection, $sql);
    if ($result->num_rows > 0) {
        echo "<select name='category'>";
        while ($row = mysqli_fetch_array($result)) {
            if ($row['id'] == $id) {
                $selected = 'selected="selected"';
            } else{
                $selected="";
            }
            echo "<option value='" . $row['id'] . "'" . $selected . ">" . $row['category'] . "</option>";
        }
        echo "</select>";
    } else {
        echo "Database error !!";
    }
    mysqli_free_result($result);
    mysqli_close($connection);
}