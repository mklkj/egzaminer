<?php include '_head.html.php'; ?>

<a href="<?=$this->dir();?>/admin/test/add" class="btn btn-default">Dodaj test</a>

<hr>

<?php if (!empty($this->data['exams_list'])): ?>

<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Nazwa testu</th>
        <th>Liczba pytań</th>
        <th>Akcje</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($this->data['exams_list'] as $key => $value): ?>
        <tr>
          <td><?=++$key;?></td>
          <td>
            <a href="<?=$this->dir();?>/test/<?=$value['id'];?>" title="zobacz test">
              <?=$value['title'];?>
            </a>
          </td>
          <td><?=$value['questions'];?></td>
          <td>
            <a href="<?=$this->dir();?>/admin/test/edit/<?=$value['id'];?>" class="btn btn-xs btn-primary">
              <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edytuj
            </a>
            <a href="<?=$this->dir();?>/admin/test/del/<?=$value['id'];?>" class="btn btn-xs btn-danger">
              <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Usuń
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php else: ?>
<div class="alert alert-info">Brak testów do wyświetlenia!</div>
<?php endif;?>

<?php include '_foot.html.php'; ?>