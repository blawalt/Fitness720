<?php
include_once 'index.html';
?>

<html>

<form method ="get">
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
    <br><br>
    <input type="submit" value="Add" name="add">
    <input type="submit" value="View Journal" name="journal">
</form>


</html>

<!--php for when add is pressed. adding recipe to journal table-->

<?php

include 'connect.php';

if (isset($_GET['add'])){
        $sql = "SELECT * FROM recipes";
        $result=$conn->query($sql);
        if ($result->num_rows > 0){
            while($row=$result->fetch_assoc()){
                echo $row['recipeid'];
            }
        
        }
        else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }





//php for when view journal is pressed. repeats recview.php

elseif (isset($_GET['journal'])){

    echo "bye";
}

else {
    echo "whats going on";
}

?>