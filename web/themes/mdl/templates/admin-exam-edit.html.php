<?php include '_head.html.php'; ?>

<form action="" method="post">

  <a href="<?=$this->dir();?>/admin/test/add" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
    Dodaj nowy test
  </a>
  <a href="<?=$this->dir();?>/admin/test/edit/<?=$this->data['test-edit']['test']['id'];?>/question/add" class="mdl-button mdl-js-button mdl-button--accent mdl-button--raised mdl-js-ripple-effect">Dodaj pytanie</a>
  <button type="submit" name="edit" class="mdl-button mdl-js-button mdl-button--colored mdl-button--raised mdl-js-ripple-effect">Zapisz</button>
<hr>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="title" name="title" value="<?=$this->escape($this->data['test-edit']['test']['title']);?>">
    <label class="mdl-textfield__label" for="title">Tytuł testu</label>
  </div>
<br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="number" name="questions"
      value="<?=$this->data['test-edit']['test']['questions'];?>"
      pattern="-?[0-9]*(\.[0-9]+)?" id="questions">
    <label class="mdl-textfield__label" for="questions">Liczba pytań</label>
    <span class="mdl-textfield__error">To nie jest liczba!</span>
  </div>
<br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="number" name="threshold"
      value="<?=$this->data['test-edit']['test']['threshold'];?>"
      pattern="-?[0-9]*(\.[0-9]+)?" id="threshold">
    <label class="mdl-textfield__label" for="threshold">Próg zaliczenia</label>
    <span class="mdl-textfield__error">To nie jest liczba!</span>
  </div>

  <div class="table--responsive">
    <table class="mdl-data-table">
      <thead>
        <tr>
          <th>#</th>
          <th class="mdl-data-table__cell--non-numeric">treść pytania</th>
          <th class="mdl-data-table__cell--non-numeric">Akcje</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($this->data['test-edit']['questions'] as $qkey => $question): $qkey++; ?>
        <tr>
          <th><?=$qkey;?></th>
          <td class="mdl-data-table__cell--non-numeric table-truncate-container">
            <span class="table-truncate"><?=$question['content'];?></span>
          </td>
          <td class="mdl-data-table__cell--non-numeric">
            <a href="<?=$this->dir();?>/admin/test/edit/<?=$this->data['test-edit']['test']['id'];?>/question/edit/<?=$question['id'];?>" class="mdl-button">
              <i class="material-icons">edit</i> Edytuj
            </a>
            <a href="<?=$this->dir();?>/admin/test/edit/<?=$this->data['test-edit']['test']['id'];?>/question/del/<?=$question['id'];?>" class="mdl-button">
              <i class="material-icons">delete</i> Usuń
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <p>
    <button type="submit" name="edit" class="mdl-button mdl-js-button
      mdl-button--colored mdl-button--raised mdl-js-ripple-effect">Zapisz</button>
  </p>
</form>

<?php include '_foot.html.php'; ?>