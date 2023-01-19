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

    </head>
    <body>
        <!--Search bar-->
        <div class="w-full bg-gray-300 p-2 flex justify-center">
            <label>
                <input type="text" class="w-full border-2 border-gray-300 p-2 rounded-lg" placeholder="Search">
            </label>
            <!--Search button-->
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Search
            </button>
        </div>
        <!--End of search bar-->
        <div class="flex flex-wrap">

    </body>
</html>

