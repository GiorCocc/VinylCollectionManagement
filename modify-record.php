<!-- Modify the record passed by parameters (record id and artist id) -->
<?php
require_once 'database-connection.php';
require_once 'functions.php';
require_once 'lastfm-api.php';

// Get the record id
$record_id = $_GET['recordId'];
// Get the artist id
$artist_id = $_GET['artistId'];

if (isset($_POST['submit'])) {
  $newTitle = $_POST['title'];
  $newArtist = $_POST['artist'];
  $newYear = $_POST['year'];
  $newLabel = $_POST['label'];
  $newGenre = $_POST['genre'];
  $newVinylCondition = $_POST['vinyl_condition'];
  $newSleeveCondition = $_POST['sleeve_condition'];
  $newFormat = $_POST['format'];
  $newSpeed = $_POST['speed'];
  $newNotes = $_POST['notes'];
  $newNumberOfSongs = $_POST['numberOfSongs'];
  $oldNumberOfSongs = getRecordNumberOfSongs($record_id);

  $artistId = checkArtist($newArtist);
  $labelId = checkLabel($newLabel);

  // check if title, artist and label are not empty. If they are, redirect to the same page
  // if (empty($title) || empty($artist) || empty($label)) {
  //   header('Location: index.php');
  // }

  $newTitle = ucwords($newTitle);
  $newGenre = ucwords($newGenre);
  $newNotes = ucwords($newNotes);
  $newVinylCondition = ucwords($newVinylCondition);
  $newSleeveCondition = ucwords($newSleeveCondition);
  $newFormat = ucwords($newFormat);
  $newSpeed = ucwords($newSpeed);

  $sql = 'UPDATE records SET title = ?, artist = ?, year = ?, label = ?, genre = ?, vinyl_condition = ?, sleeve_condition = ?, format = ?, speed = ?, notes = ?, numberOfSongs = ? WHERE id = ?';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$newTitle, $artistId, $newYear, $labelId, $newGenre, $newVinylCondition, $newSleeveCondition, $newFormat, $newSpeed, $newNotes, $newNumberOfSongs, $record_id]);

    if(empty($newNumberOfSongs) || $newNumberOfSongs == 0) {
      // remove all songs from the database
      $sql = 'DELETE FROM songs WHERE records = ? AND artist = ?';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$record_id, $artist_id]);
      header('Location: record.php?recordId=' . $record_id);
    } else if ($newNumberOfSongs == $oldNumberOfSongs) {
      header('Location: record.php?recordId=' . $record_id);
    } else if ($oldNumberOfSongs == 0 && $newNumberOfSongs > 0) {
      header('Location: add-songs.php?numberOfSongs=' . $newNumberOfSongs . '&recordId=' . $record_id . '&artistId=' . $artist_id);
    } else if($newNumberOfSongs < $oldNumberOfSongs) {
      // remove songs from the database
      $sql = 'DELETE FROM songs WHERE records = ? AND artist = ?;';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$record_id, $artist_id]);
      header('Location: add-songs.php?numberOfSongs=' . $newNumberOfSongs . '&recordId=' . $record_id . '&artistId=' . $artist_id);
    } 
    else {
      header('Location: modify-songs.php?numberOfSongs=' . $newNumberOfSongs . '&recordId=' . $record_id . '&artistId=' . $artist_id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="https://img.icons8.com/external-flaticons-flat-flat-icons/64/null/external-vinyl-record-rage-room-flaticons-flat-flat-icons.png" />
  <title>Modifica
    <?php echo getRecordName($record_id); ?>
  </title>
</head>

<body class="from-yellow-100 via-orange-300 to-red-500 bg-gradient-to-br">
  <div class="relative w-full">
    <?php include 'header.php'; ?>
    <div class="relative w-full">

      <div class="relative">
        <div class="container m-auto px-6 pt-10 md:px-12 lg:pt-[4.8rem] lg:px-7">
          <div class="flex items-center flex-wrap px-2 md:px-0">
            <div class="w-full m-10 p-10 bg-white bg-opacity-50 shadow-xl hover:rounded-4xl rounded-3xl  shadow-xl">
              <h1 class="text-3xl font-bold text-center text-gray-900">
                Modifica <?php echo getRecordName($record_id); ?>
              </h1>
              <div class="grid grid-cols-2 gap-4">
                <!-- Get album name -->
                <?php
                $artist_id = $_GET['artistId'];
                $record_id = $_GET['recordId'];
                $artist_name = getArtistName($artist_id);
                $record_name = getAlbumNameById($record_id);
                echo '<div class="relative m-auto flex items-end overflow-hidden rounded-xl">';
                echo getAlbum($artist_name, $record_name, 4);
                echo '</div>';
                ?>
                <form action="" method="post" class="m-auto">
                  <label for="title">Titolo</label>
                  <input type="text" name="title" id="title" placeholder="Titolo dell'album" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2" value="<?php echo getRecordName($record_id); ?>"><br>
                  <label for="artist">Artista</label>
                  <input type="text" name="artist" id="artist" placeholder="Artista" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2" value="<?php echo getArtistName($artist_id); ?>"><br>
                  <label for="year">Anno di pubblicazione</label>
                  <input type="text" name="year" id="year" placeholder="Anno di pubblicazione" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2" value="<?php echo getRecordYear($record_id); ?>"><br>
                  <label for="label">Casa discografica</label>
                  <input type="text" name="label" id="label" placeholder="Casa discografica" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2" value="<?php echo getRecordLabel($record_id); ?>"><br>
                  <label for="genre">Genere</label>
                  <input type="text" name="genre" id="genre" placeholder="Genere" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2" value="<?php echo getRecordGenre($record_id); ?>"><br>
                  <label for="vinyl_condition">Condizioni del disco</label>
                  <select name="vinyl_condition" id="vinyl_condition" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2">
                    <!-- Get the vinyl condition and select the correct element -->
                    <?php
                    $vinyl_condition = getRecordVinylCondition($record_id);
                    switch ($vinyl_condition) {
                      case 1:
                        echo '<option value="1" selected>Mint</option>';
                        echo '<option value="2">Near Mint</option>';
                        echo '<option value="3">Very Good Plus</option>';
                        echo '<option value="4">Good Plus</option>';
                        echo '<option value="5">Fair</option>';
                        echo '<option value="6">Poor</option>';
                        break;
                      case 2:
                        echo '<option value="1">Mint</option>';
                        echo '<option value="2" selected>Near Mint</option>';
                        echo '<option value="3">Very Good Plus</option>';
                        echo '<option value="4">Good Plus</option>';
                        echo '<option value="5">Fair</option>';
                        echo '<option value="6">Poor</option>';
                        break;
                      case 3:
                        echo '<option value="1">Mint</option>';
                        echo '<option value="2">Near Mint</option>';
                        echo '<option value="3" selected>Very Good Plus</option>';
                        echo '<option value="4">Good Plus</option>';
                        echo '<option value="5">Fair</option>';
                        echo '<option value="6">Poor</option>';
                        break;
                      case 4:
                        echo '<option value="1">Mint</option>';
                        echo '<option value="2">Near Mint</option>';
                        echo '<option value="3">Very Good Plus</option>';
                        echo '<option value="4" selected>Good Plus</option>';
                        echo '<option value="5">Fair</option>';
                        echo '<option value="6">Poor</option>';
                        break;
                      case 5:
                        echo '<option value="1">Mint</option>';
                        echo '<option value="2">Near Mint</option>';
                        echo '<option value="3">Very Good Plus</option>';
                        echo '<option value="4">Good Plus</option>';
                        echo '<option value="5" selected>Fair</option>';
                        echo '<option value="6">Poor</option>';
                        break;
                      case 6:
                        echo '<option value="1">Mint</option>';
                        echo '<option value="2">Near Mint</option>';
                        echo '<option value="3">Very Good Plus</option>';
                        echo '<option value="4">Good Plus</option>';
                        echo '<option value="5">Fair</option>';
                        echo '<option value="6" selected>Poor</option>';
                        break;
                    }
                    ?>
                  </select>
                  <label for="sleeve_condition">Condizioni della copertina</label>
                  <select name="sleeve_condition" id="sleeve_condition" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2">
                    <?php
                    $vinyl_condition = getRecordSleeveCondition($record_id);
                    switch ($vinyl_condition) {
                      case 1:
                        echo '<option value="1" selected>Mint</option>';
                        echo '<option value="2">Near Mint</option>';
                        echo '<option value="3">Very Good Plus</option>';
                        echo '<option value="4">Good Plus</option>';
                        echo '<option value="5">Fair</option>';
                        echo '<option value="6">Poor</option>';
                        break;
                      case 2:
                        echo '<option value="1">Mint</option>';
                        echo '<option value="2" selected>Near Mint</option>';
                        echo '<option value="3">Very Good Plus</option>';
                        echo '<option value="4">Good Plus</option>';
                        echo '<option value="5">Fair</option>';
                        echo '<option value="6">Poor</option>';
                        break;
                      case 3:
                        echo '<option value="1">Mint</option>';
                        echo '<option value="2">Near Mint</option>';
                        echo '<option value="3" selected>Very Good Plus</option>';
                        echo '<option value="4">Good Plus</option>';
                        echo '<option value="5">Fair</option>';
                        echo '<option value="6">Poor</option>';
                        break;
                      case 4:
                        echo '<option value="1">Mint</option>';
                        echo '<option value="2">Near Mint</option>';
                        echo '<option value="3">Very Good Plus</option>';
                        echo '<option value="4" selected>Good Plus</option>';
                        echo '<option value="5">Fair</option>';
                        echo '<option value="6">Poor</option>';
                        break;
                      case 5:
                        echo '<option value="1">Mint</option>';
                        echo '<option value="2">Near Mint</option>';
                        echo '<option value="3">Very Good Plus</option>';
                        echo '<option value="4">Good Plus</option>';
                        echo '<option value="5" selected>Fair</option>';
                        echo '<option value="6">Poor</option>';
                        break;
                      case 6:
                        echo '<option value="1">Mint</option>';
                        echo '<option value="2">Near Mint</option>';
                        echo '<option value="3">Very Good Plus</option>';
                        echo '<option value="4">Good Plus</option>';
                        echo '<option value="5">Fair</option>';
                        echo '<option value="6" selected>Poor</option>';
                        break;
                    }
                    ?>
                  </select> <br>
                  <label for="format">Formato del disco</label>
                  <select name="format" id="format" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2 ">
                    <?php
                    $vinyl_format = getRecordFormat($record_id);
                    switch ($vinyl_format) {
                      case 1:
                        echo '<option value="1" selected>12"</option>';
                        echo '<option value="2">10"</option>';
                        echo '<option value="3">7"</option>';
                        break;
                      case 2:
                        echo '<option value="1">12"</option>';
                        echo '<option value="2" selected>10"</option>';
                        echo '<option value="3">7"</option>';
                        break;
                      case 3:
                        echo '<option value="1">12"</option>';
                        echo '<option value="2">10"</option>';
                        echo '<option value="3" selected>7"</option>';
                        break;
                    }
                    ?>
                  </select> <br>
                  <label for="speed">Velocità di riproduzione</label>
                  <select name="speed" id="speed" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2">
                    <?php
                    $vinyl_speed = getRecordSpeed($record_id);
                    switch ($vinyl_speed) {
                      case 1:
                        echo '<option value="1" selected>33 1/3 RPM</option>';
                        echo '<option value="2">45 RPM</option>';
                        echo '<option value="3">78 RPM</option>';
                        break;
                      case 2:
                        echo '<option value="1">33 1/3 RPM</option>';
                        echo '<option value="2" selected>45 RPM</option>';
                        echo '<option value="3">78 RPM</option>';
                        break;
                      case 3:
                        echo '<option value="1">33 1/3 RPM</option>';
                        echo '<option value="2">45 RPM</option>';
                        echo '<option value="3" selected>78 RPM</option>';
                        break;
                    }
                    ?>
                  </select> <br>
                  <label for="notes">Note</label>
                  <textarea name="notes" id="notes" cols="30" rows="5" placeholder="Note" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2"><?php echo getRecordNotes($record_id); ?></textarea> <br>

                  <label for="numberOfSongs">Numero di tracce</label>
                  <input type="text" name="numberOfSongs" id="numberOfSongs" placeholder="Numero di tracce" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2" value="<?php echo getRecordNumberOfSongs($record_id); ?>" required><br>
                  <!-- Add songs -->
                  <!-- TODO: add a cancel button -->
                  <input type="submit" name="submit" value="Salva" class="flex flex-row-reversed ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12 my-3">
                </form>
              </div>
            </div>
          </div>



        </div>
      </div>
      <?php include 'footer.php'; ?>
    </div>
</body>

</html>