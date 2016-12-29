<?php include '_head.html.php'; ?>

<a href="<?=$this->dir();?>/admin/test/edit/<?=$this->testId;?>" class="btn btn-default">
  Wróć do edycji testu
</a>

<?php if (isset($this->templateType) and 'edit' === $this->templateType): ?>
<a href="<?=$this->dir();?>/admin/test/edit/<?=$this->testId;?>/question/add" class="btn btn-default">
  Dodaj nowe pytanie
</a>
<?php endif ?>

<form class="form-horizontal" action="" enctype="multipart/form-data" method="post">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-primary pull-right">Zapisz</button>
    </div>
  </div>

  <div class="form-group">

    <label class="col-sm-2 control-label" for="question">Pytanie</label>

    <div class="col-sm-10">
      <textarea name="question[content]" id="question" class="form-control"
      rows="2"><?=$this->escape($this->data['question']['content']);?></textarea>
    </div>
  </div>

  <?php foreach ($this->data['answers'] as $key => $answer): $key++; ?>
    <div class="form-group">

      <label class="col-sm-2 control-label" for="answer_<?=$key;?>">
        Odpowiedź <?=$key;?>.
      </label>

      <div class="col-sm-1">
        <input
          class="form-control"
          name="question[correct]"
          type="radio"
          value="<?=$answer['id'];?>"
          <?=($this->data['question']['correct'] === $answer['id']) ? 'checked' : '';?>
        >
      </div>

      <div class="col-sm-9">
        <input
          class="form-control"
          id="answer_<?=$key;?>"
          name="answers[<?=$answer['id'];?>]"
          placeholder="Odpowiedź <?=$key;?>."
          type="text"
          value="<?=$this->escape($answer['content']);?>"
        >
      </div>
    </div>
  <?php endforeach; ?>

<?php if (isset($this->templateType) and 'edit' === $this->templateType): ?> 
  <hr>

  <div class="form-group">

    <label class="col-sm-2 control-label">Miniatura</label>

    <div class="col-sm-3">
      <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
      <p><input name="image" type="file"></p>

      <?php if ($this->data['question']['image']): ?>
        <label>
          <input type="checkbox" name="question[delete-img]" value="1">
          Usuń obrazek
        </label>
      <?php endif; ?>
    </div>
    <div class="col-sm-7">
      <?php if ($this->data['question']['image']): ?> 
      <a href="<?=$this->dir().'/storage/'.$this->id.'_'
        .$this->data['question']['image'];?>" target="_blank">
        <img src="<?=$this->dir().'/storage/'.$this->id.'_'
        .$this->data['question']['image'];?>"
        class="img-responsive" alt="obrazek do pytania">
      </a>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>

</form>

<?php include '_foot.html.php'; ?>