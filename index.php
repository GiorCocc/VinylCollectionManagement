<!--Website to Manage a vinyl record collection-->

<!--This is the main page. It will display all the record stored in the database, with the artwork, the title, the author
and the year of release. On top of the page, there is a searchbar that allow to find a record by its name, year, artist and songs
The project is styled using Tailwindcss and connect to a XAMPP database.-->

<!-- TODO: modificare i nomi degli elementi nel database in modo che siano capitalize -->
<!-- TODO: modificare quando vengono inseriti dei dati in modo che questi vengano salvati come capitalize -->

<?php
require_once 'database-connection.php';
function getAmountRecords($stmt)
{
    return $stmt->rowCount();
}

function getAllRecords()
{
    global $pdo;
    $sql = 'SELECT * FROM records';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function prepareQuery($param, $click)
{
    global $pdo;

    if (empty($param) || $param == ' ' || $param == '') {
        $sql = 'SELECT records.id FROM records ORDER BY records.title LIMIT 10 OFFSET ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$click * 10]);
        return $stmt;
    }
    // ottenere tutti gli album (se il parametro è il nome dell'artista) in ogni posizione
    $sql1 = 'SELECT records.id FROM records, artists WHERE records.artist = artists.id AND artists.name LIKE ' . "'%" . $param . "%'";
    // ottenere tutti gli album (se il parametro è il nome dell'album)
    $sql2 = 'SELECT records.id FROM records WHERE records.title LIKE ' . "'%" . $param . "%'";
    // ottenere tutti gli album (se il parametro è l'anno di uscita)
    $sql3 = 'SELECT records.id FROM records WHERE records.year LIKE ' . "'%" . $param . "%'";
    // ottenere tutti gli album (se il parametro è il nome della canzone)
    $sql4 = 'SELECT records.id FROM records, songs WHERE records.id = songs.records AND songs.title LIKE ' . "'%" . $param . "%'";

    // unisci i risultati delle query in un'unica query
    $sql = $sql1 . ' UNION ' . $sql2 . ' UNION ' . $sql3 . ' UNION ' . $sql4 . ' LIMIT 10 OFFSET ?';

    // ottieni i risultati
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$click * 10 ]);
    return $stmt;
}

// funzione per ottenere i dati del record passando gli id contenuti in $stmt
function getRecords($stmt, $click)
{
    global $pdo;
    $row = $stmt->fetch();
    if(!$row) {
        return null;
    }
    $id = $row['id'];
    $sql = 'SELECT * FROM records WHERE id = ?';
    $stmt1 = $pdo->prepare($sql);
    $stmt1->execute([$id]);
    return $stmt1;
}

$click = $_GET['click'] ?? 0;
$param = $_GET['param'] ?? '';
$stmt = prepareQuery($param, $click);

if (empty($param) || $param == ' ' || $param == '') {
    $possibleSteps = ceil(getAllRecords() / 10);
} else {
    $possibleSteps = ceil(getAmountRecords($stmt) / 10);
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
    <!-- component -->
    <div class="relative w-full">
        <?php include 'header.php'; ?>
        <div class="relative">
            <div class="container m-auto px-6 pt-32 md:px-12 lg:pt-[4.8rem] lg:px-7">
                <div class="flex items-center flex-wrap px-2 md:px-0">
                    <div class="relative lg:w-6/12 lg:py-24 xl:py-32">
                        <h1 class="font-bold text-4xl text-yellow-900 md:text-5xl lg:w-10/12">
                            <!-- recuperare il numero totale di dischi registrati -->
                            <?php
                            if(empty($param) || $param == ' ' || $param == '') {
                                $totalRecords = getAllRecords();
                            } else {
                                $totalRecords = getAmountRecords($stmt);
                            }
                            if ($totalRecords == 1) {
                                echo "Il tuo " . $totalRecords . " disco, pronto per essere ammirato";
                            } else if ($totalRecords == 0) {
                                echo "Non hai ancora nessun disco, aggiungine qualcuno!";
                            } else {
                                echo "I tuoi " . $totalRecords . " dischi, pronti per essere ammirati";
                            }
                            ?>
                        </h1>
                        <!-- TODO: Form per poter inserire la ricerca di un vinile per artista, nome, anno -->
                        <form action="" method="get" class="w-full mt-12">
                            <div class="relative flex p-1 rounded-full md:p-2 gap-3">
                                <input id="param" placeholder="Cerca per nome, artista, canzone..." class="w-full p-4 rounded-full bg-white bg-opacity-50 " type="text" value="<?php echo $param; ?>" name="param">
                                <input type="submit" value="Cerca" class="ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12">
                            </div>
                        </form>
                        <!-- TODO: Add filter to search -->
                        <a href="add-new-record.php">
                            <button type="button" title="Start buying" class="ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12">
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
            <div class="mx-auto grid max-w-6xl  grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                <?php
                $i = $click;
                while ($i < $totalRecords) {
                    $stmt1 = getRecords($stmt, $i);
                    if($stmt1 == null){
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
                <!-- Bottone per tornare indietro -->
                <?php
                if ($click > 0) {
                    echo '<a href="index.php?click=' . ($click - 1) . '&param=' . $param . '" class="flex justify-center mt-5">'; ?>
                    <button class="bg-slate-700 hover:bg-slate-800 text-white font-bold py-2 px-4 rounded-full">
                        Prev
                    </button>
                    </a>
                <?php }
                ?>
                <!-- Bottone per andare avanti -->
                <?php
                if ($click < $possibleSteps - 1) {
                    echo '<a href="index.php?click=' . ($click + 1) . '&param=' . $param . '" class="flex justify-center mt-5">'; ?>
                    <button class="bg-slate-700 hover:bg-slate-800 text-white font-bold py-2 px-4 rounded-full">
                        Next
                    </button>
                    </a>
                <?php }
                ?>
            </div>


        </section>

        <!-- Add record section -->
        <!-- <div id="add-new-record">
            
        </div> -->
        <?php include 'footer.php'; ?>
    </div>

</body>

</html>