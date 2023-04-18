<?php
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


//create link between ingredients and recipes
foreach ($ingredients as $ingredient){
    include 'connect.php';
    $sql4 = "SELECT ingid FROM ingredients WHERE ingName = '$ingredient'";
    
    $result = $conn->query($sql4);
    if ($result){
        $row = $result->fetch_assoc();
        foreach ($row as $ingid){
            $sql5 = "";
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

    // echo $sql4;
    // $result = $conn->query($sql4);

    // if ($result->num_rows > 0) {
    //     while ($row = $result->fetch_row()){
    //         echo $row[0];
    //     }
    // }
    // else {
    //     echo "no work bitch";
    // }





   
    
    // if ($result1 === TRUE){
    //     $row = $result1->fetch_assoc();
    //     echo $row['ingid'];
    // }
    // else {
    //     echo "no work";
    // }
    


    // $sql2 = "INSERT INTO ingredients_has_recipes (insid, recipeid) VALUES ('$ingid','$recipeid');";
    // $conn->query($sql3);"



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