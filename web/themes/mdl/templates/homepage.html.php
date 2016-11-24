<?php include '_head.html.php'; ?>


<?php if (!empty($this->data['exams_groups'])): ?>
<div class="mdl-grid">

<?php foreach ($this->data['exams_groups'] as $value): ?>

<div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp">
  <div class="mdl-card__title mdl-card--expand">
    <h3 class="mdl-card__title-text"><?=$value['title'];?></h3>
  </div>
  <div class="mdl-card__supporting-text"><?=$value['description'];?></div>
  <div class="mdl-card__actions mdl-card--border">
    <a href="<?=$this->dir();?>/group/<?=$value['id'];?>"
        class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Zobacz testy
    </a>
  </div>
</div>

<?php endforeach; ?>

</div>
<?php endif; ?>

<?php include '_foot.html.php'; ?>