<?php
require_once 'database-connection.php';
require_once 'index-functions.php';

$click = $_GET['click'] ?? 0;
$param = $_GET['param'] ?? '';
$artistId = $_GET['artistId'] ?? null;
$orderOption = $_GET['order'] ?? 0; // 0 = title, 1 = artist, 2 = year
$stmt = prepareQuery($param, $click, $orderOption);
$totalRecords = getAllRecords();

if (empty($param) || $param == ' ' || $param == '') {
  $possibleSteps = ceil(getAllRecords() / 10);
} else {
  $possibleSteps = ceil(getAmountRecords($stmt) / 10);
}

if (!empty($artistId)) {
  $sql = 'SELECT * FROM records WHERE artist = ?';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$artistId]);
}

if (isset($_GET['submit'])) {
  $click = 0;
  $param = $_GET['param'];
  header("Location: index.php?click=$click&param=$param");
}

?>

<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Record Collection</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="https://img.icons8.com/external-flaticons-flat-flat-icons/64/null/external-vinyl-record-rage-room-flaticons-flat-flat-icons.png" />
  <?php require 'database-connection.php'; ?>
  <?php require 'functions.php'; ?>
  <?php require 'lastfm-api.php'; ?>
</head>

<body class="from-yellow-100 via-orange-300 to-red-500 bg-gradient-to-br">
  <div class="relative w-full">
    <?php include 'header.php'; ?>
    <div class="relative">
      <div class="container m-auto px-6 pt-32 md:px-12 lg:pt-[4.8rem] lg:px-7">
        <div class="flex items-center flex-wrap px-2 md:px-0">
          <div class="relative lg:w-6/12 lg:py-24 xl:py-32">
            <h1 class="font-bold text-4xl text-yellow-900 md:text-5xl lg:w-10/12">
              <?php
              echo titleText($totalRecords, $click, $param);
              ?>
            </h1>
            <form action="" method="get" class="w-full mt-12">
              <div class="relative flex p-1 rounded-full md:p-2 gap-3">
                <input id="param" placeholder="Cerca per nome, artista, canzone..." class="w-full p-4 rounded-full bg-white bg-opacity-50 " type="text" value="<?php echo $param; ?>" name="param">
                <input type="submit" value="Cerca" title="Cerca il tuo disco" class="ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12 cursor-pointer">
              </div>
            </form>
            <a href="add-new-record.php">
              <button type="button" title="Aggiungi un nuovo disco ala tua collezione" class="ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12">
                <div class="flex flex-row gap-5">
                  <svg stroke="currentColor" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                    <path d="M11.5 18.5v-6h-6v-1h6v-6h1v6h6v1h-6v6Z" />
                  </svg>
                  <span class="hidden text-white font-semibold md:block">
                    Aggiungi un vinile
                  </span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 mx-auto text-yellow-900 md:hidden" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                  </svg>
                </div>
              </button>
            </a>
          </div>
          <div class="ml-auto -mb-24 lg:-mb-56 lg:w-6/12">
            <img src="resources/hero.png" class="relative" alt="food illustration" loading="lazy" width="4500" height="4500">
          </div>
        </div>
      </div>
    </div>
    <!-- Catalog view -->
    <section class="my-20 py-10 bg-white-100">
      <!-- Order by options (artist name, album name, year) -->
      <div class="container max-w-6xl p-6">
        <div class="flex flex-row justify-center gap-5">
          <div class="flex flex-row gap-5">
            <a href="index.php?click=<?php echo 0; ?>&param=<?php echo $param; ?>&order=<?php echo 2; ?>">
              <button type="button" title="Ordina per anno" class="ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12">
                <div class="flex flex-row gap-5">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor">
                    <path d="M14.7 18q-.975 0-1.65-.675-.675-.675-.675-1.625 0-.975.675-1.65.675-.675 1.65-.675.95 0 1.625.675T17 15.7q0 .95-.675 1.625T14.7 18Zm-9.4 3.5q-.75 0-1.275-.525Q3.5 20.45 3.5 19.7V6.3q0-.75.525-1.275Q4.55 4.5 5.3 4.5h1.4V2.375h1.525V4.5H15.8V2.375h1.5V4.5h1.4q.75 0 1.275.525.525.525.525 1.275v13.4q0 .75-.525 1.275-.525.525-1.275.525Zm0-1.5h13.4q.1 0 .2-.1t.1-.2v-9.4H5v9.4q0 .1.1.2t.2.1ZM5 8.8h14V6.3q0-.1-.1-.2t-.2-.1H5.3q-.1 0-.2.1t-.1.2Zm0 0V6v2.8Z" />
                  </svg>
                  <span class="hidden text-white font-semibold md:block">
                    Anno
                  </span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 mx-auto text-yellow-900 md:hidden" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M5.646 1.146a.5.5 0 0 1 .708 0l5 5a.5.5 0 0 1 0 .708l-5 5a.5.5 0 1 1-.708-.708L10.293 6.5 5.646 1.854a.5.5 0 0 1 0-.708z" />
                  </svg>
                </div>
              </button>
            </a>
            <a href="index.php?click=<?php echo 0; ?>&param=<?php echo $param; ?>&order=<?php echo 1; ?>">
              <button type="button" title="Ordina per artista" class="ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12">
                <div class="flex flex-row gap-5">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor">
                    <path d="M12 11.7q-1.45 0-2.475-1.038Q8.5 9.625 8.5 8.2q0-1.45 1.025-2.475Q10.55 4.7 12 4.7q1.45 0 2.475 1.025Q15.5 6.75 15.5 8.2q0 1.425-1.025 2.462Q13.45 11.7 12 11.7Zm-7.5 7.6v-2.225q0-.725.4-1.35.4-.625 1.075-.975 1.475-.725 2.988-1.088Q10.475 13.3 12 13.3t3.038.362q1.512.363 2.987 1.088.675.35 1.075.975.4.625.4 1.35V19.3ZM6 17.8h12v-.725q0-.3-.175-.55-.175-.25-.475-.425-1.3-.625-2.637-.963Q13.375 14.8 12 14.8t-2.713.337q-1.337.338-2.637.963-.3.175-.475.425t-.175.55Zm6-7.6q.825 0 1.413-.588Q14 9.025 14 8.2t-.587-1.413Q12.825 6.2 12 6.2q-.825 0-1.412.587Q10 7.375 10 8.2q0 .825.588 1.412.587.588 1.412.588Zm0-2Zm0 9.6Z" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 mx-auto text-yellow-900 md:hidden" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 1.146a.5.5 0 0 1 0 .708L6.207 6.5l4.647 4.646a.5.5 0 1 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
                  </svg>
                  <span class="hidden text-white font-semibold md:block">
                    Artista
                  </span>
                </div>
              </button>
            </a>
            <a href="index.php?click=<?php echo 0; ?>&param=<?php echo $param; ?>&order=<?php echo 0; ?>">
              <button type="button" title="Ordina per titolo dell'album" class="ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12">
                <div class="flex flex-row gap-5">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor">
                    <path d="M10.95 19.55v-13h-5.5v-2.1h13.1v2.1h-5.5v13Z" />
                  </svg>
                  <span class="hidden text-white font-semibold md:block">
                    Titolo
                  </span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 mx-auto text-yellow-900 md:hidden" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M5.646 1.146a.5.5 0 0 1 .708 0l5 5a.5.5 0 0 1 0 .708l-5 5a.5.5 0 1 1-.708-.708L10.293 6.5 5.646 1.854a.5.5 0 0 1 0-.708z" />
                  </svg>
                </div>
              </button>
            </a>

          </div>
        </div>
      </div>
      <div class="mx-auto grid max-w-6xl  grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
        <?php
        $i = $click;
        while ($i < $totalRecords) {
          $stmt1 = getRecords($stmt, $orderOption);
          if ($stmt1 == null) {
            break;
          }
          $row = $stmt1->fetch(PDO::FETCH_ASSOC);
          if ($row == null) {
            break;
          }
        ?>
          <article class="rounded-xl bg-white bg-opacity-50 shadow-xl hover:rounded-2xl p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
            <a href="record.php?recordId=<?php echo $row['id'] ?>">
              <div class="relative flex items-end overflow-hidden rounded-xl">
                <?php echo getAlbum(getArtistName($row['artist']), $row['title'], 3); ?>
              </div>

              <div class="mt-1 p-2">
                <?php
                echo '<h2 class="text font-bold text-slate-700 capitalize">' . $row['title'] . '</h2>';
                echo '<p class="mt-1 text-sm text-slate-700 capitalize">' . getArtistName($row['artist']) . ' ~ ' . $row['year'] . '</p>';
                ?>
              </div>
            </a>
          </article>
        <?php
          $i++;
        }
        ?>
      </div>
      <div class="flex justify-center mt-5 gap-10">
        <!-- Prev button -->
        <?php
        if ($click > 0) {
          echo '<a href="index.php?click=' . ($click - 1) . '&param=' . $param . '&order=' . $orderOption . '" class="flex justify-center mt-5">'; ?>
          <button class="ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12" value="Prev">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor">
              <path d="M14 17.65 8.35 12 14 6.35l1.05 1.05-4.6 4.6 4.6 4.6Z" />
            </svg>
          </button>
          </a>
        <?php }
        ?>
        <!-- Next button -->
        <?php
        if ($click < $possibleSteps - 1) {
          echo '<a href="index.php?click=' . ($click + 1) . '&param=' . $param . '&order=' . $orderOption . '" class="flex flex row justify-center mt-5">'; ?>
          <button class="ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12" value="Next">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor">
              <path d="M9.4 17.65 8.35 16.6l4.6-4.6-4.6-4.6L9.4 6.35 15.05 12Z" />
            </svg>
          </button>
          </a>
        <?php }
        ?>
      </div>
    </section>
    <?php include 'footer.php'; ?>
  </div>
</body>

</html>