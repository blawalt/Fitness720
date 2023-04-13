<?php
// Database connection settings
include 'connect.php';

// Fetch the ingredients list from the request body
$ingredients_list = json_decode(file_get_contents('php://input'), true);

if (is_array($ingredients_list) && count($ingredients_list) > 0) {
    // SQL query to insert ingredients
    $sql = "INSERT INTO selected_ingredients (ingredient_name, calories, protein, carb, fat) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($ingredients_list as $ingredient) {
        $stmt->bind_param(
            'sdddd',
            $ingredient['ingredient_name'],
            $ingredient['calories'],
            $ingredient['protein'],
            $ingredient['carb'],
            $ingredient['fat']
        );
        $stmt->execute();
    }

    $stmt->close();
    http_response_code(201);
    echo "Ingredients saved successfully.";
} else {
    http_response_code(400);
    echo "Invalid ingredients list.";
}

// Close the database connection
$conn->close();
?>
