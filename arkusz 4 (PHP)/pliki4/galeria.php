<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <header>
        <h1>Zdjęcia</h1>

    </header>
    <main>
        <section class="left">
            <h2>Tematy zdjęć</h2>
            <ol>
                <li>Zwierzęta</li>
                <li>Krajobrazy</li>
                <li>Miasta</li>
                <li>Przyroda</li>
                <li>Samochody</li>
            </ol>
        </section>

        <section class="center">
            <?php
            $db = mysqli_connect('localhost', 'root', '', 'galeria');

            $sql = "SELECT zdjecia.plik, zdjecia.tytul, zdjecia.polubienia, autorzy.imie, autorzy.nazwisko
FROM zdjecia
	JOIN autorzy ON autorzy.id = zdjecia.autorzy_id
ORDER BY autorzy.nazwisko;";
            $r = mysqli_query($db, $sql);

            while ($row = mysqli_fetch_assoc($r)) {
                echo "<section class='photo'>
                <img src='$row[plik]' alt='zdjęcie'>
                <h3>$row[tytul]</h3>";

                // <p>Paragraf</p>
                if ($row['polubienia'] > 40) {
                    echo "<p>Autor: $row[imie] $row[nazwisko].<br>Wiele osób polubiło ten obraz</p>";
                } else {
                    echo "<p>Autor: $row[imie] $row[nazwisko].</p>";
                }


                echo "<a href='$row[plik]' download>Pobierz</a>
            </section>";
            }
            ?>


        </section>

        <section class="right">
            <h2>Najbardziej lubiane</h2>

            <?php
            $sql = "SELECT zdjecia.tytul, zdjecia.plik FROM zdjecia WHERE zdjecia.polubienia >= 100;";
            $r = mysqli_query($db, $sql);
            $row = mysqli_fetch_row($r);
            echo "<img src='$row[1]' alt='$row[0]' />";
            ?>

            <strong>Zobacz wszystkie nasze zdjęcia</strong>

        </section>
    </main>

    <footer>
        <h5>Stronę wykonał: Adam Karczewski</h5>
    </footer>


</body>

</html>
<?php
mysqli_close($db);
?>