<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wędkowanie</title>
  <link rel="stylesheet" href="styl_1.css">
</head>
<body>
  <header>
    <h1>Portal dla wędkarzy</h1>
  </header>
  <main>
    <section class="left-block">
      <div class="first-left-block">
        <h3>Ryby zamieszkujące rzeki</h3>
        <ol>
          <?php
            $db = mysqli_connect('localhost', 'bob', '', 'wedkowanie');

            $q1 = 'SELECT r.nazwa, l.akwen, l.wojewodztwo FROM ryby r
            JOIN lowisko l ON r.id = l.Ryby_id
            WHERE l.rodzaj = 3';

            $res1 = $db -> query($q1) -> fetch_all(MYSQLI_ASSOC);

            foreach ($res1 as $row):
          ?>

          <li><?= $row['nazwa'].' pływa w rzece '.$row['akwen'].', '.$row['wojewodztwo'] ?></li>

          <?php endforeach ?>
        </ol>
      </div>
      <div class="second-left-block">
        <h1>Ryby drapieżne naszych wód</h1>
        <table>
          <thead>
            <tr>
              <th>L.p.</th>
              <th>Gatunek</th>
              <th>Występowanie</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $q2 = 'SELECT id, nazwa, wystepowanie FROM ryby
              WHERE styl_zycia = 1';

              $res2 = $db -> query($q2) -> fetch_all(MYSQLI_ASSOC);

              $db -> close();

              foreach ($res2 as $row):
            ?>

            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['nazwa'] ?></td>
              <td><?= $row['wystepowanie'] ?></td>
            </tr>

            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </section>
    <section class="right-block">
      <img src="./ryba1.jpg" alt="Sum">
      <a href="kwerendy.txt">Pobierz kwerendy</a>
    </section>
  </main>
  <footer>
    <p>Stronę wykonał: 00000000000</p>
  </footer>
</body>
</html>