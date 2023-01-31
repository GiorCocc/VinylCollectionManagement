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
    <?php require 'database-connection.php'; ?>
    <?php require 'functions.php'; ?>
    <?php require 'lastfm-api.php'; ?>
</head>

<body>
    <!-- component -->
    <div class="relative w-full">
        <?php include 'header.php'; ?>
        <div class="relative bg-yellow-50">
            <div class="container m-auto px-6 pt-32 md:px-12 lg:pt-[4.8rem] lg:px-7">
                <div class="flex items-center flex-wrap px-2 md:px-0">
                    <div class="relative lg:w-6/12 lg:py-24 xl:py-32">
                        <h1 class="font-bold text-4xl text-yellow-900 md:text-5xl lg:w-10/12">La tua collezione di vinili, pronta per essere ammirata</h1>
                        <!-- TODO: Form per poter inserire la ricerca di un vinile per artista, nome, anno -->
                        <form action="" class="w-full mt-12">
                            <div class="relative flex p-1 rounded-full bg-white border border-yellow-200 shadow-md md:p-2">
                                <input placeholder="Cerca per nome, artista, canzone..." class="w-full p-4 rounded-full" type="text">
                                <button type="button" title="Start buying" class="ml-auto py-3 px-6 rounded-full text-center transition bg-gradient-to-b from-yellow-200 to-yellow-300 hover:to-red-300 active:from-yellow-400 focus:from-red-400 md:px-12">
                                    <span class="hidden text-yellow-900 font-semibold md:block">
                                        Cerca
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 mx-auto text-yellow-900 md:hidden" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                        <a href="#add-new-record">
                            <button type="button" title="Start buying" class="mt-12 py-3 px-6 rounded-full text-center transition bg-gradient-to-b from-yellow-200 to-yellow-300 hover:to-red-300 active:from-yellow-400 focus:from-red-400 md:px-12">
                                <span class="hidden text-yellow-900 font-semibold md:block">
                                    Aggiungi un vinile
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 mx-auto text-yellow-900 md:hidden" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                            </button>
                        </a>

                        <!-- <p class="mt-8 text-gray-700 lg:w-10/12">Sit amet consectetur adipisicing elit. <a href="#" class="text-yellow-700">connection</a> tenetur nihil quaerat suscipit, sunt dignissimos.</p> -->
                    </div>
                    <div class="ml-auto -mb-24 lg:-mb-56 lg:w-6/12">
                        <img src="resources/hero.png" class="relative" alt="food illustration" loading="lazy" width="4500" height="4500">
                    </div>
                </div>
            </div>
        </div>

        <section class="my-20 py-10 bg-white-100">
            <div class="mx-auto grid max-w-6xl  grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <!-- TODO: Vinile da recuperare nel database. Creare una scheda per ogni vinile letto dalla query di ricerca -->
                <?php
                $sql = 'SELECT * FROM records order by title';
                $stmt = $pdo->query($sql);


                while ($row = $stmt->fetch()) {
                ?>
                    <article class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
                        <a href="#">
                            <div class="relative flex items-end overflow-hidden rounded-xl">
                                <!-- TODO: aggiungere l'immagine di copertina del vinile -->
                                <?php echo getAlbum(getArtistName($row['artist']), $row['title'], 3) ?>
                            </div>

                            <div class="mt-1 p-2">
                                <?php
                                echo '<h2 class="text-slate-700 capitalize">' . $row['title'] . '</h2>';
                                echo '<p class="mt-1 text-sm text-slate-400 capitalize">' . getArtistName($row['artist']) . ' ~ ' . $row['year'] . '</p>';
                                ?>
                            </div>
                        </a>
                    </article>
                <?php
                } ?>
        </section>

    </div>
    <div id="add-new-record">
        <?php include 'add-new-record.php'; ?>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>