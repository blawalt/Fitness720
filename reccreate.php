<!DOCTYPE html>
<html>
<head>
    <title>Ingredients Dropdown</title>
</head>

    <body>
    <section class="additem-form">
        <input type="text" name="recipe-name" id="recipe-name" placeholder="Enter recipe name">
        <select name="category" id="category">
        <?php
        include 'recipeCat.php';
        ?>
        </select>
        <br><br>
        <label for="ingredient">Choose an ingredient:</label><br>
        
        <select name="ingredient" id="ingredient">
            <option value="">Select an Ingredient</option>
            <?php
            include 'connect.php';

            // SQL query to fetch ingredients
            $sql = "SELECT ingid, ingName FROM ingredients";
            $result = $conn->query($sql);

            // Check if the query returned any results
            if ($result->num_rows > 0) {
                // Loop through the results and create an option for each ingredient
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["ingid"] . "'>" . $row["ingName"] . "</option>";
                }
            } else {
                echo "<option value=''>No ingredients found</option>";
            }
            
            
            

            // Close the database connection
            $conn->close();
            ?>
        </select>
        
        <br><br>
        <button onclick="addItem()">Add Item</button>
    </section>

    <section class="item-table">
        <table id="item-table">
            <thead>
                <tr>
                    <br><th>Ingredient ID</th>
                    <br><th>Ingredient Name</th>
                </tr>
            </thead>
            <tbody id="item-table-body">
            </tbody>
        </table>
    </section>
    

    <script>
        function addItem() {
var ingredient = document.getElementById("ingredient");
  var ingid = ingredient.value;
  var ingName = ingredient.options[ingredient.selectedIndex].text;
  var table = document.getElementById("item-table-body");
  var row = table.insertRow();
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  cell1.innerHTML = ingid;
  cell2.innerHTML = ingName;
  cell3.innerHTML = "<button onclick='deleteItem(this)'>Delete Item</button>";
}

function deleteItem(button) {
  var row = button.parentNode.parentNode;
  row.parentNode.removeChild(row);
}

    </script>
</body>
</html>