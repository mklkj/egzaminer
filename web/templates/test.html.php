<?php include '_head.html.php'; ?>

<div class="page-header">
  <h1><?=$data['title'];?></h1>
</div>

<form action="" method="post">
  <?php foreach ($data['questions'] as $key => $question): ?>
  <div class="question panel panel-default">
    <div class="panel-heading">
      <b><?=$key + 1;?>.</b> <?=$question['content'];?> 
    </div>

     <ul class="list-group">
       <?php foreach ($data['answers'][$question['id']] as $key => $answer): ?> 
        <li class="list-group-item">
          <input type="radio" name="question_<?=$question['id'];?>" value="<?=$answer['id'];?>" id="answer_<?=$answer['id'];?>">
          <label for="answer_<?=$answer['id'];?>">
            <?=$answer['content'];?> 
          </label>
        </li>
       <?php endforeach; ?> 
    </ul>
  </div>
  <?php endforeach; ?> 

  <input type="submit" class="btn btn-primary pull-right" name="send" value="Sprawdź odpowiedzi">
</form>

<?php include '_foot.html.php'; ?>