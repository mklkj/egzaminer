<?php include '_head.html.php'; ?>

<form class="form-horizontal" action="" enctype="multipart/form-data" method="post">

  <a href="<?=$this->dir();?>/admin/test/edit/<?=$this->testId;?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
    Wróć do edycji testu
  </a>

  <?php if (isset($this->templateType) and 'edit' === $this->templateType): ?>
  <a href="<?=$this->dir();?>/admin/test/edit/<?=$this->testId;?>/question/add"
  class="mdl-button mdl-js-button mdl-button--accent mdl-button--raised mdl-js-ripple-effect">
    Dodaj nowe pytanie
  </a>
  <?php endif ?>
  <button type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--colored mdl-button--raised mdl-js-ripple-effect">Zapisz</button>

  <div class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" name="question[content]" type="text"
      rows= "3" id="question" ><?=$this->escape($this->data['question']['content']);?></textarea>
    <label class="mdl-textfield__label" for="question">Pytanie</label>
  </div>

  <?php foreach ($this->data['answers'] as $key => $answer): $key++; ?>

      <label class="col-sm-2 control-label" for="answer_<?=$key;?>">
        Odpowiedź <?=$key;?>.
      </label>

<p>
  <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect"
    for="answer_<?=$answer['id'];?>">

    <input type="radio" id="answer_<?=$answer['id'];?>"
      class="mdl-radio__button" name="question[correct]"
      value="<?=$answer['id'];?>"
      <?=($this->data['question']['correct'] === $answer['id']) ? 'checked' : '';?>
    >

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="answer_<?=$key;?>" name="answers[<?=$answer['id'];?>]" value="<?=$this->escape($answer['content']);?>">
      <label class="mdl-textfield__label" for="answer_<?=$key;?>">Treść odpowiedzi</label>
    </div>
  </label>
</p>

  <?php endforeach; ?>

<?php if (isset($this->templateType) and 'edit' === $this->templateType): ?> 
  <hr>


    <label class="col-sm-2 control-label">Miniatura</label>

      <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
      <p><input name="image" type="file"></p>

      <?php if ($this->data['question']['image']): ?>
        <label>
          <input type="checkbox" name="question[delete-img]" value="1">
          Usuń obrazek
        </label>
      <?php endif; ?>

      <?php if ($this->data['question']['image']): ?> 
      <a href="<?=$this->dir().'/storage/'.$this->id.'_'
        .$this->data['question']['image'];?>" target="_blank">
        <img src="<?=$this->dir().'/storage/'.$this->id.'_'
        .$this->data['question']['image'];?>"
        class="img-responsive" alt="obrazek do pytania">
      </a>
      <?php endif; ?>

<?php endif; ?>

</form>

<?php include '_foot.html.php'; ?>