<?php
            include 'connect.php';

            // SQL query to fetch ingredients
            $sql1 = "SELECT recipeid, recipeCategory FROM recipes";
            $result1 = $conn->query($sql1);

            // Check if the query returned any results
            if ($result1->num_rows > 0) {
                // Loop through the results and create an option for each ingredient
                while($row = $result1->fetch_assoc()) {
                    echo '<option value='.$row["recipeCategory"].'>' . $row["recipeCategory"] .' </option>';
                }
            } else {
                echo "<option value=''>No categories found</option>";
            }
            
            
            

            // Close the database connection
            $conn->close();
            ?>