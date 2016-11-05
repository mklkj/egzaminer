<?php include '_head.html.php'; ?>

<form class="form-horizontal" action="<?=$this->dir();?>/admin/login" method="post">
  <div class="form-group">
    <label for="login" class="col-sm-2 control-label">Nazwa użytkownika</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="login" name="username" placeholder="Nazwa użytkownika">
    </div>
  </div>
  <div class="form-group">
    <label for="pass" class="col-sm-2 control-label">Hasło</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="pass" name="password" placeholder="Hasło">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="login" class="btn btn-primary">Zaloguj</button>
    </div>
  </div>
</form>

<?php include '_foot.html.php'; ?>