<!DOCTYPE html>
<html>
<head>
    <title>Ingredients Form</title>
</head>

<body>
    <form id="ingredients-form" method="get" action="submit.php">
        <section class="additem-form">
            <label for="recipe-name">Recipe Name:</label>
            <input type="text" name="recipe-name" id="recipe-name" placeholder="Enter recipe name">
            
            <label for="category">Category:</label>
            <select name="category" id="category">
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
            </select>
            
            <label for="ingredient">Choose an ingredient:</label>
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
                            echo "<option value='" . $row["ingName"] . "'>" . $row["ingName"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No ingredients found</option>";
                    }

                    // Close the database connection
                    $conn->close();
                ?>
            </select>
            
            <button type="button" onclick="addItem()">Add Item</button>
        </section>
        
        <section>
            <h2>Instructions:</h2>
            <table id="instructions-table">
                <tbody>
                </tbody>
            </table>
            <button type="button" onclick="addInstruction()">Add Instruction</button>
        </section>
        
        <section class="item-table">
            <table id="item-table">
                <thead>
                    <tr>
                        <th>Ingredient Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="item-table-body">
                </tbody>
            </table>
        </section>
        
        <button type="submit" name="submit">Submit</button>
    </form>
    <script>

    function addInstruction() {
  var table = document.getElementById("instructions-table").getElementsByTagName('tbody')[0];
  var row = table.insertRow();
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var input = document.createElement("input");
  input.type = "text";
  input.name = "instruction[]";
  input.placeholder = "Enter instruction...";
  cell1.innerHTML = table.rows.length;
  cell2.appendChild(input);
  var deleteButton = document.createElement("button");
  deleteButton.innerHTML = "Delete";
  deleteButton.onclick = function() {
    table.deleteRow(row.rowIndex);
  }
  cell2.appendChild(deleteButton);
}
function deleteItem(button) {
  var row = button.parentNode.parentNode;
  row.parentNode.removeChild(row);
}

function addItem() {
  var ingredient = document.getElementById("ingredient");
  var ingid = ingredient.value;
  var ingName = ingredient.options[ingredient.selectedIndex].text;
  var table = document.getElementById("item-table-body");
  var row = table.insertRow();
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(0);
  var cell3 = row.insertCell(1);
  cell1.innerHTML = "<input type='hidden' name='ingid[]' value='" + ingid + "'>";
  cell2.innerHTML = ingName;
  cell3.innerHTML = "<button onclick='deleteItem(this)'>Delete Item</button>";
  
  // create an array of ingredient IDs
  var ingredientIds = [];
  var rows = table.getElementsByTagName("tr");
  for (var i = 0; i < rows.length; i++) {
    var idInput = rows[i].getElementsByTagName("input")[0];
    if (idInput) {
      ingredientIds.push(idInput.value);
    }
  }
  console.log(ingredientIds);
}




</script>
</body>
</html>