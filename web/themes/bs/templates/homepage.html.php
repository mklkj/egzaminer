<?php include '_head.html.php'; ?>


<?php if (!empty($this->data['groups'])): ?>
<div class="row">

<?php foreach ($this->data['groups'] as $value): ?>

<div class="col-md-4">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?=$value['title'];?></h3>
    </div>
    <div class="panel-body"><?=$value['description'];?></div>
    <div class="panel-footer">
      <a href="<?=$this->dir();?>/group/<?=$value['id'];?>" class="btn btn-primary">
        Zobacz testy
      </a>
    </div>
  </div>
</div>

<?php endforeach; ?>

</div>
<?php endif; ?>

<?php include '_foot.html.php'; ?>