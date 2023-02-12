<?php
// inserire le canzoni prese dagli elementi di input e inserirle nel database nella tabella songs con l'id del record e l'id dell'artista corrispondente
require_once 'database-connection.php';
require_once 'functions.php';
require_once 'lastfm-api.php';
$numberOfSongs = $_GET['numberOfSongs'];

// prendere l'id dell'artista e del record
$artistId = $_GET['artistId'];
$recordId = $_GET['recordId'];

// leggere i dati delle canzoni e delle durate dai campi di input
if (isset($_POST['submit'])) {
  for ($i = 1; $i <= $numberOfSongs; $i++) {
    $song = $_POST['song' . $i];
    $duration = $_POST['duration' . $i];
    // capitalize the first letter of each word of each field
    $song = ucwords($song);
    $duration = ucwords($duration);
    
    $sql = 'INSERT INTO songs (records, artist, title, duration) VALUES (?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recordId, $artistId, $song, $duration]);
  }
  header('Location: record.php?recordId=' . $recordId);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="https://img.icons8.com/external-flaticons-flat-flat-icons/64/null/external-vinyl-record-rage-room-flaticons-flat-flat-icons.png" />
  <title>Add new record</title>
</head>

<body class="from-yellow-100 via-orange-300 to-red-500 bg-gradient-to-br">
  <div class="">
    <div class="relative w-full">
      <?php include 'header.php'; ?>
      <div class="relative w-full">

        <div class="relative">
          <div class="container m-auto px-6 pt-10 md:px-12 lg:pt-[4.8rem] lg:px-7">
            <div class="flex items-center flex-wrap px-2 md:px-0">
              <div class="w-full m-10 p-10 bg-white bg-opacity-50 shadow-xl hover:rounded-4xl rounded-3xl  shadow-xl">
                <h1 class="text-3xl font-bold text-center text-gray-900">Aggiungi le canzoni per l'album</h1>
                <div class="grid grid-cols-2 gap-4 pt-10">
                  <div class="relative m-auto flex items-end overflow-hidden rounded-xl">
                    <?php echo getAlbum(getArtistName($artistId), getAlbumNameById($recordId), 4); ?>
                  </div>
                  <form action="" method="post" class="m-auto">
                    <?php
                    // creare un numero di campi dinamico basato sul numero passato con il metodo GET alla chiamata della pagina
                    $numberOfSongs = $_GET['numberOfSongs'];
                    for ($i = 1; $i <= $numberOfSongs; $i++) {
                      echo '<div class="flex flex-col gap-3">
                  <div class="flex flex-row gap-3">
                  <label for="song' . $i . '" class="text-gray-700 my-auto">Canzone</label>
                  <input type="text" name="song' . $i . '" id="song' . $i . '" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2" placeholder="Canzone ' . $i . '">
                  <label for="duration' . $i . '" class="text-gray-700 my-auto">Durata</label>
                  <input type="text" name="duration' . $i . '" id="duration' . $i . '" class="w-full bg-white bg-opacity-50 rounded-xl border border-amber-500 px-3 py-2" placeholder="Durata ' . $i . '">
                </div>';
                    }
                    ?>
                    <input type="submit" name="submit" value="Aggiungi canzoni" class="flex flex-row-reversed ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12 my-3">
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