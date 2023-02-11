<!-- Delete the record passed by id -->
<?php
require_once 'database-connection.php';

// get the id of the record to delete
$id = $_GET['recordId'];

// delete the record
$sql = 'DELETE FROM records WHERE id = ' . $id . ';';
$stmt = $pdo->prepare($sql);
$stmt->execute();

// delete the songs associated with the record
$sql = 'DELETE FROM songs WHERE records = ' . $id . ';';
$stmt = $pdo->prepare($sql);
$stmt->execute();

// redirect to the index
header('Location: index.php');
?>