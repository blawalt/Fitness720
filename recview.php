<?php
include_once 'connect.php';
include_once 'index.html';


$recipeid = $_GET['recipe'];
echo $recipeid;
//Display Recipe Name, Category, and Difficulty
$sql = "SELECT * FROM recipes WHERE recipeid = $recipeid";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //Display Recipe Name, Category, and Difficult
        echo "<p>Recipe Name: " . $row['recipeName'] . "</p>";
        echo "<p>Category: " . $row['recipeCategory'] . "</p>";
        echo "<p>Difficulty: " . $row['difficulty'] . "</p>";
        echo "<p>Ingredients:</p><ul>";

        //Display Ingredients
        
        
        $sql1 = "SELECT * FROM ingredients, ingredients_has_recipes WHERE ingredients_has_recipes.recipeid = '$recipeid' AND ingredients_has_recipes.ingid = ingredients.ingid ";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0){
            $total_cal = 0;
            $total_pro = 0;
            $total_car = 0;
            $total_fat = 0;
            while ($row = $result1->fetch_assoc()){
                $calorie = $row['calorie'];
                $protein = $row['protein'];
                $carb = $row['carb'];
                $fat = $row['fat'];
                $ingid = $row['ingid'];
                $total_cal += $calorie;
                $total_pro += $protein;
                $total_car += $carb;
                $total_fat += $fat;

                echo "<li>" . $row['ingName'] . "</li>";
                
                
            }
        }
        echo "</ul>";
        echo "<p>Instructions:</p>";

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
        
        echo "Calories: $total_cal &nbsp";
        echo "Protein: $total_pro &nbsp";
        echo "Carbs: $total_car &nbsp";
        echo "Fat: $total_fat &nbsp";
        
        
        }
    }

$conn->close();
?>



