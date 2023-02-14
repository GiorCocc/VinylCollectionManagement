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
        $artist = ucwords($artist);
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
        $label = ucwords($label);
        $sql = 'INSERT INTO labels (name) VALUES (?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$label]);
        return $pdo->lastInsertId();
    }
}

// function to get the record name from the record id
function getRecordName($record_id)
{
    global $pdo;
    $sql = 'SELECT title FROM records WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$record_id]);
    $record = $stmt->fetch();
    return $record['title'];
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

function getRecord($recordId)
{
    global $pdo;
    $sql = 'SELECT * FROM records WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId]);
    $row = $stmt->fetch();
    return $row;
}

// function to get the record year of release from the record id
function getRecordYear($recordId)
{
    $row = getRecord($recordId);
    return $row['year'];
}

// function to get the record label from the record id
function getRecordLabel($recordId)
{
    global $pdo;
    $sql = 'SELECT *, labels.name AS label FROM records INNER JOIN labels ON records.label = labels.id WHERE records.id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId]);
    $row = $stmt->fetch();
    return $row['name'];
}

// function to get the record label id from the record id
function getRecordGenre($recordId)
{
    $row = getRecord($recordId);
    return $row['genre'];
}

// function to get the record vinyl condition from the record id
function getRecordVinylCondition($recordId)
{
    $row = getRecord($recordId);
    return $row['vinyl_condition'];
}

// function to get the record sleeve condition from the record id
function getRecordSleeveCondition($recordId)
{
    $row = getRecord($recordId);
    return $row['sleeve_condition'];
}

// function to get the record format from the record id
function getRecordFormat($recordId)
{
    $row = getRecord($recordId);
    return $row['format'];
}

// function to get the record speed from the record id
function getRecordSpeed($recordId)
{
    $row = getRecord($recordId);
    return $row['speed'];
}

// function to get the record notes from the record id
function getRecordNotes($recordId)
{
    $row = getRecord($recordId);
    return $row['notes'];
}

// function to get the record number of songs from the record id
function getRecordNumberOfSongs($recordId)
{
    $row = getRecord($recordId);
    return $row['numberOfSongs'];
}

// function to get the record song title 
function getRecordSong($recordId, $artistId, $step)
{
    global $pdo;
    $sql = 'SELECT * FROM songs WHERE records = ? AND artist = ? LIMIT ?, 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId, $artistId, $step]);
    $row = $stmt->fetch();
    return $row['title'];
}

// function to get the record song duration
function getRecordSongDuration($recordId, $artistId, $step)
{
    global $pdo;
    $sql = 'SELECT * FROM songs WHERE records = ? AND artist = ? LIMIT ?, 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId, $artistId, $step]);
    $row = $stmt->fetch();
    return $row['duration'];
}

// function to get the number of songs of a particular record
function getNumberOfSongs($recordId, $artistId)
{
    global $pdo;
    $sql = 'SELECT * FROM songs WHERE records = ? AND artist = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId, $artistId]);
    $row = $stmt->fetchAll();
    return count($row);
}

// function to get the song id
function getSongsId($recordId, $artistId)
{
    global $pdo;
    $sql = 'SELECT id FROM songs WHERE records = ? AND artist = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId, $artistId]);
    $songsId = $stmt->fetchAll();
    return $songsId;
}

// function to update the song informations
function updateSong($songId, $songTitle, $songDuration, $recordId, $artistId)
{
    global $pdo;
    $songTitle = ucwords($songTitle);
    $songDuration = ucwords($songDuration);
    
    $sql = 'UPDATE songs SET title = ?, duration = ? WHERE id = ? AND records = ? AND artist = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$songTitle, $songDuration, $songId, $recordId, $artistId]);
    return $stmt->rowCount() > 0;
}

// function to add a song
function addSong($songTitle, $songDuration, $recordId, $artistId)
{
    global $pdo;
    $songTitle = ucwords($songTitle);
    $songDuration = ucwords($songDuration);

    $sql = 'INSERT INTO songs (title, duration, records, artist) VALUES (?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$songTitle, $songDuration, $recordId, $artistId]);
}

// function to get all the songs of a particular record
function getSongs($id)
{
  global $pdo;
  $sql = 'SELECT * FROM songs WHERE records = :id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['id' => $id]);
  $songs = $stmt->fetchAll();
  return $songs;
}

// function to check if a song already exists
function checkSong($songTitle, $recordId, $artistId)
{
    global $pdo;
    $sql = 'SELECT * FROM songs WHERE title = ? AND records = ? AND artist = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$songTitle, $recordId, $artistId]);
    $row = $stmt->fetch();
    return $row ? true : false;
}
