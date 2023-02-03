<!-- Pagina veb per inserire un nuovo vinile nel database -->
<?php
require_once 'database-connection.php';
require_once 'functions.php';

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $artist = $_POST['artist'];
  $label = $_POST['label'];
  $genre = $_POST['genre'];
  $year = $_POST['year'];
  $vinyl_condition = $_POST['vinyl_condition'];
  $sleeve_condition = $_POST['sleeve_condition'];
  $format = $_POST['format'];
  $speed = $_POST['speed'];
  $notes = $_POST['notes'];
  $numberOfSongs = $_POST['numberOfSongs'];

  $artistId = checkArtist($artist);
  $labelId = checkLabel($label);

  // check if title, artist and label are not empty. If they are, redirect to the same page
  // if (empty($title) || empty($artist) || empty($label)) {
  //   header('Location: index.php');
  // }

  if (checkRecord($title, $artistId)) {
    die('Record already exists');
  } else {
    $sql = 'INSERT INTO records (title, artist, year, label, genre, vinyl_condition, sleeve_condition, format, speed, notes, numberOfSongs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $artistId, $year, $labelId, $genre, $vinyl_condition, $sleeve_condition, $format, $speed, $notes, $numberOfSongs]);
    // andare alla pagina "add songs" passando come parametro number of songs
    // header('Location: add-songs.php?numberOfSongs=' . $numberOfSongs . '&recordId=' . $pdo->lastInsertId() . '&artistId=' . $artistId);
  }

  // andare alla pagina "add songs" passando come parametro number of songs
  header('Location: add-songs.php?numberOfSongs=' . $numberOfSongs . '&recordId=' . $pdo->lastInsertId() . '&artistId=' . $artistId);

  
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Add new record</title>
</head>

<body>
  <div class="relative w-full from-yellow-100 via-orange-300 to-red-500 bg-gradient-to-br">
  <?php include 'header.php'; ?>
  <div class="relative w-full">

    <div class="relative">
      <div class="container m-auto px-6 pt-10 md:px-12 lg:pt-[4.8rem] lg:px-7">
        <div class="flex items-center flex-wrap px-2 md:px-0">
          <div class="w-full m-10 p-10 bg-white bg-opacity-50 shadow-xl hover:rounded-4xl rounded-3xl  shadow-xl">
            <h1 class="text-3xl font-bold text-center text-gray-900">Add new record</h1>
            <div class="grid grid-cols-2 gap-4">
              <img src="resources/record.png" alt="record" class=" m-auto">
              <form action="" method="post" class="m-auto">
                <label for="title">Titolo</label>
                <input type="text" name="title" id="title" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2"><br>
                <label for="artist">Artista</label>
                <input type="text" name="artist" id="artist" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2"><br>
                <label for="year">Anno di pubblicazione</label>
                <input type="text" name="year" id="year" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2"><br>
                <label for="label">Casa discografica</label>
                <input type="text" name="label" id="label" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2"><br>
                <label for="genre">Genere</label>
                <input type="text" name="genre" id="genre" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2"><br>
                <label for="vinyl_condition">Condizioni del disco</label>
                <select name="vinyl_condition" id="vinyl_condition" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2">
                  <option value="1">Mint</option>
                  <option value="2">Near Mint</option>
                  <option value="3">Very Good Plus</option>
                  <option value="4">Good Plus</option>
                  <option value="5">Fair</option>
                  <option value="6">Poor</option>
                </select>
                <label for="sleeve_condition">Condizioni della copertina</label>
                <select name="sleeve_condition" id="sleeve_condition" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2">
                  <option value="1">Mint</option>
                  <option value="2">Near Mint</option>
                  <option value="3">Very Good Plus</option>
                  <option value="4">Good Plus</option>
                  <option value="5">Fair</option>
                  <option value="6">Poor</option>
                </select> <br>
                <label for="format">Formato del disco</label>
                <select name="format" id="format" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2 ">
                  <option value="1">12"</option>
                  <option value="2">10"</option>
                  <option value="3">7"</option>
                </select> <br>
                <label for="speed">Velocità di riproduzione</label>
                <select name="speed" id="speed" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2">
                  <option value="1">33 1/3 RPM</option>
                  <option value="2">45 RPM</option>
                  <option value="3">78 RPM</option>
                </select> <br>
                <label for="notes">Note</label>
                <textarea name="notes" id="notes" cols="30" rows="5" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2"></textarea>
                
                <label for="numberOfSongs">Numero di tracce</label>
                <input type="text" name="numberOfSongs" id="numberOfSongs" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2"><br>
                <!-- Add songs -->
                <!-- TODO: add a cancel button -->
                <input type="submit" name="submit" value="Aggiungi il disco" class="flex flex-row-reversed ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12 my-3">
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