<?php
  $db = mysqli_connect('localhost', 'root', '', 'egzamin5');

  if(isset($_POST['submit'])) {
    $q4 = 'UPDATE zadania SET wpis = ? WHERE dataZadania = \'2020-07-13\'';
    $entry = $_POST['entry'];

    $stmt = $db -> prepare($q4);
    $stmt -> bind_param('s', $entry);
    $stmt -> execute();
  }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mój kalendarz</title>
  <link rel="stylesheet" href="styl5.css">
</head>
<body>
  <header>
    <div class="left-banner">
      <img src="logo1.png" alt="Mój kalendarz">
    </div>
    <div class="right-banner">
      <h1>KALENDARZ</h1>
      <?php
        $q1 = 'SELECT miesiac, rok FROM zadania WHERE dataZadania = \'2020-07-01\'';

        $res1 = $db -> query($q1) -> fetch_assoc();
      ?>

      <h3>miesiąc: <?= $res1['miesiac'] ?>, rok: <?= $res1['rok'] ?></h3>
    </div>
  </header>
  <main>
    <?php
      $q2 = 'SELECT dataZadania, wpis FROM zadania WHERE miesiac = \'lipiec\'';

      $res2 = $db -> query($q2) -> fetch_all(MYSQLI_ASSOC);

      $db -> close();

      foreach($res2 as $row):
    ?>

    <div class="calendar-day-block">
      <h5><?= $row['dataZadania'] ?></h5>
      <p><?= $row['wpis'] ?></p>
    </div>

    <?php endforeach; ?>
  </main>
  <footer>
    <form action="#" method="post">
      <label for="entry">dodaj wpis: </label>
      <input type="text" name="entry" id="entry">
      <button type="submit" name="submit">DODAJ</button>
    </form>
    <p>Stronę wykonał: 00000000000</p>
  </footer>
</body>
</html>