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

function getAlbumNameById($recordId)
{
    global $pdo;
    $sql = 'SELECT * FROM records WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId]);
    $row = $stmt->fetch();
    return $row['title'];
}

function getRecordYear($recordId)
{
    global $pdo;
    $sql = 'SELECT * FROM records WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId]);
    $row = $stmt->fetch();
    return $row['year'];
}

function getRecordLabel($recordId)
{
    global $pdo;
    $sql = 'SELECT *, labels.name AS label FROM records INNER JOIN labels ON records.label = labels.id WHERE records.id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId]);
    $row = $stmt->fetch();
    return $row['name'];
}

function getRecordGenre($recordId)
{
    global $pdo;
    $sql = 'SELECT * FROM records WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId]);
    $row = $stmt->fetch();
    return $row['genre'];
}

function getRecordVinylCondition($recordId)
{
    global $pdo;
    $sql = 'SELECT * FROM records WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId]);
    $row = $stmt->fetch();
    return $row['vinyl_condition'];
}

function getRecordSleeveCondition($recordId)
{
    global $pdo;
    $sql = 'SELECT * FROM records WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId]);
    $row = $stmt->fetch();
    return $row['sleeve_condition'];
}

function getRecordFormat($recordId)
{
    global $pdo;
    $sql = 'SELECT * FROM records WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId]);
    $row = $stmt->fetch();
    return $row['format'];
}

function getRecordSpeed($recordId)
{
    global $pdo;
    $sql = 'SELECT * FROM records WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId]);
    $row = $stmt->fetch();
    return $row['speed'];
}

function getRecordNotes($recordId)
{
    global $pdo;
    $sql = 'SELECT * FROM records WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId]);
    $row = $stmt->fetch();
    return $row['notes'];
}

function getRecordNumberOfSongs($recordId)
{
    global $pdo;
    $sql = 'SELECT * FROM records WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId]);
    $row = $stmt->fetch();
    return $row['numberOfSongs'];
}

// function to get the record song
function getRecordSong($recordId, $artistId, $step)
{
    global $pdo;
    $sql = 'SELECT * FROM songs WHERE records = ? AND artist = ? LIMIT ?, 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId, $artistId, $step]);
    $row = $stmt->fetch();
    return $row['title'];
}

function getRecordSongDuration($recordId, $artistId, $step)
{
    global $pdo;
    $sql = 'SELECT * FROM songs WHERE records = ? AND artist = ? LIMIT ?, 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId, $artistId, $step]);
    $row = $stmt->fetch();
    return $row['duration'];
}

function getNumberOfSongs($recordId, $artistId)
{
    global $pdo;
    $sql = 'SELECT * FROM songs WHERE records = ? AND artist = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId, $artistId]);
    $row = $stmt->fetchAll();
    return count($row);
}

function getSongsId($recordId, $artistId)
{
  global $pdo;
  $sql = 'SELECT id FROM songs WHERE records = ? AND artist = ?';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$recordId, $artistId]);
  $songsId = $stmt->fetchAll();
  return $songsId;
}

function countSongs($recordId, $artistId)
{
  global $pdo;
  $sql = 'SELECT COUNT(*) FROM songs WHERE records = ? AND artist = ?';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$recordId, $artistId]);
  $numberOfSongs = $stmt->fetch();
  return $numberOfSongs;
}

function updateSong($songId, $songTitle, $songDuration, $recordId, $artistId)
{
  global $pdo;
  $sql = 'UPDATE songs SET title = ?, duration = ? WHERE id = ? AND records = ? AND artist = ?';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$songTitle, $songDuration, $songId, $recordId, $artistId]);
  return $stmt->rowCount() > 0;
}

function addSong($songTitle, $songDuration, $recordId, $artistId)
{
  global $pdo;
  $sql = 'INSERT INTO songs (title, duration, records, artist) VALUES (?, ?, ?, ?)';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$songTitle, $songDuration, $recordId, $artistId]);
}