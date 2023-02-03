<!-- Delete the record passed by id -->
<?php
require_once 'database-connection.php';

// get the id of the record to delete
$id = $_GET['id'];

// delete the record
$sql = 'DELETE FROM records WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

// redirect to the index
header('Location: index.php');
?>