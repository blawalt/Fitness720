<?php
header('Content-Type: application/json');

// Database connection settings
include 'connect.php';

// Get ingredient_id from the request
$ingredient_id = isset($_GET['ingid']) ? intval($_GET['ingid']) : 0;

if ($ingredient_id > 0) {
    // SQL query to fetch ingredient data
    $sql = "SELECT ingid, ingName, calories, protein, carb, fat FROM ingredients WHERE ingid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $ingredient_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query returned a result
    if ($result->num_rows > 0) {
        // Fetch the ingredient data and return it as JSON
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        // No ingredient found with the provided ID
        echo json_encode(['error' => 'Ingredient not found.']);
    }

    $stmt->close();
} else {
    // Invalid ingredient_id provided
    echo json_encode(['error' => 'Invalid ingredient ID.']);
}

// Close the database connection
$conn->close();
?>
