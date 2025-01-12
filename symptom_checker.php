<?php
include('databaseconnection.php');

//fetch symptoms from the database for selection
$symptoms_query = "SELECT symptoms_id, symptoms_name FROM symptoms";
$symptoms_result = $connection->query($symptoms_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symptoms Checker</title>
</head>
<body>

    <h1> Select Symptoms to Find Possible Disease</h1>
    <form action ="result1.php" method="POST">

    <?php 
    if($symptoms_result->num_rows > 0){
        while($row = $symptoms_result->fetch_assoc()){
            echo "<input type= 'checkbox' name='symptoms[]' value='" .$row['symptoms_id'] . "'>" . $row['symptoms_name']. "<br>";
        }
    }else{
        echo "No Symptoms found.";
    }
    ?>

    <input type="submit" name="submit" value="Find Disease">
         </form>

</body>
</html>
