<!--Website to Manage a vinyl record collection-->

<!--This is the main page. It will display all the record stored in the database, with the artwork, the title, the author
and the year of release. On top of the page, there is a searchbar that allow to find a record by its name, year, artist and songs
The project is styled using Tailwindcss and connect to a XAMPP database.-->

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
                            $sql = 'SELECT * FROM records';
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $totalRecords = $stmt->rowCount();
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
                        <form action="" class="w-full mt-12">
                            <div class="relative flex p-1 rounded-full md:p-2 gap-3">
                                <input placeholder="Cerca per nome, artista, canzone..." class="w-full p-4 rounded-full bg-white bg-opacity-50 " type="text">
                                <button type="button" title="Start buying" class="ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12">
                                    <div class="flex flex-row gap-5">
                                        <!-- Search icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                                            <path stroke="currentColor" fill="currentColor" d="m19.475 20.15-6.25-6.25q-.75.625-1.725.975-.975.35-1.95.35-2.425 0-4.087-1.663Q3.8 11.9 3.8 9.5q0-2.4 1.663-4.063 1.662-1.662 4.062-1.662 2.4 0 4.075 1.662Q15.275 7.1 15.275 9.5q0 1.05-.375 2.025-.375.975-.975 1.65L20.2 19.45ZM9.55 14.225q1.975 0 3.35-1.362Q14.275 11.5 14.275 9.5T12.9 6.137q-1.375-1.362-3.35-1.362-2 0-3.375 1.362Q4.8 7.5 4.8 9.5t1.375 3.363q1.375 1.362 3.375 1.362Z" />
                                        </svg>

                                        <span class="hidden text-white font-semibold md:block">
                                            Cerca
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 mx-auto text-yellow-900 md:hidden" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </div>

                                </button>
                            </div>
                        </form>
                        <!-- TODO: 
                        Add filter to search -->
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
                $sql = 'SELECT * FROM records order by title';
                $stmt = $pdo->query($sql);


                while ($row = $stmt->fetch()) {
                ?>
                    <article class="rounded-xl bg-white bg-opacity-50 shadow-xl hover:rounded-2xl p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
                        <a href="record.php?recordId=<?php echo $row['id'] ?>">
                            <div class="relative flex items-end overflow-hidden rounded-xl">
                                <?php echo getAlbum(getArtistName($row['artist']), $row['title'], 3) ?>
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
                } ?>

                <!-- TODO: Add pagination -->
            </div>

        </section>

        <!-- Add record section -->
        <!-- <div id="add-new-record">
            
        </div> -->
        <?php include 'footer.php'; ?>
    </div>

</body>

</html>