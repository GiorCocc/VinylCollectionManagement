<?php
require_once 'database-connection.php';

// get the id of the record to delete
$id = $_GET['recordId'];

// delete the songs associated with the record
$sql = 'DELETE FROM songs WHERE songs.records = ' . $id . ';';
$stmt = $pdo->prepare($sql);
$stmt->execute();

// delete the record
$sql = 'DELETE FROM records WHERE records.id = ' . $id . ';';
$stmt = $pdo->prepare($sql);
$stmt->execute();

// redirect to the index
header('Location: index.php');
?>