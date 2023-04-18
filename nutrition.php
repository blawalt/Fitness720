<html>

<form method ="get" action = nutins.php>
    <label for="date">Select a date:</label>
    <input type="date" id ="date" name="date">
    <input type="submit" value="Submit">

</form>


</html>

<?php

if (isset($_GET['submit']))

    echo "yurd";



?>