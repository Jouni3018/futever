<div class="s-backgroundpic d-fullside">
<div class="s-rightside">
  <div class="shadow-lg p-3 mb-5 rounded text-center s-logreg">
    <h1>Login</h1>
    <?php
        if (isset($_SESSION['wrongLogin']) && $_SESSION['wrongLogin'] == true) {
            echo "<h6 style='color: red;'>Login inkorrekt</h6>";
            $_SESSION['wrongLogin'] = false;
        } elseif (isset($_SESSION['wrongPassword']) && $_SESSION['wrongPassword'] == true) {
            echo "<h6 style='color: red;'>Falsches Passwort</h6>";
            $_SESSION['wrongPassword'] = false;
        } else {
            echo "<br />";
        }
    ?>
    <form method="post" action="/session/dologin">
    <input class="form-control s-input" name="identifier" type="text" placeholder="Email or Username"/>
    <input class="form-control s-input" type="password" name="password" placeholder="Passwort" />
    <input class="form-control s-submit" type="submit"/>
    Haben Sie noch keinen Account? <br>
    <a href="/session/registration">Registrieren Sie sich hier</a>
  </form>

  </div>
</div>
</div>
