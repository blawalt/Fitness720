<?php
include_once 'connect.php';
include_once 'index.html';


$recipeid = $_GET['recipe'];

//Display Recipe Name, Category, and Difficulty
$sql = "SELECT * FROM recipes WHERE recipeid = $recipeid";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //Display Recipe Name, Category, and Difficult
        echo "<p>Recipe Name: " . $row['recipeName'] . "</p>";
        echo "<p>Category: " . $row['recipeCategory'] . "</p>";
        echo "<p>Difficulty: " . $row['difficulty'] . "</p>";
        echo "</ul><p>Ingredients:</p><ul>";

        //Display Ingredients
        $sql1 = "SELECT * FROM ingredients, ingredients_has_recipes WHERE ingredients_has_recipes.recipeid = '$recipeid' AND ingredients_has_recipes.ingid = ingredients.ingid ";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0){
            while ($row = $result1->fetch_assoc()){
                echo "<li>" . $row['ingName'] . "</li>";
            }
        }
        
        echo "<p>Instructions:</p><ul>";

        //Display Instructions
        $sql2 = "SELECT * FROM instructions WHERE recipeid=$recipeid";
        $result2 = $conn->query($sql2);
        echo "<ol type='1'>";
        if ($result2->num_rows > 0){
            while ($row = $result2->fetch_assoc()){
                echo "<li>" . $row['instruction'] . "</li>";
            }
        }
        echo "</ol>";
    }
}
$conn->close();
?>



