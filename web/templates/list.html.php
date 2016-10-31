<?php include '_head.html.php'; ?>

<div class="page-header">
	<h1>Testy</h1>
</div>

<?php if (!empty($this->data['tests_list'])): ?>
<ul>
<?php foreach ($this->data['tests_list'] as $key => $value): ?>
  <li><a href="./test/<?=$value['id'];?>"><?=$value['title'];?></a> - <?=$value['questions'];?> pytań</li>
<?php endforeach; ?>
</ul>
<?php else: ?>
<div class="alert alert-info">Brak testów do wyświetlenia!</div>
<?php endif;?>

<?php include '_foot.html.php'; ?>