<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Hash generator</title>
    <link rel="stylesheet" href="web/bower_components/bootstrap/dist/css/bootstrap.min.css">
  </head>
  <body>
    <section class="container">
      <div class="page-header">
        <h1>Generate your password hash</h1>
      </div>
      <form action="" method="post" class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-12">
            <input type="password" class="form-control" name="password"
            value="<?=$_POST['password'];?>" autofocus required>
          </div>
        </div>
        <button class="btn btn-primary" name="submit">Generate!</button>
      </form>
      <?php if (isset($_POST['password'])): ?>
        <hr>
        <input type="text" class="form-control"
          value="<?=password_hash($_POST['password'], PASSWORD_DEFAULT);?>">
        <p class="text-muted">It's never be the same.</p>
      <?php endif ?>
    </section>
  </body>
</html>