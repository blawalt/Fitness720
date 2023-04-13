<?php
                    include 'connect.php';
                    // SQL query to fetch ingredients
                    $sql = "SELECT ingid, ingName FROM ingredients";
                    $result = $conn->query($sql);

                    // Check if the query returned any results
                    if ($result->num_rows > 0) {
                        // Loop through the results and create an option for each ingredient
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["ingName"] . "'>" . $row["ingName"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No ingredients found</option>";
                    }

                    // Close the database connection
                    $conn->close();
                ?>