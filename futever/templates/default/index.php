<div class="d-container">
  <div class="d-profile d-rounded d-border">
    <div class="d-profilecontainer">
      <img src="<?=$iconbig?>" class="d-rounded d-center" alt="Profilbild">
      <h2 class="d-data"><?=$user->Benutzername?></h2><br>
      <h2 class="d-data">Futever Score:
        <?php if (isset($user->futever_score)): ?>
          <?=$user->futever_score?>
        <?php else: ?>
          0
        <?php endif; ?></h2>
      </div>
      <div class="d-prognose">
        <a href="/prognose/show">
          <img src="/images/prognose.png" alt="Prognose" class="d-rounded d-center d-prognosepic">
        </a>
      </div>
    </div>
    <div class="d-matches d-rounded d-border">
      <main class="p-main">
        <?php if ($_SESSION['userID'] == 1): ?>
          <form method="post" action="/session/resultateintragen">
        <?php else: ?>
          <form method="post" action="/prognose/createPrognose">
        <?php endif; ?>
        <?php if ($matchesNichtGespielt!=NULL): ?>
          <table class="text-center table">
            <td colspan="5"><h3>Kommende Spiele</h3></td>
            <tr>
              <th>Datum</th>
              <th>Heim</th>

              <th><?php if ($_SESSION['userID']==1): ?>
                Resultat
              <?php else: ?>
                Prognose
              <?php endif; ?>
            </th>
            <th>Auswärts</th>
          </tr>
          <?php foreach ($matchesNichtGespielt as $match): ?>
            <tr>
              <td><?=$match->datum?></td>
              <td><?=$match->Team1?></td>
              <td><input type="hidden" name="mid" value="<?=$match->id?>">
                <input class="d-inputtore" type="text" name=toreteam1>
                :
                <input class="d-inputtore" type="text" name="toreteam2">
              </td>
              <td><?=$match->Team2?></td>
              <td>
                <?php if ($_SESSION['userID'] == 1): ?>
                  <input type="submit" value="Resultat eintragen">
                <?php else: ?>
                  <input type="submit" value="Prognose erstellen">
                <?php endif; ?>
              </td>
              <br>
            </tr>
          <?php endforeach; ?>
        </table>
      </form>
    </main>
  <?php endif; ?>
  <main class="p-main">
    <table class="text-center table">
      <td colspan="5"><h3>Gespielte Spiele</h3></td>
      <tr>
        <th>Datum</th>
        <th>Heim</th>
        <th>Resultat</th>
        <th>Auswärts</th>
      </tr>
      <?php
      foreach ($matchesGespielt as $match):
        ?>
        <tr>
          <td><?=$match->datum?></td>
          <td><?=$match->Team1?></td>
          <td><?=$match->team1_tore.":".$match->team2_tore?></td>
          <td><?=$match->Team2?></td>
          <br>
        </tr>
      <?php endforeach; ?>
    </table>
  </main>
</div>
</div>
