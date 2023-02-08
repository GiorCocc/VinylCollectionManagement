<!-- View data of the selected record -->

<?php
// include 'header.php';
include 'database-connection.php';
include 'functions.php';
include 'lastfm-api.php';
?>

<?php
$id = $_GET['recordId'];
$sql = 'SELECT * FROM records WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$row = $stmt->fetch();

$numberOfSongs = $row['numberOfSongs'];

function getSongs($id)
{
  global $pdo;
  $sql = 'SELECT * FROM songs WHERE records = :id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['id' => $id]);
  $songs = $stmt->fetchAll();
  return $songs;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="https://img.icons8.com/external-flaticons-flat-flat-icons/64/null/external-vinyl-record-rage-room-flaticons-flat-flat-icons.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>
    <?php echo $row['title'] ?>
  </title>
</head>

<body class="from-yellow-100 via-orange-300 to-red-500 bg-gradient-to-br">
  <?php include 'header.php' ?>

  <!-- component -->
  <div class='flex items-center justify-center min-h-screen'>
    <div class="p-4 items-center justify-center w-3/4 rounded-xl group sm:flex space-x-6 bg-white bg-opacity-50 shadow-xl hover:rounded-2xl">
      <div class="relative flex items-end overflow-hidden rounded-xl">
        <?php echo getAlbum(getArtistName($row['artist']), $row['title'], 4) ?>
      </div>
      <!-- <img class="mx-auto w-full block w-4/12 h-40 rounded-lg" alt="art cover" loading="lazy" src='https://picsum.photos/seed/2/2000/1000' /> -->
      <div class="sm:w-8/12 pl-0 p-5">
        <div class="space-y-2">
          <div class="space-y-4">
            <?php echo '<h1 class="text-3xl font-semibold text-gray-900 capitalize">' . $row['title'] . '</h1>' ?>
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


                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 21q-.825 0-1.413-.587Q3 19.825 3 19v-7q0-1.875.712-3.513.713-1.637 1.926-2.85 1.212-1.212 2.85-1.925Q10.125 3 12 3t3.513.712q1.637.713 2.85 1.925 1.212 1.213 1.925 2.85Q21 10.125 21 12v7q0 .825-.587 1.413Q19.825 21 19 21h-2q-.825 0-1.412-.587Q15 19.825 15 19v-4q0-.825.588-1.413Q16.175 13 17 13h2v-1q0-2.925-2.038-4.963Q14.925 5 12 5T7.038 7.037Q5 9.075 5 12v1h2q.825 0 1.412.587Q9 14.175 9 15v4q0 .825-.588 1.413Q7.825 21 7 21Z" />
                </svg>

                <span class="text-md mx-1">
                  <p class="text-gray-900 text-s font-semibold">
                    <?php echo $row['genre'] ?>
                  </p>
                </span>
              </div>
              <div class="cursor-pointer text-center text-md justify-center items-center flex">
                <!-- <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" class="text-md">
                  <path d="M512 0C229.248 0 0 229.248 0 512s229.248 512 512 512 512-229.248 512-512S794.752 0 512 0zM512 896c-212.992 0-384-171.008-384-384S299.008 128 512 128s384 171.008 384 384-171.008 384-384 384z"></path>
                  <path d="M512 256c-106.496 0-192 85.504-192 192s85.504 192 192 192 192-85.504 192-192-85.504-192-192-192zM512 640c-70.592 0-128-57.408-128-128s57.408-128 128-128 128 57.408 128 128-57.408 128-128 128z"></path>
                </svg> -->
                <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 5.67363C17.3649 6.7971 19 9.2076 19 12M8.39241 18C6.35958 16.7751 5 14.5463 5 12M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-md mx-1">
                  <p class="text-gray-900 text-s font-semibold">
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


                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M10.75 15.2q.475.45 1.2.413.725-.038 1.075-.513l5.25-7.325-7.375 5.2q-.5.35-.55 1.05-.05.7.4 1.175ZM12 5q1.375 0 2.512.338 1.138.337 2.263 1.012l-.925.625q-.875-.475-1.825-.725T12 6Q8.675 6 6.338 8.337 4 10.675 4 14q0 1.05.287 2.075Q4.575 17.1 5.1 18h13.8q.575-.95.838-1.975Q20 15 20 13.9q0-.9-.237-1.9-.238-1-.738-1.85l.625-.925q.75 1.25 1.05 2.362.3 1.113.3 2.313 0 1.275-.288 2.4-.287 1.125-.912 2.25-.125.2-.362.325Q19.2 19 18.9 19H5.1q-.275 0-.512-.137-.238-.138-.388-.388-.5-.875-.85-1.975T3 14q0-1.85.7-3.488.7-1.637 1.913-2.862 1.212-1.225 2.862-1.937Q10.125 5 12 5Zm.05 6.95Z" />
                </svg>

                <span class="text-md mx-1">
                  <p class="text-gray-900 text-s font-semibold">
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
        <h2 class="text-2xl w-full mx-auto font-semibold text-gray-900 mt-4">
          <?php if ($numberOfSongs == 0) echo "Non ci sono canzoni registrate per questo album";
          else echo "Canzoni"; ?>
        </h2>
        <?php if ($numberOfSongs > 0) { ?>
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
        <?php } ?>
        <div>
          <!-- remove button and modify button -->
          <div class="flex flex-row-reverse space-x-2 align-right mt-10">
            <div class="flex flex-row space-x-2">
              <!-- TODO: pagina di modifica dell'album -->
              <?php
              if ($numberOfSongs != 0) {
              ?>
                <a href="modify-songs.php?numberOfSongs=<?php echo $row['numberOfSongs'] ?>&recordId=<?php echo $row['id'] ?>&artistId=<?php echo $row['artist'] ?>" class="bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">

                  <svg stroke="currentColor" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                    <path d="M11.5 18.5v-6h-6v-1h6v-6h1v6h6v1h-6v6Z" />
                  </svg>
                  <p class="text-s">Modifica canzoni</p>
                </a>
              <?php } ?>
              <a href="modify-record.php?recordId=<?php echo $row['id'] ?>&artistId=<?php echo $row['artist'] ?>" class="bg-blue-500 shadow-lg shadow- shadow-blue-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                <svg stroke="currentColor" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                  <path d="M5.3 19h1.075l9.9-9.9L15.2 8.025l-9.9 9.9ZM18.425 8.375l-2.5-2.475 1.2-1.2q.3-.325.725-.325t.725.325l1.05 1.025q.3.3.3.725t-.3.725ZM17.7 9.1 6.8 20H4.3v-2.5L15.2 6.6Zm-1.975-.55-.525-.525L16.275 9.1Z" />
                </svg>
                <p class="text-s">Modificare</p>
              </a>
              <!-- Pulsante "Elimina" per rimuovere l'elemento dal database -->
              <a href="delete-record.php?<?php echo 'id=' . $row['id'] ?>" class="bg-red-500 shadow-lg shadow- shadow-red-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                <!-- Trashcan icon -->
                <svg stroke="currentColor" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                  <path d="M7.625 20q-.675 0-1.15-.475Q6 19.05 6 18.375V6H5V5h4v-.775h6V5h4v1h-1v12.375q0 .7-.462 1.163-.463.462-1.163.462ZM17 6H7v12.375q0 .275.175.45t.45.175h8.75q.25 0 .437-.188.188-.187.188-.437ZM9.8 17h1V8h-1Zm3.4 0h1V8h-1ZM7 6v13-.625Z" />
                </svg>

                <p class="text-s">Eliminare</p>
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