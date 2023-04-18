<html>

<form method ="get" >
    <label for="date">Select a date:</label>
    <input type="date" id ="date" name="date">
    <br><br><br><br>
    <select name="recipe" id="recipe">
        <?php
        include 'connect.php';
        //Feel like there needs to be some sort of dict reading in recipeID and associating with recipeId.
        // SQL query to fetch recipes
        $sql1 = "SELECT recipeName FROM recipes";
        $result1 = $conn->query($sql1);

        // Check if the query returned any results
        if ($result1->num_rows > 0) {
            // Loop through the results and create an option for each ingredient
            while($row = $result1->fetch_assoc()) {
            
            
                echo '<option value="'.$row["recipeName"].'">' . $row["recipeName"] .' </option>';

            }
        } else {
            echo "<option value=''>No recipes found</option>";
        }
        ?>
    </select>
    <input type="submit" value="Submit">
</form>


</html>

<?php

if (isset($_GET['date']))

    



?>