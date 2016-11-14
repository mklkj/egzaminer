<?php include '_head.html.php'; ?>

<?php if (!empty($this->data['exams-group'])): ?>

<ul class="mdl-list">
<?php foreach ($this->data['exams-group'] as $key => $value): ?>
  <li class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
      <a href="<?=$this->dir();?>/test/<?=$value['id'];?>"><?=$value['title'];?></a>
    </span>
  </li>
<?php endforeach; ?>
</ul>

<?php else: ?>
<div class="alert alert--info mdl-shadow--2dp">
    <p>Brak testów do wyświetlenia!</p>
</div>
<?php endif;?>

<?php include '_foot.html.php'; ?>