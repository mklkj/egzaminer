<?php include '_head.html.php'; ?>

<div class="mdl-shadow--4dp alert alert--big alert--<?=($this->data['test-check']['stats']['results']['pass']) ? 'success' : 'danger';?>" role="alert">
    <h3><?=($this->data['test-check']['stats']['results']['pass']) ? 'Zdałeś!' : 'Nie udało ci się zdać!'; ?></h3>
    <p>
      Uzyskałeś <?=$this->data['test-check']['stats']['results']['percentages'];?>%
      (próg zaliczenia to <?=$this->data['test-check']['stats']['results']['threshold'];?>%).
    </p>
    <p>
      Twój wynik punktowy to: <?=$this->data['test-check']['stats']['results']['correct'];?>/<?=$this->data['test-check']['test']['questions'];?>
    </p>
</div>

<form>
  <?php foreach ($this->data['test-check']['questions'] as $key => $question):
    $questionIDFromUser = isset($this->data['test-check']['stats']['answers'][$question['id']])
        ? $this->data['test-check']['stats']['answers'][$question['id']] : null;
  ?>

  <div class="mdl-cell mdl-cell--12-col mdl-shadow--4dp">
    <div class="mdl-grid">

      <div class="mdl-cell mdl-cell--<?=($question['image'])?'6':'12';?>-col">
        <div class="paragraph">
          <b><?=$key + 1;?>.</b> <?=$question['content'];?>
        </div>

        <?php if ($question['correct'] === $questionIDFromUser): ?>
        <div class="alert alert--success">
            <i class="material-icons">check</i>
            <span>Twoja odpowiedź jest poprawna!</span>
        </div>
        <?php elseif (null === $questionIDFromUser):?>
        <div class="alert alert--warning">
            <i class="material-icons">warning</i>
            <span>Nie udzielono odpowiedzi</span>
        </div>
        <?php elseif ($question['correct'] !== $questionIDFromUser):?>
        <div class="alert alert--danger">
            <i class="material-icons">close</i>
            <span>Zła odpowiedź!</span>
        </div>
        <?php endif;?>

        <div class="mdl-card__supporting-text no-padding">
        <?php foreach ($this->data['test-check']['answers'][$question['id']] as $key => $answer): ?>

         <div class="paragraph">
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect"
              for="answer_<?=$answer['id'];?>">
              <input type="radio" id="answer_<?=$answer['id'];?>"
                class="mdl-radio__button" <?=($answer['id'] === $questionIDFromUser) ? 'checked' : '';?> disabled>
              <span class="mdl-radio__label <?php if ($answer['id'] === $question['correct']) {
                  echo 'alert__text--success';
                } elseif ($answer['id'] === $questionIDFromUser) {
                  echo 'alert__text--danger';
                } ?>">
                <?=$answer['content'];?>
              </span>
            </label>
          </div>

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

</form>

<?php include '_foot.html.php'; ?>