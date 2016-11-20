<?php include '_head.html.php'; ?>

<form action="" method="post">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="title" name="title">
    <label class="mdl-textfield__label" for="title">Tytuł testu</label>
  </div>
<br>
  <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
    <select id="exams_group_id" name="group_id" class="mdl-selectfield__select">
      <option value=""></option>
      <?php foreach ($this->data['exams_groups'] as $key => $value): ?>
        <option value="<?=$value['id'];?>"><?=$value['title'];?></option>
      <?php endforeach ?>
    </select>
    <label class="mdl-selectfield__label" for="exams_group_id">Grupa testów</label>
  </div>
<br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="number" name="questions"
      pattern="-?[0-9]*(\.[0-9]+)?" id="questions">
    <label class="mdl-textfield__label" for="questions">Liczba pytań</label>
    <span class="mdl-textfield__error">To nie jest liczba!</span>
  </div>
<br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="number" name="threshold"
      pattern="-?[0-9]*(\.[0-9]+)?" id="threshold">
    <label class="mdl-textfield__label" for="threshold">Próg zaliczenia</label>
    <span class="mdl-textfield__error">To nie jest liczba!</span>
  </div>

  <button type="submit" name="add" class="mdl-button mdl-js-button mdl-button--colored mdl-button--raised mdl-js-ripple-effect">Dodaj</button>
</form>

<?php include '_foot.html.php'; ?>