<!-- Database connection and utils -->

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myvinylcollection";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get connection
function getConnection() {
    global $conn;
    return $conn;
}

// Get all records from the database
function getAllRecords() {
    global $conn;
    $sql = "SELECT * FROM vinyls";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["artist"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    return $result;
}

