<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal społecznościowy</title>
  <link rel="stylesheet" href="styl5.css">
</head>
<body>
  <header>
    <div class="left-banner">
      <h2>Nasze osiedle</h2>
    </div>
    <div class="right-banner">
      <?php
        $db = mysqli_connect('localhost', 'bob', '', 'portal');

        $q1 = 'SELECT COUNT(*) FROM dane';

        $res1 = $db -> query($q1) -> fetch_assoc();

        echo '<h5>Liczba użytkowników portalu: '.$res1['COUNT(*)'].'</h5>';
      ?>
    </div>
  </header>
  <main>
    <section class="left-block">
      <h3>Logowanie</h3>
      <form action="#" method="post">
        <label for="login-input">logowanie</label>
        <input type="text" name="login-input" required>
        <label for="password-input">hasło</label>
        <input type="password" name="password-input" required>
        <button type="submit" name="submit-button">Zaloguj</button>
      </form>
    </section>
    <section class="right-block">
      <h3>Wizytówka</h3>
      <article>
        <?php
          $login = $_POST['login-input'];
          $password = $_POST['password-input'];

          $q2 = 'SELECT haslo FROM uzytkownicy WHERE login = ?';
          
          $stmt1 = $db -> prepare($q2);
          $stmt1 -> bind_param('s', $login);
          $stmt1 -> execute();
          
          $res2 = $stmt1 -> get_result() -> fetch_assoc();          

          if ($res2) {
            if (sha1($password) == $res2['haslo']) {
              $q3 = 'SELECT u.login, d.rok_urodz, d.przyjaciol, d.hobby, d.zdjecie
              FROM uzytkownicy u JOIN dane d ON u.id = d.id
              WHERE u.login = ?';

              $stmt2 = $db -> prepare($q3);
              $stmt2 -> bind_param('s', $login);
              $stmt2 -> execute();

              $res3 = $stmt2 -> get_result() -> fetch_assoc();

              $db -> close();
        ?>

          <img src="<?= $res3['zdjecie'] ?>" alt="osoba">
          <h4><?= $res3['login'].' ('.(2023 - $res3['rok_urodz']).')' ?></h4>
          <p>hobby: <?= $res3['hobby'] ?></p>
          <h1>
            <img src="icon-on.png" alt="serce">
            <?= $res3['przyjaciol'] ?>
          </h1>
          <a class="article-button-link" href="dane.html">
            <button class="article-button">Więcej informacji</button>
          </a>

        <?php
            } else {
              echo 'hasło nieprawidłowe';
            }
          } else {
            echo 'login nie istnieje';
          }
        ?>
      </article>
    </section>
  </main>
  <footer>
    <span>Stronę wykonał: 00000000000</span>
  </footer>
</body>
</html>