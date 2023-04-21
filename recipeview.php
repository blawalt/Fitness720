<?php
include 'index.html';
?>
<html>
<form id="recipe-form" method="get" action="recview.php">
<label for="recipe">Choose a recipe:</label>
<select name="recipe" id="recipe">
<?php
include_once 'connect.php';

$sql = "SELECT * FROM recipes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["recipeid"] . "'>" . $row["recipeName"] . "</option>";
        }
    }
else{
    echo "<option value=''>No recipes found</option>";
}

?>
</select>
<button type="submit" name="submit" value="submit">View</button>
</form>
</html>

