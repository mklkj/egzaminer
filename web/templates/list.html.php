<?php include '_head.html.php'; ?>

<h1>Testy</h1>
<?php if (!empty($tests)): ?>
<ul>
<?php foreach ($tests as $key => $value): ?>
  <li><a href="./?test=<?=$value['id'];?>"><?=$value['title'];?></a> - <?=$value['questions'];?> pytań</li>
<?php endforeach; ?>
</ul>
<?php else: ?>
<div class="alert alert-info">Brak testów do wyświetlenia!</div>
<?php endif;?>

<?php include '_foot.html.php'; ?>