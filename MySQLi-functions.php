<?php
function dbConfig($dbname)
{

    $servername = "";
    $username = "";
    $password = "";

    // Create connection
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        exit('Error connecting to database'); //Should be a message a typical user could understand in production
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli->set_charset("utf8mb4");

    return $mysqli;
}

function countInDb($dbname, $x, $table, $options = "")
{   
    $mysqli = dbConfig($dbname);
    $stmt = $mysqli->prepare("SELECT COUNT(" . $x . ") FROM " . $table . " " . $options);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_row();
    $stmt->close();
    // Trasforma i permessi da array a variabile
    $row = $result[0];
    return $row;
}
?>
