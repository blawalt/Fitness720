<?php
$recipeName = $_GET['recipeName'];
$category = $_GET['category'];
$difficulty = $_GET['difficulty'];
$instructions = $_GET['instructions'];
$ingredients = $_GET['ingredients'];


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


//insert statement for ingredients and instructions

foreach ($instructions as $instruction) {
    echo $instruction;
    $sql1 = "SET @max_insid = (SELECT MAX(insid) + 1 FROM instructions);
            INSERT INTO instructions (insid, instruction, recipeid) VALUES (@max_insid, $instruction, @max_recipeid)";

    if ($conn->multi_query($sql1) === TRUE){
        echo "New record created successfully!";
    }
    else {
        "Error: " . $sql . "<br>" . $conn->error;
    }
}




?>