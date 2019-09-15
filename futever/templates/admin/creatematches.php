
<div class="d-fullside text-center" style="padding-top: 100px;">
  <div >
    <form method="post" action="/session/creatematch">
      <input type="date" name=datum>
      <select class="custom-select" name="team1">
        <option selected >Choose...</option>
        <?php foreach ($teams as $team): ?>
          <option value="<?=$team->Name?>"><?=$team->Name?></option>
        <?php endforeach; ?>
      </select>
      <select class="custom-select" name="team2">
        <option selected >Choose...</option>
        <?php foreach ($teams as $team): ?>
            <option value="<?=$team->Name?>"><?=$team->Name?></option>
        <?php endforeach; ?>
      </select>
      <input type="submit" value="Speichern">
    </form>
  </div>
</div>
