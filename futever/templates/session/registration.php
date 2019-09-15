<div class="s-backgroundpic d-fullside">
<div class="s-rightside">
  <div class="shadow-lg p-3 mb-5 rounded text-center s-logreg">
    <h1>Registration</h1>
    </br>
    <form method="post" action="/session/doregistration">
    <?php
      if (isset($_SESSION['falseEmail']) && $_SESSION['falseEmail'] == true) {
          echo '<label class="text-danger">Email Address not valid!</label>';
          unset($_SESSION['falseEmail']);
      } else {
          #echo '<label>Email Address</label>';
      }
    ?>
    <input class="form-control s-input" name="email" type="email" placeholder="Email"/>
    <?php
        if (isset($_SESSION['usernameTaken'])) {
            echo '<label class="text-danger">Username taken!</label>';
            unset($_SESSION['usernameTaken']);
        } elseif(isset($_SESSION['emptyUsername'])) {
            echo '<label class="text-danger">Username must be given!</label>';
            unset($_SESSION['emptyUsername']);
        } else {
            #echo '<label>Username</label>';
        }
    ?>
    <input class="form-control s-input" name="username" type="text" placeholder="Username"/>
    <input class="form-control s-input" name="password" type="password" placeholder="Passwort" />
    <input class="form-control s-input" name="passwortconfirmation" type="password" placeholder="Wiederhole das Passwort"/>
    <input class="form-control s-submit" type="submit"/>
    Ich habe schon einen Account <br>
    <a href="/session/login">Zum Login</a>
  </form>
  </div>
</div>
</div>
