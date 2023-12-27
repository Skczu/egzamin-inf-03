<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wynajem pokoi</title>
    <link rel="stylesheet" href="styl2.css" />
  </head>
  <body>
    <header>
      <h1>Pensjonat pod dobrym humorem</h1>
    </header>
    <main>
      <article>
        <a href="index.html">GŁÓWNA</a>
        <img src="1.jpeg" alt="pokoje" />
      </article>
      <article>
        <a href="cennik.php">CENNIK</a>
        <table>
          <?php
            $db = mysqli_connect('localhost', 'bob', '', 'wynajem');
            $q = 'SELECT * FROM pokoje;';

            $res = $db -> query($q) -> fetch_all(MYSQLI_ASSOC);

            $db -> close();

            foreach ($res as $row):
          ?>

            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['nazwa'] ?></td>
              <td><?= $row['cena'] ?></td>
            </tr>

          <?php endforeach ?>
        </table>
      </article>
      <article>
        <a href="kalkulator.html">KALKULATOR</a>
        <img src="3.jpeg" alt="pokoje" />
      </article>
    </main>
    <footer>
      <p>Stronę opracował: 00000000000</p>
    </footer>
  </body>
</html>
