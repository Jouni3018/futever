<div class="d-container">
  <div class="p-data d-rounded d-border">
    <div class="p-titel">
      <h1>Deine Prognosen:</h1>
    </div>
    <main class="p-main">
        <?php if (isset($prognosen)): ?>
          <div class="p-prognose">
            <? var_dump($prognosen) ?>
            <?php foreach ($prognosen as $prognose): ?>
              <table class="table">
                <tr>
                  <th>Datum</th>
                  <th>Heim</th>
                  <th>Prognose</th>
                  <th>Auswärts</th>
                </tr>
                <tr>
                  <td><?=$prognose->Datum?></td>
                  <td><?=$prognose->Team1?></td>
                  <td><?=$prognose->Goals1?> : <?=$prognose->Goals2?></td>
                  <td><?=$prognose->Team2?></td>
                </tr>
              </table>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
    </main>
  </div>
</div>
