<?php include '_head.html.php'; ?>

<a href="<?=$this->dir();?>/admin/test/add"
  class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  <i class="material-icons">add</i>
  Dodaj test
</a>

<hr>

<?php if (!empty($this->data['tests_list'])): ?>

<div class="table--responsive">
  <table class="mdl-data-table table--conensed mdl-js-data-table mdl-shadow--2dp">
    <thead>
      <tr>
        <th>#</th>
        <th>Nazwa testu</th>
        <th>Liczba pytań</th>
        <th>Akcje</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($this->data['tests_list'] as $key => $value): ?>
        <tr>
          <td><?=++$key;?></td>
          <td>
            <a href="<?=$this->dir();?>/test/<?=$value['id'];?>" title="zobacz test">
              <?=$value['title'];?>
            </a>
          </td>
          <td><?=$value['questions'];?></td>
          <td>
            <a href="<?=$this->dir();?>/admin/test/edit/<?=$value['id'];?>" class="mdl-button">
              <i class="material-icons">edit</i> Edytuj
            </a>
            <a href="<?=$this->dir();?>/admin/test/del/<?=$value['id'];?>" class="mdl-button">
              <i class="material-icons">delete</i> Usuń
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php else: ?>
<div class="alert alert--info">Brak testów do wyświetlenia!</div>
<?php endif;?>

<?php include '_foot.html.php'; ?>