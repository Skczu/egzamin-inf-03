<?php
  $db = mysqli_connect('localhost', 'bob', '', 'dane2');

  if(isset($_POST['submit'])) {
    $nazwa = $_POST['nazwa'];
    $cena = $_POST['cena'];

    $q2 = "INSERT INTO produkty VALUES (NULL, 1, 4, ?, 10, '', ?, 'owoce.jpg')";

    $stmt = $db -> prepare($q2);
    $stmt -> bind_param('sd', $nazwa, $cena);
    $stmt -> execute();
  }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Warzywniak</title>
  <link rel="stylesheet" href="styl2.css">
</head>
<body>
  <header>
    <div class="left-banner">
      <h1>Internetowy sklep z eko-warzywami</h1>
    </div>
    <div class="right-banner">
      <ol>
        <li>warzywa</li>
        <li>owoce</li>
        <li><a href="https://terapiasokami.pl/">Soki</a></li>
      </ol>
    </div>
  </header>
  <main>
    <?php
      $q1 = 'SELECT nazwa, ilosc, opis, cena, zdjecie FROM produkty
      WHERE Rodzaje_id IN (1, 2)';

      $res1 = $db -> query($q1) -> fetch_all(MYSQLI_ASSOC);

      foreach ($res1 as $row):
    ?>

    <article class="product-block">
      <img src="<?= $row['zdjecie'] ?>" alt="warzywniak">
      <h5><?= $row['nazwa'] ?></h5>
      <p>opis: <?= $row['opis'] ?></p>
      <p>na stanie: <?= $row['ilosc'] ?></p>
      <h2><?= $row['cena'] ?> zł</h2>
    </article>

    <?php endforeach; ?>
  </main>
  <footer>
    <form action="#" method="post">
      <label for="nazwa-input">Nazwa:</label>
      <input type="text" name="nazwa">
      <label for="cena-input">Cena:</label>
      <input type="number" name="cena" step="0.01">
      <button type="submit" name="submit">Dodaj produkt</button>
    </form>
    <span>Stronę wykonał: 00000000000</span>
  </footer>
</body>
</html>