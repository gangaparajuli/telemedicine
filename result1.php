<?php

include('databaseconnection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['symptoms'])){
$selected_symptoms = $_POST['symptoms'];
$symptom_ids = implode(",", array_map('intval', $selected_symptoms));

$disease_query="SELECT d.diseases_id, d.diseases_name,
COUNT(ds.symptoms_id) AS matched_symptoms,
(COUNT(ds.symptoms_id) * 1.0 / (SELECT COUNT(symptoms_id) FROM diseases_symptoms WHERE diseases_id = d.diseases_id)) AS match_score
FROM
diseases d
JOIN 
diseases_symptoms ds ON d.diseases_id = ds.diseases_id
WHERE 
ds.symptoms_id IN($symptom_ids)
GROUP BY d.diseases_id, d.diseases_name
ORDER BY
match_score DESC LIMIT 1
";

$diseases_result = $connection->query($disease_query);

if($diseases_result->num_rows > 0){
    $row = $diseases_result->fetch_assoc();
    $diseases_id = $row['diseases_id'];

    echo "<h2>Possible Disease</h2>";
    echo "<p><strong>Disease:</strong> " .$row['diseases_name'] . "</p>";
    echo"<p><strong>Match score:</strong> ". round($row['match_score'] *100, 2) . "%</p>";

    //query to find medicine for the most likely disease
    $treatment_query = "SELECT t.treatment_name FROM diseases_treatments dt
    JOIN treatments t ON dt.treatment_id = t.treatment_id
    WHERE dt.diseases_id = $diseases_id";

    $treatment_result = $connection->query($treatment_query);

    if($treatment_result->num_rows > 0){
        echo"<h3>Recommended Medicine</h3><ul>";
        while($treatment_row =  $treatment_result->fetch_assoc()){
            echo "<li>" . $treatment_row['treatment_name'] ."</li>";
        }
        echo "</ul>";
    }
    else{
        echo"<p> No medicine recommendatins available for this disease.</p>";
    }
}
else{
    echo "<p>No matching diseases found for the selcted symptoms</p>";
}
}

//close connection
$connection->close();
?>
