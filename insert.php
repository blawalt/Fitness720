<?php
include_once 'index.html';


$recipeName = $_GET['recipeName'];
$category = $_GET['category'];
$difficulty = $_GET['difficulty'];
$instructions = $_GET['instructions'];
$ingredients = $_GET['ingredients'];


include 'connect.php';

//Think about if a loop is needed in order to reset the max_recipeid for each submission
$sql = "SET @max_recipeid = (SELECT MAX(recipeid) + 1 FROM recipes);
INSERT INTO recipes (recipeid, recipeName, recipeCategory, difficulty) VALUES (@max_recipeid,'$recipeName','$category','$difficulty'); ";


if ($conn->multi_query($sql) === TRUE){
    echo "New record created successfully!<br>";
}
else {
    "Error: " . $sql . "<br>" . $conn->error;
}

//pulling recipeid
include 'connect.php';
$sql0 ="SELECT MAX(recipeid) FROM recipes";
$result0 = $conn->query($sql0);

if ($result0){
    $row = $result0->fetch_assoc();
        $recipeid = $row['MAX(recipeid)'];
    }

else {
    echo "Error: " . $sql0 . "<br>" . $conn->error;
}



//create link between ingredients and recipes
foreach ($ingredients as $ingredient){
    include 'connect.php';
    //I bet if i did DISTINCT, it would actually print correct. food for thought
    $sql4 = "SELECT ingid FROM ingredients WHERE ingName = '$ingredient'";
    
    $result = $conn->query($sql4);
    if ($result){
        $row = $result->fetch_assoc();
        foreach ($row as $ingid){
            echo $ingid;
            $sql5 = "INSERT INTO ingredients_has_recipes (ingid, recipeid) VALUES ('$ingid','$recipeid')";
            $result1 = $conn->query($sql5);
            if ($result1){
                echo "New record created successfully!<br>";
            }
            else {
                echo "Error: " . $sql5 . "<br>" . $conn->error;
            }
        }
    }
    else {
        echo "Error: " . $sql4 . "<br>" . $conn->error;
    }


 }
//insert statement for ingredients and instructions

foreach ($instructions as $instruction) {
    include 'connect.php';
    $sql1 = "SET @max_recipeid = (SELECT MAX(recipeid) FROM recipes);
    SET @max_insid = (SELECT MAX(insid) + 1 FROM instructions);
    INSERT INTO instructions (insid, instruction, recipeid) VALUES (@max_insid, '$instruction', @max_recipeid);";
    
    
    if ($conn->multi_query($sql1) === TRUE){
        echo "New record created successfully!<br>";
    }
    else {
        "Error: " . $sql1 . "<br>" . $conn->error;
    }
}




?>