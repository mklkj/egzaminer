<?php include '_head.html.php'; ?>

<div class="page-header">
    <h1>Edycja testu</h1>
</div>

<?php if (isset($this->data['test-edit']['invalid'])): ?>
<div class="alert alert-danger">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  Coś wpisałeś nie poprawnie! Albo zepsuło się coś innego. Ale nie wiadomo co. Spróbuj jeszcze raz może.
</div>
<?php elseif(isset($this->data['test-edit']['valid'])): ?>
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  Udało się zrobić to, co chciałeś!
</div>
<?php endif; ?>

<form class="form-horizontal" action="" method="post">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="edit" class="btn btn-primary pull-right">Zapisz</button>
    </div>
  </div>
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">Tytuł testu</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="title" name="test[title]"
        placeholder="Tytuł testu" value="<?=$this->data['test-edit']['test']['title'];?>">
    </div>
  </div>
  <div class="form-group">
    <label for="questions" class="col-sm-2 control-label">Liczba pytań</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="questions" name="test[questions]"
      placeholder="Liczba pytań" value="<?=$this->data['test-edit']['test']['questions'];?>">
      <p class="text-muted">Całkowita liczba pytań. By dodać pytania do testu, zwiększ najpierw tą wartość.</p>
    </div>
  </div>
  <div class="form-group">
    <label for="threshold" class="col-sm-2 control-label">Próg zaliczenia</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="threshold" name="test[threshold]"
      placeholder="Próg zaliczenia" value="<?=$this->data['test-edit']['test']['threshold'];?>">
      <p class="text-muted">Liczba poprawnych odpowiedzi potrzebnych do zaliczenia testu.</p>
    </div>
  </div>

  <hr>

  <?php foreach ($this->data['test-edit']['questions'] as $qkey => $question): $qkey++; ?>
  <div class="form-group">

    <label
      class="col-sm-2 control-label"
      for="question_id-<?=$question['id'];?>_order-<?=$qkey;?>"
    >
      Pytanie <?=$qkey;?>.
    </label>

    <div class="col-sm-10">
      <input
        class="form-control"
        id="question_id-<?=$question['id'];?>_order-<?=$qkey;?>"
        name="questions[<?=$question['id'];?>][content]"
        placeholder="Pytanie <?=$qkey;?>."
        value="<?=$question['content'];?>"
        type="text"
      >
    </div>
  </div>

  <?php foreach ($this->data['test-edit']['answers'][$question['id']] as $akey => $answer): $akey++; ?>
    <div class="form-group">

      <label
        class="col-sm-2 control-label"
        for="answer_<?=$answer['id'];?>_<?=$akey;?>"
      >
        Odpowiedź <?=$akey;?>.
      </label>

      <div class="col-sm-1">
        <input
          class="form-control"
          id="question_answer_<?=$question['id'];?>_<?=$qkey;?>"
          name="questions[<?=$question['id'];?>][correct]"
          type="radio"
          value="<?=$answer['id'];?>"
          <?=($question['correct'] === $answer['id']) ? 'checked' : '';?>
        >
      </div>

      <div class="col-sm-9">
        <input
          class="form-control"
          id="answer_<?=$answer['id'];?>_<?=$akey;?>"
          name="answers[<?=$answer['id'];?>]"
          placeholder="Odpowiedź <?=$akey;?>."
          type="text"
          value="<?=$answer['content'];?>"
        >
      </div>
    </div>
    <?php endforeach; ?>

  <hr>
  <?php endforeach; ?>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="edit" class="btn btn-primary pull-right">Zapisz</button>
    </div>
  </div>
</form>

<?php include '_foot.html.php'; ?>