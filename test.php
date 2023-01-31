<!-- Script per recuperare tutti i vinili contenuti nel database -->
<?php
require_once 'database-connection.php';
require_once 'functions.php';
require_once 'lastfm-api.php';

$sql = 'SELECT * FROM records';
$stmt = $pdo->query($sql);

while ($row = $stmt->fetch()) {
    echo $row['title'] . '<br>';
    echo getArtistName($row['artist']) . '<br>';
    echo $row['year'] . '<br>';
    echo getAlbum(getArtistName($row['artist']), $row['title'], 2);
}
?>