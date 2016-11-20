<?php include '_head.html.php'; ?>

<form class="form-horizontal" action="" method="post">
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">Tytuł testu</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="title" name="title"
        placeholder="Tytuł testu">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="exams_group_id">Grupa testów</label>
    <div class="col-sm-10">
      <select id="exams_group_id" name="group_id" class="form-control">
        <option value=""></option>
        <?php foreach ($this->data['exams_groups'] as $key => $value): ?>
          <option value="<?=$value['id'];?>"><?=$value['title'];?></option>
        <?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="questions" class="col-sm-2 control-label">Liczba pytań</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="questions" name="questions"
      placeholder="Liczba pytań">
      <p class="text-muted">Całkowita liczba pytań. Pytania dodasz później.</p>
    </div>
  </div>
  <div class="form-group">
    <label for="threshold" class="col-sm-2 control-label">Próg zaliczenia</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="threshold" name="threshold"
      placeholder="Próg zaliczenia">
      <p class="text-muted">Liczba poprawnych odpowiedzi potrzebnych do zaliczenia testu.</p>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="add" class="btn btn-primary pull-right">Dodaj</button>
    </div>
  </div>
</form>

<?php include '_foot.html.php'; ?>