<?php
require_once 'database-connection.php';
require_once 'functions.php';
require_once 'lastfm-api.php';

$numberOfSongs = $_GET['numberOfSongs'];
$artistId = $_GET['artistId'];
$recordId = $_GET['recordId'];
$storedSongs = getNumberOfSongs($recordId, $artistId);

if (isset($_POST['submit'])) {
  for ($i = 1; $i <= $numberOfSongs; $i++) {
    $songTitle = $_POST['song' . $i];
    $songDuration = $_POST['duration' . $i];
    $songId = getSongsId($recordId, $artistId)[$i - 1]['id'];

    if (!updateSong($songId, $songTitle, $songDuration, $recordId, $artistId)) {
      if ($numberOfSongs > $storedSongs['COUNT(*)'])
        addSong($songTitle, $songDuration, $recordId, $artistId);
    }
  }
  header('Location: record.php?recordId=' . $recordId);
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="https://img.icons8.com/external-flaticons-flat-flat-icons/64/null/external-vinyl-record-rage-room-flaticons-flat-flat-icons.png" />
  <title>Aggiungi un nuovo disco</title>
</head>

<body class="from-yellow-100 via-orange-300 to-red-500 bg-gradient-to-br h-screen">
  <div class="">
    <div class="relative ">
      <?php include 'header.php'; ?>
      <div class="relative w-full">

        <div class="relative">
          <div class="container m-auto px-6 pt-10 md:px-12 lg:pt-[4.8rem] lg:px-7">
            <div class="flex items-center flex-wrap px-2 md:px-0">
              <div class="w-full m-10 p-10 bg-white bg-opacity-50 shadow-xl hover:rounded-4xl rounded-3xl  shadow-xl">
                <h1 class="text-3xl font-bold text-center text-gray-900">Aggiungi le canzoni per l'album</h1>
                <div class="grid grid-cols-2 gap-4 pt-10">
                  <?php
                  $artist_id = $_GET['artistId'];
                  $record_id = $_GET['recordId'];
                  $artist_name = getArtistName($artist_id);
                  $record_name = getRecordName($record_id);
                  echo '<div class="relative m-auto flex items-end overflow-hidden rounded-xl">';
                  echo getAlbum($artist_name, $record_name, 4);
                  echo '</div>';
                  ?>
                  <form action="" method="post" class="m-auto">
                    <?php
                    // Get all the songs of the album and display them
                    $sql = 'SELECT * FROM songs WHERE records = ?';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$record_id]);
                    $songs = $stmt->fetchAll();
                    $i = 1;

                    foreach ($songs as $song) {
                      echo '<div class="flex flex-col gap-3">';
                      echo '<div class="flex flex-row gap-3">';
                      echo '<label for="song' . $i . '" class="text-gray-700 my-auto">Canzone</label>';
                      echo '<input type="text" name="song' . $i . '" id="song' . $i . '" value="' . $song['title'] . '" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2">';
                      echo '<label for="duration' . $i . '" class="text-gray-700 my-auto">Durata</label>';
                      echo '<input type="text" name="duration' . $i . '" id="duration' . $i . '" value="' . $song['duration'] . '" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2">';
                      echo '</div>';
                      echo '</div>';
                      $i++;
                    }

                    // if there are less songs than the number of songs in the album, add the missing ones
                    if ($i <= $numberOfSongs) {
                      for ($i; $i <= $numberOfSongs; $i++) {
                        echo '<div class="flex flex-col gap-3">';
                        echo '<div class="flex flex-row gap-3">';
                        echo '<label for="song' . $i . '" class="text-gray-700 my-auto">Canzone</label>';
                        echo '<input type="text" name="song' . $i . '" id="song' . $i . '" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2">';
                        echo '<label for="duration' . $i . '" class="text-gray-700 my-auto">Durata</label>';
                        echo '<input type="text" name="duration' . $i . '" id="duration' . $i . '" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2">';
                        echo '</div>';
                        echo '</div>';
                      }
                    }
                    ?>
                    <input type="submit" name="submit" value="Modifica" class="flex flex-row-reversed ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12 my-3">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>

</html>