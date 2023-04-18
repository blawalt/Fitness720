<?php

include_once 'index.html';

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
    
    echo "<p>Ingredients:</p><ul>";
    
    foreach ($ingredients as $ingredient){
        echo "<li>" . $ingredient . "</li>";
    }
    echo "</ul>";
    echo "<p>Instructions:</p><ol type ='1'>";
    foreach ($instructions as $instruction) {
        echo "<li>" . $instruction . "</li>";
    }
    }
    
    echo "</ol>";
    // include 'connect.php';
    // $sql0 = "SELECT * FROM ingredients, ingredients_has_recipes WHERE ingredients_has_recipes.recipeid = (SELECT recipeid FROM recipes WHERE recipeName = '$recipeName') AND ingredients_has_recipes.ingid = ingredients.ingid";
    // $result = $conn->query($sql0);

    //     if ($result->num_rows > 0){
    //         $total_cal = 0;
    //         $total_pro = 0;
    //         $total_car = 0;
    //         $total_fat = 0;
    //         while ($row = $result->fetch_assoc()){
    //             $calorie = $row['calorie'];
    //             $protein = $row['protein'];
    //             $carb = $row['carb'];
    //             $fat = $row['fat'];
    //             $ingid = $row['ingid'];
    //             $total_cal += $calorie;
    //             $total_pro += $protein;
    //             $total_car += $carb;
    //             $total_fat += $fat;

    //             echo "<li>" . $row['ingName'] . "</li>";
                
                
    //         }
    //     }
    //     echo "Calories: $total_cal &nbsp";
    //     echo "Protein: $total_pro &nbsp";
    //     echo "Carbs: $total_car &nbsp";
    //     echo "Fat: $total_fat &nbsp";


    echo "<form method='get' action='insert.php'>";
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
    
    

    

    




