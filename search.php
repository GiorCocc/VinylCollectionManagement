<?php
require_once 'database-connection.php';
require_once 'functions.php';
require_once 'lastfm-api.php';

// get the search parameter from the form; if it's empty, redirect to index.php, otherwise send it to index.php as a GET parameter
if(isset($_GET['param']) && !empty($_GET['param'])) {
    $param = $_GET['param'];
    header("Location: index.php?param=$param");
} else {
    header("Location: index.php");
}



?>

<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
  <form action="" method="get" class="w-full mt-12">
    <div class="relative flex p-1 rounded-full md:p-2 gap-3">
      <input id="param" placeholder="Cerca per nome, artista, canzone..." class="w-full p-4 rounded-full bg-white bg-opacity-50 " type="text">
      <input type="submit" value="Cerca" class="ml-auto py-3 px-6 rounded-full text-center transition bg-orange-500 shadow-lg shadow- shadow-orange-600 text-white md:px-12">  
    </div>
  </form>
</body>

</html>