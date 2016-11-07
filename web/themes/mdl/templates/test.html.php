<?php include '_head.html.php'; ?>

<form action="" method="post">
  <?php foreach ($this->data['test']['questions'] as $key => $question): ?>

  <div class="mdl-cell mdl-cell--12-col mdl-shadow--4dp">
    <div class="mdl-grid">

      <div class="mdl-cell mdl-cell--<?=($question['image'])?'6':'12';?>-col">
        <p>
          <b><?=$key + 1;?>.</b> <?=$question['content'];?>
        </p>

        <div class="mdl-card__supporting-text no-padding">
          <?php foreach ($this->data['test']['answers'][$question['id']] as $key => $answer): ?>
            <p>
              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect"
                for="answer_<?=$answer['id'];?>">
                <input type="radio" id="answer_<?=$answer['id'];?>"
                  class="mdl-radio__button" name="question_<?=$question['id'];?>"
                  value="<?=$answer['id'];?>">
                <span class="mdl-radio__label">
                  <?=$this->escape($answer['content']);?>
                </span>
              </label>
            </p>
          <?php endforeach; ?>
        </div>
      </div>

      <?php if ($question['image']): ?>
        <div class="mdl-cell mdl-cell--6-col">
          <img src="<?=$this->dir().'/storage/'.$question['id'].'_'
            .$question['image'];?>" class="img-responsive">
        </div>
      <?php endif ?>
    </div>

  </div>

<?php endforeach; ?>
  <div class="mdl-grid">
    <input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" name="send" value="Sprawdź odpowiedzi">
  </div>
</form>

<?php include '_foot.html.php'; ?>