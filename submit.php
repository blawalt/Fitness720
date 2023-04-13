<?php
if(isset($_GET['submit'])) {
    $recipeName = $_GET['recipe-name'];
    $category = $_GET['category'];
    $instructions = $_GET['instruction'];
    $ingredients = $_GET['ingid'];
    $difficulty = $_GET['difficulty'];



    // Echo out the values
    echo "<p>Recipe Name: " . $recipeName . "</p>";
    echo "<p>Category: " . $category . "</p>";
    echo "<p>Difficulty: " . $difficulty . "</p>";
    
    echo "</ol><p>Ingredients:</p><ul>";
    
    foreach ($ingredients as $ingredient){
        echo "<li>" . $ingredient . "</li>";
    }
    echo "<p>Instructions:</p><ol type ='1'>";
    foreach ($instructions as $instruction) {
        echo "<li>" . $instruction . "</li>";
    }
    }
    
    echo "</ul>";
    
    echo "<form method='post' action='insert.php'>";
    echo "<input type='hidden' name='recipeName' value='" . $recipeName . "'>";
    echo "<input type='hidden' name='category' value='" . $category . "'>";
    echo "<input type='hidden' name='difficulty' value='" . $difficulty . "'>";

    foreach ($instructions as $key => $value) {
        echo "<input type='hidden' name='instructions[]' value='" . $value . "'>";
    }
    foreach ($ingredients as $key => $value) {
        echo "<input type='hidden' name='ingredients[]' value='" . $value . "'>";
    }
    echo "<input type='submit' name='submit' value='Insert'>";
    echo "</form>";

?>
    
    

    

    




