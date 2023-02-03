<!-- View data of the selected record -->

<?php
// include 'header.php';
include 'database-connection.php';
include 'functions.php';
include 'lastfm-api.php';
?>

<?php
$id = $_GET['id'];
$sql = 'SELECT * FROM records WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$row = $stmt->fetch();

function getSongs($id)
{
    global $pdo;
    $sql = 'SELECT * FROM songs WHERE records = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $songs = $stmt->fetchAll();
    return $songs;
}

function getNumberOfSongs($id)
{
    global $pdo;
    $sql = 'SELECT COUNT(*) FROM songs WHERE records = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $songs = $stmt->fetch();
    return $songs[0];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Document</title>
</head>

<body>
  <?php include 'header.php' ?>

  <!-- component -->
  <div class='flex items-center justify-center min-h-screen from-yellow-100 via-orange-300 to-red-500 bg-gradient-to-br'>
    <div class="p-4 items-center justify-center w-3/4 rounded-xl group sm:flex space-x-6 bg-white bg-opacity-50 shadow-xl hover:rounded-2xl">
      <div class="relative flex items-end overflow-hidden rounded-xl">
        <?php echo getAlbum(getArtistName($row['artist']), $row['title'], 4) ?>
      </div>
      <!-- <img class="mx-auto w-full block w-4/12 h-40 rounded-lg" alt="art cover" loading="lazy" src='https://picsum.photos/seed/2/2000/1000' /> -->
      <div class="sm:w-8/12 pl-0 p-5">
        <div class="space-y-2">
          <div class="space-y-4">
            <?php echo '<h1 class="text-3xl font-semibold text-gray-900">' . $row['title'] . '</h1>' ?>
          </div>
          <div class="flex items-center space-x-4 justify-between">
            <div class="flex gap-3 space-y-1">
              <!-- TODO: fare in modo di mostrare la foto dell'artista -->
              <div class="rounded-full h-8 w-8">

                <?php echo getArtistPhoto(getArtistName($row['artist']), 3);
                ?>
              </div>
              <!-- <img src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" class="rounded-full h-8 w-8" /> -->
              <span class="text-sm">
                <?php echo '<p class="text-gray-900 font-semibold">' . getArtistName($row['artist']) . '</p>' ?>
                <p class="text-gray-500">
                  <?php echo $row['year'] ?>
                </p>
              </span>
            </div>
            <div class=" px-3 py-1 rounded-lg flex space-x-2 flex-row">
              <div class="cursor-pointer text-center text-md justify-center items-center flex">
                <!-- <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" class="text-md">
                  <path d="M512 0C229.248 0 0 229.248 0 512s229.248 512 512 512 512-229.248 512-512S794.752 0 512 0zM512 896c-212.992 0-384-171.008-384-384S299.008 128 512 128s384 171.008 384 384-171.008 384-384 384z"></path>
                  <path d="M512 256c-106.496 0-192 85.504-192 192s85.504 192 192 192 192-85.504 192-192-85.504-192-192-192zM512 640c-70.592 0-128-57.408-128-128s57.408-128 128-128 128 57.408 128 128-57.408 128-128 128z"></path>
                </svg> -->
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 5.67363C17.3649 6.7971 19 9.2076 19 12M8.39241 18C6.35958 16.7751 5 14.5463 5 12M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-xs mx-1">
                  <p class="text-gray-900 text-xs font-semibold">
                    <?php switch ($row['format']) {
                      case 1:
                        echo '12"';
                        break;
                      case 2:
                        echo '10"';
                        break;
                      case 3:
                        echo '7"';
                        break;
                    } ?>
                  </p>
                </span>
              </div>
              <div class="cursor-pointer text-center text-md justify-center items-center flex">

                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6.34315 17.6569C5.22433 16.538 4.4624 15.1126 4.15372 13.5607C3.84504 12.0089 4.00346 10.4003 4.60896 8.93853C5.21446 7.47672 6.23984 6.22729 7.55544 5.34824C8.87103 4.46919 10.4177 4 12 4C13.5823 4 15.129 4.46919 16.4446 5.34824C17.7602 6.22729 18.7855 7.47672 19.391 8.93853C19.9965 10.4003 20.155 12.0089 19.8463 13.5607C19.5376 15.1126 18.7757 16.538 17.6569 17.6569" stroke="#33363F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M12 12L16 10" stroke="#33363F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <span class="text-md mx-1">
                  <p class="text-gray-900 text-xs font-semibold">
                    <?php switch ($row['speed']) {
                      case 1:
                        echo '33 1/3 RPM';
                        break;
                      case 2:
                        echo '45 RPM';
                        break;
                      case 3:
                        echo '78 RPM';
                        break;
                    } ?>
                  </p>
                </span>
              </div>
            </div>
          </div>
          <div class="flex items-center space-x-4 justify-between">
            <!-- <div class="text-grey-500 flex flex-row space-x-1  my-4">
              <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <p class="text-xs">2 hours ago</p>
            </div> -->
            <div class="flex flex-row space-x-1">
              <?php
              switch ($row['vinyl_condition']) {
                case 1:
                  echo "<div class=\"bg-green-500 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row\">";
                  echo '<span class="text-xs text-white-900 font-semibold">Disco: Mint</span>';
                  echo "</div>";
                  break;
                case 2:
                  echo "<div class=\"bg-yellow-500 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row\">";
                  echo '<span class="text-xs text-white-900 font-semibold">Disco: Near Mint</span>';
                  echo "</div>";
                  // echo '<p class="text-xs text-gray-900 font-semibold">Near Mint</p>';
                  break;
                case 3:
                  echo "<div class=\"bg-orange-500 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row\">";
                  echo '<span class="text-xs text-white-900 font-semibold">Disco: Very Good</span>';
                  echo "</div>";
                  // echo '<p class="text-xs text-gray-900 font-semibold">Very Good</p>';
                  break;
                case 4:
                  echo "<div class=\"bg-red-500 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row\">";
                  echo '<span class="text-xs text-white-900 font-semibold">Disco: Good</span>';
                  echo "</div>";
                  // echo '<p class="text-xs text-gray-900 font-semibold">Good</p>';
                  break;
                case 5:
                  echo "<div class=\"bg-black-500 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row\">";
                  echo '<span class="text-xs text-white-900 font-semibold">Disco: Fair</span>';
                  echo "</div>";
                  // echo '<p class="text-xs text-gray-900 font-semibold">Fair</p>';
                  break;
              }
              ?>
              <?php
              switch ($row['sleeve_condition']) {
                case 1:
                  echo "<div class=\"bg-green-500 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row\">";
                  echo '<span class="text-xs text-white-900 font-semibold">Copertina: Mint</span>';
                  echo "</div>";
                  break;
                case 2:
                  echo "<div class=\"bg-yellow-500 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row\">";
                  echo '<span class="text-xs text-white-900 font-semibold">Copertina: Near Mint</span>';
                  echo "</div>";
                  // echo '<p class="text-xs text-gray-900 font-semibold">Near Mint</p>';
                  break;
                case 3:
                  echo "<div class=\"bg-orange-500 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row\">";
                  echo '<span class="text-xs text-white-900 font-semibold">Copertina: Very Good</span>';
                  echo "</div>";
                  // echo '<p class="text-xs text-gray-900 font-semibold">Very Good</p>';
                  break;
                case 4:
                  echo "<div class=\"bg-red-500 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row\">";
                  echo '<span class="text-xs text-white-900 font-semibold">Copertina: Good</span>';
                  echo "</div>";
                  // echo '<p class="text-xs text-gray-900 font-semibold">Good</p>';
                  break;
                case 5:
                  echo "<div class=\"bg-black-500 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row\">";
                  echo '<span class="text-xs text-white-900 font-semibold">Copertina: Fair</span>';
                  echo "</div>";
                  // echo '<p class="text-xs text-gray-900 font-semibold">Fair</p>';
                  break;
              }
              ?>



            </div>
          </div>
          <?php
          if ($row['notes'] != '') {
            echo "<div class=\"text-grey-500 text-xs flex flex-row space-x-1 max-h-20 overflow-auto my-4\">";
            echo '<span>Note: ' . $row['notes'] . '</span>';
            echo "</div>";
          }
          ?>
        </div>
        <!-- TODO: Mostrare le canzoni contenute nell'album -->
        <h2 class="text-2xl w-full mx-auto font-semibold text-gray-900 mt-4">Canzoni</h2>
        <table class="w-full">
          <thead>
            <tr>
            <th class="text-left text-gray-900 font-semibold"></th>
              <th class="text-left text-gray-900 font-semibold">Titolo</th>
              <th class="text-left text-gray-900 font-semibold">Durata</th>
            </tr>
          </thead>
          <tbody>
            <!-- Prendere tutte le canzoni salvate nella tabella songs che hanno lo stesso id dell'album visualizzato -->
            <?php
            $songs = getSongs($row['id']);
            $i = 1;
            foreach ($songs as $song) {
              echo "<tr>";
              echo "<td class=\"text-left text-gray-900 font-semibold\">" . $i . "</td>";
              echo "<td class=\"text-left text-gray-900 font-semibold\">" . $song['title'] . "</td>";
              echo "<td class=\"text-left text-gray-900 font-semibold\">" . $song['duration'] . "</td>";
              echo "</tr>";
              $i++;
            }
            ?>
          </tbody>
        </table>
        <div>
            <!-- remove button and modify button -->
            <div class="flex flex-row-reverse space-x-2 align-right">
              <div class="flex flex-row space-x-2">
                <!-- TODO: pagina di modifica dell'album -->
                <!-- <a href="add-songs.php?numberOfSongs=<?php echo $row['numberOfSongs'] ?>&recordId=<?php echo $row['id'] ?>&artistId=<?php echo $row['artist'] ?>"
                class="bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                  <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                  </svg>
                  <p class="text-xs">Aggiungi canzoni</p>
                </a> -->
                <a href="modify-record.php" class="bg-blue-500 shadow-lg shadow- shadow-blue-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                  <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                  </svg>
                  <p class="text-xs">Modificare</p>
                </a>
                <!-- Pulsante "Elimina" per rimuovere l'elemento dal database -->
                <a href="delete-record.php?<?php echo 'id=' . $row['id'] ?>" class="bg-red-500 shadow-lg shadow- shadow-red-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                  <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
                  <p class="text-xs">Eliminare</p>
                </a>

              </div>
              <!-- <div class="flex flex-row space-x-2">
                <div class="bg-green-500 shadow-lg shadow- shadow-green-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                  <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  <p class="text-xs">

                </div>
              </div> -->
            </div>
          </div>
      </div>
    </div>
    
  </div>

  <?php include 'footer.php'; ?>
</body>

</html>