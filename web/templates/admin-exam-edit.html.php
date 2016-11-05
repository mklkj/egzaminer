<?php include '_head.html.php'; ?>

<a href="<?=$this->dir();?>/admin/test/add" class="btn btn-default">
  Dodaj nowy test
</a>

<form class="form-horizontal" action="" method="post">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="edit" class="btn btn-primary pull-right">Zapisz</button>
    </div>
  </div>
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">Tytuł testu</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="title" name="title"
        placeholder="Tytuł testu" value="<?=$this->data['test-edit']['test']['title'];?>">
    </div>
  </div>
  <div class="form-group">
    <label for="questions" class="col-sm-2 control-label">Liczba pytań</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="questions" name="questions"
      placeholder="Liczba pytań" value="<?=$this->data['test-edit']['test']['questions'];?>">
      <p class="text-muted">Całkowita liczba pytań.</p>
    </div>
  </div>
  <div class="form-group">
    <label for="threshold" class="col-sm-2 control-label">Próg zaliczenia</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="threshold" name="threshold"
      placeholder="Próg zaliczenia" value="<?=$this->data['test-edit']['test']['threshold'];?>">
      <p class="text-muted">Liczba poprawnych odpowiedzi potrzebnych do zaliczenia testu.</p>
    </div>
  </div>

  <hr>
  <a href="<?=$this->dir();?>/admin/test/edit/<?=$this->data['test-edit']['test']['id'];?>/question/add" class="btn btn-success">Dodaj pytanie</a>
  <hr>

  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>ID</th>
          <th>ID poprawnej odpowiedzi</th>
          <th>treść pytania</th>
          <th>akcje</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($this->data['test-edit']['questions'] as $qkey => $question): $qkey++; ?>
        <tr>
          <th><?=$qkey;?></th>
          <td><?=$question['id'];?></td>
          <td><?=$question['correct'];?></td>
          <td><?=$question['content'];?></td>
          <td>
            <a href="<?=$this->dir();?>/admin/test/edit/<?=$this->data['test-edit']['test']['id'];?>/question/edit/<?=$question['id'];?>" class="btn btn-xs">
              <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edytuj
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="edit" class="btn btn-primary pull-right">Zapisz</button>
    </div>
  </div>
</form>

<?php include '_foot.html.php'; ?>