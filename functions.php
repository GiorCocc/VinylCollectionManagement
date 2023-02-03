<?php
require_once 'database-connection.php';

// function to check if an artist is already in the database; if not, it adds it
function checkArtist($artist)
{
    global $pdo;
    $sql = 'SELECT * FROM artists WHERE name = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$artist]);
    $row = $stmt->fetch();
    if ($row) {
        return $row['id'];
    } else {
        $sql = 'INSERT INTO artists (name) VALUES (?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$artist]);
        return $pdo->lastInsertId();
    }
}

// function to check if a record already exists in the database using its title and artist
function checkRecord($title, $artist)
{
    global $pdo;
    $sql = 'SELECT * FROM records WHERE title = ? AND artist = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $artist]);
    $row = $stmt->fetch();
    if ($row) {
        return true;
    } else {
        return false;
    }
}

// function to check if a label is already in the database; if not, it adds it
function checkLabel($label)
{
    global $pdo;
    $sql = 'SELECT * FROM labels WHERE name = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$label]);
    $row = $stmt->fetch();
    if ($row) {
        return $row['id'];
    } else {
        $sql = 'INSERT INTO labels (name) VALUES (?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$label]);
        return $pdo->lastInsertId();
    }
}

// function to get artist name from artist id
function getArtistName($artistId)
{
    global $pdo;
    $sql = 'SELECT * FROM artists WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$artistId]);
    $row = $stmt->fetch();
    return $row['name'];
}

// function getSongs($record){
//     global $pdo;
//     $sql = 'SELECT * FROM songs WHERE records = ?';
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute([$record]);
//     $row = $stmt->fetchAll();
//     return $row;
// }
