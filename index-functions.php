<?php

// function to get the amount of records of an artist
function getAmountRecords($stmt)
{
    return $stmt->rowCount();
}

// function to get the get the amount of records in the database
function getAllRecords()
{
    global $pdo;
    $sql = 'SELECT * FROM records';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

// function to set the order filter for the query
function orderOption($orderOption)
{
    switch ($orderOption) {
            // case 0 -> title
        case 0:
            return 'records.title ASC';
            break;
            // case 1 -> artist
        case 1:
            return 'artists.name ASC';
            break;
            // case 2 -> year
        case 2:
            return 'records.year ASC';
            break;
    }
}

// function to setup the search query 
function prepareQuery($param, $click, $orderOption)
{
    global $pdo;

    if (empty($param) || $param == ' ' || $param == '') {
        $sql = 'SELECT records.id FROM records, artists WHERE records.artist = artists.id ORDER BY ' . orderOption($orderOption) . ' LIMIT 10 OFFSET ?';
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
    $stmt->execute([$click * 10]);
    return $stmt;
}

// function get the records from the query
function getRecords($stmt, $orderOption)
{
    global $pdo;
    $row = $stmt->fetch();
    if (!$row) {
        return null;
    }
    $id = $row['id'];
    $sql = 'SELECT records.id, records.title, records.artist, records.year FROM records, artists WHERE records.artist = artists.id AND records.id = ? ORDER BY ' . orderOption($orderOption);
    $stmt1 = $pdo->prepare($sql);
    $stmt1->execute([$id]);
    return $stmt1;
}

// function to setup the title of the homepage
function titleText($totalRecords, $click, $param)
{
    if ($click == 0 && $param == '') {
        if ($totalRecords == 1) {
            return "Il tuo " . $totalRecords . " disco, pronto per essere ammirato";
        } else if ($totalRecords == 0) {
            return "Non hai ancora nessun disco, aggiungine qualcuno!";
        } else {
            $random = rand(0, 5);
            switch ($random) {
                case 0:
                    return "I tuoi " . $totalRecords . " dischi, pronti per essere ammirati";
                    break;
                case 1:
                    return "Il tuo disco più vecchio è del " . olderRecord();
                    break;
                case 2:
                    return "Il tuo disco più recente è del " . newestRecord();
                    break;
                case 3:
                    return "Il tuo disco più vecchio è del " . olderRecord() . " e il più recente è del " . newestRecord();
                    break;
                case 4:
                    return "L'ultimo disco che hai inserito è \"" . latestInsered() . "\"";
                    break;
                case 5:
                    return "Cosa ascoltiamo oggi? Io propongo \"" . randomRecord() . "\"";
                    break;
            }
        }
    } else if ($param != '') {
        $matchedRecords = getAmountRecords(prepareQuery($param, 0, 0));
        return "I risultati della ricerca per \"" . $param . "\" sono " . $matchedRecords;
    } else return "I tuoi " . $totalRecords . " dischi, pronti per essere ammirati";
}

// function to get a random record title
function randomRecord()
{
    global $pdo;
    $sql = 'SELECT records.title FROM records ORDER BY RAND() LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['title'];
}

// function to get the latest inserted record
function latestInsered()
{
    global $pdo;
    $sql = 'SELECT records.title FROM records ORDER BY records.insert_date DESC LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['title'];
}

// function to get the oldest record
function olderRecord()
{
    global $pdo;
    $sql = 'SELECT records.year FROM records ORDER BY records.year ASC LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['year'];
}

// function to get the newest record
function newestRecord()
{
    global $pdo;
    $sql = 'SELECT records.year FROM records ORDER BY records.year DESC LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['year'];
}
