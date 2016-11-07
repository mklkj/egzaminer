<?php include '_head.html.php'; ?>

<?php if (!empty($this->data['tests_list'])): ?>

<ul class="mdl-list">
<?php foreach ($this->data['tests_list'] as $key => $value): ?>
  <li class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
      <a href="./test/<?=$value['id'];?>"><?=$value['title'];?></a>
    </span>
  </li>
<?php endforeach; ?>
</ul>

<?php else: ?>
<p>Brak testów do wyświetlenia!</p>
<?php endif;?>

<?php include '_foot.html.php'; ?>