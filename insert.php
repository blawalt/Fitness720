<?php
$recipeName = $_GET['recipeName'];
$category = $_GET['category'];
$difficulty = $_GET['difficulty'];
$instructions = $_GET['instructions'];
//$ingredients = $_GET['ingid'];


include_once 'connect.php';

//Think about if a loop is needed in order to reset the max_recipeid for each submission
$sql = "SET @max_recipeid = (SELECT MAX(recipeid) + 1 FROM recipes);
INSERT INTO recipes (recipeid, recipeName, recipeCategory, difficulty) VALUES (@max_recipeid,'$recipeName','$category','$difficulty'); ";

if ($conn->multi_query($sql) === TRUE){
    echo "New record created successfully!";
}
else {
    "Error: " . $sql . "<br>" . $conn->error;
}

echo "<p>Ingredients:</p><ul>";
    
    foreach ($ingredients as $ingredient){
        echo $ingredient . "<br>";
    }
    echo "</ul>";

echo "<p>Instructions:</p><ol type ='1'>";
foreach ($instructions as $instruction) {
   echo $instruction . "<br>";
}
echo "</ol>";



?>