<?php include '_head.html.php'; ?>

<form action="" method="post">
  <?php foreach ($this->data['test']['questions'] as $key => $question): ?>
  <div class="question panel panel-default">
    <div class="panel-heading">
      <b><?=$key + 1;?>.</b> <?=$question['content'];?> 
    </div>
    <?php if ($question['image']): ?>
    <div class="panel-body">
      <img src="<?=$this->dir().'/storage/'.$question['id'].'_'
        .$question['image'];?>" class="img-responsive">
    </div>
    <?php endif ?>
     <ul class="list-group">
       <?php foreach ($this->data['test']['answers'][$question['id']] as $key => $answer): ?> 
        <li class="list-group-item">
          <input type="radio" name="question_<?=$question['id'];?>" value="<?=$answer['id'];?>" id="answer_<?=$answer['id'];?>">
          <label for="answer_<?=$answer['id'];?>">
            <?=$this->escape($answer['content']);?> 
          </label>
        </li>
       <?php endforeach; ?> 
    </ul>
  </div>
  <?php endforeach; ?> 

  <input type="submit" class="btn btn-primary pull-right" name="send" value="Sprawdź odpowiedzi">
</form>

<?php include '_foot.html.php'; ?>