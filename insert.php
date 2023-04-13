<?php
$recipeName = $_GET['recipe-name'];
$category = $_GET['category'];
$instructions = $_GET['instruction'];
$ingredients = $_GET['ingid'];


include_once 'connect.php';
include_once 'submit.php';

//Think about if a loop is needed in order to reset the max_recipeid for each submission
$sql = "SET @max_recipeid = (SELECT MAX(recipeid) + 1 FROM recipes);
INSERT INTO recipes (recipeid, recipeName, recipeCategory, difficulty, ingredients, instructions) VALUES (@max_recipeid,$recipeName,'hard',$ingredients,'ingr','inst'); ";

if ($conn->multi_query($sql) === TRUE){
    echo "New record created successfully!";
}
else {
    "Error: " . $sql . "<br>" . $conn->error;
}



?>