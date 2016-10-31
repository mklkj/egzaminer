<?php include '_head.html.php'; ?>

<div class="page-header">
  <h1><?=$this->data['test-check']['test']['title'];?></h1>
</div>

<div class="alert alert-<?=($this->data['test-check']['stats']['results']['pass']) ? 'success' : 'danger';?>" role="alert">
    <h2><?=($this->data['test-check']['stats']['results']['pass']) ? 'Zdałeś!' : 'Nie udało ci się zdać!'; ?></h2>
    <p>Uzyskałeś <?=$this->data['test-check']['stats']['results']['percentages'];?>%.</p>
    <p>Próg zaliczenia to <?=$this->data['test-check']['stats']['results']['threshold'];?>%.</p>
</div>

<form>

  <?php foreach ($this->data['test-check']['questions'] as $key => $question):
    $questionIDFromUser = isset($this->data['test-check']['stats']['answers'][$question['id']])
        ? $this->data['test-check']['stats']['answers'][$question['id']] : null;
  ?>
  <div class="question panel panel-default">
    <div class="panel-heading">
        <b><?=$key + 1;?>.</b> <?=$question['content'];?>
    </div>

    <?php if ($question['correct'] === $questionIDFromUser): ?>
    <div class="panel-body bg-success">
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        Twoja odpowiedź jest poprawna!
    </div>
    <?php elseif (null === $questionIDFromUser):?>
    <div class="panel-body bg-warning">
        <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
        Nie udzielono odpowiedzi
    </div>
    <?php elseif ($question['correct'] !== $questionIDFromUser):?>
    <div class="panel-body bg-danger">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        Zła odpowiedź!
    </div>
    <?php endif;?>

    <ul class="list-group">
       <?php foreach ($this->data['test-check']['answers'][$question['id']] as $key => $answer):
        $answerID = $answer['id'];
       ?>
        <li class="list-group-item list-group-item-<?php
            if ($answerID === $question['correct']) {
                echo 'success';
            } elseif ($answerID === $questionIDFromUser) {
                echo 'danger';
            }
          ?>">
          <input type="radio" name="question_<?=$question['id'];?>" value="<?=$answerID;?>" id="answer_<?=$answerID;?>" <?=($answerID === $questionIDFromUser) ? 'checked' : '';?> disabled>
          <label for="answer_<?=$answerID;?>">
            <?=$answer['content'];?>
          </label>
        </li>
       <?php endforeach; ?>
    </ul>
  </div>
  <?php endforeach; ?>

</form>

<?php include '_foot.html.php'; ?>